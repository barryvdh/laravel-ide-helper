## Laravel IDE Helper & Generator

### Complete phpDocs, directly from the source

Add the helper file to your laravel folder (not in a public folder). The file isn't used by Laravel, but it has to be indexed by your IDE.

* Netbeans and PHPStorm version: https://gist.github.com/barryvdh/5227822
* SublimeText CodeIntel version: https://gist.github.com/barryvdh/5227814

### Automatic phpDoc generation for Laravel Facades

Require this package in your composer.json:

    "barryvdh/laravel-ide-helper": "1.*"

And add the ServiceProvider to the providers array in app/config/app.php

    'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider',

You can now re-generate the docs yourself (for future updates) in artisan

    php artisan ide-helper:generate

If you use SublimeText CodeIntel, the format is a bit different. So add --sublime (or -S) to your command

    php artisan ide-helper:generate -S

Note: You do need CodeIntel for Sublime Text: https://github.com/Kronuz/SublimeCodeIntel

You can configure your composer.json to do this after each commit:

    "scripts":{
        "post-update-cmd":[
            "php artisan optimize",
            "php artisan ide-helper:generate",
        ]
    },

You can also publish the config-file to change implementations (ie. interface to specific class) or set defaults for --helpers or --sublime.

    php artisan config:publish barryvdh/laravel-ide-helper

The generator tries to identify the real class, but if it cannot be found, you can define it in the config file.

Some classes need a working database connection. If you do not have a working default connection, some facades will not be included.
You can use a in-memory sqlite driver, using the -M option.

You can choose to include helper files. This is not enabled by default, but you can override this with the --helpers (-H) option.
The Illuminate/Support/helpers.php is already set-up, but you can add/remove your own files in the config file.


### Work in progress: Model docs

If you don't want to write your properties yourself, you can use the (experimental) command `ide-helper:models` to generate
phpDocs, based on table columns, relations and getters/setters. Very alpha, so please provide feedback if you want.
Docs are written to a phpfile in the root of the project, so you can move the docs to the real model.

For now, only models in app/models are scanned. The optional argument tells what models to use.
`php artisan ide-helper:models Post,User`

Note: With namespaces, uses \\ instead of \
`php artisan ide-helper:models API\\User`

This creates a file with the phpDocs for each Model. You should check and change them to be more accurate.
It doesn't know if datetimes are returned as string or DateTime/Carbon, but I assume they are.
Also, all relations are Eloquent|Eloquent[] by default, you can change them to the actual Model.
After copying the phpdocs to your model, you can clear the file, so your IDE only uses the real source.


### License

The Laravel IDE Helper Generator is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)