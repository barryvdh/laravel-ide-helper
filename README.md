# IDE Helper Generator for Laravel

[![Tests](https://github.com/barryvdh/laravel-ide-helper/actions/workflows/run-tests.yml/badge.svg)](https://github.com/barryvdh/laravel-ide-helper/actions)
[![Packagist License](https://img.shields.io/badge/Licence-MIT-blue)](http://choosealicense.com/licenses/mit/)
[![Latest Stable Version](https://img.shields.io/packagist/v/barryvdh/laravel-ide-helper?label=Stable)](https://packagist.org/packages/barryvdh/laravel-ide-helper)
[![Total Downloads](https://img.shields.io/packagist/dt/barryvdh/laravel-ide-helper?label=Downloads)](https://packagist.org/packages/barryvdh/laravel-ide-helper)
[![Fruitcake](https://img.shields.io/badge/Powered%20By-Fruitcake-b2bc35.svg)](https://fruitcake.nl/)

**Complete PHPDocs, directly from the source**

This package generates helper files that enable your IDE to provide accurate autocompletion.
Generation is done based on the files in your project, so they are always up-to-date.

The 3.x branch supports Laravel 10 and 11. For older version, use the 2.x releases.

- [Installation](#installation)
- [Usage](#usage)
  - [Automatic PHPDoc generation for Laravel Facades](#automatic-phpdoc-generation-for-laravel-facades)
  - [Automatic PHPDocs for models](#automatic-phpdocs-for-models)
    - [Model Directories](#model-directories)
    - [Ignore Models](#ignore-models)
    - [Model Hooks](#model-hooks)
  - [Automatic PHPDocs generation for Laravel Fluent methods](#automatic-phpdocs-generation-for-laravel-fluent-methods)
  - [Auto-completion for factory builders](#auto-completion-for-factory-builders)
  - [PhpStorm Meta for Container instances](#phpstorm-meta-for-container-instances)
- [License](#license)

## Installation

Require this package with composer using the following command:

```bash
composer require --dev barryvdh/laravel-ide-helper
```


## Usage

### TL;DR

Run this to generate autocompletion for Facades. This creates _ide_helper.php

```
php artisan ide-helper:generate
```

Run this to add phpdocs for your models. Add -RW to Reset existing phpdocs and Write to the models directly.
```
php artisan ide-helper:models -RW
```

If you don't want the full _ide_helper.php file, you can run add `--write-eloquent-helper` to the model command to generate small version, which is required for the `@mixin \Eloquent` to be able to add the QueryBuilder methods.

If you don't want to add all the phpdocs to your Models directly, you can use `--nowrite` to create a seperate file. The  `--write-mixin` option can be used to only add a `@mixin` to your models, but add the generated phpdocs in a seperate file. This avoids having the results marked as duplicate.


_Check out [this Laracasts video](https://laracasts.com/series/how-to-be-awesome-in-phpstorm/episodes/15) for a quick introduction/explanation!_

- `php artisan ide-helper:generate` - [PHPDoc generation for Laravel Facades ](#automatic-phpdoc-generation-for-laravel-facades)
- `php artisan ide-helper:models` - [PHPDocs for models](#automatic-phpdocs-for-models)
- `php artisan ide-helper:meta` - [PhpStorm Meta file](#phpstorm-meta-for-container-instances)


> Note: You do need CodeComplice for Sublime Text: https://github.com/spectacles/CodeComplice

### Automatic PHPDoc generation for Laravel Facades

You can now re-generate the docs yourself (for future updates)

```bash
php artisan ide-helper:generate
```

This will generate the file `_ide_helper.php` which is expected to be additionally parsed by your IDE for autocomplete. You can use the config `filename` to change its name.

You can configure your `composer.json` to do this each time you update your dependencies:

```js
"scripts": {
    "post-update-cmd": [
        "Illuminate\\Foundation\\ComposerScripts::postUpdate",
        "@php artisan ide-helper:generate",
        "@php artisan ide-helper:meta"
    ]
},
```

You can also publish the config file to change implementations (ie. interface to specific class) or set defaults for `--helpers`.

```bash
php artisan vendor:publish --provider="Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider" --tag=config
```

The generator tries to identify the real class, but if it cannot be found, you can define it in the config file.

Some classes need a working database connection. If you do not have a default working connection, some facades will not be included.
You can use an in-memory SQLite driver by adding the `-M` option.

If you use [real-time facades](https://laravel.com/docs/master/facades#real-time-facades) in your app, those will also be included in the generated file using a `@mixin` annotation and extending the original class underneath the facade. 

> **Note**: this feature uses the generated real-time facades files in the `storage/framework/cache` folder. Those files are generated on-demand as you use the real-time facade, so if the framework has not generated that first, it will not be included in the helper file. Run the route/command/code first and then regenerate the helper file and this time the real-time facade will be included in it.

You can choose to include helper files. This is not enabled by default, but you can override it with the `--helpers (-H)` option.
The `Illuminate/Support/helpers.php` is already set up, but you can add/remove your own files in the config file.

### Automatic PHPDoc generation for macros and mixins

This package can generate PHPDocs for macros and mixins which will be added to the `_ide_helper.php` file.

But this only works if you use type hinting when declaring a macro.

```php
Str::macro('concat', function(string $str1, string $str2) : string {
    return $str1 . $str2;
});
```

You can add any custom Macroable traits to detect in the `macroable_traits` config option.

### Automatic PHPDocs for models

If you don't want to write your properties yourself, you can use the command `php artisan ide-helper:models` to generate
PHPDocs, based on table columns, relations and getters/setters.

> Note: this command requires a working database connection to introspect the table of each model

By default, you are asked to overwrite or write to a separate file (`_ide_helper_models.php`).
You can write the comments directly to your Model file, using the `--write (-W)` option, or
force to not write with `--nowrite (-N)`.

Alternatively using the `--write-mixin (-M)` option will only add a mixin tag to your Model file,
writing the rest in (`_ide_helper_models.php`).
The class name will be different from the model, avoiding the IDE duplicate annoyance.

> Please make sure to back up your models, before writing the info.

> You need the _ide_helper.php file to add the QueryBuilder methods. You can add --write-eloquent-helper/-E to generate a minimal version. If this file does not exist, you will be prompted for it.

Writing to the models should keep the existing comments and only append new properties/methods. It will not update changed properties/methods.

With the `--reset (-R)` option, the whole existing PHPDoc is replaced, including any comments that have been made.

```bash
php artisan ide-helper:models "App\Models\Post"
```

```php
/**
 * App\Models\Post
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $title
 * @property string $text
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\Comment[] $comments
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Post forAuthors(\User ...$authors)
 * …
 */
```

With the `--write-mixin (-M)` option
```php
/**
 * …
 * @mixin IdeHelperPost
 */
```

#### Model Directories

By default, models in `app/models` are scanned. The optional argument tells what models to use (also outside app/models).

```bash
php artisan ide-helper:models "App\Models\Post" "App\Models\User"
```

You can also scan a different directory, using the `--dir` option (relative from the base path):

```bash
php artisan ide-helper:models --dir="path/to/models" --dir="app/src/Model"
```

You can publish the config file (`php artisan vendor:publish`) and set the default directories.

#### Ignore Models

Models can be ignored using the `--ignore (-I)` option

```bash
php artisan ide-helper:models --ignore="App\Models\Post,App\Models\User"
```

Or can be ignored by setting the `ignored_models` config

```php
'ignored_models' => [
    App\Post::class,
    Api\User::class
],
```

#### Magic `where*` methods

Eloquent allows calling `where<Attribute>` on your models, e.g. `Post::whereTitle(…)` and automatically translates this to e.g. `Post::where('title', '=', '…')`.

If for some reason it's undesired to have them generated (one for each column), you can disable this via config `write_model_magic_where` and setting it to `false`.

#### Magic `*_count` properties

You may use the [`::withCount`](https://laravel.com/docs/master/eloquent-relationships#counting-related-models) method to count the number results from a relationship without actually loading them. Those results are then placed in attributes following the `<columname>_count` convention.

By default, these attributes are generated in the phpdoc. You can turn them off by setting the config `write_model_relation_count_properties` to `false`.

#### Generics annotations

Laravel 9 introduced generics annotations in DocBlocks for collections. PhpStorm 2022.3 and above support the use of generics annotations within `@property` and `@property-read` declarations in DocBlocks, e.g. `Collection<User>` instead of `Collection|User[]`.

These can be disabled by setting the config `use_generics_annotations` to `false`.

#### Support `@comment` based on DocBlock

In order to better support IDEs, relations and getters/setters can also add a comment to a property like table columns. Therefore a custom docblock `@comment` is used:
```php
class Users extends Model
{
    /**
     * @comment Get User's full name
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' .$this->last_name ;
    }
}

// => after generate models

/**
 * App\Models\Users
 * 
 * @property-read string $full_name Get User's full name
 * …
 */
```

#### Dedicated Eloquent Builder methods

A new method to the eloquent models was added called `newEloquentBuilder` [Reference](https://timacdonald.me/dedicated-eloquent-model-query-builders/) where we can 
add support for creating a new dedicated class instead of using local scopes in the model itself.

If for some reason it's undesired to have them generated (one for each column), you can disable this via config `write_model_external_builder_methods` and setting it to `false`.

#### Custom Relationship Types

If you are using relationships not built into Laravel you will need to specify the name and returning class in the config to get proper generation.

```php
'additional_relation_types' => [
    'externalHasMany' => \My\Package\externalHasMany::class
],
```

Found relationships will typically generate a return value based on the name of the relationship.

If your custom relationships don't follow this traditional naming scheme you can define its return type manually. The available options are `many` and `morphTo`.

```php
'additional_relation_return_types' => [
    'externalHasMultiple' => 'many'
],
```

#### Model Hooks

If you need additional information on your model from sources that are not handled by default, you can hook in to the
 generation process with model hooks to add extra information on the fly.
 Simply create a class that implements `ModelHookInterface` and add it to the `model_hooks` array in the config:
 
 ```php
'model_hooks' => [
    MyCustomHook::class,
],
```

The `run` method will be called during generation for every model and receives the current running `ModelsCommand` and the current `Model`, e.g.:

```php
class MyCustomHook implements ModelHookInterface
{
    public function run(ModelsCommand $command, Model $model): void
    {
        if (! $model instanceof MyModel) {
            return;
        }

        $command->setProperty('custom', 'string', true, false, 'My custom property');
        $command->unsetMethod('method');
        $command->setMethod('method', $command->getMethodType($model, '\Some\Class'), ['$param']);
    }
}
```

```php
/**
 * MyModel
 *
 * @property integer $id
 * @property-read string $custom
```

### Automatic PHPDocs generation for Laravel Fluent methods

If you need PHPDocs support for Fluent methods in migration, for example

```php
$table->string("somestring")->nullable()->index();
```

After publishing vendor, simply change the `include_fluent` line in your `config/ide-helper.php` file into:

```php
'include_fluent' => true,
```

Then run `php artisan ide-helper:generate`, you will now see all Fluent methods recognized by your IDE.

### Auto-completion for factory builders

If you would like the `factory()->create()` and `factory()->make()` methods to return the correct model class,
you can enable custom factory builders with the `include_factory_builders` line in your `config/ide-helper.php` file.
Deprecated for Laravel 8 or latest.

```php
'include_factory_builders' => true,
```

For this to work, you must also publish the PhpStorm Meta file (see below).

## PhpStorm Meta for Container instances

It's possible to generate a PhpStorm meta file to [add support for factory design pattern](https://www.jetbrains.com/help/phpstorm/ide-advanced-metadata.html).
For Laravel, this means we can make PhpStorm understand what kind of object we are resolving from the IoC Container.
For example, `events` will return an `Illuminate\Events\Dispatcher` object,
so with the meta file you can call `app('events')` and it will autocomplete the Dispatcher methods.

```bash
php artisan ide-helper:meta
```

```php
app('events')->fire();
\App::make('events')->fire();

/** @var \Illuminate\Foundation\Application $app */
$app->make('events')->fire();

// When the key is not found, it uses the argument as class name
app('App\SomeClass');
// Also works with
app(App\SomeClass::class);
```

> Note: You might need to restart PhpStorm and make sure `.phpstorm.meta.php` is indexed.

> Note: When you receive a FatalException: class not found, check your config
> (for example, remove S3 as cloud driver when you don't have S3 configured. Remove Redis ServiceProvider when you don't use it).

You can change the generated filename via the config `meta_filename`. This can be useful for cases where you want to take advantage of PhpStorm's support of the _directory_ `.phpstorm.meta.php/`: all files placed there are parsed, should you want to provide additional files to PhpStorm.

## License

The Laravel IDE Helper Generator is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

