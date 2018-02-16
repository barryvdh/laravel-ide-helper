<?php

/**
 * Laravel IDE Helper to add \Eloquent mixin to Eloquent\Model
 *
 * @author Charles A. Peterson <artistan@gmail.com>
 */
namespace Barryvdh\LaravelIdeHelper;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Barryvdh\Reflection\DocBlock;
use Barryvdh\Reflection\DocBlock\Context;
use Barryvdh\Reflection\DocBlock\Serializer as DocBlockSerializer;
use Barryvdh\Reflection\DocBlock\Tag;

class Eloquent
{
    /**
     * Write mixin helper to the Eloquent\Model
     * This is needed since laravel/framework v5.4.29
     *
     * @param Command    $command
     * @param Filesystem $files
     *
     * @return void
     */
    public static function writeEloquentModelHelper(Command $command, Filesystem $files)
    {
        $class = 'Illuminate\Database\Eloquent\Model';

        $reflection  = new \ReflectionClass($class);
        $namespace   = $reflection->getNamespaceName();
        $originalDoc = $reflection->getDocComment();
        if (!$originalDoc) {
            $command->info('Unexpected no document on ' . $class);
        }
        $phpdoc = new DocBlock($reflection, new Context($namespace));

        $mixins = $phpdoc->getTagsByName('mixin');
        foreach ($mixins as $m) {
            if ($m->getContent() === '\Eloquent') {
                $command->info('Tag Exists: @mixin \Eloquent in ' . $class);

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
            $contents = $files->get($filename);
            if ($contents) {
                $count    = 0;
                $contents = str_replace($originalDoc, $docComment, $contents, $count);
                if ($count > 0) {
                    if ($files->put($filename, $contents)) {
                        $command->info('Wrote @mixin \Eloquent to ' . $filename);
                    } else {
                        $command->error('File write failed to ' . $filename);
                    }
                } else {
                    $command->error('Content did not change ' . $contents);
                }
            } else {
                $command->error('No file contents found ' . $filename);
            }
        } else {
            $command->error('Filename not found ' . $class);
        }
    }
}
