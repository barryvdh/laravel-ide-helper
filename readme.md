## Laravel IDE Helper Generator
[![Latest Stable Version](https://poser.pugx.org/barryvdh/laravel-ide-helper/version.png)](https://packagist.org/packages/barryvdh/laravel-ide-helper) [![Total Downloads](https://poser.pugx.org/barryvdh/laravel-ide-helper/d/total.png)](https://packagist.org/packages/barryvdh/laravel-ide-helper)

### For Laravel 5, check the [2.0 branch](https://github.com/barryvdh/laravel-ide-helper)

### Complete phpDocs, directly from the source

_Checkout [this Laracasts video](https://laracasts.com/series/how-to-be-awesome-in-phpstorm/episodes/15) for a quick introduction/explanation!_

This packages generates a file that your IDE can understand, so it can provide accurate autocompletion. Generation is done, based on the files in your project, so they are alway up-to-date.
If you don't want to generate it, you can add a pre-generated file to the root folder of your laravel project. (But this isn't as up-to-date as self generated files)

* Generated version: https://gist.github.com/barryvdh/5227822

Note: You do need CodeIntel for Sublime Text: https://github.com/SublimeCodeIntel/SublimeCodeIntel

### New: PhpStorm Meta for Container instances

It's possible to generate a PhpStorm meta file, to [add support for factory design pattern](https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Advanced+Metadata). For Laravel, this means we can make PhpStorm understand what kind of object we are resolving from the IoC Container. For example, `events` will return ann `Illuminate\Events\Dispatcher` object, so with the meta file you can call `app('events')` and it will autocomplete the Dispatcher methods.

    php artisan ide-helper:meta
    
    app('events')->fire();
    \App::make('events')->fire();
    
    /** @var \Illuminate\Foundation\Application $app */
    $app->make('events')->fire();

Pre-generated example: https://gist.github.com/barryvdh/bb6ffc5d11e0a75dba67    

> Note: You might need to restart PhpStorm and make sure `.phpstorm.meta.php` is indexed.

### Automatic phpDoc generation for Laravel Facades

Require this package with composer using the following command:

    composer require barryvdh/laravel-ide-helper ~1.11

After updating composer, add the ServiceProvider to the providers array in app/config/app.php

    'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider',

You can now re-generate the docs yourself (for future updates) in artisan

    php artisan ide-helper:generate

Note: bootstrap/compiled.php has to be cleared first, so run `php artisan clear-compiled` before generating (and `php artisan optimize` after..)

You can configure your composer.json to do this after each commit:

    "scripts":{
        "post-update-cmd":[
            "php artisan clear-compiled",
            "php artisan ide-helper:generate",
            "php artisan optimize"
        ]
    },

You can also publish the config-file to change implementations (ie. interface to specific class) or set defaults for --helpers or --sublime.

    php artisan config:publish barryvdh/laravel-ide-helper

The generator tries to identify the real class, but if it cannot be found, you can define it in the config file.

Some classes need a working database connection. If you do not have a working default connection, some facades will not be included.
You can use a in-memory sqlite driver, using the -M option.

You can choose to include helper files. This is not enabled by default, but you can override this with the --helpers (-H) option.
The Illuminate/Support/helpers.php is already set-up, but you can add/remove your own files in the config file.

### Automatic phpDocs for Models

> **Note:** Since v1.10 you need to require `doctrine/dbal: ~2.3` in your own composer.json. 

If you don't want to write your properties yourself, you can use the command `ide-helper:models` to generate
phpDocs, based on table columns, relations and getters/setters. You can write the comments directly to your Model file, using the `--write (-W)` option. By default, you are asked to overwrite or write to a separate file (\_ide\_helper\_models.php) (You can force No with `--nowrite (-N)`).
Please make sure to backup your models, before writing the info.
It should keep the existing comments and only append new properties/methods. The existing phpdoc is replaced, or added if not found.
With the `--reset (-R)` option, the existing phpdocs are ignored, only the newly found columns/relations are saved as phpdocs.

    php artisan ide-helper:models Post

    /**
     * An Eloquent Model: 'Post'
     *
     * @property integer $id
     * @property integer $author_id
     * @property string $title
     * @property string $text
     * @property \Carbon\Carbon $created_at
     * @property \Carbon\Carbon $updated_at
     * @property-read \User $author
     * @property-read \Illuminate\Database\Eloquent\Collection|\Comment[] $comments
     */

By default, models in app/models are scanned. The optional argument tells what models to use (also outside app/models).

    php artisan ide-helper:models Post User

You can also scan a different directory, using the --dir option (relative from the base path):

    php artisan ide-helper:models --dir="app/workbench/name/package/models" --dir="app/src/Model"
   
You can publish the config file (`php artisan config:publish barryvdh/laravel-ide-helper`) and set the default directories.

Models can be ignored using the --ignore (-I) option

    php artisan ide-helper:models --ignore="Post,User"

Note: With namespaces, wrap your model name in " signs: `php artisan ide-helper:models "API\User"`, or escape the slashes (`Api\\User`)

### License

The Laravel IDE Helper Generator is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
