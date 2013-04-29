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
            }

        }

        return $output;

    }


    protected function loadModels(){
        $models = array();
        foreach(self::createMap(app_path().'/models') as $model=> $path){
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
                        $type = 'string|DateTime';
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
                   //If not declared in parent class, assuming relation.
                   $this->setProperty($method, 'Eloquent', true, null);
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


    /**
     * Copy from Composer\Autoload\ClassMapGenerator
     * @author Gyula Sallai <salla016@gmail.com>
     *
     * Iterate over all files in the given directory searching for classes
     *
     * @param Iterator|string $path      The path to search in or an iterator
     * @param string          $whitelist Regex that matches against the file path
     *
     * @return array A class map array
     *
     * @throws \RuntimeException When the path is neither an existing file nor directory
     */
    public static function createMap($path, $whitelist = null)
    {
        if (is_string($path)) {
            if (is_file($path)) {
                $path = array(new \SplFileInfo($path));
            } elseif (is_dir($path)) {
                $path = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            } else {
                throw new \RuntimeException(
                    'Could not scan for classes inside "'.$path.
                        '" which does not appear to be a file nor a folder'
                );
            }
        }

        $map = array();

        foreach ($path as $file) {
            if (!$file->isFile()) {
                continue;
            }

            $filePath = $file->getRealPath();

            if (!in_array(pathinfo($filePath, PATHINFO_EXTENSION), array('php', 'inc'))) {
                continue;
            }

            if ($whitelist && !preg_match($whitelist, strtr($filePath, '\\', '/'))) {
                continue;
            }

            $classes = self::findClasses($filePath);

            foreach ($classes as $class) {
                $map[$class] = $filePath;
            }

        }

        return $map;
    }

    /**
     * Extract the classes in the given file
     *
     * @param string $path The file to check
     *
     * @return array The found classes
     */
    private static function findClasses($path)
    {
        $traits = version_compare(PHP_VERSION, '5.4', '<') ? '' : '|trait';

        try {
            $contents = php_strip_whitespace($path);
        } catch (\Exception $e) {
            throw new \RuntimeException('Could not scan for classes inside '.$path.": \n".$e->getMessage(), 0, $e);
        }

        // return early if there is no chance of matching anything in this file
        if (!preg_match('{\b(?:class|interface'.$traits.')\b}i', $contents)) {
            return array();
        }

        // strip heredocs/nowdocs
        $contents = preg_replace('{<<<\'?(\w+)\'?(?:\r\n|\n|\r)(?:.*?)(?:\r\n|\n|\r)\\1(?=\r\n|\n|\r|;)}s', 'null', $contents);
        // strip strings
        $contents = preg_replace('{"[^"\\\\]*(\\\\.[^"\\\\]*)*"|\'[^\'\\\\]*(\\\\.[^\'\\\\]*)*\'}', 'null', $contents);
        // strip leading non-php code if needed
        if (substr($contents, 0, 2) !== '<?') {
            $contents = preg_replace('{^.+?<\?}s', '<?', $contents);
        }
        // strip non-php blocks in the file
        $contents = preg_replace('{\?>.+<\?}s', '?><?', $contents);
        // strip trailing non-php code if needed
        $pos = strrpos($contents, '?>');
        if (false !== $pos && false === strpos(substr($contents, $pos), '<?')) {
            $contents = substr($contents, 0, $pos);
        }

        preg_match_all('{
            (?:
                 \b(?<![\$:>])(?P<type>class|interface'.$traits.') \s+ (?P<name>[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)
               | \b(?<![\$:>])(?P<ns>namespace) (?P<nsname>\s+[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*(?:\s*\\\\\s*[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)*)? \s*[\{;]
            )
        }ix', $contents, $matches);

        $classes = array();
        $namespace = '';

        for ($i = 0, $len = count($matches['type']); $i < $len; $i++) {
            if (!empty($matches['ns'][$i])) {
                $namespace = str_replace(array(' ', "\t", "\r", "\n"), '', $matches['nsname'][$i]) . '\\';
            } else {
                $classes[] = ltrim($namespace . $matches['name'][$i], '\\');
            }
        }

        return $classes;
    }

}
