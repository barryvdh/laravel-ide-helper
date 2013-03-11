## Laravel IDE Helper & Generator

### Complete phpDocs, directly from the source

Add the _IDE_helper.php to your laravel folder (not in a public folder). The file isn't used by Laravel, but it has to be indexed by your IDE.
You can also add Laravel/framework/preload/compiled.php to your dependencies/libraries to include all real namespaces (Laravel & Symfony), so you can link through to the original implementation.
This way you don't need to index/download your entire vendor folder.
The file has been tested in Netbeans 7.3 and PHPStorm 6.

### Automatic phpDoc generation for Laravel Facades

Require this package in your composer.json:

    "barryvdh/laravel-ide-helper": "dev-master"

And add the ServiceProvider to the providers array in app/config/app.php

    'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider',

You can now re-generate the docs yourself (for future updates) in arisan

    php artisan ide-helper:generate

You can also publish the config-file to add extra facades (ie. for bundles).

    php artisan config:publish barryvdh/laravel-ide-helper

You can just add the Facade and the 'real' class, like the rest of the classes.

    'Basset'  => 'Basset\Basset',

You can choose to include helper files. This is not enabled by default, but you can override this with the --helpers (-H) or --nohelpers (-N) option.
The Illuminate/Support/helpers.php file is already set-up, but you can add your own files in the config file.





