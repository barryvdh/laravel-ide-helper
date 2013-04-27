<?php namespace Barryvdh\LaravelIdeHelper;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
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
        $filename = $this->argument('filename');
        $model = $this->option('model');

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
            array('filename', InputArgument::OPTIONAL, 'The path to the helper file', 'model_phpdocs.php'),
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
            array('model', "M", InputOption::VALUE_OPTIONAL, 'Which models to include', '*'),
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
            $models = array($model);
        }

        foreach($models as $name){
            $this->properties = array();
            $model = new $name();
            $this->getPropertiesFromTable($model);
            $this->getPropertiesFromMethods($model);
            $output .= $this->createPhpDocs($name);
        }

        return $output;

    }


    protected function loadModels(){
        $models = array();
       foreach(\File::files(app_path().'/models') as $file){
           list($name, $ext) = explode('.', basename($file));
           $models[] = ucfirst($name);
       }
        return $models;
    }

    protected function getPropertiesFromTable($model){
        $table = $model->getTable();
        $schema = $model->getConnection()->getDoctrineSchemaManager($table);

        $columns = $schema->listTableColumns($table);

        $properties = array();
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
                    $type = 'string|DateTime';
                    break;
                default:
                    $type = 'mixed';
                    break;
            }
            $this->setProperty($name, $type, true, true);
        }
    }

    protected function getPropertiesFromMethods($model){
       foreach(get_class_methods($model) as $method){
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
               //If not declared in parent class, assuming relation.
               $this->setProperty($method, 'Eloquent', true, null);
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
        $output = "/**\n *\n * Generated properties for $class\n *\n";
        foreach($this->properties as $name => $property){

            if($property['read'] && $property['write']){
                $attr = 'property';
            }elseif($property['write']){
                $attr = 'property-write';
            }else{
                $attr = 'property-read';
            }
            $type = $property['type'];
            //TODO; check if returned as date

            $output .= " * @$attr $type \$$name \n";

        }
        $output .= " *\n */\nclass $class {}\n\n";
        return $output;
    }

}
