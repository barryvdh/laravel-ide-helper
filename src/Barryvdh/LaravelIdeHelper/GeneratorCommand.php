<?php
/**
 * Laravel IDE Helper Generator
 *
 * @author    Barry vd. Heuvel <barryvdh@gmail.com>
 * @copyright 2013 Barry vd. Heuvel / Fruitcake Studio (http://www.fruitcakestudio.nl)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/barryvdh/laravel-ide-helper
 */

namespace Barryvdh\LaravelIdeHelper;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Foundation\AliasLoader;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Context;
use phpDocumentor\Reflection\DocBlock\Tag;
use phpDocumentor\Reflection\DocBlock\Serializer as DocBlockSerializer;
/**
 * A command to generate autocomplete information for your IDE
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */
class GeneratorCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ide-helper:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new IDE Helper file.';

    protected $extra;
    protected $onlyExtend;
    protected $helpers;
    protected $magic;


    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (file_exists($compiled = base_path().'/bootstrap/compiled.php')){
            $this->error('Error generating IDE Helper: first delete bootstrap/compiled.php (php artisan clear-compiled)');
        }else{
            $filename = $this->argument('filename');
    
            if($this->option('memory')){
                $this->useMemoryDriver();
            }
    
            $this->extra = \Config::get('laravel-ide-helper::extra');
            $this->magic = \Config::get('laravel-ide-helper::magic');

            if( $this->option('helpers') || (\Config::get('laravel-ide-helper::include_helpers') )){
                $this->helpers = \Config::get('laravel-ide-helper::helper_files');
            }else{
                $this->helpers = array();
            }

            $content = $this->generateDocs();
    
            $written = \File::put($filename, $content);
    
            if($written !== false){
                $this->info("A new helper file was written to $filename");
            }else{
                $this->error("The helper file could not be created at $filename");
            }
        }    
    }

    protected function useMemoryDriver(){
        //Use a sqlite database in memory, to avoid connection errors on Database facades
        \Config::set('database.connections.sqlite',array(
                'driver'   => 'sqlite',
                'database' => ':memory:',
            ));
        \Config::set('database.default', 'sqlite');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('filename', InputArgument::OPTIONAL, 'The path to the helper file', \Config::get('laravel-ide-helper::filename')),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('helpers', "H", InputOption::VALUE_NONE, 'Include the helper files'),
            array('memory', "M", InputOption::VALUE_NONE, 'Use sqlite memory driver'),
            array('sublime', "S", InputOption::VALUE_NONE, 'DEPRECATED: Use different style for SublimeText CodeIntel'),
        );
    }

    /**
     * Generate the docs for all facades in the AliasLoader
     *
     * @return string
     */
    protected function generateDocs(){

        $aliasLoader = AliasLoader::getInstance();

        $outputString = "<?php
/**
 * An helper file for Laravel 4, to provide autocomplete information to your IDE
 * Generated with https://github.com/barryvdh/laravel-ide-helper
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */\n\n";
        $output['__root'] = "\texit('Only to be used as an helper for your IDE');\n\n";

        //Get all aliases
        $aliases = $aliasLoader->getAliases();

        foreach($aliases as $alias => $facade){
            //Check if the facade is not a Trait (could need a better check..)
            if(\Str::contains($facade, 'Trait')){
                continue;
            }
            $facade = '\\'.ltrim($facade, '\\');
            $root = $this->getRoot($facade);
            if(!$root){
                continue;
            }

            try{
                if (strpos($alias, '\\')){
                    $nsParts = explode('\\', $alias);
                    $alias = array_pop($nsParts);
                    $ns = implode('\\', $nsParts);
                } else {
                    $ns = '__root';
                }
                if (!isset($output[$ns])) $output[$ns] = '';

                //Some classes extend the facade
                if(interface_exists($facade)){
                    $output[$ns] .= "\tinterface $alias extends $facade{\n";
                }elseif(class_exists($facade)){
                    $output[$ns] .= "\tclass $alias extends $facade{\n";
                }else{
                    $output[$ns] .= "\tclass $alias{\n";
                }

                $usedMethods = array();

                //Only add the methods to the output when the root is not the same as the facade.
                $addOutput = ($root !== $facade);
                $output[$ns] .= $this->getMethods($root, $alias, $usedMethods, $addOutput);


                $driver =  $this->getDriver($alias);
                if($driver){
                    $output[$ns] .= $this->getMethods($driver, $alias, $usedMethods);
                }

                //Add extra methods, from other classes (magic static calls)
                if(array_key_exists($alias, $this->extra)){
                    $output[$ns] .= $this->getMethods($this->extra[$alias], $alias, $usedMethods);
                }

                //Add extra methods, from other classes (magic static calls)
                if(array_key_exists($alias, $this->magic)){
                    $output[$ns] .= $this->addMagicMethods($this->magic[$alias], $alias, $usedMethods);
                }


                $output[$ns] .= "\t}\n";

            }catch(\Exception $e){
                $this->error("Exception: ".$e->getMessage()."\nCould not analyze $root.");
            }

        }
        
        //Include the helper file, if requested
        if(!empty($this->helpers)){
            foreach($this->helpers as $helper){
                if (file_exists($helper)){
                    $output['__root'] .= str_replace(array('<?php', '?>'), '',  \File::get($helper));
                }
            }
        }

        foreach ($output as $ns => $body){
            if ($ns == '__root'){
                $ns = '';
            }
            $outputString .= "namespace $ns{\n";
            $outputString .= $body;
            $outputString .= "}\n\n";
        }

        return $outputString;
    }

    /**
     * Get the real root of a facade
     *
     * @param $facade
     * @return bool|string
     */
    protected function getRoot($facade){
        try{
            //If possible, get the facade root
            if(method_exists($facade, 'getFacadeRoot')){
                $root = get_class($facade::getFacadeRoot());
            }else{
                $root = $facade;
            }

            //If it doesn't exist, skip it
            if(!class_exists($root) && !interface_exists($root)){
                $this->error("Class $root is not found.");
                return false;
            }

            return $root;

            //When the database connection is not set, some classes will be skipped
        }catch(\PDOException $e){
            $this->error("PDOException: ".$e->getMessage()."\nPlease configure your database connection correctly, or use the sqlite memory driver (-M). Skipping $facade.");
            return false;
        }catch(\Exception $e){
            $this->error("Exception: ".$e->getMessage()."\nSkipping $facade.");
            return false;
        }

    }

    /**
     * Get the driver/connection/store from the managers
     *
     * @param $alias
     * @return array|bool|string
     */
    public function getDriver($alias){
        try{
            if($alias == "Auth"){
                $driver = \Auth::driver();
            }elseif($alias == "DB"){
                $driver = \DB::connection();
            }elseif($alias == "Cache"){
                $driver = get_class(\Cache::driver());
                $store = get_class(\Cache::getStore());
                return array($driver, $store);
            }elseif($alias == "Queue"){
                $driver = \Queue::connection();
            }else{
                return false;
            }

            return get_class($driver);
        }catch(\Exception $e){
            $this->error("Could not determine driver/connection for $alias.");
            return false;
        }
    }

    /**
     * Get the methods for one or multiple classes.
     *
     * @param $classes
     * @param $alias
     * @param $usedMethods
     * @param bool $addOutput
     * @return string
     */
    protected function getMethods($classes, $alias, &$usedMethods, $addOutput = true){
        if(!is_array($classes)){
            $classes = array($classes);
        }
        $output = '';
        foreach($classes as $class){
            if(!class_exists($class) && !interface_exists($class)){
                continue;
            }
            $reflection = new \ReflectionClass($class);

            $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
            if($methods)
            {
                foreach ($methods as $method)
                {
                    if(!in_array($method->name, $usedMethods)){
                        if( $addOutput){
                            $output .= $this->parseMethod($method, $alias, $reflection);
                        }
                        $usedMethods[] = $method->name;
                    }
                }
            }
        }
        return $output;
    }

    /**
     * Get the methods for one or multiple magic methods.
     *
     * @param $methods
     * @param $alias
     * @param $usedMethods
     * @param bool $addOutput
     * @return string
     */
    protected function addMagicMethods($methods, $alias, &$usedMethods, $addOutput = true){
        $output = '';
        foreach($methods as $magic => $real){
            list($className, $name) = explode('::', $real);
            if(!class_exists($className) && !interface_exists($className)){
                continue;
            }
            $method = new \ReflectionMethod($className, $name);
            $class = new \ReflectionClass($className);

            if(!in_array($method->name, $usedMethods)){
                if( $addOutput){
                    $output .= $this->parseMethod($method, $alias, $class, $magic);
                }
                $usedMethods[] = $method->name;
            }


            $usedMethods[] = $magic;

        }
        return $output;
    }

    /**
     * @param \ReflectionMethod $method
     * @param string $alias
     * @param $class
     * @param null $methodName
     * @return string
     */
    protected function parseMethod($method, $alias, $class, $methodName = null){
        $output = '';

        // Don't add the __clone() functions
        if($method->name === '__clone'){
            return $output;
        }
        $methodName = $methodName ?: $method->name;

        $namespace = $method->getDeclaringClass()->getNamespaceName();

        //Create a DocBlock and serializer instance
        $phpdoc = new DocBlock($method, new Context($namespace));
        $serializer = new DocBlockSerializer(1, "\t\t");

        //Normalize the description and inherit the docs from parents/interfaces
        try{
            $this->normalizeDescription($phpdoc, $method);
        }catch(\Exception $e){
            $this->info("Cannot normalize method $alias::$methodName..");
        }

        //Correct the return values
        $returnValue = $this->getReturn($phpdoc);

        //Get the parameters, including formatted default values
        list($params, $paramsWithDefault) = $this->getParameters($method);

        //Make the method static
        $phpdoc->appendTag(Tag::createInstance('@static', $phpdoc));

        //Write the output, using the DocBlock serializer
        $output .= $serializer->getDocComment($phpdoc) ."\n\t\t public static function ".$methodName."(";

        $output .= implode($paramsWithDefault, ", ");
        $output .= "){\n";

        //Only return when not a constructor and not void.
        $return = ($returnValue && $returnValue !== "void" && $method->name !== "__construct") ? 'return' : '';

        //Reference the 'real' function in the declaringclass
        $declaringClass = $method->getDeclaringClass();
        $declaringClassName = '\\'.ltrim($declaringClass->name, '\\');
        $root = '\\'.ltrim($class->getName(), '\\');

        if($declaringClass->name != $root){
            $output .= "\t\t\t//Method inherited from $declaringClassName\n";
        }

        $output .=  "\t\t\t$return $root::";

        //Write the default parameters in the function call
        $output .=  $method->name."(".implode($params, ", ").");\n";
        $output .= "\t\t }\n\n";

        return $output;
    }

    /**
     * Get the description and get the inherited docs.
     *
     * @param $phpdoc
     * @param $method
     */
    protected function normalizeDescription(&$phpdoc, $method){
        //Get the short + long description from the DocBlock
        $description = $phpdoc->getText();

        //Loop through parents/interfaces, to fill in {@inheritdoc}
        if(strpos($description, '{@inheritdoc}') !== false){
            $inheritdoc = $this->getInheritDoc($method);
            $inheritDescription = $inheritdoc->getText();

            $description = str_replace('{@inheritdoc}', $inheritDescription, $description);
            $phpdoc->setText($description);

            //Add the tags that are inherited
            $inheritTags = $inheritdoc->getTags();
            if($inheritTags){
                foreach($inheritTags as $tag){
                    $tag->setDocBlock();
                    $phpdoc->appendTag($tag);
                }
            }
        }
    }

    /**
     * Make some changes to the return types, if needed.
     *
     * @param $phpdoc
     * @return string|null
     */
    protected function getReturn($phpdoc){
        //Get the return type and adjust them for beter autocomplete
        $returnTags = $phpdoc->getTagsByName('return');
        if($returnTags){
            /** @var  $tag */
            $tag = reset($returnTags);
            $returnValue = $tag->getType();
        }else{
            $returnValue = null;
        }
        return $returnValue;
    }

    /**
     * Get the parameters and format them correctly
     *
     * @param $method
     * @return array
     */
    public function getParameters($method){
        //Loop through the default values for paremeters, and make the correct output string
        $params = array();
        $paramsWithDefault = array();
        foreach ($method->getParameters() as $param) {
            $paramStr = '$'.$param->getName();
            $params[] = $paramStr;
            if ($param->isOptional()) {
                $default = $param->getDefaultValue();
                if(is_bool($default)){
                    $default = $default? 'true':'false';
                }elseif(is_array($default)){
                    $default = 'array()';
                }elseif(is_null($default)){
                    $default = 'null';
                }elseif(is_int($default)){
                    //$default = $default;
                }else{
                    $default = "'".trim($default)."'";
                }
                $paramStr .= " = $default";
            }
            $paramsWithDefault[] = $paramStr;
        }
        return array($params, $paramsWithDefault);
    }

    /**
     * @param \ReflectionMethod $reflectionMethod
     * @return string
     */
    protected function getInheritDoc($reflectionMethod){
        $parentClass = $reflectionMethod->getDeclaringClass()->getParentClass();

        //Get either a parent or the interface
        if($parentClass){
            $method = $parentClass->getMethod($reflectionMethod->getName());
        }else{
            $method = $reflectionMethod->getPrototype();
        }
        if($method){
            $phpdoc = new DocBlock($method);
            if(strpos($phpdoc->getText(), '{@inheritdoc}') !== false ){
                //Not at the end yet, try another parent/interface..
                return $this->getInheritDoc($method);
            }else{
                return $phpdoc;
            }
        }
    }

}
