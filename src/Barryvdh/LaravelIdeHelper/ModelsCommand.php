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
use Symfony\Component\ClassLoader\ClassMapGenerator;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Context;
use phpDocumentor\Reflection\DocBlock\Tag;
use phpDocumentor\Reflection\DocBlock\Serializer as DocBlockSerializer;
/**
 * A command to generate autocomplete information for your IDE
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */
class ModelsCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ide-helper:models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate autocompletion for models';

    protected $properties = array();
    protected $methods = array();
    protected $write = false;
    protected $dir;



    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $filename = $this->option('filename');
        $this->write = $this->option('write');
        $this->dir = $this->option('dir');
        $model = $this->argument('model');

        $content = $this->generateDocs($model);

        if(!$this->write){
            $written = \File::put($filename, $content);
            if($written !== false){
                $this->info("Model information was written to $filename");
            }else{
                $this->error("Failed to write model information to $filename");
            }
        }

    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('model', InputArgument::OPTIONAL, 'Which models to include', '*'),

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
            array('filename', 'F', InputOption::VALUE_OPTIONAL, 'The path to the helper file', '_ide_helper_models.php'),
            array('dir', 'D', InputOption::VALUE_OPTIONAL, 'The model dir', app_path().'/models'),
            array('write', 'W', InputOption::VALUE_NONE, 'Write to Model file'),
        );
    }

    protected function generateDocs($model){


        $output = "<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */
\n\n";

        if($model === '*'){
            $models = $this->loadModels();
        }else{
            $models = explode(',', $model);
        }

        foreach($models as $name){
            $this->properties = array();
            $this->methods = array();
            if(class_exists($name)){
                try{
                    $model = new $name();
                    $this->getPropertiesFromTable($model);
                    $this->getPropertiesFromMethods($model);
                    $output .= $this->createPhpDocs($name);
                }catch(\Exception $e){
                    $this->error("Exception: ".$e->getMessage()."\nCould not analyze class $name.");
                }
            }else{
                $this->error("Class $name does not exist");
            }

        }

        return $output;

    }


    protected function loadModels(){
        $dir = $this->dir;
        if(!file_exists($dir)){
            $dir = base_path().'/'.$dir;
        }
        $models = array();
        foreach(ClassMapGenerator::createMap($dir) as $model=> $path){
            $models[] = $model;
        }
        return $models;
    }

    /**
     * Load the properties from the database table.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    protected function getPropertiesFromTable($model){
        $table = $model->getTable();
        $schema = $model->getConnection()->getDoctrineSchemaManager($table);
        $schema->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

        $columns = $schema->listTableColumns($table);

        if($columns){
            foreach ($columns as $column) {
                $name = $column->getName();
                $type =  $column->getType()->getName();

                switch($type){
                    case 'string':
                    case 'text':
                    case 'date':
                    case 'time':
                    case 'guid':
                        $type = 'string';
                        break;
                    case 'integer':
                    case 'bigint':
                    case 'smallint':
                        $type = 'integer';
                        break;
                    case 'decimal':
                        case 'float':
                        $type = 'float';
                        break;
                    case 'boolean':
                        $type = 'boolean';
                        break;
                    case 'datetimetz':  //String or DateTime, depending on $dates
                    case 'datetime':
                        $type = '\Carbon\Carbon';
                        break;
                    default:
                        $type = 'mixed';
                        break;
                }
                $this->setProperty($name, $type, true, true);
            }
        }
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    protected function getPropertiesFromMethods($model){
        $methods = get_class_methods($model);
        if($methods){
           foreach($methods as $method){
               if(\Str::startsWith($method, 'get') && \Str::endsWith($method, 'Attribute') && $method !== 'setAttribute'){
                   //Magic get<name>Attribute
                   $name =  \Str::snake(substr($method, 3, -9));
                   if(!empty($name)){
                        $this->setProperty($name, null, true, null);
                   }
               }elseif(\Str::startsWith($method, 'set') && \Str::endsWith($method, 'Attribute') && $method !== 'setAttribute'){
                   //Magic set<name>Attribute
                   $name =  \Str::snake(substr($method, 3, -9));
                   if(!empty($name)){
                        $this->setProperty($name, null, null, true);
                   }
               }elseif(\Str::startsWith($method, 'scope') && $method !== 'scopeQuery'){
                   //Magic set<name>Attribute
                   $name =  \Str::snake(substr($method, 5));
                   if(!empty($name)){
                       $this->setMethod($name, 'static');
                   }
               }elseif(!method_exists('Eloquent', $method) && !\Str::startsWith($method, 'get')){

                   //Use reflection to inspect the code, based on Illuminate/Support/SerializableClosure.php
                   $reflection = new \ReflectionMethod($model, $method);

                   $file = new \SplFileObject($reflection->getFileName());
                   $file->seek($reflection->getStartLine() - 1);

                   $code = '';
                   while ($file->key() < $reflection->getEndLine())
                   {
                       $code .= $file->current(); $file->next();
                   }
                   $begin = strpos($code, 'function(');
                   $code = substr($code, $begin, strrpos($code, '}') - $begin + 1);

                   $begin = stripos($code, 'return $this->');
                   $parts = explode("'", substr($code, $begin+14),3);  //"return $this->" is 14 chars
                   if (isset($parts[2]))
                   {
                       list($relation, $returnModel, $rest) = $parts;
                       $returnModel = "\\".ltrim($returnModel, "\\");
                       $relation = trim($relation, ' (');
    
                       if($relation === "belongsTo" or $relation === 'hasOne'){
                           //Single model is returned
                           $this->setProperty($method, $returnModel, true, null);
                       }elseif($relation === "belongsToMany" or $relation === 'hasMany'){
                           //Collection or array of models (because Collection is Arrayable)
                           $this->setProperty($method,  '\Illuminate\Database\Eloquent\Collection|'.$returnModel.'[]', true, null);
                       }
                   }else{
                       //Not a relation
                   }

               }
           }
        }
    }

    /**
     * @param string $name
     * @param string|null $type
     * @param bool|null $read
     * @param bool|null $write
     */
    protected function setProperty($name, $type = null, $read = null, $write = null){
        if(!isset($this->properties[$name])){
            $this->properties[$name] = array();
            $this->properties[$name]['type'] = 'mixed';
            $this->properties[$name]['read'] = false;
            $this->properties[$name]['write'] = false;
        }
        if($type !== null){
            $this->properties[$name]['type'] = $type;
        }
        if($read !== null){
            $this->properties[$name]['read'] = $read;
        }
        if($write !== null){
            $this->properties[$name]['write'] = $write;
        }
    }

    protected function setMethod($name, $type = null){
        if(!isset($this->methods[$name])){
            $this->methods[$name] = array();
            $this->methods[$name]['type'] = 'static';
        }
        if($type !== null){
            $this->methods[$name]['type'] = $type;
        }
    }

    /**
     * @param string $class
     * @return string
     */
    protected function createPhpDocs($class){

        $reflection = new \ReflectionClass($class);
        $namespace = $reflection->getNamespaceName();
        $classname = $reflection->getShortName();
        $originalDoc = $reflection->getDocComment();
        $phpdoc = new DocBlock($reflection, new Context($namespace));

        if(!$phpdoc->getText()){
            $phpdoc->setText("Generated properties for $class");
        }

        $properties = array();
        $methods = array();
        foreach($phpdoc->getTags() as $tag){
            $name = $tag->getName();
            if($name == "property" || $name == "property-read" || $name == "property-write"){
                $properties[] =$tag->getVariableName();
            }elseif($name == "method"){
                $methods[] = $tag->getMethodName();
            }
        }

        foreach($this->properties as $name => $property){
            $name = "\$$name";
            if(in_array($name, $properties)){
                continue;
            }
            if($property['read'] && $property['write']){
                $attr = 'property';
            }elseif($property['write']){
                $attr = 'property-write';
            }else{
                $attr = 'property-read';
            }
            $tag = Tag::createInstance("@{$attr} {$property['type']} {$name}", $phpdoc);
            $phpdoc->appendTag($tag);
        }

        foreach($this->methods as $name => $method){
            if(in_array($name, $methods)){
                continue;
            }
            $name = "$name()";
            $tag = Tag::createInstance("@method {$method['type']} {$name}", $phpdoc);
            $phpdoc->appendTag($tag);
        }

        $serializer = new DocBlockSerializer();
        $serializer->getDocComment($phpdoc);
        $docComment = $serializer->getDocComment($phpdoc);


        if($this->write){
            $filename = $reflection->getFileName();
            $contents = \File::get($filename);
            if($originalDoc){
                $contents = str_replace($originalDoc, $docComment, $contents);
            }else{
                $needle = "class {$classname}";
                $replace = "{$docComment}\nclass {$classname}";
                $pos = strpos($contents,$needle);
                if ($pos !== false) {
                    $contents = substr_replace($contents,$replace,$pos,strlen($needle));
                }
            }
            if(\File::put($filename, $contents)){
                $this->info('Written new phpDocBlock to '.$filename);
            }
        }

        $output = "namespace {$namespace}{\n{$docComment}\n\tclass {$classname} {}\n}\n\n";
        return $output;
    }

}
