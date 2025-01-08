<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Filename
    |--------------------------------------------------------------------------
    |
    | The default filename.
    |
    */

    'filename' => '_ide_helper.php',

    /*
    |--------------------------------------------------------------------------
    | Models filename
    |--------------------------------------------------------------------------
    |
    | The default filename for the models helper file.
    |
    */

    'models_filename' => '_ide_helper_models.php',

    /*
    |--------------------------------------------------------------------------
    | PhpStorm meta filename
    |--------------------------------------------------------------------------
    |
    | PhpStorm also supports the directory `.phpstorm.meta.php/` with arbitrary
    | files in it, should you need additional files for your project; e.g.
    | `.phpstorm.meta.php/laravel_ide_Helper.php'.
    |
    */
    'meta_filename' => '.phpstorm.meta.php',

    /*
    |--------------------------------------------------------------------------
    | Fluent helpers
    |--------------------------------------------------------------------------
    |
    | Set to true to generate commonly used Fluent methods.
    |
    */

    'include_fluent' => false,

    /*
    |--------------------------------------------------------------------------
    | Factory builders
    |--------------------------------------------------------------------------
    |
    | Set to true to generate factory generators for better factory()
    | method auto-completion.
    |
    | Deprecated for Laravel 8 or latest.
    |
    */

    'include_factory_builders' => false,

    /*
    |--------------------------------------------------------------------------
    | Write model magic methods
    |--------------------------------------------------------------------------
    |
    | Set to false to disable write magic methods of model.
    |
    */

    'write_model_magic_where' => true,

    /*
    |--------------------------------------------------------------------------
    | Write model external Eloquent builder methods
    |--------------------------------------------------------------------------
    |
    | Set to false to disable write external Eloquent builder methods.
    |
    */

    'write_model_external_builder_methods' => true,

    /*
    |--------------------------------------------------------------------------
    | Write model relation count properties
    |--------------------------------------------------------------------------
    |
    | Set to false to disable writing of relation count properties to model DocBlocks.
    |
    */

    'write_model_relation_count_properties' => true,

    /*
    |--------------------------------------------------------------------------
    | Write Eloquent model mixins
    |--------------------------------------------------------------------------
    |
    | This will add the necessary DocBlock mixins to the model class
    | contained in the Laravel framework. This helps the IDE with
    | auto-completion.
    |
    | Please be aware that this setting changes a file within the /vendor directory.
    |
    */

    'write_eloquent_model_mixins' => false,

    /*
    |--------------------------------------------------------------------------
    | Helper files to include
    |--------------------------------------------------------------------------
    |
    | Include helper files. By default not included, but can be toggled with the
    | -- helpers (-H) option. Extra helper files can be included.
    |
    */

    'include_helpers' => false,

    'helper_files' => [
        base_path() . '/vendor/laravel/framework/src/Illuminate/Support/helpers.php',
        base_path() . '/vendor/laravel/framework/src/Illuminate/Foundation/helpers.php',
    ],

    /*
    |--------------------------------------------------------------------------
    | Model locations to include
    |--------------------------------------------------------------------------
    |
    | Define in which directories the ide-helper:models command should look
    | for models.
    |
    | glob patterns are supported to easier reach models in sub-directories,
    | e.g. `app/Services/* /Models` (without the space).
    |
    */

    'model_locations' => [
        'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Models to ignore
    |--------------------------------------------------------------------------
    |
    | Define which models should be ignored.
    |
    */

    'ignored_models' => [
        // App\MyModel::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Models hooks
    |--------------------------------------------------------------------------
    |
    | Define which hook classes you want to run for models to add custom information.
    |
    | Hooks should implement Barryvdh\LaravelIdeHelper\Contracts\ModelHookInterface.
    |
    */

    'model_hooks' => [
        // App\Support\IdeHelper\MyModelHook::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Extra classes
    |--------------------------------------------------------------------------
    |
    | These implementations are not really extended, but called with magic functions.
    |
    */

    'extra' => [
        'Eloquent' => ['Illuminate\Database\Eloquent\Builder', 'Illuminate\Database\Query\Builder'],
        'Session' => ['Illuminate\Session\Store'],
    ],

    'magic' => [],

    /*
    |--------------------------------------------------------------------------
    | Interface implementations
    |--------------------------------------------------------------------------
    |
    | These interfaces will be replaced with the implementing class. Some interfaces
    | are detected by the helpers, others can be listed below.
    |
    */

    'interfaces' => [
        // App\MyInterface::class => App\MyImplementation::class,
    ],

    /*
     |--------------------------------------------------------------------------
     | Support for camel cased models
     |--------------------------------------------------------------------------
     |
     | There are some Laravel packages (such as Eloquence) that allow for accessing
     | Eloquent model properties via camel case, instead of snake case.
     |
     | Enabling this option will support these packages by saving all model
     | properties as camel case, instead of snake case.
     |
     | For example, normally you would see this:
     |
     |  * @property \Illuminate\Support\Carbon $created_at
     |  * @property \Illuminate\Support\Carbon $updated_at
     |
     | With this enabled, the properties will be this:
     |
     |  * @property \Illuminate\Support\Carbon $createdAt
     |  * @property \Illuminate\Support\Carbon $updatedAt
     |
     | Note, it is currently an all-or-nothing option.
     |
     */
    'model_camel_case_properties' => false,

    /*
    |--------------------------------------------------------------------------
    | Property casts
    |--------------------------------------------------------------------------
    |
    | Cast the given "real type" to the given "type".
    |
    */
    'type_overrides' => [
        'integer' => 'int',
        'boolean' => 'bool',
    ],

    /*
    |--------------------------------------------------------------------------
    | Include DocBlocks from classes
    |--------------------------------------------------------------------------
    |
    | Include DocBlocks from classes to allow additional code inspection for
    | magic methods and properties.
    |
    */
    'include_class_docblocks' => false,

    /*
    |--------------------------------------------------------------------------
    | Force FQN usage
    |--------------------------------------------------------------------------
    |
    | Use the fully qualified (class) name in DocBlocks,
    | even if the class exists in the same namespace
    | or there is an import (use className) of the class.
    |
    */
    'force_fqn' => false,

    /*
    |--------------------------------------------------------------------------
    | Use generics syntax
    |--------------------------------------------------------------------------
    |
    | Use generics syntax within DocBlocks,
    | e.g. `Collection<User>` instead of `Collection|User[]`.
    |
    */
    'use_generics_annotations' => true,

    /*
    |--------------------------------------------------------------------------
    | Additional relation types
    |--------------------------------------------------------------------------
    |
    | Sometimes it's needed to create custom relation types. The key of the array
    | is the relationship method name. The value of the array is the fully-qualified
    | class name of the relationship, e.g. `'relationName' => RelationShipClass::class`.
    |
    */
    'additional_relation_types' => [],

    /*
    |--------------------------------------------------------------------------
    | Additional relation return types
    |--------------------------------------------------------------------------
    |
    | When using custom relation types its possible for the class name to not contain
    | the proper return type of the relation. The key of the array is the relationship
    | method name. The value of the array is the return type of the relation ('many'
    | or 'morphTo').
    | e.g. `'relationName' => 'many'`.
    |
    */
    'additional_relation_return_types' => [],

    /*
    |--------------------------------------------------------------------------
    | Enforce nullable Eloquent relationships on not null columns
    |--------------------------------------------------------------------------
    |
    | When set to true (default), this option enforces nullable Eloquent relationships.
    | However, in cases where the application logic ensures the presence of related
    | records it may be desirable to set this option to false to avoid unwanted null warnings.
    |
    | Default: true
    | A not null column with no foreign key constraint will have a "nullable" relationship.
    |  * @property int $not_null_column_with_no_foreign_key_constraint
    |  * @property-read BelongsToVariation|null $notNullColumnWithNoForeignKeyConstraint
    |
    | Option: false
    | A not null column with no foreign key constraint will have a "not nullable" relationship.
    |  * @property int $not_null_column_with_no_foreign_key_constraint
    |  * @property-read BelongsToVariation $notNullColumnWithNoForeignKeyConstraint
    |
    */

    'enforce_nullable_relationships' => true,

    /*
    |--------------------------------------------------------------------------
    | Run artisan commands after migrations to generate model helpers
    |--------------------------------------------------------------------------
    |
    | The specified commands should run after migrations are finished running.
    |
    */
    'post_migrate' => [
        // 'ide-helper:models --nowrite',
    ],

    /*
    |--------------------------------------------------------------------------
    | Macroable Traits
    |--------------------------------------------------------------------------
    |
    | Define which traits should be considered capable of adding Macro.
    | You can add any custom trait that behaves like the original Laravel one.
    |
    */
    'macroable_traits' => [
        Filament\Support\Concerns\Macroable::class,
        Spatie\Macroable\Macroable::class,
    ],

];
