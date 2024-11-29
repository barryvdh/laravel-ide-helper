<?php

/**
 * Laravel IDE Helper Generator
 *
 * @author    Barry vd. Heuvel <barryvdh@gmail.com>
 * @copyright 2014 Barry vd. Heuvel / Fruitcake Studio (http://www.fruitcakestudio.nl)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/barryvdh/laravel-ide-helper
 */

namespace Barryvdh\LaravelIdeHelper\Console;

use Barryvdh\LaravelIdeHelper\Contracts\ModelHookInterface;
use Barryvdh\LaravelIdeHelper\Parsers\PhpDocReturnTypeParser;
use Barryvdh\Reflection\DocBlock;
use Barryvdh\Reflection\DocBlock\Context;
use Barryvdh\Reflection\DocBlock\Serializer as DocBlockSerializer;
use Barryvdh\Reflection\DocBlock\Tag;
use Composer\ClassMapGenerator\ClassMapGenerator;
use Illuminate\Console\Command;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Database\Eloquent\CastsInboundAttributes;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Schema\Builder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\ContextFactory;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionObject;
use ReflectionType;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

/**
 * A command to generate autocomplete information for your IDE
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */
class ModelsCommand extends Command
{
    protected const RELATION_TYPES = [
        'hasMany' => HasMany::class,
        'hasManyThrough' => HasManyThrough::class,
        'hasOneThrough' => HasOneThrough::class,
        'belongsToMany' => BelongsToMany::class,
        'hasOne' => HasOne::class,
        'belongsTo' => BelongsTo::class,
        'morphOne' => MorphOne::class,
        'morphTo' => MorphTo::class,
        'morphMany' => MorphMany::class,
        'morphToMany' => MorphToMany::class,
        'morphedByMany' => MorphToMany::class,
    ];

    /**
     * @var Filesystem $files
     */
    protected $files;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ide-helper:models';

    /**
     * @var string
     */
    protected $filename;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate autocompletion for models';

    protected $write_model_magic_where;
    protected $write_model_relation_count_properties;
    protected $properties = [];
    protected $methods = [];
    protected $write = false;
    protected $write_mixin = false;
    protected $dirs = [];
    protected $reset;
    protected $phpstorm_noinspections;
    protected $write_model_external_builder_methods;
    /**
     * @var array<string, true>
     */
    protected $nullableColumns = [];
    /**
     * @var string[]
     */
    protected $foreignKeyConstraintsColumns = [];

    /**
     * During initialization we use Laravels Date Facade to
     * determine the actual date class and store it here.
     *
     * @var string
     */
    protected $dateClass;

    /**
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->filename = $this->laravel['config']->get('ide-helper.models_filename', '_ide_helper_models.php');
        $filename = $this->option('filename') ?? $this->filename;
        $this->write = $this->option('write');
        $this->write_mixin = $this->option('write-mixin');
        $this->dirs = array_merge(
            $this->laravel['config']->get('ide-helper.model_locations', []),
            $this->option('dir')
        );
        $model = $this->argument('model');
        $ignore = $this->option('ignore');
        $this->reset = $this->option('reset');
        $this->phpstorm_noinspections = $this->option('phpstorm-noinspections');
        $this->write_model_magic_where = $this->laravel['config']->get('ide-helper.write_model_magic_where', true);
        $this->write_model_external_builder_methods = $this->laravel['config']->get('ide-helper.write_model_external_builder_methods', true);
        $this->write_model_relation_count_properties =
            $this->laravel['config']->get('ide-helper.write_model_relation_count_properties', true);

        $this->write = $this->write_mixin ? true : $this->write;
        //If filename is default and Write is not specified, ask what to do
        if (!$this->write && $filename === $this->filename && !$this->option('nowrite')) {
            if (
                $this->confirm(
                    "Do you want to overwrite the existing model files? Choose no to write to $filename instead"
                )
            ) {
                $this->write = true;
            }
        }

        $this->dateClass = class_exists(\Illuminate\Support\Facades\Date::class)
            ? '\\' . get_class(\Illuminate\Support\Facades\Date::now())
            : '\Illuminate\Support\Carbon';

        $content = $this->generateDocs($model, $ignore);

        if (!$this->write || $this->write_mixin) {
            $written = $this->files->put($filename, $content);
            if ($written !== false) {
                $this->info("Model information was written to $filename");
            } else {
                $this->error("Failed to write model information to $filename");
            }
        }
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['model', InputArgument::OPTIONAL | InputArgument::IS_ARRAY, 'Which models to include', []],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['filename', 'F', InputOption::VALUE_OPTIONAL, 'The path to the helper file'],
            ['dir', 'D', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
                'The model dir, supports glob patterns', [], ],
            ['write', 'W', InputOption::VALUE_NONE, 'Write to Model file'],
            ['write-mixin', 'M', InputOption::VALUE_NONE,
                "Write models to {$this->filename} and adds @mixin to each model, avoiding IDE duplicate declaration warnings",
            ],
            ['nowrite', 'N', InputOption::VALUE_NONE, 'Don\'t write to Model file'],
            ['reset', 'R', InputOption::VALUE_NONE, 'Remove the original phpdocs instead of appending'],
            ['smart-reset', 'r', InputOption::VALUE_NONE, 'Retained for compatibility, while it no longer has any effect'],
            ['phpstorm-noinspections', 'p', InputOption::VALUE_NONE,
                'Add PhpFullyQualifiedNameUsageInspection and PhpUnnecessaryFullyQualifiedNameInspection PHPStorm ' .
                'noinspection tags',
            ],
            ['ignore', 'I', InputOption::VALUE_OPTIONAL, 'Which models to ignore', ''],
        ];
    }

    protected function generateDocs($loadModels, $ignore = '')
    {
        $output = "<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */
\n\n";

        if (empty($loadModels)) {
            $models = $this->loadModels();
        } else {
            $models = [];
            foreach ($loadModels as $model) {
                $models = array_merge($models, explode(',', $model));
            }
        }

        $ignore = array_merge(
            explode(',', $ignore),
            $this->laravel['config']->get('ide-helper.ignored_models', [])
        );

        foreach ($models as $name) {
            if (in_array($name, $ignore)) {
                if ($this->output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
                    $this->comment("Ignoring model '$name'");
                }
                continue;
            }
            $this->properties = [];
            $this->methods = [];
            $this->foreignKeyConstraintsColumns = [];
            if (class_exists($name)) {
                try {
                    // handle abstract classes, interfaces, ...
                    $reflectionClass = new ReflectionClass($name);

                    if (!$reflectionClass->isSubclassOf('Illuminate\Database\Eloquent\Model')) {
                        continue;
                    }

                    $this->comment("Loading model '$name'", OutputInterface::VERBOSITY_VERBOSE);

                    if (!$reflectionClass->IsInstantiable()) {
                        // ignore abstract class or interface
                        continue;
                    }

                    $model = $this->laravel->make($name);

                    $this->getPropertiesFromTable($model);

                    if (method_exists($model, 'getCasts')) {
                        $this->castPropertiesType($model);
                    }

                    $this->getPropertiesFromMethods($model);
                    $this->getSoftDeleteMethods($model);
                    $this->getCollectionMethods($model);
                    $this->getFactoryMethods($model);

                    $this->runModelHooks($model);

                    $output                .= $this->createPhpDocs($name);
                    $ignore[]              = $name;
                    $this->nullableColumns = [];
                } catch (Throwable $e) {
                    $this->error('Exception: ' . $e->getMessage() .
                        "\nCould not analyze class $name.\n\nTrace:\n" .
                        $e->getTraceAsString());
                }
            }
        }

        return $output;
    }


    protected function loadModels()
    {
        $models = [];
        foreach ($this->dirs as $dir) {
            if (is_dir(base_path($dir))) {
                $dir = base_path($dir);
            }

            $dirs = glob($dir, GLOB_ONLYDIR);
            foreach ($dirs as $dir) {
                if (!is_dir($dir)) {
                    $this->error("Cannot locate directory '{$dir}'");
                    continue;
                }

                if (file_exists($dir)) {
                    $classMap = ClassMapGenerator::createMap($dir);

                    // Sort list so it's stable across different environments
                    ksort($classMap);

                    foreach ($classMap as $model => $path) {
                        $models[] = $model;
                    }
                }
            }
        }
        return $models;
    }

    /**
     * cast the properties's type from $casts.
     *
     * @param Model $model
     */
    public function castPropertiesType($model)
    {
        $casts = $model->getCasts();
        foreach ($casts as $name => $type) {
            if (Str::startsWith($type, 'decimal:')) {
                $type = 'decimal';
            } elseif (Str::startsWith($type, 'custom_datetime:')) {
                $type = 'date';
            } elseif (Str::startsWith($type, 'date:')) {
                $type = 'date';
            } elseif (Str::startsWith($type, 'datetime:')) {
                $type = 'date';
            } elseif (Str::startsWith($type, 'immutable_custom_datetime:')) {
                $type = 'immutable_date';
            } elseif (Str::startsWith($type, 'immutable_date:')) {
                $type = 'immutable_date';
            } elseif (Str::startsWith($type, 'immutable_datetime:')) {
                $type = 'immutable_datetime';
            } elseif (Str::startsWith($type, 'encrypted:')) {
                $type = Str::after($type, ':');
            }

            $params = [];

            switch ($type) {
                case 'encrypted':
                    $realType = 'mixed';
                    break;
                case 'boolean':
                case 'bool':
                    $realType = 'bool';
                    break;
                case 'decimal':
                    $realType = 'numeric';
                    break;
                case 'string':
                case 'hashed':
                    $realType = 'string';
                    break;
                case 'array':
                case 'json':
                    $realType = 'array';
                    break;
                case 'object':
                    $realType = 'object';
                    break;
                case 'int':
                case 'integer':
                case 'timestamp':
                    $realType = 'int';
                    break;
                case 'real':
                case 'double':
                case 'float':
                    $realType = 'float';
                    break;
                case 'date':
                case 'datetime':
                    $realType = $this->dateClass;
                    break;
                case 'immutable_date':
                case 'immutable_datetime':
                    $realType = '\Carbon\CarbonImmutable';
                    break;
                case 'collection':
                    $realType = '\Illuminate\Support\Collection';
                    break;
                case AsArrayObject::class:
                    $realType = '\ArrayObject';
                    break;
                default:
                    // In case of an optional custom cast parameter , only evaluate
                    // the `$type` until the `:`
                    $type = strtok($type, ':');
                    $realType = class_exists($type) ? ('\\' . $type) : 'mixed';
                    $this->setProperty($name, null, true, true);

                    $params = strtok(':');
                    $params = $params ? explode(',', $params) : [];
                    break;
            }

            if (!isset($this->properties[$name])) {
                continue;
            }
            if ($this->isInboundCast($realType)) {
                continue;
            }

            if (Str::startsWith($type, AsCollection::class)) {
                $realType = $this->getTypeInModel($model, $params[0] ?? null) ?? '\Illuminate\Support\Collection';
            }

            if (Str::startsWith($type, AsEnumCollection::class)) {
                $realType = '\Illuminate\Support\Collection';
                $relatedModel = $this->getTypeInModel($model, $params[0] ?? null);
                if ($relatedModel) {
                    $realType = $this->getCollectionTypeHint($realType, $relatedModel);
                }
            }

            $realType = $this->checkForCastableCasts($realType, $params);
            $realType = $this->checkForCustomLaravelCasts($realType);
            $realType = $this->getTypeOverride($realType);
            $realType = $this->getTypeInModel($model, $realType);
            $realType = $this->applyNullability($realType, isset($this->nullableColumns[$name]));

            $this->properties[$name]['type'] = $realType;
        }
    }

    protected function applyNullability(?string $type, bool $isNullable): ?string
    {
        if (!$type) {
            return null;
        }

        $nullString = null;

        // Find instance of:
        // A) start of string or non-word character (like space or pipe) followed by 'null|'
        // B) '|null' followed by end of string or non-word character (like space or pipe)
        // This will find 'or null' instances at the beginning, middle or end of a type string,
        // but will exclude solo/pure null instances and null being part of a type's name (e.g. class 'Benull').
        if (preg_match('/(?:(?:^|\W)(null\|))|(\|null(?:$|\W))/', $type, $matches) === 1) {
            $nullString = array_pop($matches);
        }

        // Return the current type string if:
        // A) the type can be null and the type contains a null instance
        // B) the type can not be null and the type does not contain a null instance
        if (!($isNullable xor $nullString)) {
            return $type;
        }

        if ($isNullable) {
            $type .= '|null';
        } else {
            $type = str_replace($nullString, '', $type);
        }

        return $type;
    }

    /**
     * Returns the override type for the give type.
     *
     * @param string $type
     * @return string|null
     */
    protected function getTypeOverride($type)
    {
        $typeOverrides = $this->laravel['config']->get('ide-helper.type_overrides', []);

        return $typeOverrides[$type] ?? $type;
    }

    /**
     * Load the properties from the database table.
     *
     * @param Model $model
     *
     */
    public function getPropertiesFromTable($model)
    {
        $table = $model->getTable();
        $schema = $model->getConnection()->getSchemaBuilder();
        $columns = $schema->getColumns($table);
        $driverName = $model->getConnection()->getDriverName();


        if (!$columns) {
            return;
        }

        $this->setForeignKeys($schema, $table);
        foreach ($columns as $column) {
            $name = $column['name'];
            if (in_array($name, $model->getDates())) {
                $type = $this->dateClass;
            } else {
                // Match types to php equivalent
                $type = match ($column['type_name']) {
                    'tinyint', 'bit',
                    'integer', 'int', 'int4',
                    'smallint', 'int2',
                    'mediumint',
                    'bigint', 'int8' => 'int',

                    'boolean', 'bool' => 'bool',

                    'float', 'real', 'float4',
                    'double', 'float8' => 'float',

                    default => 'string',
                };
            }

            if ($column['nullable']) {
                $this->nullableColumns[$name] = true;
            }
            $this->setProperty(
                $name,
                $this->getTypeInModel($model, $type),
                true,
                true,
                $column['comment'],
                $column['nullable']
            );
            if ($this->write_model_magic_where) {
                $builderClass = $this->write_model_external_builder_methods
                    ? get_class($model->newModelQuery())
                    : '\Illuminate\Database\Eloquent\Builder';

                $this->setMethod(
                    Str::camel('where_' . $name),
                    $this->getClassNameInDestinationFile($model, $builderClass)
                    . '<static>|'
                    . $this->getClassNameInDestinationFile($model, get_class($model)),
                    ['$value']
                );
            }
        }
    }

    /**
     * @param Model $model
     */
    public function getPropertiesFromMethods($model)
    {
        $reflectionClass = new ReflectionClass($model);
        $reflections = $reflectionClass->getMethods();
        if ($reflections) {
            // Filter out private methods because they can't be used to generate magic properties and HasAttributes'
            // methods that resemble mutators but aren't.
            $reflections = array_filter($reflections, function (\ReflectionMethod $methodReflection) {
                return !$methodReflection->isPrivate() && !(
                    $methodReflection->getDeclaringClass()->getName() === Model::class && (
                        $methodReflection->getName() === 'setClassCastableAttribute' ||
                        $methodReflection->getName() === 'setEnumCastableAttribute'
                    )
                );
            });
            sort($reflections);
            foreach ($reflections as $reflection) {
                $type = $this->getReturnTypeFromReflection($reflection);
                $isAttribute = is_a($type, '\Illuminate\Database\Eloquent\Casts\Attribute', true);
                $method = $reflection->getName();
                if (
                    Str::startsWith($method, 'get') && Str::endsWith($method, 'Attribute') && $method !== 'getAttribute'
                ) {
                    //Magic get<name>Attribute
                    $name = Str::snake(substr($method, 3, -9));
                    if (!empty($name)) {
                        $type = $this->getReturnType($reflection);
                        $type = $this->getTypeInModel($model, $type);
                        $comment = $this->getCommentFromDocBlock($reflection);
                        $this->setProperty($name, $type, true, null, $comment);
                    }
                } elseif ($isAttribute) {
                    $types = $this->getAttributeTypes($model, $reflection);
                    $type = $this->getTypeInModel($model, $types->get('get') ?: $types->get('set')) ?: null;
                    $this->setProperty(
                        Str::snake($method),
                        $type,
                        $types->has('get') ?: null,
                        $types->has('set') ?: null,
                        $this->getCommentFromDocBlock($reflection)
                    );
                } elseif (
                    Str::startsWith($method, 'set') &&
                    Str::endsWith($method, 'Attribute') &&
                    $method !== 'setAttribute'
                ) {
                    //Magic set<name>Attribute
                    $name = Str::snake(substr($method, 3, -9));
                    if (!empty($name)) {
                        $comment = $this->getCommentFromDocBlock($reflection);
                        $this->setProperty($name, null, null, true, $comment);
                    }
                } elseif (Str::startsWith($method, 'scope') && $method !== 'scopeQuery' && $method !== 'scope' && $method !== 'scopes') {
                    //Magic scope<name>Attribute
                    $name = Str::camel(substr($method, 5));
                    if (!empty($name)) {
                        $comment = $this->getCommentFromDocBlock($reflection);
                        $args = $this->getParameters($reflection);
                        //Remove the first ($query) argument
                        array_shift($args);
                        $builder = $this->getClassNameInDestinationFile(
                            $reflection->getDeclaringClass(),
                            get_class($model->newModelQuery())
                        );
                        $modelName = $this->getClassNameInDestinationFile(
                            new ReflectionClass($model),
                            get_class($model)
                        );
                        $this->setMethod($name, $builder . '<static>|' . $modelName, $args, $comment);
                    }
                } elseif (in_array($method, ['query', 'newQuery', 'newModelQuery'])) {
                    $builder = $this->getClassNameInDestinationFile($model, get_class($model->newModelQuery()));

                    $this->setMethod(
                        $method,
                        $builder . '<static>|' . $this->getClassNameInDestinationFile($model, get_class($model))
                    );

                    if ($this->write_model_external_builder_methods) {
                        $this->writeModelExternalBuilderMethods($model);
                    }
                } elseif (
                    !method_exists('Illuminate\Database\Eloquent\Model', $method)
                    && !Str::startsWith($method, 'get')
                ) {
                    //Use reflection to inspect the code, based on Illuminate/Support/SerializableClosure.php
                    if ($returnType = $reflection->getReturnType()) {
                        $type = $returnType instanceof ReflectionNamedType
                            ? $returnType->getName()
                            : (string)$returnType;
                    } else {
                        // php 7.x type or fallback to docblock
                        $type = (string)$this->getReturnTypeFromDocBlock($reflection);
                    }

                    $file = new \SplFileObject($reflection->getFileName());
                    $file->seek($reflection->getStartLine() - 1);

                    $code = '';
                    while ($file->key() < $reflection->getEndLine()) {
                        $code .= $file->current();
                        $file->next();
                    }
                    $code = trim(preg_replace('/\s\s+/', '', $code));
                    $begin = strpos($code, 'function(');
                    $code = substr($code, $begin, strrpos($code, '}') - $begin + 1);

                    foreach (
                        $this->getRelationTypes() as $relation => $impl
                    ) {
                        $search = '$this->' . $relation . '(';
                        if (stripos($code, $search) || ltrim($impl, '\\') === ltrim((string)$type, '\\')) {
                            //Resolve the relation's model to a Relation object.
                            if ($reflection->getNumberOfParameters()) {
                                continue;
                            }

                            $comment = $this->getCommentFromDocBlock($reflection);
                            // Adding constraints requires reading model properties which
                            // can cause errors. Since we don't need constraints we can
                            // disable them when we fetch the relation to avoid errors.
                            $relationObj = Relation::noConstraints(function () use ($model, $reflection) {
                                try {
                                    $methodName = $reflection->getName();
                                    return $model->$methodName();
                                } catch (Throwable $e) {
                                    $this->warn(sprintf('Error resolving relation model of %s:%s() : %s', get_class($model), $reflection->getName(), $e->getMessage()));

                                    return null;
                                }
                            });

                            if ($relationObj instanceof Relation) {
                                $relatedModel = $this->getClassNameInDestinationFile(
                                    $model,
                                    get_class($relationObj->getRelated())
                                );

                                $relationReturnType = $this->getRelationReturnTypes()[$relation] ?? false;

                                if (
                                    $relationReturnType === 'many' ||
                                    (
                                        !$relationReturnType &&
                                        str_contains(get_class($relationObj), 'Many')
                                    )
                                ) {
                                    if ($relationObj instanceof BelongsToMany) {
                                        $pivot = get_class($relationObj->newPivot());
                                        if (!in_array($pivot, [Pivot::class, MorphPivot::class])) {
                                            $pivot = $this->getClassNameInDestinationFile($model, $pivot);

                                            if ($existingPivot = ($this->properties[$relationObj->getPivotAccessor()] ?? null)) {
                                                $existingClasses = explode('|', $existingPivot['type']);

                                                if (!in_array($pivot, $existingClasses)) {
                                                    array_unshift($existingClasses, $pivot);
                                                }
                                            } else {
                                                // No existing pivot property, so we need to add a null type
                                                $existingClasses = [$pivot, 'null'];
                                            }

                                            // create a union type of all pivot classes
                                            $unionType = implode('|', $existingClasses);

                                            $this->setProperty(
                                                $relationObj->getPivotAccessor(),
                                                $unionType,
                                                true,
                                                false
                                            );
                                        }
                                    }

                                    //Collection or array of models (because Collection is Arrayable)
                                    $relatedClass = '\\' . get_class($relationObj->getRelated());
                                    $collectionClass = $this->getCollectionClass($relatedClass);
                                    $collectionClassNameInModel = $this->getClassNameInDestinationFile(
                                        $model,
                                        $collectionClass
                                    );
                                    $collectionTypeHint = $this->getCollectionTypeHint($collectionClassNameInModel, $relatedModel);
                                    $this->setProperty(
                                        $method,
                                        $collectionTypeHint,
                                        true,
                                        null,
                                        $comment
                                    );
                                    if ($this->write_model_relation_count_properties) {
                                        $this->setProperty(
                                            Str::snake($method) . '_count',
                                            'int|null',
                                            true,
                                            false
                                            // What kind of comments should be added to the relation count here?
                                        );
                                    }
                                } elseif (
                                    $relationReturnType === 'morphTo' ||
                                    (
                                        !$relationReturnType &&
                                        $relation === 'morphTo'
                                    )
                                ) {
                                    // Model isn't specified because relation is polymorphic
                                    $this->setProperty(
                                        $method,
                                        $this->getClassNameInDestinationFile($model, Model::class) . '|\Eloquent',
                                        true,
                                        null,
                                        $comment,
                                        $this->isMorphToRelationNullable($relationObj)
                                    );
                                } else {
                                    //Single model is returned
                                    $this->setProperty(
                                        $method,
                                        $relatedModel,
                                        true,
                                        null,
                                        $comment,
                                        $this->isRelationNullable($relation, $relationObj)
                                    );
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Check if the relation is nullable
     *
     * @param string   $relation
     * @param Relation $relationObj
     *
     * @return bool
     */
    protected function isRelationNullable(string $relation, Relation $relationObj): bool
    {
        $reflectionObj = new ReflectionObject($relationObj);

        if (in_array($relation, ['hasOne', 'hasOneThrough', 'morphOne'], true)) {
            $defaultProp = $reflectionObj->getProperty('withDefault');
            $defaultProp->setAccessible(true);

            return !$defaultProp->getValue($relationObj);
        }

        if (!$reflectionObj->hasProperty('foreignKey')) {
            return false;
        }

        $fkProp = $reflectionObj->getProperty('foreignKey');
        $fkProp->setAccessible(true);

        $enforceNullableRelation = $this->laravel['config']->get('ide-helper.enforce_nullable_relationships', true);

        foreach (Arr::wrap($fkProp->getValue($relationObj)) as $foreignKey) {
            if (isset($this->nullableColumns[$foreignKey])) {
                return true;
            }

            if (!in_array($foreignKey, $this->foreignKeyConstraintsColumns, true)) {
                return $enforceNullableRelation;
            }
        }

        return false;
    }

    /**
     * Check if the morphTo relation is nullable
     *
     * @param Relation $relationObj
     *
     * @return bool
     */
    protected function isMorphToRelationNullable(Relation $relationObj): bool
    {
        $reflectionObj = new ReflectionObject($relationObj);

        if (!$reflectionObj->hasProperty('foreignKey')) {
            return false;
        }

        $fkProp = $reflectionObj->getProperty('foreignKey');
        $fkProp->setAccessible(true);

        foreach (Arr::wrap($fkProp->getValue($relationObj)) as $foreignKey) {
            if (isset($this->nullableColumns[$foreignKey])) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string      $name
     * @param string|null $type
     * @param bool|null   $read
     * @param bool|null   $write
     * @param string|null $comment
     * @param bool        $nullable
     */
    public function setProperty($name, $type = null, $read = null, $write = null, $comment = '', $nullable = false)
    {
        if (!isset($this->properties[$name])) {
            $this->properties[$name] = [];
            $this->properties[$name]['type'] = 'mixed';
            $this->properties[$name]['read'] = false;
            $this->properties[$name]['write'] = false;
            $this->properties[$name]['comment'] = (string) $comment;
        }
        if ($type !== null) {
            $newType = $this->getTypeOverride($type);
            if ($nullable) {
                $newType .= '|null';
            }
            $this->properties[$name]['type'] = $newType;
        }
        if ($read !== null) {
            $this->properties[$name]['read'] = $read;
        }
        if ($write !== null) {
            $this->properties[$name]['write'] = $write;
        }
    }

    public function setMethod($name, $type = '', $arguments = [], $comment = '')
    {
        $methods = array_change_key_case($this->methods, CASE_LOWER);

        if (!isset($methods[strtolower($name)])) {
            $this->methods[$name] = [];
            $this->methods[$name]['type'] = $type;
            $this->methods[$name]['arguments'] = $arguments;
            $this->methods[$name]['comment'] = $comment;
        }
    }

    public function unsetMethod($name)
    {
        foreach ($this->methods as $k => $v) {
            if (strtolower($k) === strtolower($name)) {
                unset($this->methods[$k]);
                return;
            }
        }
    }

    public function getMethodType(Model $model, string $classType)
    {
        $modelName = $this->getClassNameInDestinationFile($model, get_class($model));
        $builder = $this->getClassNameInDestinationFile($model, $classType);
        return $builder . '<static>|' . $modelName;
    }

    /**
     * @param string $class
     * @return string
     */
    protected function createPhpDocs($class)
    {
        $reflection = new ReflectionClass($class);
        $namespace = $reflection->getNamespaceName();
        $classname = $reflection->getShortName();
        $originalDoc = $reflection->getDocComment();
        $keyword = $this->getClassKeyword($reflection);
        $interfaceNames = array_diff_key(
            $reflection->getInterfaceNames(),
            $reflection->getParentClass()->getInterfaceNames()
        );

        $phpdoc = new DocBlock($reflection, new Context($namespace));
        if ($this->reset) {
            $phpdoc->setText(
                (new DocBlock($reflection, new Context($namespace)))->getText()
            );
            foreach ($phpdoc->getTags() as $tag) {
                if (
                    in_array($tag->getName(), ['property', 'property-read', 'property-write', 'method', 'mixin'])
                    || ($tag->getName() === 'noinspection' && in_array($tag->getContent(), ['PhpUnnecessaryFullyQualifiedNameInspection', 'PhpFullyQualifiedNameUsageInspection']))
                ) {
                    $phpdoc->deleteTag($tag);
                }
            }
        }

        $properties = [];
        $methods = [];
        foreach ($phpdoc->getTags() as $tag) {
            $name = $tag->getName();
            if ($name == 'property' || $name == 'property-read' || $name == 'property-write') {
                $properties[] = $tag->getVariableName();
            } elseif ($name == 'method') {
                $methods[] = $tag->getMethodName();
            }
        }

        foreach ($this->properties as $name => $property) {
            $name = "\$$name";

            if ($this->hasCamelCaseModelProperties()) {
                $name = Str::camel($name);
            }

            if (in_array($name, $properties)) {
                continue;
            }
            if ($property['read'] && $property['write']) {
                $attr = 'property';
            } elseif ($property['write']) {
                $attr = 'property-write';
            } else {
                $attr = 'property-read';
            }

            $tagLine = trim("@{$attr} {$property['type']} {$name} {$property['comment']}");
            $tag = Tag::createInstance($tagLine, $phpdoc);
            $phpdoc->appendTag($tag);
        }

        ksort($this->methods);

        foreach ($this->methods as $name => $method) {
            if (in_array($name, $methods)) {
                continue;
            }
            $arguments = implode(', ', $method['arguments']);
            $tagLine = "@method static {$method['type']} {$name}({$arguments})";
            if ($method['comment'] !== '') {
                $tagLine .= " {$method['comment']}";
            }
            $tag = Tag::createInstance($tagLine, $phpdoc);
            $phpdoc->appendTag($tag);
        }

        if ($this->write) {
            $eloquentClassNameInModel = $this->getClassNameInDestinationFile($reflection, 'Eloquent');

            // remove the already existing tag to prevent duplicates
            foreach ($phpdoc->getTagsByName('mixin') as $tag) {
                if ($tag->getContent() === $eloquentClassNameInModel) {
                    $phpdoc->deleteTag($tag);
                }
            }

            $phpdoc->appendTag(Tag::createInstance('@mixin ' . $eloquentClassNameInModel, $phpdoc));
        }

        if ($this->phpstorm_noinspections) {
            /**
             * Facades, Eloquent API
             * @see https://www.jetbrains.com/help/phpstorm/php-fully-qualified-name-usage.html
             */
            $phpdoc->appendTag(Tag::createInstance('@noinspection PhpFullyQualifiedNameUsageInspection', $phpdoc));
            /**
             * Relations, other models in the same namespace
             * @see https://www.jetbrains.com/help/phpstorm/php-unnecessary-fully-qualified-name.html
             */
            $phpdoc->appendTag(
                Tag::createInstance('@noinspection PhpUnnecessaryFullyQualifiedNameInspection', $phpdoc)
            );
        }

        $serializer = new DocBlockSerializer();
        $docComment = $serializer->getDocComment($phpdoc);

        if ($this->write_mixin) {
            $phpdocMixin = new DocBlock($reflection, new Context($namespace));
            // remove all mixin tags prefixed with IdeHelper
            foreach ($phpdocMixin->getTagsByName('mixin') as $tag) {
                if (Str::startsWith($tag->getContent(), 'IdeHelper')) {
                    $phpdocMixin->deleteTag($tag);
                }
            }

            $mixinClassName = "IdeHelper{$classname}";
            $phpdocMixin->appendTag(Tag::createInstance("@mixin {$mixinClassName}", $phpdocMixin));
            $mixinDocComment = $serializer->getDocComment($phpdocMixin);
            // remove blank lines if there's no text
            if (!$phpdocMixin->getText()) {
                $mixinDocComment = preg_replace("/\s\*\s*\n/", '', $mixinDocComment);
            }

            foreach ($phpdoc->getTagsByName('mixin') as $tag) {
                if (Str::startsWith($tag->getContent(), 'IdeHelper')) {
                    $phpdoc->deleteTag($tag);
                }
            }
            $docComment = $serializer->getDocComment($phpdoc);
        }

        if ($this->write) {
            $modelDocComment = $this->write_mixin ? $mixinDocComment : $docComment;
            $filename = $reflection->getFileName();
            $contents = $this->files->get($filename);
            if ($originalDoc) {
                $contents = str_replace($originalDoc, $modelDocComment, $contents);
            } else {
                $replace = "{$modelDocComment}\n";
                $pos = strpos($contents, "final class {$classname}") ?: strpos($contents, "class {$classname}");
                if ($pos !== false) {
                    $contents = substr_replace($contents, $replace, $pos, 0);
                }
            }
            if ($this->files->put($filename, $contents)) {
                $this->info('Written new phpDocBlock to ' . $filename);
            }
        }

        $classname = $this->write_mixin ? $mixinClassName : $classname;

        $allowDynamicAttributes = $this->write_mixin ? "#[\AllowDynamicProperties]\n\t" : '';
        $output = "namespace {$namespace}{\n{$docComment}\n\t{$allowDynamicAttributes}{$keyword}class {$classname} ";

        if (!$this->write_mixin) {
            $output .= "extends \Eloquent ";

            if ($interfaceNames) {
                $interfaces = implode(', \\', $interfaceNames);
                $output .= "implements \\{$interfaces} ";
            }
        }

        return $output . "{}\n}\n\n";
    }

    /**
     * Get the parameters and format them correctly
     *
     * @param $method
     * @return array
     * @throws \ReflectionException
     */
    public function getParameters($method)
    {
        //Loop through the default values for parameters, and make the correct output string
        $paramsWithDefault = [];
        /** @var \ReflectionParameter $param */
        foreach ($method->getParameters() as $param) {
            $paramStr = $param->isVariadic() ? '...$' . $param->getName() : '$' . $param->getName();

            if ($paramType = $this->getParamType($method, $param)) {
                $paramStr = $paramType . ' ' . $paramStr;
            }

            if ($param->isOptional() && $param->isDefaultValueAvailable()) {
                $default = $param->getDefaultValue();
                if (is_bool($default)) {
                    $default = $default ? 'true' : 'false';
                } elseif (is_array($default)) {
                    $default = '[]';
                } elseif (is_null($default)) {
                    $default = 'null';
                } elseif (is_int($default)) {
                    //$default = $default;
                } elseif ($default instanceof \UnitEnum) {
                    $default = '\\' . get_class($default) . '::' . $default->name;
                } else {
                    $default = "'" . trim($default) . "'";
                }

                $paramStr .= " = $default";
            }

            $paramsWithDefault[] = $paramStr;
        }
        return $paramsWithDefault;
    }

    /**
     * Determine a model classes' collection type.
     *
     * @see http://laravel.com/docs/eloquent-collections#custom-collections
     * @param string $className
     * @return string
     */
    protected function getCollectionClass($className)
    {
        // Return something in the very very unlikely scenario the model doesn't
        // have a newCollection() method.
        if (!method_exists($className, 'newCollection')) {
            return '\Illuminate\Database\Eloquent\Collection';
        }

        /** @var Model $model */
        $model = new $className();
        return '\\' . get_class($model->newCollection());
    }

    /**
     * Determine a model classes' collection type hint.
     *
     * @param string $collectionClassNameInModel
     * @param string $relatedModel
     * @return string
     */
    protected function getCollectionTypeHint(string $collectionClassNameInModel, string $relatedModel): string
    {
        $useGenericsSyntax = $this->laravel['config']->get('ide-helper.use_generics_annotations', true);
        if ($useGenericsSyntax) {
            return $collectionClassNameInModel . '<int, ' . $relatedModel . '>';
        } else {
            return $collectionClassNameInModel . '|' . $relatedModel . '[]';
        }
    }

    /**
     * Returns the available relation types
     */
    protected function getRelationTypes(): array
    {
        $configuredRelations = $this->laravel['config']->get('ide-helper.additional_relation_types', []);
        return array_merge(self::RELATION_TYPES, $configuredRelations);
    }

    /**
     * Returns the return types of relations
     */
    protected function getRelationReturnTypes(): array
    {
        return $this->laravel['config']->get('ide-helper.additional_relation_return_types', []);
    }

    /**
     * @return bool
     */
    protected function hasCamelCaseModelProperties()
    {
        return $this->laravel['config']->get('ide-helper.model_camel_case_properties', false);
    }

    /**
     * @psalm-suppress NoValue
     */
    protected function getAttributeTypes(Model $model, \ReflectionMethod $reflectionMethod): Collection
    {
        // Private/protected ReflectionMethods require setAccessible prior to PHP 8.1
        $reflectionMethod->setAccessible(true);

        /** @var Attribute $attribute */
        $attribute = $reflectionMethod->invoke($model);

        $methods = new Collection();

        if ($attribute->get) {
            $methods['get'] = optional(new \ReflectionFunction($attribute->get))->getReturnType();
        }
        if ($attribute->set) {
            $function = optional(new \ReflectionFunction($attribute->set));
            if ($function->getNumberOfParameters() === 0) {
                $methods['set'] = null;
            } else {
                $methods['set'] = $function->getParameters()[0]->getType();
            }
        }

        return $methods
            ->map(function ($type) {
                if ($type === null) {
                    $types = collect([]);
                } elseif ($type instanceof \ReflectionUnionType) {
                    $types = collect($type->getTypes())
                        /** @var ReflectionType $reflectionType */
                        ->map(function ($reflectionType) {
                            return collect($this->extractReflectionTypes($reflectionType));
                        })
                        ->flatten();
                } else {
                    $types = collect($this->extractReflectionTypes($type));
                }

                if ($type && $type->allowsNull()) {
                    $types->push('null');
                }

                return $types->join('|');
            });
    }

    protected function getReturnType(\ReflectionMethod $reflection): ?string
    {
        $type = $this->getReturnTypeFromDocBlock($reflection);
        if ($type) {
            return $type;
        }

        return $this->getReturnTypeFromReflection($reflection);
    }

    /**
     * Get method comment based on it DocBlock comment
     *
     * @param \ReflectionMethod $reflection
     *
     * @return null|string
     */
    protected function getCommentFromDocBlock(\ReflectionMethod $reflection)
    {
        $phpDocContext = (new ContextFactory())->createFromReflector($reflection);
        $context = new Context(
            $phpDocContext->getNamespace(),
            $phpDocContext->getNamespaceAliases()
        );
        $comment = '';
        $phpdoc = new DocBlock($reflection, $context);

        if ($phpdoc->hasTag('comment')) {
            $comment = $phpdoc->getTagsByName('comment')[0]->getContent();
        }

        return $comment;
    }

    /**
     * Get method return type based on it DocBlock comment
     *
     * @param \ReflectionMethod $reflection
     * @param ?\Reflector $reflectorForContext
     *
     * @return null|string
     */
    protected function getReturnTypeFromDocBlock(\ReflectionMethod $reflection, ?\Reflector $reflectorForContext = null)
    {
        $phpDocContext = (new ContextFactory())->createFromReflector($reflectorForContext ?? $reflection);
        $context = new Context(
            $phpDocContext->getNamespace(),
            $phpDocContext->getNamespaceAliases()
        );
        $type = null;
        $phpdoc = new DocBlock($reflection, $context);

        if ($phpdoc->hasTag('return')) {
            $returnTag = $phpdoc->getTagsByName('return')[0];

            $typeParser = new PhpDocReturnTypeParser($returnTag->getContent(), $context->getNamespaceAliases());
            if ($typeAlias = $typeParser->parse()) {
                return $typeAlias;
            }

            $type = $phpdoc->getTagsByName('return')[0]->getType();
        }

        return $type;
    }

    protected function getReturnTypeFromReflection(\ReflectionMethod $reflection): ?string
    {
        $returnType = $reflection->getReturnType();
        if (!$returnType) {
            return null;
        }

        $types = $this->extractReflectionTypes($returnType);

        $type = implode('|', $types);

        if ($returnType->allowsNull()) {
            $type .= '|null';
        }

        return $type;
    }


    /**
     * Generates methods provided by the SoftDeletes trait
     * @param Model $model
     */
    protected function getSoftDeleteMethods($model)
    {
        $traits = class_uses_recursive($model);
        if (in_array('Illuminate\\Database\\Eloquent\\SoftDeletes', $traits)) {
            $modelName = $this->getClassNameInDestinationFile($model, get_class($model));
            $builder = $this->getClassNameInDestinationFile($model, \Illuminate\Database\Eloquent\Builder::class);
            $this->setMethod('withTrashed', $builder . '<static>|' . $modelName, []);
            $this->setMethod('withoutTrashed', $builder . '<static>|' . $modelName, []);
            $this->setMethod('onlyTrashed', $builder . '<static>|' . $modelName, []);
        }
    }

    /**
     * Generate factory method from "HasFactory" trait.
     *
     * @param Model $model
     */
    protected function getFactoryMethods($model)
    {
        if (!class_exists(Factory::class)) {
            return;
        }

        $modelName = get_class($model);


        $traits = class_uses_recursive($modelName);
        if (!in_array('Illuminate\\Database\\Eloquent\\Factories\\HasFactory', $traits)) {
            return;
        }

        if ($modelName::newFactory()) {
            $factory = get_class($modelName::newFactory());
        } else {
            $factory = Factory::resolveFactoryName($modelName);
        }

        $factory = '\\' . trim($factory, '\\');

        if (!class_exists($factory)) {
            return;
        }

        $this->setMethod('factory', $factory, ['$count = null, $state = []']);
    }

    /**
     * Generates methods that return collections
     * @param Model $model
     */
    protected function getCollectionMethods($model)
    {
        $collectionClass = $this->getCollectionClass(get_class($model));

        if ($collectionClass !== '\\' . \Illuminate\Database\Eloquent\Collection::class) {
            $collectionClassInModel = $this->getClassNameInDestinationFile($model, $collectionClass);

            $collectionTypeHint = $this->getCollectionTypeHint($collectionClassInModel, 'static');
            $this->setMethod('get', $collectionTypeHint, ['$columns = [\'*\']']);
            $this->setMethod('all', $collectionTypeHint, ['$columns = [\'*\']']);
        }
    }

    /**
     * @param ReflectionClass $reflection
     * @return string
     */
    protected function getClassKeyword(ReflectionClass $reflection)
    {
        if ($reflection->isFinal()) {
            $keyword = 'final ';
        } elseif ($reflection->isAbstract()) {
            $keyword = 'abstract ';
        } else {
            $keyword = '';
        }

        return $keyword;
    }

    protected function isInboundCast(string $type): bool
    {
        return class_exists($type) && is_subclass_of($type, CastsInboundAttributes::class);
    }

    protected function checkForCastableCasts(string $type, array $params = []): string
    {
        if (!class_exists($type) || !interface_exists(Castable::class)) {
            return $type;
        }

        $reflection = new ReflectionClass($type);

        if (!$reflection->implementsInterface(Castable::class)) {
            return $type;
        }

        $cast = call_user_func([$type, 'castUsing'], $params);

        if (is_string($cast) && !is_object($cast)) {
            return $cast;
        }

        $castReflection = new ReflectionObject($cast);

        $methodReflection = $castReflection->getMethod('get');

        return $this->getReturnTypeFromReflection($methodReflection) ??
            $this->getReturnTypeFromDocBlock($methodReflection, $reflection) ??
            $type;
    }

    /**
     * @param  string  $type
     * @return string|null
     * @throws \ReflectionException
     */
    protected function checkForCustomLaravelCasts(string $type): ?string
    {
        if (!class_exists($type) || !interface_exists(CastsAttributes::class)) {
            return $type;
        }

        $reflection = new ReflectionClass($type);

        if (!$reflection->implementsInterface(CastsAttributes::class)) {
            return $type;
        }

        $methodReflection = new \ReflectionMethod($type, 'get');

        $reflectionType = $this->getReturnTypeFromReflection($methodReflection);

        if ($reflectionType === null) {
            $reflectionType = $this->getReturnTypeFromDocBlock($methodReflection);
        }

        if ($reflectionType === 'static' || $reflectionType === '$this') {
            $reflectionType = $type;
        }

        return $reflectionType;
    }

    protected function getTypeInModel(object $model, ?string $type): ?string
    {
        if ($type === null) {
            return null;
        }

        if (class_exists($type)) {
            $type = $this->getClassNameInDestinationFile($model, $type);
        }

        return $type;
    }

    protected function getClassNameInDestinationFile(object $model, string $className): string
    {
        $reflection = $model instanceof ReflectionClass
            ? $model
            : new ReflectionObject($model);

        $className = trim($className, '\\');
        $writingToExternalFile = !$this->write || $this->write_mixin;
        $classIsNotInExternalFile = $reflection->getName() !== $className;
        $forceFQCN = $this->laravel['config']->get('ide-helper.force_fqn', false);

        if (($writingToExternalFile && $classIsNotInExternalFile) || $forceFQCN) {
            return '\\' . $className;
        }

        $usedClassNames = $this->getUsedClassNames($reflection);
        return $usedClassNames[$className] ?? ('\\' . $className);
    }

    /**
     * @param ReflectionClass $reflection
     * @return string[]
     */
    protected function getUsedClassNames(ReflectionClass $reflection): array
    {
        $namespaceAliases = array_flip((new ContextFactory())->createFromReflector($reflection)->getNamespaceAliases());
        $namespaceAliases[$reflection->getName()] = $reflection->getShortName();

        return $namespaceAliases;
    }

    protected function writeModelExternalBuilderMethods(Model $model): void
    {
        $fullBuilderClass = '\\' . get_class($model->newModelQuery());
        $newBuilderMethods = get_class_methods($fullBuilderClass);
        $originalBuilderMethods = get_class_methods('\Illuminate\Database\Eloquent\Builder');

        // diff the methods between the new builder and original one
        // and create helpers for the ones that are new
        $newMethodsFromNewBuilder = array_diff($newBuilderMethods, $originalBuilderMethods);

        if (!$newMethodsFromNewBuilder) {
            return;
        }

        // after we have retrieved the builder's methods
        // get the class of the builder based on the FQCN option
        $builderClassBasedOnFQCNOption = $this->getClassNameInDestinationFile($model, get_class($model->newModelQuery()));

        foreach ($newMethodsFromNewBuilder as $builderMethod) {
            $reflection = new \ReflectionMethod($fullBuilderClass, $builderMethod);
            $args = $this->getParameters($reflection);

            $this->setMethod(
                $builderMethod,
                $builderClassBasedOnFQCNOption . '<static>|' . $this->getClassNameInDestinationFile($model, get_class($model)),
                $args
            );
        }
    }

    protected function getParamType(\ReflectionMethod $method, \ReflectionParameter $parameter): ?string
    {
        if ($paramType = $parameter->getType()) {
            $types = $this->extractReflectionTypes($paramType);

            $type = implode('|', $types);

            if ($paramType->allowsNull()) {
                if (count($types) == 1) {
                    $type = '?' . $type;
                } else {
                    $type .= '|null';
                }
            }

            return $type;
        }

        $docComment = $method->getDocComment();

        if (!$docComment) {
            return null;
        }

        preg_match(
            '/@param ((?:(?:[\w?|\\\\<>])+(?:\[])?)+)/',
            $docComment ?? '',
            $matches
        );
        $type = $matches[1] ?? '';

        if (strpos($type, '|') !== false) {
            $types = explode('|', $type);

            // if we have more than 2 types
            // we return null as we cannot use unions in php yet
            if (count($types) > 2) {
                return null;
            }

            $hasNull = false;

            foreach ($types as $currentType) {
                if ($currentType === 'null') {
                    $hasNull = true;
                    continue;
                }

                // if we didn't find null assign the current type to the type we want
                $type = $currentType;
            }

            // if we haven't found null type set
            // we return null as we cannot use unions with different types yet
            if (!$hasNull) {
                return null;
            }

            $type = '?' . $type;
        }

        // convert to proper type hint types in php
        $type = str_replace(['boolean', 'integer'], ['bool', 'int'], $type);

        $allowedTypes = [
            'int',
            'bool',
            'string',
            'float',
        ];

        // we replace the ? with an empty string so we can check the actual type
        if (!in_array(str_replace('?', '', $type), $allowedTypes)) {
            return null;
        }

        // if we have a match on index 1
        // then we have found the type of the variable if not we return null
        return $type;
    }

    protected function extractReflectionTypes(ReflectionType $reflection_type)
    {
        if ($reflection_type instanceof ReflectionNamedType) {
            $types[] = $this->getReflectionNamedType($reflection_type);
        } else {
            $types = [];
            foreach ($reflection_type->getTypes() as $named_type) {
                if ($named_type->getName() === 'null') {
                    continue;
                }

                $types[] = $this->getReflectionNamedType($named_type);
            }
        }

        return $types;
    }

    protected function getReflectionNamedType(ReflectionNamedType $paramType): string
    {
        $parameterName = $paramType->getName();
        if (!$paramType->isBuiltin() && $paramType->getName() !== 'static') {
            $parameterName = '\\' . $parameterName;
        }

        return $parameterName;
    }

    /**
     * @param Model $model
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \RuntimeException
     */
    protected function runModelHooks($model): void
    {
        $hooks = $this->laravel['config']->get('ide-helper.model_hooks', []);

        foreach ($hooks as $hook) {
            $hookInstance = $this->laravel->make($hook);

            if (!$hookInstance instanceof ModelHookInterface) {
                throw new \RuntimeException(
                    'Your IDE helper model hook must implement Barryvdh\LaravelIdeHelper\Contracts\ModelHookInterface'
                );
            }

            $hookInstance->run($this, $model);
        }
    }

    /**
     * @param Builder $schema
     * @param string $table
     */
    protected function setForeignKeys($schema, $table)
    {
        foreach ($schema->getForeignKeys($table) as $foreignKeyConstraint) {
            foreach ($foreignKeyConstraint['columns'] as $columnName) {
                $this->foreignKeyConstraintsColumns[] = $columnName;
            }
        }
    }
}
