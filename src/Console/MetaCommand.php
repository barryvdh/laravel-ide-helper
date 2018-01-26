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
 * @property \Illuminate\Container\Container $laravel
 */
class MetaCommand extends Command {

    /**
     * {@inheritdoc}
     */
    protected $name = 'ide-helper:meta';
    protected $filename = '.phpstorm.meta.php';

    /**
     * {@inheritdoc}
     */
    protected $description = 'Generate metadata for PhpStorm';

    /** @var \Illuminate\Filesystem\Filesystem */
    protected $files;

    /** @var \Illuminate\View\Factory */
    protected $view;

    protected $methods = array(
        '\Illuminate\Foundation\Application::make',
        'new \Illuminate\Foundation\Application',
        '\Illuminate\Container\Container::make',
        'new \Illuminate\Container\Container',
        '\App::make',
        'app',
    );

    /**
     * {@inheritdoc}
     *
     * @param \Illuminate\Container\Container $app
     */
    public function __construct($app)
    {
        $this->laravel = $app;
        $this->files = $app['files'];
        $this->view = $app['view'];
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
            } catch (\Exception $e) {
                $this->error("Cannot make $abstract: " . $e->getMessage());
            }
        }

        $content = $this->view->make('laravel-ide-helper::meta', array(
            'bindings' => $bindings,
            'methods' => $this->methods,
        ))->render();

        $filename = $this->option('filename');
        $written = $this->files->put($filename, $content);

        if ($written !== false) {
            $this->info("A new meta file was written to $filename");
        } else {
            $this->error("The meta file could not be created at $filename");
        }
    }

    /**
     * Get a list of abstracts from the Laravel Application.
     *
     * @return array
     */
    protected function getAbstracts()
    {
        return array_keys($this->laravel->getBindings());
    }

    /**
     * {@inheritdoc}
     */
    protected function getOptions()
    {
        return array(
            array('filename', 'F', InputOption::VALUE_OPTIONAL, 'The path to the meta file', $this->filename),
        );
    }
}
