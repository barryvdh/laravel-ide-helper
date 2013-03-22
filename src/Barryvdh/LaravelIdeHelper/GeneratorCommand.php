<?php namespace Barryvdh\LaravelIdeHelper;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use DocBlock\Parser;

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


    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $filename = $this->argument('filename');

        $this->setupDefaults();

        $aliases = \Config::get('laravel-ide-helper::aliases');
        $aliases += \Config::get('app.aliases');

        if( $this->option('helpers') || (\Config::get('laravel-ide-helper::include_helpers') && ! $this->option('nohelpers'))){
            $helpers = \Config::get('laravel-ide-helper::helper_files');
        }else{
            $helpers = array();
        }

        $content = $this->generateDocs($aliases, $helpers);

        $written = \File::put($filename, $content);

        if($written !== false){
            $this->info("A new helper file was written to $filename");
        }else{
            $this->error("The helper file could not be created at $filename");
        }

    }

    protected function setupDefaults(){
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
            array('nohelpers', "N", InputOption::VALUE_NONE, 'Do not include the helper files'),
        );
    }

    protected function generateDocs($aliases, $helpers = array()){
        $d = new Parser();
        $d->setAllowInherited(true);
        $d->setMethodFilter(\ReflectionMethod::IS_PUBLIC);

        $output = "<?php\nnamespace {\n\tdie('Only to be used as an helper for your IDE');\n}\n\n";

        foreach($aliases as $alias => $facade){

            if(method_exists($facade, 'getFacadeRoot')){
                $root = get_class($facade::getFacadeRoot());
            }else{
                $root = $facade;
            }

            if(strpos($alias, '\\') !== false){
                $parts = explode('\\', $alias);
                $alias = array_pop($parts);
                $namespace = implode($parts, '\\');
            }else{
                $namespace = '';
            }

            $d->analyze($root);

            $output .= "namespace $namespace {\n class $alias{\r\n";
            $output .= "\t/**\n\t * @var $root \$root\n\t */\n\t static private \$root;\n\n";
            $methods = $d->getMethods();

            foreach ($methods as $method)
            {
                $output .= $this->parseMethod($method);
            }
            $output .= " }\n}\n\n";

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

    protected function parseMethod($method){
        if($method->name === '__clone'){
            return '';
        }
        $output = '';

        $returnAnnotations = $method->getAnnotations(array("return"));
        if(!empty($returnAnnotations)){
            foreach ($returnAnnotations as $annotation)
            {
                $returnValue = $annotation->values[0];
            }
        }else{
            $returnValue = 'void';
        }

        $annotations = $method->getAnnotations(array("param"));

        $description = str_replace("\n", "\n\t * ", trim($method->description));
        $output .= "\t/**\n\t * ".$description."\n\t *\n\t * @static\n";

        if(!empty($annotations)){
            foreach ($annotations as $annotation)
            {
                $output .="\t * @param\t".implode($annotation->values, "\t")."\n";
            }
        }
        if($returnValue !== "void"){
            $output .= "\t * @return ".$returnValue."\n";
        }
        $output .= "\t */\n\t public static function ".$method->name."(";


        $reflection = $method->getReflectionObject();
        $params = array();
        $paramsWithDefault = array();

        foreach ($reflection->getParameters() as $param) {
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

        $output .= "){\r\n\t\t".($returnValue !== "void" ? 'return ' : '')."self::\$root->".$method->name."(".implode($params, ", ").");\r\n\t }\n\n";

        return $output;
    }

}
