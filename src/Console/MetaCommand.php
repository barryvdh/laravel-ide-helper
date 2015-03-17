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

    /** @var \Illuminate\Contracts\Filesystem\Filesystem */
    protected $files;

    /** @var \Illuminate\Contracts\View\Factory */
    protected $view;
    
    protected $methods = [
      '\Illuminate\Foundation\Application::make',
      '\Illuminate\Contracts\Foundation\Application::make',
      '\Illuminate\Contracts\Container\Container::make',
      '\Illuminate\Container\Container::make',
      '\App::make',
      'app',
    ];

    /**
     *
     * @param \Illuminate\Contracts\Filesystem\Filesystem $files
     * @param \Illuminate\Contracts\View\Factory $view
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
        $bindings = array();
        foreach ($this->getAbstracts() as $abstract) {
            try {
                $concrete = $this->laravel->make($abstract);
                if (is_object($concrete)) {
                    $bindings[$abstract] = get_class($concrete);
                }
            }catch (\Exception $e) {
                $this->error("Cannot make $abstract: ".$e->getMessage());
            }
        }

        $content = $this->view->make('ide-helper::meta', [
          'bindings' => $bindings,
          'methods' => $this->methods,
        ])->render();

        $filename = $this->option('filename');
        $written = $this->files->put($filename, $content);

        if ($written !== false) {
            $this->info("A new meta file was written to $filename");
        } else {
            $this->error("The meta file could not be created at $filename");
        }
    }

    /**
     * Get a filtered list of abstracts from the Laravel Application.
     * 
     * @return array
     */
    protected function getAbstracts()
    {
        $abstracts = $this->laravel->getBindings();
        
        // Remove the S3 cloud driver when not available
        if (config('filesystems.cloud') === 's3' && !class_exists('League\Flysystem\AwsS3v2\AwsS3Adapter')) {
            unset($abstracts['filesystem.cloud']);
        }
        
        // Remove Redis when not available
        if (isset($abstracts['redis']) && !class_exists('Predis\Client')) {
            unset($abstracts['redis']);
        }

        // Return the abstract names only
        return array_keys($abstracts);
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
