<?php

namespace Barryvdh\LaravelIdeHelper\Console;

use Barryvdh\Reflection\DocBlock\Context;
use Barryvdh\Reflection\DocBlock as DocBlock;
use Barryvdh\Reflection\DocBlock\Serializer;
use Barryvdh\Reflection\DocBlock\Tag;
use Composer\Autoload\ClassMapGenerator;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Factory;

class FormRequestsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ide-helper:form-requests 
                                {request?}                                  : Fully qualified class name of the FormRequest to generate the helper for.
                                {--dir=*}                                   : An array of the directories in which to search for form requests. The default directory is automatically injected.
                                {--internal}                                : Force the command to write all the docblocks inside class files. 
                                {--filename=_ide_helper_forms_requests.php} : Override the name of the helper file. This has no effect when --internal is used. 
                                {--ignore=*}                                : Ignore form requests. You can use this option multiple times.';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate autocompletion for form requests.';

    /**
     * Name of the request to generate the helper for.
     *
     * @var null
     */
    protected $formRequest = null;

    /**
     * The name of the file to which to write the helper.
     *
     * @var string
     */
    protected $filename = null;

    /**
     * Array of FQCN's that should be skipped by this command.
     *
     * @var array
     */
    protected $blacklist = [];

    /**
     * A flag determining whether docblocks should be written internally or externally.
     *
     * @var bool
     */
    protected $writeToExternal = true;

    /**
     * A flag determining whether original docblock data should be retained in the case of writing internally.
     *
     * @var bool
     */
    protected $reset = false;

    /**
     * An array of directories in which to search for form requests.
     *
     * @var array
     */
    protected $dirs = [];

    /** @var \Illuminate\Filesystem\Filesystem */
    protected $filesystem;

    /** @var \Barryvdh\Reflection\DocBlock\Serializer  */
    protected $serializer;

    /**
     * A map of all the rules and the types they enforce.
     */
    const RULE_MAP = [
        'accepted' => 'boolean|string',
        'boolean' => 'boolean',

        'array' => 'array',
        'json' => 'array',

        'integer' => 'integer',

        'numeric' => 'integer|float',
        'digits' => 'integer|float',
        'digits_between' => 'integer|float',

        'active_url' => 'string',
        'after' => 'string',
        'after_or_equal' => 'string',
        'alpha' => 'string',
        'alpha_dash' => 'string',
        'alpha_numeric' => 'string',
        'before' => 'string',
        'before_or_equal' => 'string',
        'date' => 'string',
        'date_equals' => 'string',
        'date_format' => 'string',
        'ip_address' => 'string',
        'string' => 'string',
        'timezone' => 'string',
        'url' => 'string',
        'uuid' => 'string',

        'dimensions' => UploadedFile::class,
        'file' => UploadedFile::class,
        'image' => UploadedFile::class,
        'mimetypes' => UploadedFile::class,
        'mimes' => UploadedFile::class,
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $filesystem, Serializer $serializer)
    {
        parent::__construct();

        $this->filesystem = $filesystem;

        $this->serializer = $serializer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->parseOptionsAndArguments();
        
        $requests = ($this->formRequest !== null)
            ? $this->extractRelevantRequestReflections([$this->formRequest])
            : $this->getRequestReflections();

        if (empty($requests)) {
            return $this->error("No requests were found for the current configuration.");
        }

        return $this->createHelpersForRequests($requests);
    }

    /**
     * @param array<\ReflectionClass> $requests
     */
    protected function createHelpersForRequests($requests)
    {
        $output = '';
        
        /** @var \ReflectionClass $request */
        foreach ($requests as $request) {
            $instance = $request->newInstance();
            $values = $this->parseValidation($instance->rules());
            
            ($this->writeToExternal)
                ? $this->appendToOutput($output, $request, $values)
                : $this->writeToFile($request, $values) && $this->info("Written new phpDocBlock to" . $request->getFileName());
        }

        if ($this->writeToExternal) {
            $output = $this->initializeExternalOutput() . $output;
            $this->filesystem->put($this->filename, $output);
            return $this->info("Fresh helper comments have been written to {$this->filename}");
        }

        $this->info("\nWritten a total of " . count($requests) . " phpDocBlocks");
    }

    /** Create and return the header for an external output file. */
    protected function initializeExternalOutput()
    {
        return
"<?php

// @formatter off

/**
* This is a helper file for your form requests. 
* It provides you with autocompletion for validated form request data.
* 
* @author Misa Kovic <misa95kovic@gmail.com>
**/


";
    }

    /**
     * Append the parsed values for the specified class to an existing (external) output.
     *
     * @param DocBlock $output
     * @param \ReflectionClass $request
     * @param array $values
     * @return DocBlock
     */
    protected function appendToOutput(&$output, $request, $values)
    {
        $docBlock = $this->createDocBlockForRequest($request, $values);
        $docBlockComment = $this->serializer->getDocComment($docBlock);

        $classDeclaration = $this->createClassDeclarationForRequest($request, $values);

        $namespace = $request->getNamespaceName();

        $output .= "namespace {$namespace} {\n{$docBlockComment}\n{$classDeclaration}\n}\n\n";
    }

    /**
     * Create a DocBlock instance for a form request.
     *
     * @param \ReflectionClass $request
     * @param array $rules
     * @return \Barryvdh\Reflection\DocBlock
     */
    protected function createDocBlockForRequest(\ReflectionClass $request, array $rules)
    {
        $context = new Context($request->getNamespaceName());
        $docBlock = new DocBlock('', $context);
        $docBlock->setText($request->name);

        $docBlock->setText($request->name);

        foreach ($rules as $rule) {
            $docBlock->appendTag($this->parameterTag($rule));
        }
        
        return $docBlock;
    }

    /**
     * Create a Mock class declaration for a request.
     *
     * @param \ReflectionClass $request
     * @param array $rules
     * @return string
     */
    public function createClassDeclarationForRequest(\ReflectionClass $request, array $rules)
    {
        $class = $request->getShortName();
        $parent = $request->getParentClass()->name;

        return "class {$class} extends {$parent} {}";
    }

    /**
     * Write a docblock with the parsed values to the request file (internally).
     *
     * @param \ReflectionClass $request
     * @param array $values
     */
    protected function writeToFile($request, $values)
    {
        $filePath = $request->getFileName();
        $newDocBlockComment = $this->serializer->getDocComment($this->createDocBlockForRequest($request, $values));
        $oldDocBlockComment = $request->getDocComment();
        $fileContents = $this->filesystem->get($filePath);
        
        if ($oldDocBlockComment) {
            $fileContents = str_replace($oldDocBlockComment, $newDocBlockComment, $fileContents);
        } else {
            $className = $request->getShortName();
            $toBeReplaced = "class {$className}";
            if (!Str::contains($fileContents, $toBeReplaced)) {
                return false;
            }

            $newDocBlockComment .= "\nclass {$className}";
            
            $fileContents = str_replace($toBeReplaced, $newDocBlockComment, $fileContents);
        }
        
        return $this->filesystem->put($filePath, $fileContents);
    }
    
    protected function parameterTag(array $rule)
    {
        return new Tag(
            'property',
            "{$rule['type']} {$rule['name']}"
        );
    }

    /**
     * Parse the validation rules to extract the names and types of values.
     *
     * @param array $rules
     */
    protected function parseValidation($rules)
    {
        $parsed = [];

        foreach ($rules as $name => $constrains) {
            $parsed[] = [
                'name' => $name,
                'type' => $this->parseValidationType($constrains),
            ];
        }

        return $parsed;
    }

    /**
     * Parse the type of a value from its validation rules.
     *
     * @param $constraints
     * @return string
     */
    protected function parseValidationType($constraints)
    {
        $constraints = $this->parseValidationRules($constraints);
        $parsedType = 'mixed';

        foreach (static::RULE_MAP as $rule => $types) {
            if (in_array($rule, $constraints)) {
                $parsedType = $types;
            }
        }

        if (in_array('nullable', $constraints)) {
            $parsedType .= '|null';
        }

        return $parsedType;
    }

    /**
     * Parse individual rules from a validation rules string.
     *
     * @param $constraints
     */
    protected function parseValidationRules($constraints)
    {
        $constraints = explode('|', $constraints);

        $constraints = array_map(function ($constraint) {
            if (strpos($constraint, ':') > -1) {
                $constraint = explode(':', $constraint)[0];
            }

            return $constraint;
        }, $constraints);

        return $constraints;
    }

    /**
     * Parse all the options and store them as object attributes.
     *
     * @return void
     */
    protected function parseOptionsAndArguments()
    {
        $this->filename = $this->option('filename');

        $this->writeToExternal = ! $this->option('internal');

        $this->blacklist = $this->option('ignore');

        $this->formRequest = $this->argument('request');
    }

    /**
     * Prepare an array of all the requests that should have helpers generated.
     *
     * @return array<\ReflectionClass>
     */
    protected function getRequestReflections()
    {
        $defaultRequests = $this->getClassesInConfigSpecification();

        $specifiedRequests = $this->getClassesInArgumentDirs();

        return $this->extractRelevantRequestReflections(array_merge($defaultRequests, $specifiedRequests));
    }

    /**
     * Extract all the relevant FormRequest classess from an array of all the classes and return ReflectionClass objects for them.
     *
     * @param array<string> $allClasses
     * @return array<\ReflectionClass>
     */
    protected function extractRelevantRequestReflections($allClasses)
    {
        $relevant = [];

        foreach ($allClasses as $class) {
            if (in_array($class, $this->blacklist) || !class_exists($class)) {
                continue;
            }

            $reflected = new \ReflectionClass($class);

            if (!$reflected->isSubclassOf(FormRequest::class)) {
                continue;
            }

            $relevant[] = $reflected;
        }

        return $relevant;
    }

    /**
     * Read the config file and load all the requests from the paths specified in it.
     *
     * @return array<string>
     */
    protected function getClassesInConfigSpecification()
    {
        $configPaths = $this->laravel['config']->get('ide-helper.form_request_locations');
        $allClasses = [];

        foreach ($configPaths as $dir) {
            $dir = base_path($dir);
            $allClasses = array_merge($allClasses, $this->getClassesFromDirectory($dir));
        }

        return $allClasses;
    }

    /**
     * Go through all the directories specified in the options and return the classes from them.
     *
     * @return array<string>
     */
    protected function getClassesInArgumentDirs()
    {
        $allClasses = [];

        foreach ($this->dirs as $dir) {
            $allClasses = array_merge($allClasses, $this->getClassesFromDirectory($dir));
        }

        return array_unique($allClasses);
    }

    /**
     * Parse a directory and extract all the classes in it.
     *
     * @param string $dir
     * @return array<string>
     */
    protected function getClassesFromDirectory($dir)
    {
        if (!is_dir($dir)) {
            return [];
        }

        return array_keys(ClassMapGenerator::createMap($dir));
    }
}
