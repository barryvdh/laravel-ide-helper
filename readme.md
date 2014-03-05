## Laravel IDE Helper Generator
[![Latest Stable Version](https://poser.pugx.org/barryvdh/laravel-ide-helper/version.png)](https://packagist.org/packages/barryvdh/laravel-ide-helper) [![Total Downloads](https://poser.pugx.org/barryvdh/laravel-ide-helper/d/total.png)](https://packagist.org/packages/barryvdh/laravel-ide-helper)

### Complete phpDocs, directly from the source

This packages generates a file that your IDE can understand, so it can provide accurate autocompletion. Generation is done, based on the files in your project, so they are alway up-to-date.
If you don't want to generate it, you can add a pre-generated file to the root folder of your laravel project. (But this isn't as up-to-date as self generated files)

* Generated version: https://gist.github.com/barryvdh/5227822

Note: You do need CodeIntel for Sublime Text: https://github.com/SublimeCodeIntel/SublimeCodeIntel

### Automatic phpDoc generation for Laravel Facades

Require this package in your composer.json and run composer update (or run `composer require barryvdh/laravel-ide-helper:1.*` directly):

    "barryvdh/laravel-ide-helper": "1.*"

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
            "php artisan optimize",
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

If you don't want to write your properties yourself, you can use the command `ide-helper:models` to generate
phpDocs, based on table columns, relations and getters/setters. Still in beta, so please provide feedback if you want.
You can now also write the comments directly to your Model file, using the `--write (-W)` option. By default, you are asked to overwrite or
write to a separate file (\_ide\_helper\_models.php) (You can force No with `--nowrite (-N)`).
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
