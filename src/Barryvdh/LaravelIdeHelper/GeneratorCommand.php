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
use Barryvdh\Reflection\DocBlock;
use Barryvdh\Reflection\DocBlock\Context;
use Barryvdh\Reflection\DocBlock\Tag;
use Barryvdh\Reflection\DocBlock\Serializer as DocBlockSerializer;
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
    protected $extra_nonstatic;
    protected $onlyExtend;
    protected $helpers;


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
            $this->extra_nonstatic = \Config::get('laravel-ide-helper::extra_nonstatic');

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

        $output = "<?php
/**
 * An helper file for Laravel 4, to provide autocomplete information to your IDE
 * Generated with https://github.com/barryvdh/laravel-ide-helper
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */
namespace {\n\tdie('Only to be used as an helper for your IDE');\n}\n\n";

        //Get all aliases
        $aliases = $aliasLoader->getAliases();

        foreach($aliases as $alias => $facade){

            $root = $this->getRoot($facade);
            if(!$root){
                continue;
            }

            try{

                //Some classes extend the facade
                if(class_exists($facade)){
                    $output .= "class $alias extends $facade{\n";
                }else{
                    $output .= "class $alias{\n";
                }

                $usedMethods = array();

                //Only add the methods to the output when the root is not the same as the facade.
                $addOutput = ($root !== $facade);
                $output .= $this->getMethods($root, $alias, $usedMethods, true, $addOutput);

                if(array_key_exists($alias, $this->extra_nonstatic)){
                    $output .=  $this->getMethods($this->extra_nonstatic[$alias], $alias, $usedMethods, true);
                }

                //Add extra methods, from other classes (magic static calls)
                if(array_key_exists($alias, $this->extra)){
                    $output .= $this->getMethods($this->extra[$alias], $alias, $usedMethods, false);
                }

                $output .= "}\n\n";

            }catch(\Exception $e){
                $this->error("Exception: ".$e->getMessage()."\nCould not analyze $root.");
            }

        }

        //Include the helper file, if requested
        if(!empty($helpers)){
            foreach($helpers as $helper){
                if (file_exists($helper)){
                    $output .= str_replace(array('<?php', '?>'), '', \File::get($helper));
                }
            }
        }

        return $output;
    }

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
    protected function getMethods($classes, $alias, &$usedMethods, $static=true, $addOutput = true){
        if(!is_array($classes)){
            $classes = array($classes);
        }
        $output = '';
        foreach($classes as $class){
            if(!class_exists($class) && !interface_exists($class)){
                continue;
            }
            $reflection = new \ReflectionClass($class);

            $methods = $reflection->getMethods();
            if($methods)
            {
                foreach ($methods as $method)
                {
                    if(!in_array($method->name, $usedMethods)){
                        if($method->isPublic() && $addOutput){
                            $output .= $this->parseMethod($method, $alias, $static);
                        }
                        $usedMethods[] = $method->name;
                    }
                }
            }
        }
        return $output;
    }
    /**
     * @param \ReflectionMethod $method
     * @param string $alias
     * @param string $root
     * @param bool $static
     * @param string $rootParam
     * @return string
     */
    protected function parseMethod($method, $alias, $static = true){
        $output = '';

        // Don't add the __clone() functions
        if($method->name === '__clone'){
            return $output;
        }

        $namespace = $method->getDeclaringClass()->getNamespaceName();

        //Create a DocBlock and serializer instance
        $phpdoc = new DocBlock($method, new Context($namespace));
        $serializer = new DocBlockSerializer(1, "\t");

        //Normalize the description and inherit the docs from parents/interfaces
        $this->normalizeDescription($phpdoc, $method);

        //Correct the return values
        $returnValue = $this->normalizeReturn($phpdoc, $method, $alias);

        //Get the parameters, including formatted default values
        list($params, $paramsWithDefault) = $this->getParameters($method);

        //Make the method static
        $phpdoc->appendTag(Tag::createInstance('@static', $phpdoc));

        //Write the output, using the DocBlock serializer
        $output .= $serializer->getDocComment($phpdoc) ."\n\t public ".($static ? 'static ' : '')."function ".$method->name."(";

        $output .= implode($paramsWithDefault, ", ");
        $output .= "){\r\n";

        //Only return when not a constructor and not void.
        $return = ($returnValue && $returnValue !== "void" && $method->name !== "__construct") ? 'return' : '';

        //Reference the 'real' function in the declaringclass
        $root = $method->getDeclaringClass()->getName();
        $output .=  "\t\t$return \\$root::";

        //Write the default parameters in the function call
        $output .=  $method->name."(".implode($params, ", ").");\r\n";
        $output .= "\t }\n\n";

        return $output;
    }

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

    protected function normalizeReturn(&$phpdoc, $method, $alias){
        //Get the return type and adjust them for beter autocomplete
        $returnTags = $phpdoc->getTagsByName('return');
        if($returnTags){
            /** @var  $tag */
            $tag = reset($returnTags);
            $returnValue = $tag->getType();

            if($method->name == "__construct"){
                $tag->setType('self');
            }elseif($alias == 'Eloquent' and
                (in_array($method->name, array('pluck', 'first', 'fill', 'newInstance', 'newFromBuilder', 'create', 'find', 'findOrFail'))
                    or $returnValue === '\Illuminate\Database\Query\Builder')){
                //Reference the calling class, to provide more accurate auto-complete
                $tag->addType('static');
            }elseif($alias == 'Eloquent' and in_array($method->name, array('all', 'get'))){
                $tag->addType('\Eloquent[]');
                $tag->addType('static[]');
            }elseif($alias == 'Eloquent' and in_array($method->name, array('hasOne', 'hasMany', 'belongsTo', 'belongsToMany', 'morphOne', 'morphTo', 'morphMany'))){
                $tag->addType('\Eloquent');
            }
        }else{
            $returnValue = null;
        }
        return $returnValue;
    }

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
