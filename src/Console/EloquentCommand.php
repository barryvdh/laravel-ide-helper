<?php
/**
 * Laravel IDE Helper Generator - Eloquent Model Mixin
 *
 * @author Charles A. Peterson <artistan@gmail.com>
 * @copyright 2017 Charles A. Peterson / Fruitcake Studio (http://www.fruitcakestudio.nl)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/barryvdh/laravel-ide-helper
 */

namespace Barryvdh\LaravelIdeHelper\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Barryvdh\Reflection\DocBlock;
use Barryvdh\Reflection\DocBlock\Context;
use Barryvdh\Reflection\DocBlock\Tag;
use Barryvdh\Reflection\DocBlock\Serializer as DocBlockSerializer;

/**
 * A command to add \Eloquent mixin to Eloquent\Model
 *
 * @author Charles A. Peterson <artistan@gmail.com>
 */
class EloquentCommand extends Command
{
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ide-helper:eloquent';

	/**
	 * @var Filesystem $files
	 */
	protected $files;

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Add \Eloquent helper to \Eloquent\Model';

	/**
	 * @param Filesystem $files
	 */
	public function __construct(Filesystem $files)
	{
		parent::__construct();
		$this->files = $files;
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$class = 'Illuminate\Database\Eloquent\Model';

		$reflection = new \ReflectionClass($class);
		$namespace = $reflection->getNamespaceName();
		$originalDoc = $reflection->getDocComment();
		if (!$originalDoc) {
			$this->info('Unexpected no document on ' . $class);
		}
		$phpdoc = new DocBlock($reflection, new Context($namespace));

		$mixins = $phpdoc->getTagsByName('mixin');
		foreach($mixins as $m) {
			if($m->getContent() === '\Eloquent'){
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
		if($filename){
			$contents = $this->files->get($filename);
			if($contents){
				$count=0;
				$contents = str_replace($originalDoc, $docComment, $contents,$count);
				if ($count>0) {
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

}
