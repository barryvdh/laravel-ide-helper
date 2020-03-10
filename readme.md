## Laravel IDE Helper Generator

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

__For Laravel 4.x, check [version 1.11](https://github.com/barryvdh/laravel-ide-helper/tree/1.11)__

  * [Complete phpDocs, directly from the source](#complete-phpdocs--directly-from-the-source)
  * [Install](#install)
  * [Automatic phpDoc generation for Laravel Facades](#automatic-phpdoc-generation-for-laravel-facades)
  * [Automatic phpDocs for models](#automatic-phpdocs-for-models)
  * [Automatic phpDocs generation for Laravel Fluent methods](#automatic-phpdocs-generation-for-laravel-fluent-methods)
  * [Auto-completion for factory builders](#auto-completion-for-factory-builders)
- [PhpStorm Meta for Container instances](#phpstorm-meta-for-container-instances)
- [Lumen Install](#lumen-install)
    + [Enabling Facades](#enabling-facades)
    + [Adding the Service Provider](#adding-the-service-provider)
    + [Adding Additional Facades](#adding-additional-facades)
  * [License](#license)

### Complete phpDocs, directly from the source

_Check out [this Laracasts video](https://laracasts.com/series/how-to-be-awesome-in-phpstorm/episodes/15) for a quick introduction/explanation!_

 * [`php artisan ide-helper:generate` - phpDoc generation for Laravel Facades ](#automatic-phpdoc-generation-for-laravel-facades)
 * [`php artisan ide-helper:models` - phpDocs for models](#automatic-phpdocs-for-models)
 * [`php artisan ide-helper:meta` - PhpStorm Meta file](#phpstorm-meta-for-container-instances)

This package generates a file that your IDE understands, so it can provide accurate autocompletion. Generation is done based on the files in your project, so they are always up-to-date.
If you don't want to generate it, you can add a pre-generated file to the root folder of your Laravel project (but this isn't as up-to-date as self generated files).

* Generated version for L5: https://gist.github.com/barryvdh/5227822
* Generated version for Lumen: https://gist.github.com/barryvdh/be17164b0ad51f832f20
* Generated Phpstorm Meta file: https://gist.github.com/barryvdh/bb6ffc5d11e0a75dba67

Note: You do need CodeComplice for Sublime Text: https://github.com/spectacles/CodeComplice

### Install

Require this package with composer using the following command:

```bash
composer require --dev barryvdh/laravel-ide-helper
```

After updating composer, add the service provider to the `providers` array in `config/app.php`

```php
Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
```
**Laravel 5.5** uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

In Laravel, instead of adding the service provider in the `config/app.php` file, you can add the following code to your `app/Providers/AppServiceProvider.php` file, within the `register()` method:

```php
public function register()
{
    if ($this->app->environment() !== 'production') {
        $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
    }
    // ...
}
```

This will allow your application to load the Laravel IDE Helper on non-production enviroments.

### Automatic phpDoc generation for Laravel Facades

You can now re-generate the docs yourself (for future updates)

```bash
php artisan ide-helper:generate
```

Note: `bootstrap/compiled.php` has to be cleared first, so run `php artisan clear-compiled` before generating.

You can configure your composer.json to do this after each commit:

```js
"scripts":{
    "post-update-cmd": [
        "Illuminate\\Foundation\\ComposerScripts::postUpdate",
        "@php artisan ide-helper:generate",
        "@php artisan ide-helper:meta"
    ]
},
```

You can also publish the config file to change implementations (ie. interface to specific class) or set defaults for `--helpers` or `--sublime`.

```bash
php artisan vendor:publish --provider="Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider" --tag=config
```

The generator tries to identify the real class, but if it cannot be found, you can define it in the config file.

Some classes need a working database connection. If you do not have a default working connection, some facades will not be included.
You can use an in-memory SQLite driver by adding the `-M` option.

You can choose to include helper files. This is not enabled by default, but you can override it with the `--helpers (-H)` option.
The `Illuminate/Support/helpers.php` is already set up, but you can add/remove your own files in the config file.

### Automatic phpDocs for models

If you don't want to write your properties yourself, you can use the command `php artisan ide-helper:models` to generate
phpDocs, based on table columns, relations and getters/setters. You can write the comments directly to your Model file, using the `--write (-W)` option. By default, you are asked to overwrite or write to a separate file (`_ide_helper_models.php`). You can force No with `--nowrite (-N)`.
Please make sure to backup your models, before writing the info.
It should keep the existing comments and only append new properties/methods. The existing phpdoc is replaced, or added if not found.
With the `--reset (-R)` option, the existing phpdocs are ignored, and only the newly found columns/relations are saved as phpdocs.

```bash
php artisan ide-helper:models Post
```

```php
/**
 * An Eloquent Model: 'Post'
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $title
 * @property string $text
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\Comment[] $comments
 */
```

By default, models in `app/models` are scanned. The optional argument tells what models to use (also outside app/models).

```bash
php artisan ide-helper:models Post User
```

You can also scan a different directory, using the `--dir` option (relative from the base path):

```bash
php artisan ide-helper:models --dir="path/to/models" --dir="app/src/Model"
```

You can publish the config file (`php artisan vendor:publish`) and set the default directories.

Models can be ignored using the `--ignore (-I)` option

```bash
php artisan ide-helper:models --ignore="Post,User"
```

Or can be ignored by setting the `ignored_models` config
```php
'ignored_models' => array(
    Post::class,
    Api\User::class
),
```

Note: With namespaces, wrap your model name in double-quotes (`"`): `php artisan ide-helper:models "API\User"`, or escape the slashes (`Api\\User`)

For properly recognition of `Model` methods (i.e. `paginate`, `findOrFail`) you should extend `\Eloquent` or add
```php
/** @mixin \Eloquent */
```
for your model class.

### Automatic phpDocs generation for Laravel Fluent methods
If you need phpDocs support for Fluent methods in migration, for example
```php
$table->string("somestring")->nullable()->index();
```
After publishing vendor, simply change the `include_fluent` line your `config/ide-helper.php` file into:
```php
'include_fluent' => true,
```
And then run `php artisan ide-helper:generate` , you will now see all of the Fluent methods are recognized by your IDE.


### Auto-completion for factory builders

If you would like the `factory()->create()` and `factory()->make()` methods to return the correct model class,
you can enable custom factory builders with the `include_factory_builders` line your `config/ide-helper.php` file.

```php
'include_factory_builders' => true,
```

For this to work, you must also publish the PhpStorm Meta file (see below). 


## PhpStorm Meta for Container instances

It's possible to generate a PhpStorm meta file to [add support for factory design pattern](https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Advanced+Metadata). For Laravel, this means we can make PhpStorm understand what kind of object we are resolving from the IoC Container. For example, `events` will return an `Illuminate\Events\Dispatcher` object, so with the meta file you can call `app('events')` and it will autocomplete the Dispatcher methods.

``` bash
php artisan ide-helper:meta
```

```php
app('events')->fire();
\App::make('events')->fire();

/** @var \Illuminate\Foundation\Application $app */
$app->make('events')->fire();

// When the key is not found, it uses the argument as class name
app('App\SomeClass');
```

Pre-generated example: https://gist.github.com/barryvdh/bb6ffc5d11e0a75dba67

> Note: You might need to restart PhpStorm and make sure `.phpstorm.meta.php` is indexed.
> Note: When you receive a FatalException about a class that is not found, check your config (for example, remove S3 as cloud driver when you don't have S3 configured. Remove Redis ServiceProvider when you don't use it).

## Lumen Install

This package is focused on Laravel development, but it can also be used in Lumen with some workarounds. Because Lumen works a little different, as it is like a barebone version of Laravel and the main configuration parameters are instead located in `bootstrap/app.php`, some alterations must be made.

#### Enabling Facades

While Laravel IDE Helper can generate automatically default Facades for code hinting, Lumen doesn't come with Facades activated. If you plan in using them, you must enable them under the `Create The Application` section, uncommenting this line:

```php
// $app->withFacades();
```

From there, you should be able to use the `create_alias()` function to add additional Facades into your application.

#### Adding the Service Provider

You can install Laravel IDE Helper in `app/Providers/AppServiceProvider.php`, and uncommenting this line that registers the App Service Providers so it can properly load.

```php
// $app->register(App\Providers\AppServiceProvider::class);
```

If you are not using that line, that is usually handy to manage gracefully multiple Laravel/Lumen installations, you will have to add this line of code under the `Register Service Providers` section of your `bootstrap/app.php`.

```php
if ($app->environment() !== 'production') {
    $app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
}
```

After that, Laravel IDE Helper should work correctly. During the generation process, the script may throw exceptions saying that some Class(s) doesn't exist or there are some undefined indexes. This is normal, as Lumen has some default packages stripped away, like Cookies, Storage and Session. If you plan to add these packages, you will have to add them manually and create additional Facades if needed.

#### Adding Additional Facades

Currently Lumen IDE Helper doesn't take into account additional Facades created under `bootstrap/app.php` using `create_alias()`, so you need to create a `config/app.php` file and add your custom aliases under an `aliases` array again, like so:

```php
return [
    'aliases' => [
        'CustomAliasOne' => Example\Support\Facades\CustomAliasOne::class,
        'CustomAliasTwo' => Example\Support\Facades\CustomAliasTwo::class,
        //...
    ]
];
```

After you run ```php artisan ide-helper:generate```, it's recommended (but not mandatory) to rename `config/app.php` to something else until you have to re-generate the docs or after passing to production enviroment. Lumen 5.1+ will read this file for configuration parameters if it is present, and may overlap some configurations if it is completely populated.

### License

The Laravel IDE Helper Generator is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)


[ico-version]: https://img.shields.io/packagist/v/barryvdh/laravel-ide-helper.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/barryvdh/laravel-ide-helper/master.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/barryvdh/laravel-ide-helper.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/barryvdh/laravel-ide-helper
[link-travis]: https://travis-ci.org/barryvdh/laravel-ide-helper
[link-downloads]: https://packagist.org/packages/barryvdh/laravel-ide-helper
[link-author]: https://github.com/barryvdh
[link-contributors]: ../../contributors
