## Laravel IDE Helper & Generator

### Complete phpDocs, directly from the source

Add the _IDE_helper.php to your laravel folder (not in a public folder). The file isn't used by Laravel, but it has to be indexed by your IDE.
The file has been tested in PHPStorm 6.

### Automatic phpDoc generation for Laravel Facades

Require this package in your composer.json:

    "barryvdh/laravel-ide-helper": "dev-master"

And add the ServiceProvider to the providers array in app/config/app.php

    'Barryvdh\IdeHelper\IdeHelperServiceProvider',

You can now re-generate the docs yourself (for future updates) in arisan

    php artisan ide-helper:generate

You can also publish the config-file to add extra facades (ie. for bundles).

    php artisan config:publish barryvdh/ide-helper

You can just add the Facade and the 'real' class, like the rest of the classes.

    'Eloquent'  => 'Illuminate\Database\Eloquent\Model',



