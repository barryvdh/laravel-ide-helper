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

use Illuminate\Config\Repository;
use Illuminate\Console\Command;
use Illuminate\Contracts\View\Factory;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;

/**
 * A command to generate phpstorm meta data
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */
class MetaCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ide-helper:meta';

    /** @var string */
    protected $filename = '.phpstorm.meta.php';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate metadata for PhpStorm';

    /** @var \Illuminate\Filesystem\Filesystem */
    protected $files;

    /** @var \Illuminate\Contracts\View\Factory */
    protected $view;

    /** @var \Illuminate\Config\Repository */
    protected $config;

    /**
     *
     * @param \Illuminate\Filesystem\Filesystem  $files
     * @param \Illuminate\Contracts\View\Factory $view
     * @param \Illuminate\Config\Repository      $config
     */
    public function __construct(Filesystem $files, Factory $view, Repository $config)
    {
        $this->files  = $files;
        $this->view   = $view;
        $this->config = $config;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $bindings = [];
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

        $config = new Repository();
        $config->get('');

        $content = $this->view->make('ide-helper::meta', [
            'loc'    => [
                'bindings' => $bindings,
                'methods'  => config('ide-helper.meta.methods.loc'),
            ],
            'config' => [
                'keys'    => $this->getConfigKeys(),
                'methods' => config('ide-helper.meta.methods.config'),
            ],
        ])->render();

        $filename = $this->option('filename');
        $written  = $this->files->put($filename, $content);

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

        $aliases   = method_exists($this->laravel, 'getAliases') ? $this->laravel->getAliases() : [];
        $instances = method_exists($this->laravel, 'getInstances') ? $this->laravel->getInstances() : [];

        $temp = [];
        foreach ($aliases as $alias => $concrete) {
            if (array_key_exists($concrete, $abstracts) || array_key_exists($concrete, $instances)) {
                $temp[] = $alias;
            }
        }

        // Return the abstract names only
        return array_unique(array_merge(array_keys($instances), array_keys($abstracts), $temp));
    }

    /**
     * Get list of all config keys
     *
     * @return string[]
     */
    protected function getConfigKeys()
    {
        return $this->getConfigKeysRecursive($this->config->all());
    }

    /**
     * @param array  $values
     * @param string $key
     *
     * @return array
     */
    protected function getConfigKeysRecursive(array $values, $key = '')
    {
        $result          = [];
        $recursiveResult = [];
        foreach ($values as $subKey => $value) {
            $result[$key . $subKey] = 'arr';
            if (is_array($value)) {
                $recursiveResult[] = $this->getConfigKeysRecursive($value, $key . $subKey . '.');
            } elseif (is_int($value)) {
                $result[$key . $subKey] = 'int';
            } elseif (is_float($value)) {
                $result[$key . $subKey] = 'float';
            } elseif (is_string($value)) {
                $result[$key . $subKey] = 'string';
            } elseif (is_bool($value)) {
                $result[$key . $subKey] = 'bool';
            }
        }

        return array_merge($result, ...$recursiveResult);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['filename', 'F', InputOption::VALUE_OPTIONAL, 'The path to the meta file', $this->filename],
        ];
    }
}
