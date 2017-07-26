<?php
/**
 * Laravel IDE Helper Generator
 *
 * @author    Barry vd. Heuvel <barryvdh@gmail.com>
 * @copyright 2014 Barry vd. Heuvel / Fruitcake Studio (http://www.fruitcakestudio.nl)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/barryvdh/laravel-ide-helper
 */

namespace Barryvdh\LaravelIdeHelper\Console;

use Barryvdh\LaravelIdeHelper\Generator;
use Barryvdh\Reflection\DocBlock;
use Barryvdh\Reflection\DocBlock\Context;
use Barryvdh\Reflection\DocBlock\Serializer as DocBlockSerializer;
use Barryvdh\Reflection\DocBlock\Tag;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * A command to generate autocomplete information for your IDE
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */
class GeneratorCommand extends Command
{

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

    /** @var \Illuminate\Config\Repository */
    protected $config;

    /** @var \Illuminate\Filesystem\Filesystem */
    protected $files;

    /** @var \Illuminate\View\Factory */
    protected $view;

    protected $onlyExtend;


    /**
     *
     * @param \Illuminate\Config\Repository $config
     * @param \Illuminate\Filesystem\Filesystem $files
     * @param \Illuminate\View\Factory $view
     */
    public function __construct(
        /*ConfigRepository */ $config,
        Filesystem $files,
        /* Illuminate\View\Factory */
        $view
    ) {
        $this->config = $config;
        $this->files = $files;
        $this->view = $view;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (file_exists(base_path() . '/vendor/compiled.php') ||
            file_exists(base_path() . '/bootstrap/cache/compiled.php') ||
            file_exists(base_path() . '/storage/framework/compiled.php')) {
            $this->error(
                'Error generating IDE Helper: first delete your compiled file (php artisan clear-compiled)'
            );
        } else {
            $filename = $this->argument('filename');
            $format = $this->option('format');

            // Strip the php extension
            if (substr($filename, -4, 4) == '.php') {
                $filename = substr($filename, 0, -4);
            }

            $filename .= '.' . $format;

            if ($this->option('memory')) {
                $this->useMemoryDriver();
            }


            $helpers = '';
            if ($this->option('helpers') || ($this->config->get('ide-helper.include_helpers'))) {
                foreach ($this->config->get('ide-helper.helper_files', array()) as $helper) {
                    if (file_exists($helper)) {
                        $helpers .= str_replace(array('<?php', '?>'), '', $this->files->get($helper));
                    }
                }
            } else {
                $helpers = '';
            }

            $generator = new Generator($this->config, $this->view, $this->getOutput(), $helpers);
            $content = $generator->generate($format);
            $written = $this->files->put($filename, $content);

            if ($written !== false) {
                $this->info("A new helper file was written to $filename");
                $this->writeEloquentModelHelper();
            } else {
                $this->error("The helper file could not be created at $filename");
            }
        }
    }

    /**
     * Write mixin helper to the Eloquent\Model
     * This is needed since laravel/framework v5.4.29
     *
     * @return void
     */
    protected function writeEloquentModelHelper()
    {
        $class = 'Illuminate\Database\Eloquent\Model';

        $reflection  = new \ReflectionClass($class);
        $namespace   = $reflection->getNamespaceName();
        $originalDoc = $reflection->getDocComment();
        if (!$originalDoc) {
            $this->info('Unexpected no document on ' . $class);
        }
        $phpdoc = new DocBlock($reflection, new Context($namespace));

        $mixins = $phpdoc->getTagsByName('mixin');
        foreach ($mixins as $m) {
            if ($m->getContent() === '\Eloquent') {
                $this->info('Tag Exists: @mixin \Eloquent in ' . $class);

                return;
            }
        }

        // add the Eloquent mixin
        $phpdoc->appendTag(Tag::createInstance("@mixin \\Eloquent", $phpdoc));

        $serializer = new DocBlockSerializer();
        $serializer->getDocComment($phpdoc);
        $docComment = $serializer->getDocComment($phpdoc);

        $filename = $reflection->getFileName();
        if ($filename) {
            $contents = $this->files->get($filename);
            if ($contents) {
                $count    = 0;
                $contents = str_replace($originalDoc, $docComment, $contents, $count);
                if ($count > 0) {
                    if ($this->files->put($filename, $contents)) {
                        $this->info('Wrote @mixin \Eloquent to ' . $filename);
                    } else {
                        $this->error('File write failed to ' . $filename);
                    }
                } else {
                    $this->error('Content did not change ' . $contents);
                }
            } else {
                $this->error('No file contents found ' . $filename);
            }
        } else {
            $this->error('Filename not found ' . $class);
        }
    }

    protected function useMemoryDriver()
    {
        //Use a sqlite database in memory, to avoid connection errors on Database facades
        $this->config->set(
            'database.connections.sqlite',
            array(
                'driver' => 'sqlite',
                'database' => ':memory:',
            )
        );
        $this->config->set('database.default', 'sqlite');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        $filename = $this->config->get('ide-helper.filename');

        return array(
            array(
                'filename', InputArgument::OPTIONAL, 'The path to the helper file', $filename
            ),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        $format = $this->config->get('ide-helper.format');

        return array(
            array('format', "F", InputOption::VALUE_OPTIONAL, 'The format for the IDE Helper', $format),
            array('helpers', "H", InputOption::VALUE_NONE, 'Include the helper files'),
            array('memory', "M", InputOption::VALUE_NONE, 'Use sqlite memory driver'),
            array('sublime', "S", InputOption::VALUE_NONE, 'DEPRECATED: Use different style for SublimeText CodeIntel'),
        );
    }
}
