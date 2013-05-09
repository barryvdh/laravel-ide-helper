<?php namespace Barryvdh\LaravelIdeHelper;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\ClassLoader\ClassMapGenerator;
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


    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $filename = $this->option('filename');
        $model = $this->argument('model');

        $content = $this->generateDocs($model);

        $written = \File::put($filename, $content);

        if($written !== false){
            $this->info("Model information was written to $filename");
        }else{
            $this->error("Failed to write model information to $filename");
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
        $models = array();
        foreach(ClassMapGenerator::createMap(app_path().'/models') as $model=> $path){
            $models[] = $model;
        }
        return $models;
    }

    protected function getPropertiesFromTable($model){
        $table = $model->getTable();
        $schema = $model->getConnection()->getDoctrineSchemaManager($table);

        $columns = $schema->listTableColumns($table);

        $properties = array();
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

    protected function createPhpDocs($class){

        if(strpos($class, '\\') !== false){
            $parts = explode('\\', $class);
            $class = array_pop($parts);
            $namespace = implode($parts, '\\');
        }else{
            $namespace = '';
        }
        $output = "namespace $namespace{\n";
        $output .= "\t/**\n\t *\n\t * Generated properties for $class\n\t *\n";
        foreach($this->properties as $name => $property){

            if($property['read'] && $property['write']){
                $attr = 'property';
            }elseif($property['write']){
                $attr = 'property-write';
            }else{
                $attr = 'property-read';
            }
            $type = $property['type'];

            $output .= "\t * @$attr $type \$$name \n";

        }
        $output .= "\t *\n\t */\n\tclass $class {}\n}\n\n";
        return $output;
    }

}
