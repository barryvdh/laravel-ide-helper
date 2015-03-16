<?php
/**
 * Laravel IDE Helper Generator
 *
 * @author    Barry vd. Heuvel <barryvdh@gmail.com>
 * @copyright 2015 Barry vd. Heuvel / Fruitcake Studio (http://www.fruitcakestudio.nl)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/barryvdh/laravel-ide-helper
 */

namespace Barryvdh\LaravelIdeHelper\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * A command to generate phpstorm meta data
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */
class MetaCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ide-helper:meta';
    protected $filename = '.phpstorm.meta.php';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate metadata for PhpStorm';

    /** @var \Illuminate\Filesystem\Filesystem */
    protected $files;

    /** @var \Illuminate\View\Factory */
    protected $view;
    
    protected $methods = array(
      '\Illuminate\Foundation\Application::make',
      '\Illuminate\Container\Container::make',
      '\App::make',
      'app',
    );

    /**
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     * @param \Illuminate\View\Factory $view
     */
    public function __construct($files, $view) {
        $this->files = $files;
        $this->view = $view;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $filename = $this->option('filename');

        $bindings = array();

        foreach ($this->laravel->getBindings() as $abstract => $options) {
            try {
                $concrete = $this->laravel->make($abstract);
                if (is_object($concrete)) {
                    $bindings[$abstract] = get_class($concrete);
                }
            }catch (\Exception $e) {
                $this->error("Cannot make $abstract: ".$e->getMessage());
            }
        }
        
        $content = $this->view->make('laravel-ide-helper::meta', array(
          'bindings' => $bindings,
          'methods' => $this->methods,
        ))->render();
        
        $written = $this->files->put($filename, $content);

        if ($written !== false) {
            $this->info("A new meta file was written to $filename");
        } else {
            $this->error("The meta file could not be created at $filename");
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('filename', 'F', InputOption::VALUE_OPTIONAL, 'The path to the meta file', $this->filename),
        );
    }
}
