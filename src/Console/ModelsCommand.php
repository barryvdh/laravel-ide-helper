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
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\ClassLoader\ClassMapGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * todo split class as it seems to be too long
 * A command to generate autocomplete information for your IDE
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */
class ModelsCommand extends Command
{
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

    /**
     * @var bool $write_model_magic_where
     */
    protected $write_model_magic_where;
    protected $properties = [];
    protected $methods = [];
    protected $write = false;
    protected $dirs = [];
    /**
     * @var bool $reset
     */
    protected $reset;
    /**
     * @var bool[string]
     */
    protected $nullableColumns = [];

    /**
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * @param string $filename
     * @return bool
     */
    protected function overwriteModelFiles($filename)
    {
        return $this->confirm(
            "Do you want to overwrite the existing model files? Choose no to write to $filename instead? (Yes/No): "
        );
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
        $this->dirs = array_merge(
            $this->laravel['config']->get('ide-helper.model_locations'),
            $this->option('dir')
        );
        $model = $this->argument('model');
        $ignore = $this->option('ignore');
        $this->reset = $this->option('reset');
        $this->write_model_magic_where = $this->laravel['config']->get('ide-helper.write_model_magic_where', true);

        //If filename is default and Write is not specified, ask what to do
        if (!$this->write && $filename === $this->filename && !$this->option('nowrite')) {
            if ($this->overwriteModelFiles($filename)) {
                $this->write = true;
            }
        }

        $content = $this->generateDocs($model, $ignore);

        if (!$this->write) {
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
          ['dir', 'D', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'The model dir', []],
          ['write', 'W', InputOption::VALUE_NONE, 'Write to Model file'],
          ['nowrite', 'N', InputOption::VALUE_NONE, 'Don\'t write to Model file'],
          ['reset', 'R', InputOption::VALUE_NONE, 'Remove the original phpdocs instead of appending'],
          ['ignore', 'I', InputOption::VALUE_OPTIONAL, 'Which models to ignore', ''],
        ];
    }

    /**
     * @param array|null $loadModels
     * @param string $ignore
     * @return string
     */
    protected function generateDocs(array $loadModels = null, $ignore = '')
    {


        $output = "<?php
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
            $models = [[]];
            foreach ($loadModels as $model) {
                $models[] = explode(',', $model);
            }
            $models = call_user_func_array('array_merge', $models);
        }

        $ignore = explode(',', $ignore);

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
                    $reflectionClass = new \ReflectionClass($name);

                    if (!$reflectionClass->isSubclassOf('Illuminate\Database\Eloquent\Model') ||
                        $reflectionClass->isSubclassOf('Illuminate\Database\Eloquent\Relations\Pivot')
                    ) {
                        continue;
                    }

                    if (!$reflectionClass->isInstantiable()) {
                        // ignore abstract class or interface
                        continue;
                    }

                    if ($this->output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
                        $this->comment("Loading model '$name'");
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
                    $output                .= $this->createPhpDocs($name);
                    $ignore[]              = $name;
                    $this->nullableColumns = [];
                } catch (\Exception $e) {
                    $this->error("Exception: " . $e->getMessage() . "\nCould not analyze class $name.");
                }
            }
        }

        if (!$hasDoctrine) {
            $this->error(
                'Warning: `"doctrine/dbal": "~2.3"` is required to load database information. '.
                'Please require that in your composer.json and run `composer update`.'
            );
        }

        return $output;
    }

    /**
     * @return array
     */
    protected function loadModels()
    {
        $models = [];
        foreach ($this->dirs as $dir) {
            $dir = base_path($dir);
            if (file_exists($dir)) {
                foreach (ClassMapGenerator::createMap($dir) as $model => $path) {
                    $models[] = $model;
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
                    $realType = '\Carbon\Carbon';
                    break;
                case 'collection':
                    $realType = '\Illuminate\Support\Collection';
                    break;
                default:
                    $realType = 'mixed';
                    break;
            }

            if (!isset($this->properties[$name])) {
                continue;
            }

            $this->properties[$name]['type'] = $this->getTypeOverride($realType);
        }
    }

    /**
     * Returns the overide type for the give type.
     *
     * @param string $type
     * @return string
     */
    protected function getTypeOverride($type)
    {
        $typeOverrides = $this->laravel['config']->get('ide-helper.type_overrides', []);

        return isset($typeOverrides[$type]) ? $typeOverrides[$type] : $type;
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
            list($database, $table) = explode('.', $table);
        }

        $columns = $schema->listTableColumns($table, $database);

        if ($columns) {
            foreach ($columns as $column) {
                $name = $column->getName();
                if (in_array($name, $model->getDates())) {
                    $type = '\Carbon\Carbon';
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
                        case 'decimal':
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
                $this->setProperty($name, $type, true, true, $comment, !$column->getNotnull());
                if ($this->write_model_magic_where) {
                    $this->setMethod(
                        Str::camel("where_" . $name),
                        '\Illuminate\Database\Eloquent\Builder|\\' . get_class($model),
                        ['$value']
                    );
                }
            }
        }
    }

    /**
     * @param string $attribute
     * @param string $method
     * @return bool
     */
    protected function hasAttribute($attribute, $method)
    {
        return Str::startsWith($method, $attribute) &&
            Str::endsWith($method, 'Attribute') &&
            $method !== $attribute . 'Attribute';
    }

    /**
     * @param string $method
     * @return bool
     */
    protected function isAccessor($method) 
    {
        return $this->hasAttribute('get', $method);
    }

    /**
     * @param string $method
     * @return bool
     */
    protected function isMutator($method)
    {
        return $this->hasAttribute('set', $method);
    }

    /**
     * @param string $method
     * @return string
     */
    protected function getAccessorAttributeName($method)
    {
        //Magic get<name>Attribute
        return Str::snake(substr($method, 3, -9));
    }

    /**
     * @param string $method
     * @return string
     */
    protected function getMutatorAttributeName($method)
    {
        //Magic set<name>Attribute
        return $this->getAccessorAttributeName($method);
    }

    /**
     * @param string $method
     * @return bool
     */
    protected function isScope($method)
    {
        return $method !== 'scopeQuery' && Str::startsWith($method, 'scope');
    }

    /**
     * @param string $method
     * @return string
     */
    protected function getScopeName($method)
    {
        return Str::camel(substr($method, 5));
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
                if ($this->isAccessor($method)) {
                    //Magic get<name>Attribute
                    $name = $this->getAccessorAttributeName($method);
                    if (!empty($name)) {
                        $reflection = new \ReflectionMethod($model, $method);
                        $type = $this->getReturnTypeFromDocBlock($reflection);
                        $this->setProperty($name, $type, true);
                    }
                } elseif ($this->isMutator($method)) {
                    //Magic set<name>Attribute
                    $name = $this->getMutatorAttributeName($method);
                    if (!empty($name)) {
                        $this->setProperty($name, null, null, true);
                    }
                } elseif ($this->isScope($method)) {
                    //Magic set<name>Attribute
                    $name = $this->getScopeName($method);
                    if (!empty($name)) {
                        $reflection = new \ReflectionMethod($model, $method);
                        $args = $this->getParameters($reflection);
                        //Remove the first ($query) argument
                        array_shift($args);
                        $this->setMethod($name, '\Illuminate\Database\Eloquent\Builder|\\' . $reflection->class, $args);
                    }
                } elseif (!method_exists('Illuminate\Database\Eloquent\Model', $method)
                    && !Str::startsWith($method, 'get')
                ) {
                    //Use reflection to inspect the code, based on Illuminate/Support/SerializableClosure.php
                    $reflection = new \ReflectionMethod($model, $method);

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

                    //todo move to CONST array when PHP min >= 5.6
                    $relations = [
                        'hasMany',
                        'hasManyThrough',
                        'belongsToMany',
                        'hasOne',
                        'belongsTo',
                        'morphOne',
                        'morphTo',
                        'morphMany',
                        'morphToMany'
                    ];
                    //todo move to CONST array when PHP min >= 5.6
                    $manyRelations = [
                        'hasManyThrough',
                        'belongsToMany',
                        'hasMany',
                        'morphMany',
                        'morphToMany'
                    ];
                    foreach ($relations as $relation) {
                        $search = '$this->' . $relation . '(';
                        $foundInCode = stripos($code, $search);
                        if ($foundInCode) {
                            //Resolve the relation's model to a Relation object.
                            $relationObj = $model->$method();

                            if ($relationObj instanceof Relation) {
                                $relatedModel = '\\' . get_class($relationObj->getRelated());

                                if ($this->isManyRelation($relation, $manyRelations)) {
                                    //Collection or array of models (because Collection is Arrayable)
                                    $this->setProperty(
                                        $method,
                                        $this->getCollectionClass($relatedModel) . '|' . $relatedModel . '[]',
                                        true
                                    );
                                } elseif ($relation === "morphTo") {
                                    // Model isn't specified because relation is polymorphic
                                    $this->setProperty(
                                        $method,
                                        '\Illuminate\Database\Eloquent\Model|\Eloquent',
                                        true
                                    );
                                } else {
                                    //Single model is returned
                                    $this->setProperty(
                                        $method,
                                        $relatedModel,
                                        true,
                                        null,
                                        '',
                                        $this->isRelationForeignKeyNullable($relationObj)
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
     * todo doesn't make much sence right now but will when PHP min >= 5.6,
     * then we can move $manyRelations to const array
     * @param string $relation
     * @param array $manyRelations
     * @return bool
     */
    private function isManyRelation($relation, array $manyRelations)
    {
        return in_array($relation, $manyRelations);
    }

    /**
     * Check if the foreign key of the relation is nullable
     *
     * @param Relation $relation
     *
     * @return bool
     */
    private function isRelationForeignKeyNullable(Relation $relation)
    {
        $reflectionObj = new \ReflectionObject($relation);
        if (!$reflectionObj->hasProperty('foreignKey')) {
            return false;
        }
        $fkProp = $reflectionObj->getProperty('foreignKey');
        $fkProp->setAccessible(true);

        return isset($this->nullableColumns[$fkProp->getValue($relation)]);
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
                $newType .='|null';
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

    /**
     * @param string $name
     * @param string $type
     * @param array $arguments
     */
    protected function setMethod($name, $type = '', array $arguments = [])
    {
        $methods = array_change_key_case($this->methods, CASE_LOWER);

        if (!isset($methods[strtolower($name)])) {
            $this->methods[$name] = [];
            $this->methods[$name]['type'] = $type;
            $this->methods[$name]['arguments'] = $arguments;
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    private function isProperty($name)
    {
        return ($name == "property" || $name == "property-read" || $name == "property-write");
    }

    /**
     * @param string $class
     * @return string
     */
    protected function createPhpDocs($class)
    {

        $reflection = new \ReflectionClass($class);
        $namespace = $reflection->getNamespaceName();
        $classname = $reflection->getShortName();
        $originalDoc = $reflection->getDocComment();

        if ($this->reset) {
            $phpdoc = new DocBlock('', new Context($namespace));
        } else {
            $phpdoc = new DocBlock($reflection, new Context($namespace));
        }

        if (!$phpdoc->getText()) {
            $phpdoc->setText($class);
        }

        $properties = [];
        $methods = [];
        /** @var \Barryvdh\Reflection\DocBlock\Tag\ParamTag|\Barryvdh\Reflection\DocBlock\Tag\MethodTag $tag */
        foreach ($phpdoc->getTags() as $tag) {
            $name = $tag->getName();
            if ($this->isProperty($name)) {
                $properties[] = $tag->getVariableName();
            } elseif ($name == "method") {
                $methods[] = $tag->getMethodName();
            }
        }

        foreach ($this->properties as $name => $property) {
            $name = "\$$name";
            if (in_array($name, $properties)) {
                continue;
            }
            $attr = 'property-read';
            if ($property['read'] && $property['write']) {
                $attr = 'property';
            } elseif ($property['write']) {
                $attr = 'property-write';
            }

            if ($this->hasCamelCaseModelProperties()) {
                $name = Str::camel($name);
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

        if ($this->write && ! $phpdoc->getTagsByName('mixin')) {
            $phpdoc->appendTag(Tag::createInstance("@mixin \\Eloquent", $phpdoc));
        }

        $serializer = new DocBlockSerializer();
        $serializer->getDocComment($phpdoc);
        $docComment = $serializer->getDocComment($phpdoc);


        if ($this->write) {
            $filename = $reflection->getFileName();
            $contents = $this->files->get($filename);
            if ($originalDoc) {
                $contents = str_replace($originalDoc, $docComment, $contents);
            } else {
                $needle = "class {$classname}";
                $replace = "{$docComment}\nclass {$classname}";
                $pos = strpos($contents, $needle);
                if ($pos !== false) {
                    $contents = substr_replace($contents, $replace, $pos, strlen($needle));
                }
            }
            if ($this->files->put($filename, $contents)) {
                $this->info('Written new phpDocBlock to ' . $filename);
            }
        }

        $output = "namespace {$namespace}{\n{$docComment}\n\tclass {$classname} extends \Eloquent {}\n}\n\n";
        return $output;
    }

    /**
     * Get the parameters and format them correctly
     *
     * @param \ReflectionMethod $method
     * @return array
     */
    public function getParameters(\ReflectionMethod $method)
    {
        //Loop through the default values for paremeters, and make the correct output string
        $paramsWithDefault = [];
        /** @var \ReflectionParameter $param */
        foreach ($method->getParameters() as $param) {
            $paramClass = $param->getClass();
            $paramStr = (!is_null($paramClass) ? '\\' . $paramClass->getName() . ' ' : '') . '$' . $param->getName();
            if ($param->isOptional() && $param->isDefaultValueAvailable()) {
                $default = $param->getDefaultValue();
                if (is_bool($default)) {
                    $default = $default ? 'true' : 'false';
                } elseif (is_array($default)) {
                    $default = 'array()';
                } elseif (is_null($default)) {
                    $default = 'null';
                } elseif (is_int($default)) {
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
    private function getCollectionClass($className)
    {
        // Return something in the very very unlikely scenario the model doesn't
        // have a newCollection() method.
        if (!method_exists($className, 'newCollection')) {
            return '\Illuminate\Database\Eloquent\Collection';
        }

        return $this->getCustomCollectionClass($className);
    }

    /**
     * @param $className
     * @return string
     */
    private function getCustomCollectionClass($className)
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $className;
        return '\\' . get_class($model->newCollection());
    }

    /**
     * @return bool
     */
    protected function hasCamelCaseModelProperties()
    {
        return $this->laravel['config']->get('ide-helper.model_camel_case_properties', false);
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
        $type = null;
        $phpdoc = new DocBlock($reflection);

        if ($phpdoc->hasTag('return')) {
            $type = $phpdoc->getTagsByName('return')[0]->getType();
        }

        return $type;
    }

    /**
     * Generates methods provided by the SoftDeletes trait
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    protected function getSoftDeleteMethods($model)
    {
        $traits = class_uses(get_class($model));
        if (in_array('Illuminate\\Database\\Eloquent\\SoftDeletes', $traits)) {
            $this->setMethod('forceDelete', 'bool|null');
            $this->setMethod('restore', 'bool|null');

            $this->setMethod('withTrashed', '\Illuminate\Database\Query\Builder|\\' . get_class($model));
            $this->setMethod('withoutTrashed', '\Illuminate\Database\Query\Builder|\\' . get_class($model));
            $this->setMethod('onlyTrashed', '\Illuminate\Database\Query\Builder|\\' . get_class($model));
        }
    }
}
