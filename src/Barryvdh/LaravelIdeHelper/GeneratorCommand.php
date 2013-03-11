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

        $aliases = \Config::get('laravel-ide-helper::aliases');
        $content = $this->parseDocBlocks($aliases);

        $written = \File::put($filename, $content);

        if($written !== false){
            $this->info("A new helper file was written to $filename");
        }else{
            $this->error("The helper file could not be created at $filename");
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
            array('filename', InputArgument::OPTIONAL, 'The path to the helper file', \Config::get('laravel-ide-helper::filename')),
        );
    }

    protected function parseDocBlocks($aliases){
        $d = new Parser();
        $d->setAllowInherited(true);
        $d->setMethodFilter(\ReflectionMethod::IS_PUBLIC);

        $output = "<?php die('Only to be used as an helper for your IDE');\n";

        foreach($aliases as $alias => $className){

            $d->analyze($className);

            $output .= " class $alias{\r\n";
            $output .= "\t/**\n\t * @var $className \$realClass\n\t */\n\t static private \$realClass;\n\n";
            $methods = $d->getMethods();

            foreach ($methods as $method)
            {
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
                        }else{
                            $default = "'".trim($default)."'";
                        }

                        $paramStr .= " = $default";
                    }
                    $paramsWithDefault[] = $paramStr;
                }
                $output .= implode($paramsWithDefault, ", ");

                $output .= "){\r\n\t\t".($returnValue !== "void" ? 'return ' : '')."self::\$realClass->".$method->name."(".implode($params, ", ").");\r\n\t }\n\n";


            }
            $output .= "}\n\n";

        }

        return $output;
    }

}
