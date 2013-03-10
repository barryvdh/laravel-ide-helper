<?php namespace Barryvdh\IdeHelper;
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

        $aliases = \Config::get('ide-helper::aliases');
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
            array('filename', InputArgument::OPTIONAL, 'The path to the helper file', \Config::get('ide-helper::filename')),
        );
    }

    protected function parseDocBlocks($aliases){
        $d = new Parser();

        $output = "<?php\r\ndie('Only to be used as an helper for your IDE');\n";

        foreach($aliases as $alias => $className){

            $d->analyze($className);
            $output .= "class $alias extends $className{\r\n";

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

                $output .= "/**\n * ".trim($method->description)."\n *\n * @static\n";
                $params = array();
                if(!empty($annotations)){
                    foreach ($annotations as $annotation)
                    {
                        $output .=" * @param\t".implode($annotation->values, "\t")."\n";
                    }
                }

                $output .= " * @return ".$returnValue."\n */\n public static function ".$method->name."(";

                $reflection = $method->getReflectionObject();
                foreach ($reflection->getParameters() as $param) {
                    $paramStr = '$'.$param->getName();
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
                    $params[] = $paramStr;
                }
                $output .= implode($params, ", ");


                $output .= "){}\n\n";


            }
            $output .= "}\n\n";

        }

        return $output;
    }

}
