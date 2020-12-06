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

use Barryvdh\Reflection\DocBlock;
use Barryvdh\Reflection\DocBlock\Context;
use Barryvdh\Reflection\DocBlock\Serializer as DocBlockSerializer;
use Barryvdh\Reflection\DocBlock\Tag;
use Composer\Autoload\ClassMapGenerator;
use Illuminate\Console\Command;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\ContextFactory;
use ReflectionClass;
use ReflectionObject;
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
    protected $filename = '_ide_helper_models.php';

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
    protected $keep_text;
    protected $phpstorm_noinspections;
    protected $write_model_external_builder_methods;
    /**
     * @var bool[string]
     */
    protected $nullableColumns = [];

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
        $filename = $this->option('filename');
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
        if ($this->option('smart-reset')) {
            $this->keep_text = $this->reset = true;
        }
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
          ['filename', 'F', InputOption::VALUE_OPTIONAL, 'The path to the helper file', $this->filename],
          ['dir', 'D', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
              'The model dir, supports glob patterns', [], ],
          ['write', 'W', InputOption::VALUE_NONE, 'Write to Model file'],
          ['write-mixin', 'M', InputOption::VALUE_NONE,
              "Write models to {$this->filename} and adds @mixin to each model, avoiding IDE duplicate declaration warnings",
          ],
          ['nowrite', 'N', InputOption::VALUE_NONE, 'Don\'t write to Model file'],
          ['reset', 'R', InputOption::VALUE_NONE, 'Remove the original phpdocs instead of appending'],
          ['smart-reset', 'r', InputOption::VALUE_NONE, 'Refresh the properties/methods list, but keep the text'],
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
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */
\n\n";

        $hasDoctrine = interface_exists('Doctrine\DBAL\Driver');

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

                    if ($hasDoctrine) {
                        $this->getPropertiesFromTable($model);
                    }

                    if (method_exists($model, 'getCasts')) {
                        $this->castPropertiesType($model);
                    }

                    $this->getPropertiesFromMethods($model);
                    $this->getSoftDeleteMethods($model);
                    $this->getCollectionMethods($model);
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

        if (!$hasDoctrine) {
            $this->error(
                'Warning: `"doctrine/dbal": "~2.3"` is required to load database information. ' .
                'Please require that in your composer.json and run `composer update`.'
            );
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
                    $this->error("Cannot locate directory '{'$dir}'");
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
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    protected function castPropertiesType($model)
    {
        $casts = $model->getCasts();
        foreach ($casts as $name => $type) {
            switch ($type) {
                case 'boolean':
                case 'bool':
                    $realType = 'boolean';
                    break;
                case 'string':
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
                    $realType = 'integer';
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
                case 'collection':
                    $realType = '\Illuminate\Support\Collection';
                    break;
                default:
                    // In case of an optional custom cast parameter , only evaluate
                    // the `$type` until the `:`
                    $type = strtok($type, ':');
                    $realType = class_exists($type) ? ('\\' . $type) : 'mixed';
                    break;
            }

            if (!isset($this->properties[$name])) {
                continue;
            }

            $realType = $this->checkForCustomLaravelCasts($realType);
            $realType = $this->getTypeOverride($realType);
            $this->properties[$name]['type'] = $this->getTypeInModel($model, $realType);

            if (isset($this->nullableColumns[$name])) {
                $this->properties[$name]['type'] .= '|null';
            }
        }
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
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    protected function getPropertiesFromTable($model)
    {
        $table = $model->getConnection()->getTablePrefix() . $model->getTable();
        $schema = $model->getConnection()->getDoctrineSchemaManager();
        $databasePlatform = $schema->getDatabasePlatform();
        $databasePlatform->registerDoctrineTypeMapping('enum', 'string');

        $platformName = $databasePlatform->getName();
        $customTypes = $this->laravel['config']->get("ide-helper.custom_db_types.{$platformName}", []);
        foreach ($customTypes as $yourTypeName => $doctrineTypeName) {
            $databasePlatform->registerDoctrineTypeMapping($yourTypeName, $doctrineTypeName);
        }

        $database = null;
        if (strpos($table, '.')) {
            [$database, $table] = explode('.', $table);
        }

        $columns = $schema->listTableColumns($table, $database);

        if (!$columns) {
            return;
        }

        foreach ($columns as $column) {
            $name = $column->getName();
            if (in_array($name, $model->getDates())) {
                $type = $this->dateClass;
            } else {
                $type = $column->getType()->getName();
                switch ($type) {
                    case 'string':
                    case 'text':
                    case 'date':
                    case 'time':
                    case 'guid':
                    case 'datetimetz':
                    case 'datetime':
                    case 'decimal':
                        $type = 'string';
                        break;
                    case 'integer':
                    case 'bigint':
                    case 'smallint':
                        $type = 'integer';
                        break;
                    case 'boolean':
                        switch (config('database.default')) {
                            case 'sqlite':
                            case 'mysql':
                                $type = 'integer';
                                break;
                            default:
                                $type = 'boolean';
                                break;
                        }
                        break;
                    case 'float':
                        $type = 'float';
                        break;
                    default:
                        $type = 'mixed';
                        break;
                }
            }

            $comment = $column->getComment();
            if (!$column->getNotnull()) {
                $this->nullableColumns[$name] = true;
            }
            $this->setProperty(
                $name,
                $this->getTypeInModel($model, $type),
                true,
                true,
                $comment,
                !$column->getNotnull()
            );
            if ($this->write_model_magic_where) {
                $builderClass = $this->write_model_external_builder_methods
                    ? get_class($model->newModelQuery())
                    : '\Illuminate\Database\Eloquent\Builder';

                $this->setMethod(
                    Str::camel('where_' . $name),
                    $this->getClassNameInDestinationFile($model, $builderClass)
                    . '|'
                    . $this->getClassNameInDestinationFile($model, get_class($model)),
                    ['$value']
                );
            }
        }
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    protected function getPropertiesFromMethods($model)
    {
        $methods = get_class_methods($model);
        if ($methods) {
            sort($methods);
            foreach ($methods as $method) {
                if (
                    Str::startsWith($method, 'get') && Str::endsWith(
                        $method,
                        'Attribute'
                    ) && $method !== 'getAttribute'
                ) {
                    //Magic get<name>Attribute
                    $name = Str::snake(substr($method, 3, -9));
                    if (!empty($name)) {
                        $reflection = new \ReflectionMethod($model, $method);
                        $type = $this->getReturnType($reflection);
                        $type = $this->getTypeInModel($model, $type);
                        $this->setProperty($name, $type, true, null);
                    }
                } elseif (
                    Str::startsWith($method, 'set') && Str::endsWith(
                        $method,
                        'Attribute'
                    ) && $method !== 'setAttribute'
                ) {
                    //Magic set<name>Attribute
                    $name = Str::snake(substr($method, 3, -9));
                    if (!empty($name)) {
                        $this->setProperty($name, null, null, true);
                    }
                } elseif (Str::startsWith($method, 'scope') && $method !== 'scopeQuery') {
                    //Magic set<name>Attribute
                    $name = Str::camel(substr($method, 5));
                    if (!empty($name)) {
                        $reflection = new \ReflectionMethod($model, $method);
                        $args = $this->getParameters($reflection);
                        //Remove the first ($query) argument
                        array_shift($args);
                        $builder = $this->getClassNameInDestinationFile(
                            $reflection->getDeclaringClass(),
                            get_class($model->newModelQuery())
                        );
                        $modelName = $this->getClassNameInDestinationFile(
                            $reflection->getDeclaringClass(),
                            $reflection->getDeclaringClass()->getName()
                        );
                        $this->setMethod($name, $builder . '|' . $modelName, $args);
                    }
                } elseif (in_array($method, ['query', 'newQuery', 'newModelQuery'])) {
                    $builder = $this->getClassNameInDestinationFile($model, get_class($model->newModelQuery()));

                    $this->setMethod(
                        $method,
                        $builder . '|' . $this->getClassNameInDestinationFile($model, get_class($model))
                    );

                    if ($this->write_model_external_builder_methods) {
                        $this->writeModelExternalBuilderMethods($model);
                    }
                } elseif (
                    !method_exists('Illuminate\Database\Eloquent\Model', $method)
                    && !Str::startsWith($method, 'get')
                ) {
                    //Use reflection to inspect the code, based on Illuminate/Support/SerializableClosure.php
                    $reflection = new \ReflectionMethod($model, $method);

                    if ($returnType = $reflection->getReturnType()) {
                        $type = $returnType instanceof \ReflectionNamedType
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
                            $methodReflection = new \ReflectionMethod($model, $method);
                            if ($methodReflection->getNumberOfParameters()) {
                                continue;
                            }

                            // Adding constraints requires reading model properties which
                            // can cause errors. Since we don't need constraints we can
                            // disable them when we fetch the relation to avoid errors.
                            $relationObj = Relation::noConstraints(function () use ($model, $method) {
                                try {
                                    return $model->$method();
                                } catch (Throwable $e) {
                                    $this->warn(sprintf('Error resolving relation model of %s:%s() : %s', get_class($model), $method, $e->getMessage()));

                                    return null;
                                }
                            });

                            if ($relationObj instanceof Relation) {
                                $relatedModel = $this->getClassNameInDestinationFile(
                                    $model,
                                    get_class($relationObj->getRelated())
                                );

                                if (strpos(get_class($relationObj), 'Many') !== false) {
                                    //Collection or array of models (because Collection is Arrayable)
                                    $relatedClass = '\\' . get_class($relationObj->getRelated());
                                    $collectionClass = $this->getCollectionClass($relatedClass);
                                    $collectionClassNameInModel = $this->getClassNameInDestinationFile(
                                        $model,
                                        $collectionClass
                                    );
                                    $this->setProperty(
                                        $method,
                                        $collectionClassNameInModel . '|' . $relatedModel . '[]',
                                        true,
                                        null
                                    );
                                    if ($this->write_model_relation_count_properties) {
                                        $this->setProperty(
                                            Str::snake($method) . '_count',
                                            'int|null',
                                            true,
                                            false
                                        );
                                    }
                                } elseif ($relation === 'morphTo') {
                                    // Model isn't specified because relation is polymorphic
                                    $this->setProperty(
                                        $method,
                                        $this->getClassNameInDestinationFile($model, Model::class) . '|\Eloquent',
                                        true,
                                        null
                                    );
                                } else {
                                    //Single model is returned
                                    $this->setProperty(
                                        $method,
                                        $relatedModel,
                                        true,
                                        null,
                                        '',
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

        return isset($this->nullableColumns[$fkProp->getValue($relationObj)]);
    }

    /**
     * @param string      $name
     * @param string|null $type
     * @param bool|null   $read
     * @param bool|null   $write
     * @param string|null $comment
     * @param bool        $nullable
     */
    protected function setProperty($name, $type = null, $read = null, $write = null, $comment = '', $nullable = false)
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

    protected function setMethod($name, $type = '', $arguments = [])
    {
        $methods = array_change_key_case($this->methods, CASE_LOWER);

        if (!isset($methods[strtolower($name)])) {
            $this->methods[$name] = [];
            $this->methods[$name]['type'] = $type;
            $this->methods[$name]['arguments'] = $arguments;
        }
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

        if ($this->reset) {
            $phpdoc = new DocBlock('', new Context($namespace));
            if ($this->keep_text) {
                $phpdoc->setText(
                    (new DocBlock($reflection, new Context($namespace)))->getText()
                );
            }
        } else {
            $phpdoc = new DocBlock($reflection, new Context($namespace));
        }

        if (!$phpdoc->getText()) {
            $phpdoc->setText($class);
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
            $tag = Tag::createInstance("@method static {$method['type']} {$name}({$arguments})", $phpdoc);
            $phpdoc->appendTag($tag);
        }

        if ($this->write && !$phpdoc->getTagsByName('mixin')) {
            $eloquentClassNameInModel = $this->getClassNameInDestinationFile($reflection, 'Eloquent');
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
        $output = "namespace {$namespace}{\n{$docComment}\n\t{$keyword}class {$classname} extends \Eloquent ";

        if ($interfaceNames) {
            $interfaces = implode(', \\', $interfaceNames);
            $output .= "implements \\{$interfaces} ";
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
            $paramStr = '$' . $param->getName();
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

        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $className();
        return '\\' . get_class($model->newCollection());
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
     * @return bool
     */
    protected function hasCamelCaseModelProperties()
    {
        return $this->laravel['config']->get('ide-helper.model_camel_case_properties', false);
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
     * Get method return type based on it DocBlock comment
     *
     * @param \ReflectionMethod $reflection
     *
     * @return null|string
     */
    protected function getReturnTypeFromDocBlock(\ReflectionMethod $reflection)
    {
        $phpDocContext = (new ContextFactory())->createFromReflector($reflection);
        $context = new Context(
            $phpDocContext->getNamespace(),
            $phpDocContext->getNamespaceAliases()
        );
        $type = null;
        $phpdoc = new DocBlock($reflection, $context);

        if ($phpdoc->hasTag('return')) {
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

        $type = $returnType instanceof \ReflectionNamedType
            ? $returnType->getName()
            : (string)$returnType;

        if (!$returnType->isBuiltin()) {
            $type = '\\' . $type;
        }

        if ($returnType->allowsNull()) {
            $type .= '|null';
        }

        return $type;
    }


    /**
     * Generates methods provided by the SoftDeletes trait
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    protected function getSoftDeleteMethods($model)
    {
        $traits = class_uses(get_class($model), true);
        if (in_array('Illuminate\\Database\\Eloquent\\SoftDeletes', $traits)) {
            $modelName = $this->getClassNameInDestinationFile($model, get_class($model));
            $builder = $this->getClassNameInDestinationFile($model, \Illuminate\Database\Query\Builder::class);
            $this->setMethod('withTrashed', $builder . '|' . $modelName, []);
            $this->setMethod('withoutTrashed', $builder . '|' . $modelName, []);
            $this->setMethod('onlyTrashed', $builder . '|' . $modelName, []);
        }
    }

    /**
     * Generates methods that return collections
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    protected function getCollectionMethods($model)
    {
        $collectionClass = $this->getCollectionClass(get_class($model));

        if ($collectionClass !== '\\' . \Illuminate\Database\Eloquent\Collection::class) {
            $collectionClassInModel = $this->getClassNameInDestinationFile($model, $collectionClass);

            $this->setMethod('get', $collectionClassInModel . '|static[]', ['$columns = [\'*\']']);
            $this->setMethod('all', $collectionClassInModel . '|static[]', ['$columns = [\'*\']']);
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

        $reflection = new \ReflectionClass($type);

        if (!$reflection->implementsInterface(CastsAttributes::class)) {
            return $type;
        }

        $methodReflection = new \ReflectionMethod($type, 'get');

        $reflectionType = $this->getReturnTypeFromReflection($methodReflection);

        if ($reflectionType === null) {
            $reflectionType = $this->getReturnTypeFromDocBlock($methodReflection);
        }

        if($reflectionType === 'static' || $reflectionType === '$this') {
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
            : new ReflectionObject($model)
        ;

        $className = trim($className, '\\');
        $writingToExternalFile = !$this->write;
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
                $builderClassBasedOnFQCNOption . '|' . $this->getClassNameInDestinationFile($model, get_class($model)),
                $args
            );
        }
    }

    protected function getParamType(\ReflectionMethod $method, \ReflectionParameter $parameter): ?string
    {
        if ($paramType = $parameter->getType()) {
            $parameterName = $paramType->getName();

            if (!$paramType->isBuiltin()) {
                $parameterName = '\\' . $parameterName;
            }

            if ($paramType->allowsNull()) {
                return '?' . $parameterName;
            }

            return $parameterName;
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
        $type = $matches[1] ?? null;

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
}
