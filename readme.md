## Laravel IDE Helper & Generator

### Complete phpDocs, directly from the source

Add the helper file to your laravel folder (not in a public folder). The file isn't used by Laravel, but it has to be indexed by your IDE.

* Netbeans and PHPStorm version: https://gist.github.com/barryvdh/5227822
* SublimeText CodeIntel version: https://gist.github.com/barryvdh/5227814

### Automatic phpDoc generation for Laravel Facades

Require this package in your composer.json:

    "barryvdh/laravel-ide-helper": "dev-master"

And add the ServiceProvider to the providers array in app/config/app.php

    'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider',

You can now re-generate the docs yourself (for future updates) in arisan

    php artisan ide-helper:generate

If you use SublimeText CodeIntel, the format is a bit different. So add --sublime (or -S) to your command

    php artisan ide-helper:generate -S

You can also publish the config-file to add extra facades (ie. for bundles) or set defaults for --helpers or --sublime.

    php artisan config:publish barryvdh/laravel-ide-helper

The generator tries to identify the real class, but if it cannot be found, you can define it in the config file.

You can choose to include helper files. This is not enabled by default, but you can override this with the --helpers (-H) or --nohelpers (-N) option.
The Illuminate/Support/helpers.php is already set-up, but you can add/remove your own files in the config file.





