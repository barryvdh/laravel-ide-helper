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
    protected $nonstatic;
    protected $onlyExtend;
    protected $helpers;
    protected $sublime;


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
            $this->nonstatic = \Config::get('laravel-ide-helper::nonstatic');
            $this->onlyExtend = \Config::get('laravel-ide-helper::only_extend');
    
            if( $this->option('helpers') || (\Config::get('laravel-ide-helper::include_helpers') && ! $this->option('nohelpers'))){
                $this->helpers = \Config::get('laravel-ide-helper::helper_files');
            }else{
                $this->helpers = array();
            }
    
            $this->sublime = $this->option('sublime') || \Config::get('laravel-ide-helper::sublime');
    
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
            array('sublime', "S", InputOption::VALUE_NONE, 'Use different style for SublimeText CodeIntel'),
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

        $aliases = $aliasLoader->getAliases();

        foreach($aliases as $alias => $facade){

            try{
                if(method_exists($facade, 'getFacadeRoot')){
                    $root = get_class($facade::getFacadeRoot());
                }else{
                    $root = $facade;
                }

                if(!class_exists($root) && !interface_exists($root)){
                    $this->error("Class $root is not found.");
                    continue;
                }
            }catch(\PDOException $e){
                $this->error("PDOException: ".$e->getMessage()."\nPlease configure your database connection correctly, or use the sqlite memory driver (-M). Skipping $facade.");
                continue;
            }catch(\Exception $e){
                $this->error("Exception: ".$e->getMessage()."\nSkipping $facade.");
                continue;
            }

            if(strpos($alias, '\\') !== false){
                $parts = explode('\\', $alias);
                $alias = array_pop($parts);
                $namespace = implode($parts, '\\');
            }else{
                $namespace = '';
            }

            try{
                $reflection = new \ReflectionClass($root);

                $output .= "namespace $namespace {\n";

                if($root !== $facade or in_array($alias, $this->onlyExtend)){
                    //If the root class is not the same as the facade extend it.
                    $output .= " class $alias extends $facade{\n";
                }else{
                    $output .= " class $alias{\n";
                }
                $output .= "\t/**\n\t * @var \\$root \$root\n\t */\n\t static private \$root;\n\n";

                if(!in_array($alias, $this->onlyExtend))
                {
                    $usedMethods = array();
                    if(array_key_exists($alias, $this->nonstatic) ){
                        $nonstaticMethods = $this->nonstatic[$alias];
                    }else{
                        $nonstaticMethods = array();
                    }


                    $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
                    if($methods)
                    {
                        foreach ($methods as $method)
                        {
                            if(!in_array($method->name, $usedMethods)){
                                $static = !in_array($method->name, $nonstaticMethods);
                                $output .= $this->parseMethod($method, $alias, $root, $static);
                                $usedMethods[] = $method->name;
                            }
                        }
                    }

                    if(array_key_exists($alias, $this->extra)){
                        $i = 2;
                        foreach($this->extra[$alias] as $extraClass){
                            if(!class_exists($extraClass) && !interface_exists($extraClass)){
                                continue;
                            }
                            $reflection = new \ReflectionClass($extraClass);

                            $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
                            if($methods)
                            {
                                $rootParam = "root".$i++;
                                $output .= "\t/**\n\t * @var \\$extraClass \$$rootParam\n\t */\n\t static private \$$rootParam;\n\n";
                                foreach ($methods as $method)
                                {
                                    if(!in_array($method->name, $usedMethods)){
                                        $static = !in_array($method->name, $nonstaticMethods);
                                        $output .= $this->parseMethod($method, $alias, $extraClass, $static, $rootParam);
                                        $usedMethods[] = $method->name;
                                    }

                                }
                            }

                        }
                    }
                }
                $output .= " }\n}\n\n";

            }catch(\Exception $e){
                $this->error("Exception: ".$e->getMessage()."\nCould not analyze $root.");
            }

        }

        if(!empty($helpers)){
            foreach($helpers as $helper){
                if (file_exists($helper)){
                    $output .= str_replace(array('<?php', '?>'), '', \File::get($helper));
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
    protected function parseMethod($method, $alias, $root, $static = true, $rootParam = 'root'){
        $output = '';
        if($method->name === '__clone'){
            return $output;
        }

        $namespace = $method->getDeclaringClass()->getNamespaceName();

        $phpdoc = new DocBlock($method, new Context($namespace));
        $serializer = new DocBlockSerializer(1, "\t");

        $description = $phpdoc->getText();

        if(strpos($description, '{@inheritdoc}') !== false){
            $inheritdoc = $this->getInheritDoc($method);
            $inheritDescription = $inheritdoc->getText();

            $description = str_replace('{@inheritdoc}', $inheritDescription, $description);
            $phpdoc->setText($description);

            $inheritTags = $inheritdoc->getTags();
            if($inheritTags){
                foreach($inheritTags as $tag){
                    $tag->setDocBlock();
                    $phpdoc->appendTag($tag);
                }
            }
        }

        $phpdoc->appendTag(Tag::createInstance('@static', $phpdoc));

        //Looping through the parameters and re-setting the type, to get the expanded type (with namespace)
        //Should be fixed in a future version of ReflectionDocBlock I hope..
        $paramTags = $phpdoc->getTagsByName('param');
        if($paramTags){
            /** @var  $tag */
            foreach($paramTags as $tag){
                $content = $tag->getContent();
                //Closure should be \Closure..
                $content = str_replace('\Closure', 'Closure', $content);
                $content = str_replace('Closure', '\Closure', $content);
                $tag->setContent($content);
                $tag->setContent($tag->getType() . ' ' . $tag->getVariableName() . ' ' . $tag->getDescription());
            }
        }

        $returnTags = $phpdoc->getTagsByName('return');
        if($returnTags){
            /** @var  $tag */
            $tag = reset($returnTags);
            $returnValue = $tag->getType();

            if($method->name == "__construct"){
                $returnValue = 'self';
            }elseif(!$this->sublime and $alias == 'Eloquent' and
                (in_array($method->name, array('pluck', 'first', 'fill', 'newInstance', 'newFromBuilder', 'create', 'find', 'findOrFail'))
                    or $returnValue === '\Illuminate\Database\Query\Builder')){
                //Reference the calling class, to provide more accurate auto-complete
                $returnValue = "static";
            }elseif($alias == 'Eloquent' and in_array($method->name, array('all', 'get'))){
                $returnValue .= "|\Eloquent[]|static[]";
            }elseif($alias == 'Eloquent' and in_array($method->name, array('hasOne', 'hasMany', 'belongsTo', 'belongsToMany', 'morphOne', 'morphTo', 'morphMany'))){
                $returnValue .= "|\Eloquent";
            }
           $tag->setContent($returnValue . " ". $tag->getDescription());
        }else{
            $returnValue = null;
        }

        $output .= $serializer->getDocComment($phpdoc) ."\n\t public ".($static ? 'static' : '')." function ".$method->name."(";

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
        $output .= implode($paramsWithDefault, ", ");
        $output .= "){\r\n";

        $return = ($returnValue && $returnValue !== "void" && $method->name !== "__construct") ? 'return' : '';

        if($this->sublime){
            $output .= "\t\t\$$rootParam = new $root();\r\n";
            $output .=  "\t\t$return \$$rootParam->";
        }else{
            $output .=  "\t\t$return static::\$$rootParam->";
        }
        $output .=  $method->name."(".implode($params, ", ").");\r\n";
        $output .= "\t }\n\n";

        return $output;
    }

    /**
     * @param \ReflectionMethod $reflectionMethod
     * @return string
     */
    protected function getInheritDoc($reflectionMethod){
        $parentClass = $reflectionMethod->getDeclaringClass()->getParentClass();

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
