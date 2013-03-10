<?php
die('Only to be used as an helper for your IDE');
class App extends Illuminate\Foundation\Application{
    /**
     * Create a new Illuminate application instance.
     *
     * @static
     * @return void
     */
    public static function __construct(){}

    /**
     * Bind the installation paths to the application.
     *
     * @static
     * @param	array	$paths
     * @return void
     */
    public static function bindInstallPaths($paths){}

    /**
     * Get the application bootstrap file.
     *
     * @static
     * @return string
     */
    public static function getBootstrapFile(){}

    /**
     * Register the aliased class loader.
     *
     * @static
     * @param	array	$aliases
     * @return void
     */
    public static function registerAliasLoader($aliases){}

    /**
     * Start the exception handling for the request.
     *
     * @static
     * @return void
     */
    public static function startExceptionHandling(){}

    /**
     * Get the current application environment.
     *
     * @static
     * @return string
     */
    public static function environment(){}

    /**
     * Detect the application's current environment.
     *
     * @static
     * @param	array|string	$environments
     * @return string
     */
    public static function detectEnvironment($environments){}

    /**
     * Set the application environment for a web request.
     *
     * @static
     * @param	string	$base
     * @param	array|string	$environments
     * @return string
     */
    public static function detectWebEnvironment($base, $environments){}

    /**
     * Set the application environment from command-line arguments.
     *
     * @static
     * @param	string	$base
     * @param	mixed	$environments
     * @param	array	$arguments
     * @return string
     */
    public static function detectConsoleEnvironment($base, $environments, $arguments){}

    /**
     * Determine if the name matches the machine name.
     *
     * @static
     * @param	string	$name
     * @return bool
     */
    public static function isMachine($name){}

    /**
     * Determine if we are running in the console.
     *
     * @static
     * @return bool
     */
    public static function runningInConsole(){}

    /**
     * Determine if we are running unit tests.
     *
     * @static
     * @return bool
     */
    public static function runningUnitTests(){}

    /**
     * Register a service provider with the application.
     *
     * @static
     * @param	Illuminate\Support\ServiceProvider	$provider
     * @param	array	$options
     * @return void
     */
    public static function register($provider, $options = array()){}

    /**
     * Load and boot all of the remaining deferred providers.
     *
     * @static
     * @return void
     */
    public static function loadDeferredProviders(){}

    /**
     * Load the provider for a deferred service.
     *
     * @static
     * @param	string	$service
     * @return void
     */
    public static function loadDeferredProvider($service){}

    /**
     * Resolve the given type from the container.
    (Overriding Container::make)
     *
     * @static
     * @param	string	$abstract
     * @param	array	$parameters
     * @return mixed
     */
    public static function make($abstract, $parameters = array()){}

    /**
     * Register a "before" application filter.
     *
     * @static
     * @param	Closure|string	$callback
     * @return void
     */
    public static function before($callback){}

    /**
     * Register an "after" application filter.
     *
     * @static
     * @param	Closure|string	$callback
     * @return void
     */
    public static function after($callback){}

    /**
     * Register a "close" application filter.
     *
     * @static
     * @param	Closure|string	$callback
     * @return void
     */
    public static function close($callback){}

    /**
     * Register a "finish" application filter.
     *
     * @static
     * @param	Closure|string	$callback
     * @return void
     */
    public static function finish($callback){}

    /**
     * Register a "shutdown" callback.
     *
     * @static
     * @param	callable	$callback
     * @return void
     */
    public static function shutdown($callback = null){}

    /**
     * Handles the given request and delivers the response.
     *
     * @static
     * @return void
     */
    public static function run(){}

    /**
     * Handle the given request and get the response.
     *
     * @static
     * @param	Illuminate\Foundation\Request	$request
     * @return Symfony\Component\HttpFoundation\Response
     */
    public static function dispatch($request){}

    /**
     * Handle the given request and get the response.
    Provides compatibility with BrowserKit functional testing.
     *
     * @static
     * @param	Illuminate\Foundation\Request	$request
     * @param	int	$type
     * @param	bool	$catch
     * @return Symfony\Component\HttpFoundation\Response
     */
    public static function handle($request, $type = '1', $catch = true){}

    /**
     * Boot the application's service providers.
     *
     * @static
     * @return void
     */
    public static function boot(){}

    /**
     * Register a new boot listener.
     *
     * @static
     * @param	mixed	$callback
     * @return void
     */
    public static function booting($callback){}

    /**
     * Register a new "booted" listener.
     *
     * @static
     * @param	mixed	$callback
     * @return void
     */
    public static function booted($callback){}

    /**
     * Call the booting callbacks for the application.
     *
     * @static
     * @return void
     */
    public static function fireAppCallbacks($callbacks){}

    /**
     * Prepare the request by injecting any services.
     *
     * @static
     * @param	Illuminate\Foundation\Request	$request
     * @return Illuminate\Foundation\Request
     */
    public static function prepareRequest($request){}

    /**
     * Prepare the given value as a Response object.
     *
     * @static
     * @param	mixed	$value
     * @param	Illuminate\Foundation\Request	$request
     * @return Symfony\Component\HttpFoundation\Response
     */
    public static function prepareResponse($value, $request){}

    /**
     * Set the current application locale.
     *
     * @static
     * @param	string	$locale
     * @return void
     */
    public static function setLocale($locale){}

    /**
     * Throw an HttpException with the given data.
     *
     * @static
     * @param	int	$code
     * @param	string	$message
     * @param	array	$headers
     * @return void
     */
    public static function abort($code, $message = '', $headers = array()){}

    /**
     * Register a 404 error handler.
     *
     * @static
     * @param	Closure	$callback
     * @return void
     */
    public static function missing($callback){}

    /**
     * Register an application error handler.
     *
     * @static
     * @param	Closure	$callback
     * @return void
     */
    public static function error($callback){}

    /**
     * Register an error handler for fatal errors.
     *
     * @static
     * @param	Closure	$callback
     * @return void
     */
    public static function fatal($callback){}

    /**
     * Get the service providers that have been loaded.
     *
     * @static
     * @return array
     */
    public static function getLoadedProviders(){}

    /**
     * Set the application's deferred services.
     *
     * @static
     * @param	array	$services
     * @return void
     */
    public static function setDeferredServices($services){}

    /**
     * Dynamically access application services.
     *
     * @static
     * @param	string	$key
     * @return mixed
     */
    public static function __get($key){}

    /**
     * Dynamically set application services.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @return void
     */
    public static function __set($key, $value){}

    /**
     * Determine if the given abstract type has been bound.
     *
     * @static
     * @param	string	$abstract
     * @return bool
     */
    public static function bound($abstract){}

    /**
     * Register a binding with the container.
     *
     * @static
     * @param	string	$abstract
     * @param	Closure|string|null	$concrete
     * @param	bool	$shared
     * @return void
     */
    public static function bind($abstract, $concrete = null, $shared = false){}

    /**
     * Register a binding if it hasn't already been registered.
     *
     * @static
     * @param	string	$abstract
     * @param	Closure|string|null	$concrete
     * @param	bool	$shared
     * @return bool
     */
    public static function bindIf($abstract, $concrete = null, $shared = false){}

    /**
     * Register a shared binding in the container.
     *
     * @static
     * @param	string	$abstract
     * @param	Closure|string|null	$concrete
     * @return void
     */
    public static function singleton($abstract, $concrete = null){}

    /**
     * Wrap a Closure such that it is shared.
     *
     * @static
     * @param	Closure	$closure
     * @return Closure
     */
    public static function share($closure){}

    /**
     * "Extend" an abstract type in the container.
     *
     * @static
     * @param	string	$abstract
     * @param	Closure	$closure
     * @return void
     */
    public static function extend($abstract, $closure){}

    /**
     * Register an existing instance as shared in the container.
     *
     * @static
     * @param	string	$abstract
     * @param	mixed	$instance
     * @return void
     */
    public static function instance($abstract, $instance){}

    /**
     * Alias a type to a shorter name.
     *
     * @static
     * @param	string	$abstract
     * @param	string	$alias
     * @return void
     */
    public static function alias($abstract, $alias){}

    /**
     * Extract the type and alias from a given definition.
     *
     * @static
     * @param	array	$definition
     * @return array
     */
    public static function extractAlias($definition){}

    /**
     * Get the concrete type for a given abstract.
     *
     * @static
     * @param	string	$abstract
     * @return mixed
     */
    public static function getConcrete($abstract){}

    /**
     * Instantiate a concrete instance of the given type.
     *
     * @static
     * @param	string	$concrete
     * @param	array	$parameters
     * @return mixed
     */
    public static function build($concrete, $parameters = array()){}

    /**
     * Resolve all of the dependencies from the ReflectionParameters.
     *
     * @static
     * @param	array	$parameters
     * @return array
     */
    public static function getDependencies($parameters){}

    /**
     * Resolve a non-class hinted dependency.
     *
     * @static
     * @param	ReflectionParameter	$parameter
     * @return mixed
     */
    public static function resolveNonClass($parameter){}

    /**
     * Register a new resolving callback.
     *
     * @static
     * @param	Closure	$callback
     * @return void
     */
    public static function resolving($callback){}

    /**
     * Fire all of the resolving callbacks.
     *
     * @static
     * @param	mixed	$object
     * @return void
     */
    public static function fireResolvingCallbacks($object){}

    /**
     * Determine if a given type is shared.
     *
     * @static
     * @param	string	$abstract
     * @return bool
     */
    public static function isShared($abstract){}

    /**
     * Determine if the given concrete is buildable.
     *
     * @static
     * @param	mixed	$concrete
     * @param	string	$abstract
     * @return bool
     */
    public static function isBuildable($concrete, $abstract){}

    /**
     * Get the alias for an abstract if available.
     *
     * @static
     * @param	string	$abstract
     * @return string
     */
    public static function getAlias($abstract){}

    /**
     * Get the container's bindings.
     *
     * @static
     * @return array
     */
    public static function getBindings(){}

    /**
     * Determine if a given offset exists.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function offsetExists($key){}

    /**
     * Get the value at a given offset.
     *
     * @static
     * @param	string	$key
     * @return mixed
     */
    public static function offsetGet($key){}

    /**
     * Set the value at a given offset.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @return void
     */
    public static function offsetSet($key, $value){}

    /**
     * Unset the value at a given offset.
     *
     * @static
     * @param	string	$key
     * @return void
     */
    public static function offsetUnset($key){}

}

class Artisan extends Illuminate\Foundation\Artisan{
    /**
     * Create a new Artisan command runner instance.
     *
     * @static
     * @param	Illuminate\Foundation\Application	$app
     * @return void
     */
    public static function __construct($app){}

    /**
     * Run an Artisan console command by name.
     *
     * @static
     * @param	string	$command
     * @param	array	$parameters
     * @param	Symfony\Component\Console\Output\OutputInterface	$output
     * @return void
     */
    public static function call($command, $parameters = array(), $output = null){}

    /**
     * Get the Artisan console instance.
     *
     * @static
     * @return Illuminate\Console\Application
     */
    public static function getArtisan(){}

    /**
     * Dynamically pass all missing methods to console Artisan.
     *
     * @static
     * @param	string	$method
     * @param	array	$parameters
     * @return mixed
     */
    public static function __call($method, $parameters){}

}

class Auth extends Illuminate\Auth\Guard{
    /**
     * Create a new authentication guard.
     *
     * @static
     * @param	Illuminate\Auth\UserProviderInterface	$provider
     * @param	Illuminate\Session\Store	$session
     * @return void
     */
    public static function __construct($provider, $session){}

    /**
     * Determine if the current user is authenticated.
     *
     * @static
     * @return bool
     */
    public static function check(){}

    /**
     * Determine if the current user is a guest.
     *
     * @static
     * @return bool
     */
    public static function guest(){}

    /**
     * Get the currently authenticated user.
     *
     * @static
     * @return Illuminate\Auth\UserInterface|null
     */
    public static function user(){}

    /**
     * Get the decrypted recaller cookie for the request.
     *
     * @static
     * @return string|null
     */
    public static function getRecaller(){}

    /**
     * Log a user into the application without sessions or cookies.
     *
     * @static
     * @param	array	$credentials
     * @return bool
     */
    public static function stateless($credentials = array()){}

    /**
     * Validate a user's credentials.
     *
     * @static
     * @param	array	$credentials
     * @return bool
     */
    public static function validate($credentials = array()){}

    /**
     * Attempt to authenticate a user using the given credentials.
     *
     * @static
     * @param	array	$credentials
     * @param	bool	$remember
     * @param	bool	$login
     * @return bool
     */
    public static function attempt($credentials = array(), $remember = false, $login = true){}

    /**
     * Log a user into the application.
     *
     * @static
     * @param	Illuminate\Auth\UserInterface	$user
     * @param	bool	$remember
     * @return void
     */
    public static function login($user, $remember = false){}

    /**
     * Log the given user ID into the application.
     *
     * @static
     * @param	mixed	$id
     * @param	bool	$remember
     * @return Illuminate\Auth\UserInterface
     */
    public static function loginUsingId($id, $remember = false){}

    /**
     * Create a remember me cookie for a given ID.
     *
     * @static
     * @param	mixed	$id
     * @return Symfony\Component\HttpFoundation\Cookie
     */
    public static function createRecaller($id){}

    /**
     * Log the user out of the application.
     *
     * @static
     * @return void
     */
    public static function logout(){}

    /**
     * Remove the user data from the session and cookies.
     *
     * @static
     * @return void
     */
    public static function clearUserDataFromStorage(){}

    /**
     * Get the cookie creator instance used by the guard.
     *
     * @static
     * @return Illuminate\CookieJar
     */
    public static function getCookieJar(){}

    /**
     * Set the cookie creator instance used by the guard.
     *
     * @static
     * @param	Illuminate\CookieJar	$cookie
     * @return void
     */
    public static function setCookieJar($cookie){}

    /**
     * Get the event dispatcher instance.
     *
     * @static
     * @return Illuminate\Events\Dispatcher
     */
    public static function getDispatcher(){}

    /**
     * Set the event dispatcher instance.
     *
     * @static
     * @param	Illuminate\Events\Dispatcher
     * @return void
     */
    public static function setDispatcher($events){}

    /**
     * Get the session store used by the guard.
     *
     * @static
     * @return Illuminate\Session\Store
     */
    public static function getSession(){}

    /**
     * Get the cookies queued by the guard.
     *
     * @static
     * @return array
     */
    public static function getQueuedCookies(){}

    /**
     * Get the user provider used by the guard.
     *
     * @static
     * @return Illuminate\Auth\UserProviderInterface
     */
    public static function getProvider(){}

    /**
     * Return the currently cached user of the application.
     *
     * @static
     * @return Illuminate\Auth\UserInterface|null
     */
    public static function getUser(){}

    /**
     * Set the current user of the application.
     *
     * @static
     * @param	Illuminate\Auth\UserInterface	$user
     * @return void
     */
    public static function setUser($user){}

    /**
     * Get a unique identifier for the auth session value.
     *
     * @static
     * @return string
     */
    public static function getName(){}

    /**
     * Get the name of the cookie used to store the "recaller".
     *
     * @static
     * @return string
     */
    public static function getRecallerName(){}

}

class Blade extends Illuminate\View\Compilers\BladeCompiler{
    /**
     * Compile the view at the given path.
     *
     * @static
     * @param	string	$path
     * @return void
     */
    public static function compile($path){}

    /**
     * Compile the given Blade template contents.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileString($value){}

    /**
     * Register a custom Blade compiler.
     *
     * @static
     * @param	Closure	$compiler
     * @return void
     */
    public static function extend($compiler){}

    /**
     * Execute the user defined extensions.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileExtensions($value){}

    /**
     * Compile Blade template extensions into valid PHP.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileExtends($value){}

    /**
     * Compile the proper template inheritance for the lines.
     *
     * @static
     * @param	array	$lines
     * @return array
     */
    public static function compileLayoutExtends($lines){}

    /**
     * Compile Blade comments into valid PHP.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileComments($value){}

    /**
     * Compile Blade echos into valid PHP.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileEchos($value){}

    /**
     * Compile the "regular" echo statements.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileRegularEchos($value){}

    /**
     * Compile the escaped echo statements.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileEscapedEchos($value){}

    /**
     * Compile Blade structure openings into valid PHP.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileOpenings($value){}

    /**
     * Compile Blade structure closings into valid PHP.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileClosings($value){}

    /**
     * Compile Blade else statements into valid PHP.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileElse($value){}

    /**
     * Compile Blade unless statements into valid PHP.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileUnless($value){}

    /**
     * Compile Blade end unless statements into valid PHP.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileEndUnless($value){}

    /**
     * Compile Blade include statements into valid PHP.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileIncludes($value){}

    /**
     * Compile Blade each statements into valid PHP.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileEach($value){}

    /**
     * Compile Blade yield statements into valid PHP.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileYields($value){}

    /**
     * Compile Blade show statements into valid PHP.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileShows($value){}

    /**
     * Compile Blade section start statements into valid PHP.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileSectionStart($value){}

    /**
     * Compile Blade section stop statements into valid PHP.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function compileSectionStop($value){}

    /**
     * Get the regular expression for a generic Blade function.
     *
     * @static
     * @param	string	$function
     * @return string
     */
    public static function createMatcher($function){}

    /**
     * Get the regular expression for a generic Blade function.
     *
     * @static
     * @param	string	$function
     * @return string
     */
    public static function createOpenMatcher($function){}

    /**
     * Create a plain Blade matcher.
     *
     * @static
     * @param	string	$function
     * @return string
     */
    public static function createPlainMatcher($function){}

    /**
     * Sets the content tags used for the compiler.
     *
     * @static
     * @param	string	$openTag
     * @param	string	$closeTag
     * @param	array	$raw
     * @return void
     */
    public static function setContentTags($openTag, $closeTag, $raw = false){}

    /**
     * Sets the raw content tags used for the compiler.
     *
     * @static
     * @param	string	$openTag
     * @param	string	$closeTag
     * @return void
     */
    public static function setEscapedContentTags($openTag, $closeTag){}

    /**
     * Create a new compiler instance.
     *
     * @static
     * @param	string	$cachePath
     * @return void
     */
    public static function __construct($files, $cachePath){}

    /**
     * Get the path to the compiled version of a view.
     *
     * @static
     * @param	string	$path
     * @return string
     */
    public static function getCompiledPath($path){}

    /**
     * Determine if the view at the given path is expired.
     *
     * @static
     * @param	string	$path
     * @return bool
     */
    public static function isExpired($path){}

}

class Cache extends Illuminate\Cache\Store{
    /**
     * Retrieve an item from the cache by key.
     *
     * @static
     * @param	string	$key
     * @return mixed
     */
    public static function retrieveItem($key){}

    /**
     * Store an item in the cache for a given number of minutes.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @param	int	$minutes
     * @return void
     */
    public static function storeItem($key, $value, $minutes){}

    /**
     * Store an item in the cache indefinitely.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @return void
     */
    public static function storeItemForever($key, $value){}

    /**
     * Remove an item from the cache.
     *
     * @static
     * @param	string	$key
     * @return void
     */
    public static function removeItem($key){}

    /**
     * Remove all items from the cache.
     *
     * @static
     * @return void
     */
    public static function flushItems(){}

    /**
     * Determine if an item exists in the cache.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function has($key){}

    /**
     * Retrieve an item from the cache by key.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return mixed
     */
    public static function get($key, $default = null){}

    /**
     * Store an item in the cache.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @param	int	$minutes
     * @return void
     */
    public static function put($key, $value, $minutes){}

    /**
     * Store an item in the cache indefinitely.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @return void
     */
    public static function forever($key, $value){}

    /**
     * Get an item from the cache, or store the default value.
     *
     * @static
     * @param	string	$key
     * @param	int	$minutes
     * @param	Closure	$callback
     * @return
     */
    public static function remember($key, $minutes, $callback){}

    /**
     * Get an item from the cache, or store the default value forever.
     *
     * @static
     * @param	string	$key
     * @param	Closure	$callback
     * @return
     */
    public static function rememberForever($key, $callback){}

    /**
     * Remove an item from the cache.
     *
     * @static
     * @param	string	$key
     * @return void
     */
    public static function forget($key){}

    /**
     * Remove all items from the cache.
     *
     * @static
     * @return void
     */
    public static function flush(){}

    /**
     * Get the default cache time.
     *
     * @static
     * @return int
     */
    public static function getDefaultCacheTime(){}

    /**
     * Set the default cache time in minutes.
     *
     * @static
     * @param	int	$minutes
     * @return void
     */
    public static function setDefaultCacheTime($minutes){}

    /**
     * Determine if an item is in memory.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function existsInMemory($key){}

    /**
     * Get all of the values in memory.
     *
     * @static
     * @return array
     */
    public static function getMemory(){}

    /**
     * Get the value of an item in memory.
     *
     * @static
     * @param	string	$key
     * @return mixed
     */
    public static function getFromMemory($key){}

    /**
     * Set the value of an item in memory.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @return void
     */
    public static function setInMemory($key, $value){}

    /**
     * Determine if a cached value exists.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function offsetExists($key){}

    /**
     * Retrieve an item from the cache by key.
     *
     * @static
     * @param	string	$key
     * @return mixed
     */
    public static function offsetGet($key){}

    /**
     * Store an item in the cache for the default time.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @return void
     */
    public static function offsetSet($key, $value){}

    /**
     * Remove an item from the cache.
     *
     * @static
     * @param	string	$key
     * @return void
     */
    public static function offsetUnset($key){}

}

class ClassLoader extends Illuminate\Support\ClassLoader{
    /**
     * Load the given class file.
     *
     * @static
     * @param	string	$class
     * @return void
     */
    public static function load($class){}

    /**
     * Get the normal file name for a class.
     *
     * @static
     * @param	string	$class
     * @return string
     */
    public static function normalizeClass($class){}

    /**
     * Register the given class loader on the auto-loader stack.
     *
     * @static
     * @return void
     */
    public static function register(){}

    /**
     * Add directories to the class loader.
     *
     * @static
     * @param	string|array	$directories
     * @return void
     */
    public static function addDirectories($directories){}

    /**
     * Remove directories from the class loader.
     *
     * @static
     * @param	string|array	$directories
     * @return void
     */
    public static function removeDirectories($directories = null){}

    /**
     * Gets all the directories registered with the loader.
     *
     * @static
     * @return array
     */
    public static function getDirectories(){}

}

class Config extends Illuminate\Config\Repository{
    /**
     * Create a new configuration repository.
     *
     * @static
     * @param	Illuminate\Config\LoaderInterface	$loader
     * @param	string	$environment
     * @return void
     */
    public static function __construct($loader, $environment){}

    /**
     * Determine if the given configuration value exists.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function has($key){}

    /**
     * Determine if a configuration group exists.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function hasGroup($key){}

    /**
     * Get the specified configuration value.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return mixed
     */
    public static function get($key, $default = null){}

    /**
     * Set a given configuration value.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @return void
     */
    public static function set($key, $value){}

    /**
     * Load the configuration group for the key.
     *
     * @static
     * @param	string	$key
     * @param	string	$namespace
     * @param	string	$collection
     * @return void
     */
    public static function load($group, $namespace, $collection){}

    /**
     * Call the after load callback for a namespace.
     *
     * @static
     * @param	string	$namespace
     * @param	string	$group
     * @param	array	$items
     * @return array
     */
    public static function callAfterLoad($namespace, $group, $items){}

    /**
     * Parse an array of namespaced segments.
     *
     * @static
     * @param	string	$key
     * @return array
     */
    public static function parseNamespacedSegments($key){}

    /**
     * Parse the segments of a package namespace.
     *
     * @static
     * @param	string	$namespace
     * @param	string	$item
     * @return array
     */
    public static function parsePackageSegments($key, $namespace, $item){}

    /**
     * Register a package for cascading configuration.
     *
     * @static
     * @param	string	$package
     * @param	string	$hint
     * @param	string	$namespace
     * @return void
     */
    public static function package($package, $hint, $namespace = null){}

    /**
     * Get the configuration namespace for a package.
     *
     * @static
     * @param	string	$package
     * @param	string	$namespace
     * @return string
     */
    public static function getPackageNamespace($package, $namespace){}

    /**
     * Register an after load callback for a given namespace.
     *
     * @static
     * @param	string	$namespace
     * @param	Closure	$callback
     * @return void
     */
    public static function afterLoading($namespace, $callback){}

    /**
     * Get the collection identifier.
     *
     * @static
     * @param	string	$group
     * @param	string	$namespace
     * @return string
     */
    public static function getCollection($group, $namespace = null){}

    /**
     * Add a new namespace to the loader.
     *
     * @static
     * @param	string	$namespace
     * @param	string	$hint
     * @return void
     */
    public static function addNamespace($namespace, $hint){}

    /**
     * Returns all registered namespaces with the config
    loader.
     *
     * @static
     * @return array
     */
    public static function getNamespaces(){}

    /**
     * Get the loader implementation.
     *
     * @static
     * @return Illuminate\Config\LoaderInterface
     */
    public static function getLoader(){}

    /**
     * Set the loader implementation.
     *
     * @static
     * @return Illuminate\Config\LoaderInterface
     */
    public static function setLoader($loader){}

    /**
     * Get the current configuration environment.
     *
     * @static
     * @return string
     */
    public static function getEnvironment(){}

    /**
     * Get the after load callback array.
     *
     * @static
     * @return array
     */
    public static function getAfterLoadCallbacks(){}

    /**
     * Get all of the configuration items.
     *
     * @static
     * @return array
     */
    public static function getItems(){}

    /**
     * Determine if the given configuration option exists.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function offsetExists($key){}

    /**
     * Get a configuration option.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function offsetGet($key){}

    /**
     * Set a configuration option.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function offsetSet($key, $value){}

    /**
     * Unset a configuration option.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function offsetUnset($key){}

    /**
     * Parse a key into namespace, group, and item.
     *
     * @static
     * @param	string	$key
     * @return array
     */
    public static function parseKey($key){}

    /**
     * Parse an array of basic segments.
     *
     * @static
     * @param	array	$segments
     * @return array
     */
    public static function parseBasicSegments($segments){}

    /**
     * Set the parsed value of a key.
     *
     * @static
     * @param	string	$key
     * @param	array	$parsed
     * @return void
     */
    public static function setParsedKey($key, $parsed){}

}

class Controller extends Illuminate\Routing\Controllers\Controller{
    /**
     * Register a new "before" filter on the controller.
     *
     * @static
     * @param	string	$filter
     * @param	array	$options
     * @return void
     */
    public static function beforeFilter($filter, $options = array()){}

    /**
     * Register a new "after" filter on the controller.
     *
     * @static
     * @param	string	$filter
     * @param	array	$options
     * @return void
     */
    public static function afterFilter($filter, $options = array()){}

    /**
     * Prepare a filter and return the options.
     *
     * @static
     * @param	string	$filter
     * @param	array	$options
     * @return array
     */
    public static function prepareFilter($filter, $options){}

    /**
     * Execute an action on the controller.
     *
     * @static
     * @param	Illuminate\Container	$container
     * @param	Illuminate\Routing\Router	$router
     * @param	string	$method
     * @param	array	$parameters
     * @return Symfony\Component\HttpFoundation\Response
     */
    public static function callAction($container, $router, $method, $parameters){}

    /**
     * Call the given action with the given parameters.
     *
     * @static
     * @param	string	$method
     * @param	array	$parameters
     * @return mixed
     */
    public static function callMethod($method, $parameters){}

    /**
     * Process a controller action response.
     *
     * @static
     * @param	Illuminate\Routing\Router	$router
     * @param	string	$method
     * @param	mixed	$response
     * @return Symfony\Component\HttpFoundation\Response
     */
    public static function processResponse($router, $method, $response){}

    /**
     * Call the before filters on the controller.
     *
     * @static
     * @param	Illuminate\Routing\Router	$router
     * @param	string	$method
     * @return mixed
     */
    public static function callBeforeFilters($router, $method){}

    /**
     * Get the before filters for the controller.
     *
     * @static
     * @param	Symfony\Component\HttpFoundation\Request	$request
     * @param	string	$method
     * @return array
     */
    public static function getBeforeFilters($request, $method){}

    /**
     * Call the after filters on the controller.
     *
     * @static
     * @param	Illuminate\Routing\Router	$router
     * @param	string	$method
     * @param	Symfony\Component\HttpFoundation\Response	$response
     * @return mixed
     */
    public static function callAfterFilters($router, $method, $response){}

    /**
     * Get the after filters for the controller.
     *
     * @static
     * @param	Symfony\Component\HttpFoundation\Request	$request
     * @param	string	$method
     * @return array
     */
    public static function getAfterFilters($request, $method){}

    /**
     * Call the given route filter.
     *
     * @static
     * @param	Illuminate\Routing\Route	$route
     * @param	string	$filter
     * @param	Symfony\Component\HttpFoundation\Request	$request
     * @param	array	$parameters
     * @return mixed
     */
    public static function callFilter($route, $filter, $request, $parameters = array()){}

    /**
     * Setup the layout used by the controller.
     *
     * @static
     * @return void
     */
    public static function setupLayout(){}

    /**
     * Get the code registered filters.
     *
     * @static
     * @return array
     */
    public static function getControllerFilters(){}

    /**
     * Handle calls to missing methods on the controller.
     *
     * @static
     * @param	array	$parameters
     * @return mixed
     */
    public static function missingMethod($parameters){}

    /**
     * Handle calls to missing methods on the controller.
     *
     * @static
     * @param	string	$method
     * @param	array	$parameters
     * @return mixed
     */
    public static function __call($method, $parameters){}

}

class Cookie extends Illuminate\Cookie\CookieJar{
    /**
     * Create a new cookie manager instance.
     *
     * @static
     * @param	Symfony\Component\HttpFoundation\Request	$request
     * @param	Illuminate\Encryption\Encrypter	$encrypter
     * @param	array	$defaults
     * @return void
     */
    public static function __construct($request, $encrypter, $defaults){}

    /**
     * Determine if a cookie exists and is not null.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function has($key){}

    /**
     * Get the value of the given cookie.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return mixed
     */
    public static function get($key, $default = null){}

    /**
     * Decrypt the given cookie value.
     *
     * @static
     * @param	string	$value
     * @return mixed|null
     */
    public static function decrypt($value){}

    /**
     * Create a new cookie instance.
     *
     * @static
     * @param	string	$name
     * @param	string	$value
     * @param	int	$minutes
     * @return Symfony\Component\HttpFoundation\Cookie
     */
    public static function make($name, $value, $minutes = '0'){}

    /**
     * Create a cookie that lasts "forever" (five years).
     *
     * @static
     * @param	string	$name
     * @param	string	$value
     * @return Symfony\Component\HttpFoundation\Cookie
     */
    public static function forever($name, $value){}

    /**
     * Expire the given cookie.
     *
     * @static
     * @param	string	$name
     * @return Symfony\Component\HttpFoundation\Cookie
     */
    public static function forget($name){}

    /**
     * Set the value of a cookie option.
     *
     * @static
     * @param	string	$option
     * @param	string	$value
     * @return void
     */
    public static function setDefault($option, $value){}

    /**
     * Get the request instance.
     *
     * @static
     * @return Symfony\Component\HttpFoundation\Request
     */
    public static function getRequest(){}

    /**
     * Get the encrypter instance.
     *
     * @static
     * @return Illuminate\Encrypter
     */
    public static function getEncrypter(){}

}

class Crypt extends Illuminate\Encryption\Encrypter{
    /**
     * Create a new encrypter instance.
     *
     * @static
     * @param	string	$key
     * @return void
     */
    public static function __construct($key){}

    /**
     * Encrypt the given value.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function encrypt($value){}

    /**
     * Pad and use mcrypt on the given value and input vector.
     *
     * @static
     * @param	string	$value
     * @param	string	$iv
     * @return string
     */
    public static function padAndMcrypt($value, $iv){}

    /**
     * Decrypt the given value.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function decrypt($payload){}

    /**
     * Run the mcrypt decryption routine for the value.
     *
     * @static
     * @param	string	$value
     * @param	string	$iv
     * @return string
     */
    public static function mcryptDecrypt($value, $iv){}

    /**
     * Get the JSON array from the given payload.
     *
     * @static
     * @param	string	$payload
     * @return array
     */
    public static function getJsonPayload($payload){}

    /**
     * Create a MAC for the given value.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function hash($value){}

    /**
     * Add PKCS7 padding to a given value.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function addPadding($value){}

    /**
     * Remove the padding from the given value.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function stripPadding($value){}

    /**
     * Determine if the given padding for a value is valid.
     *
     * @static
     * @param	string	$pad
     * @param	string	$value
     * @return bool
     */
    public static function paddingIsValid($pad, $value){}

    /**
     * Verify that the encryption payload is valid.
     *
     * @static
     * @param	array	$data
     * @return bool
     */
    public static function invalidPayload($data){}

    /**
     * Get the IV size for the cipher.
     *
     * @static
     * @return int
     */
    public static function getIvSize(){}

    /**
     * Get the random data source available for the OS.
     *
     * @static
     * @return int
     */
    public static function getRandomizer(){}

}

class DB extends Illuminate\Database\Connection{
    /**
     * Create a new database connection instance.
     *
     * @static
     * @param	PDO	$pdo
     * @param	string	$database
     * @param	string	$tablePrefix
     * @param	string	$name
     * @return void
     */
    public static function __construct($pdo, $database = '', $tablePrefix = '', $name = null){}

    /**
     * Set the query grammar to the default implementation.
     *
     * @static
     * @return void
     */
    public static function useDefaultQueryGrammar(){}

    /**
     * Get the default query grammar instance.
     *
     * @static
     * @return Illuminate\Database\Query\Grammars\Grammar
     */
    public static function getDefaultQueryGrammar(){}

    /**
     * Set the schema grammar to the default implementation.
     *
     * @static
     * @return void
     */
    public static function useDefaultSchemaGrammar(){}

    /**
     * Get the default schema grammar instance.
     *
     * @static
     * @return Illuminate\Database\Schema\Grammars\Grammar
     */
    public static function getDefaultSchemaGrammar(){}

    /**
     * Set the query post processor to the default implementation.
     *
     * @static
     * @return void
     */
    public static function useDefaultPostProcessor(){}

    /**
     * Get the default post processor instance.
     *
     * @static
     * @return Illuminate\Database\Query\Processors\Processor
     */
    public static function getDefaultPostProcessor(){}

    /**
     * Get a schema builder instance for the connection.
     *
     * @static
     * @return Illuminate\Database\Schema\Builder
     */
    public static function getSchemaBuilder(){}

    /**
     * Begin a fluent query against a database table.
     *
     * @static
     * @param	string	$table
     * @return Illuminate\Database\Query\Builder
     */
    public static function table($table){}

    /**
     * Get a new raw query expression.
     *
     * @static
     * @param	mixed	$value
     * @return Illuminate\Database\Query\Expression
     */
    public static function raw($value){}

    /**
     * Run a select statement and return a single result.
     *
     * @static
     * @param	string	$query
     * @param	array	$bindings
     * @return mixed
     */
    public static function selectOne($query, $bindings = array()){}

    /**
     * Run a select statement against the database.
     *
     * @static
     * @param	string	$query
     * @param	array	$bindings
     * @return array
     */
    public static function select($query, $bindings = array()){}

    /**
     * Run an insert statement against the database.
     *
     * @static
     * @param	string	$query
     * @param	array	$bindings
     * @return bool
     */
    public static function insert($query, $bindings = array()){}

    /**
     * Run an update statement against the database.
     *
     * @static
     * @param	string	$query
     * @param	array	$bindings
     * @return int
     */
    public static function update($query, $bindings = array()){}

    /**
     * Run a delete statement against the database.
     *
     * @static
     * @param	string	$query
     * @param	array	$bindings
     * @return int
     */
    public static function delete($query, $bindings = array()){}

    /**
     * Execute an SQL statement and return the boolean result.
     *
     * @static
     * @param	string	$query
     * @param	array	$bindings
     * @return bool
     */
    public static function statement($query, $bindings = array()){}

    /**
     * Run an SQL statement and get the number of rows affected.
     *
     * @static
     * @param	string	$query
     * @param	array	$bindings
     * @return int
     */
    public static function affectingStatement($query, $bindings = array()){}

    /**
     * Run a raw, unprepared query against the PDO connection.
     *
     * @static
     * @param	string	$query
     * @return bool
     */
    public static function unprepared($query){}

    /**
     * Prepare the query bindings for execution.
     *
     * @static
     * @param	array	$bindings
     * @return array
     */
    public static function prepareBindings($bindings){}

    /**
     * Execute a Closure within a transaction.
     *
     * @static
     * @param	Closure	$callback
     * @return mixed
     */
    public static function transaction($callback){}

    /**
     * Execute the given callback in "dry run" mode.
     *
     * @static
     * @param	Closure	$callback
     * @return array
     */
    public static function pretend($callback){}

    /**
     * Run a SQL statement and log its execution context.
     *
     * @static
     * @param	string	$query
     * @param	array	$bindings
     * @param	Closure	$callback
     * @return mixed
     */
    public static function run($query, $bindings, $callback){}

    /**
     * Handle an exception that occurred during a query.
     *
     * @static
     * @param	Exception	$e
     * @param	string	$query
     * @param	array	$bindings
     * @return void
     */
    public static function handleQueryException($e, $query, $bindings){}

    /**
     * Log a query in the connection's query log.
     *
     * @static
     * @param	string	$query
     * @param	array	$bindings
     * @return void
     */
    public static function logQuery($query, $bindings, $time = null){}

    /**
     * Get the currently used PDO connection.
     *
     * @static
     * @return PDO
     */
    public static function getPdo(){}

    /**
     * Get the database connection name.
     *
     * @static
     * @return string|null
     */
    public static function getName(){}

    /**
     * Get the PDO driver name.
     *
     * @static
     * @return string
     */
    public static function getDriverName(){}

    /**
     * Get the query grammar used by the connection.
     *
     * @static
     * @return Illuminate\Database\Query\Grammars\Grammar
     */
    public static function getQueryGrammar(){}

    /**
     * Set the query grammar used by the connection.
     *
     * @static
     * @param	Illuminate\Database\Query\Grammars\Grammar
     * @return void
     */
    public static function setQueryGrammar($grammar){}

    /**
     * Get the schema grammar used by the connection.
     *
     * @static
     * @return Illuminate\Database\Query\Grammars\Grammar
     */
    public static function getSchemaGrammar(){}

    /**
     * Set the schema grammar used by the connection.
     *
     * @static
     * @param	Illuminate\Database\Schema\Grammars\Grammar
     * @return void
     */
    public static function setSchemaGrammar($grammar){}

    /**
     * Get the query post processor used by the connection.
     *
     * @static
     * @return Illuminate\Database\Query\Processors\Processor
     */
    public static function getPostProcessor(){}

    /**
     * Set the query post processor used by the connection.
     *
     * @static
     * @param	Illuminate\Database\Query\Processors\Processor
     * @return void
     */
    public static function setPostProcessor($processor){}

    /**
     * Get the event dispatcher used by the connection.
     *
     * @static
     * @return Illuminate\Events\Dispatcher
     */
    public static function getEventDispatcher(){}

    /**
     * Set the event dispatcher instance on the connection.
     *
     * @static
     * @param	Illuminate\Events\Dispatcher
     * @return void
     */
    public static function setEventDispatcher($events){}

    /**
     * Get the paginator environment instance.
     *
     * @static
     * @return Illuminate\Pagination\Environment
     */
    public static function getPaginator(){}

    /**
     * Set the pagination environment instance.
     *
     * @static
     * @param	Illuminate\Pagination\Environment|Closure	$paginator
     * @return void
     */
    public static function setPaginator($paginator){}

    /**
     * Determine if the connection in a "dry run".
     *
     * @static
     * @return bool
     */
    public static function pretending(){}

    /**
     * Get the default fetch mode for the connection.
     *
     * @static
     * @return int
     */
    public static function getFetchMode(){}

    /**
     * Set the default fetch mode for the connection.
     *
     * @static
     * @param	int	$fetchMode
     * @return int
     */
    public static function setFetchMode($fetchMode){}

    /**
     * Get the connection query log.
     *
     * @static
     * @return array
     */
    public static function getQueryLog(){}

    /**
     * Clear the query log.
     *
     * @static
     * @return void
     */
    public static function flushQueryLog(){}

    /**
     * Get the name of the connected database.
     *
     * @static
     * @return string
     */
    public static function getDatabaseName(){}

    /**
     * Set the name of the connected database.
     *
     * @static
     * @param	string	$database
     * @return string
     */
    public static function setDatabaseName($database){}

    /**
     * Get the table prefix for the connection.
     *
     * @static
     * @return string
     */
    public static function getTablePrefix(){}

    /**
     * Set the table prefix in use by the connection.
     *
     * @static
     * @param	string	$prefix
     * @return void
     */
    public static function setTablePrefix($prefix){}

    /**
     * Set the table prefix and return the grammar.
     *
     * @static
     * @param	Illuminate\Database\Grammar	$grammar
     * @return Illuminate\Database\Grammar
     */
    public static function withTablePrefix($grammar){}

}

class Eloquent extends Illuminate\Database\Eloquent\Model{
    /**
     * Create a new Eloquent model instance.
     *
     * @static
     * @param	array	$attributes
     * @return void
     */
    public static function __construct($attributes = array()){}

    /**
     * The "booting" method of the model.
     *
     * @static
     * @return void
     */
    public static function boot(){}

    /**
     * Fill the model with an array of attributes.
     *
     * @static
     * @param	array	$attributes
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function fill($attributes){}

    /**
     * Create a new instance of the given model.
     *
     * @static
     * @param	array	$attributes
     * @param	bool	$exists
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function newInstance($attributes = array(), $exists = false){}

    /**
     * Create a new model instance that is existing.
     *
     * @static
     * @param	array	$attributes
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function newExisting($attributes = array()){}

    /**
     * Save a new model and return the instance.
     *
     * @static
     * @param	array	$attributes
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function create($attributes){}

    /**
     * Begin querying the model on a given connection.
     *
     * @static
     * @param	string	$connection
     * @return Illuminate\Database\Eloquent\Builder
     */
    public static function on($connection){}

    /**
     * Get all of the models from the database.
     *
     * @static
     * @param	array	$columns
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function all($columns = array()){}

    /**
     * Find a model by its primary key.
     *
     * @static
     * @param	mixed	$id
     * @param	array	$columns
     * @return Illuminate\Database\Eloquent\Model|Collection
     */
    public static function find($id, $columns = array()){}

    /**
     * Being querying a model with eager loading.
     *
     * @static
     * @param	array	$relations
     * @return Illuminate\Database\Eloquent\Builder
     */
    public static function with($relations){}

    /**
     * Define a one-to-one relationship.
     *
     * @static
     * @param	string	$related
     * @param	string	$foreignKey
     * @return Illuminate\Database\Eloquent\Relation\HasOne
     */
    public static function hasOne($related, $foreignKey = null){}

    /**
     * Define a polymorphic one-to-one relationship.
     *
     * @static
     * @param	string	$related
     * @param	string	$name
     * @param	string	$type
     * @param	string	$id
     * @return Illuminate\Database\Eloquent\Relation\MorphOne
     */
    public static function morphOne($related, $name, $type = null, $id = null){}

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @static
     * @param	string	$related
     * @param	string	$foreignKey
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public static function belongsTo($related, $foreignKey = null){}

    /**
     * Define an polymorphic, inverse one-to-one or many relationship.
     *
     * @static
     * @param	string	$name
     * @param	string	$type
     * @param	string	$id
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public static function morphTo($name = null, $type = null, $id = null){}

    /**
     * Define a one-to-many relationship.
     *
     * @static
     * @param	string	$related
     * @param	string	$foreignKey
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public static function hasMany($related, $foreignKey = null){}

    /**
     * Define a polymorphic one-to-many relationship.
     *
     * @static
     * @param	string	$related
     * @param	string	$name
     * @param	string	$type
     * @param	string	$id
     * @return Illuminate\Database\Eloquent\Relation\MorphMany
     */
    public static function morphMany($related, $name, $type = null, $id = null){}

    /**
     * Define a many-to-many relationship.
     *
     * @static
     * @param	string	$related
     * @param	string	$table
     * @param	string	$foreignKey
     * @param	string	$otherKey
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public static function belongsToMany($related, $table = null, $foreignKey = null, $otherKey = null){}

    /**
     * Get the joining table name for a many-to-many relation.
     *
     * @static
     * @param	string	$related
     * @return string
     */
    public static function joiningTable($related){}

    /**
     * Delete the model from the database.
     *
     * @static
     * @return void
     */
    public static function delete(){}

    /**
     * Register an updating model event with the dispatcher.
     *
     * @static
     * @param	Closure	$callback
     * @return void
     */
    public static function updating($callback){}

    /**
     * Register an updated model event with the dispatcher.
     *
     * @static
     * @param	Closure	$callback
     * @return void
     */
    public static function updated($callback){}

    /**
     * Register a creating model event with the dispatcher.
     *
     * @static
     * @param	Closure	$callback
     * @return void
     */
    public static function creating($callback){}

    /**
     * Register a created model event with the dispatcher.
     *
     * @static
     * @param	Closure	$callback
     * @return void
     */
    public static function created($callback){}

    /**
     * Register a model event with the dispatcher.
     *
     * @static
     * @param	string	$event
     * @param	Closure	$callback
     * @return void
     */
    public static function registerModelEvent($event, $callback){}

    /**
     * Save the model to the database.
     *
     * @static
     * @return bool
     */
    public static function save(){}

    /**
     * Perform a model update operation.
     *
     * @static
     * @param	Illuminate\Database\Eloquent\Builder
     * @return bool
     */
    public static function performUpdate($query){}

    /**
     * Perform a model insert operation.
     *
     * @static
     * @param	Illuminate\Database\Eloquent\Builder
     * @return bool
     */
    public static function performInsert($query){}

    /**
     * Fire the given event for the model.
     *
     * @static
     * @return mixed
     */
    public static function fireModelEvent($event, $halt = true){}

    /**
     * Set the keys for a save update query.
     *
     * @static
     * @param	Illuminate\Database\Eloquent\Builder
     * @return void
     */
    public static function setKeysForSaveQuery($query){}

    /**
     * Update the model's update timestamp.
     *
     * @static
     * @return bool
     */
    public static function touch(){}

    /**
     * Update the creation and update timestamps.
     *
     * @static
     * @return void
     */
    public static function updateTimestamps(){}

    /**
     * Set the value of the "created at" attribute.
     *
     * @static
     * @param	mixed	$value
     * @return void
     */
    public static function setCreatedAt($value){}

    /**
     * Set the value of the "updated at" attribute.
     *
     * @static
     * @param	mixed	$value
     * @return void
     */
    public static function setUpdatedAt($value){}

    /**
     * Get the name of the "created at" column.
     *
     * @static
     * @return string
     */
    public static function getCreatedAtColumn(){}

    /**
     * Get the name of the "updated at" column.
     *
     * @static
     * @return string
     */
    public static function getUpdatedAtColumn(){}

    /**
     * Get a fresh timestamp for the model.
     *
     * @static
     * @return mixed
     */
    public static function freshTimestamp(){}

    /**
     * Get a new query builder for the model's table.
     *
     * @static
     * @return Illuminate\Database\Eloquent\Builder
     */
    public static function newQuery(){}

    /**
     * Get a new query builder instance for the connection.
     *
     * @static
     * @return Illuminate\Database\Query\Builder
     */
    public static function newBaseQueryBuilder(){}

    /**
     * Create a new Eloquent Collection instance.
     *
     * @static
     * @param	array	$models
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function newCollection($models = array()){}

    /**
     * Get the table associated with the model.
     *
     * @static
     * @return string
     */
    public static function getTable(){}

    /**
     * Set the table associated with the model.
     *
     * @static
     * @param	string	$table
     * @return void
     */
    public static function setTable($table){}

    /**
     * Get the value of the model's primary key.
     *
     * @static
     * @return mixed
     */
    public static function getKey(){}

    /**
     * Get the primary key for the model.
     *
     * @static
     * @return string
     */
    public static function getKeyName(){}

    /**
     * Determine if the model uses timestamps.
     *
     * @static
     * @return bool
     */
    public static function usesTimestamps(){}

    /**
     * Get the polymorphic relationship columns.
     *
     * @static
     * @param	string	$name
     * @param	string	$type
     * @param	string	$id
     * @return array
     */
    public static function getMorphs($name, $type, $id){}

    /**
     * Get the number of models to return per page.
     *
     * @static
     * @return int
     */
    public static function getPerPage(){}

    /**
     * Set the number of models ot return per page.
     *
     * @static
     * @param	int	$perPage
     * @return void
     */
    public static function setPerPage($perPage){}

    /**
     * Get the default foreign key name for the model.
     *
     * @static
     * @return string
     */
    public static function getForeignKey(){}

    /**
     * Get the hidden attributes for the model.
     *
     * @static
     * @return array
     */
    public static function getHidden(){}

    /**
     * Set the hidden attributes for the model.
     *
     * @static
     * @param	array	$hidden
     * @return void
     */
    public static function setHidden($hidden){}

    /**
     * Get the fillable attributes for the model.
     *
     * @static
     * @return array
     */
    public static function getFillable(){}

    /**
     * Set the fillable attributes for the model.
     *
     * @static
     * @param	array	$fillable
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function fillable($fillable){}

    /**
     * Set the guarded attributes for the model.
     *
     * @static
     * @param	array	$guarded
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function guard($guarded){}

    /**
     * Determine if the given attribute may be mass assigned.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function isFillable($key){}

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @static
     * @return bool
     */
    public static function getIncrementing(){}

    /**
     * Set whether IDs are incrementing.
     *
     * @static
     * @param	bool	$value
     * @return void
     */
    public static function setIncrementing($value){}

    /**
     * Convert the model instance to JSON.
     *
     * @static
     * @param	int	$options
     * @return string
     */
    public static function toJson($options = '0'){}

    /**
     * Convert the model instance to an array.
     *
     * @static
     * @return array
     */
    public static function toArray(){}

    /**
     * Convert the model's attributes to an array.
     *
     * @static
     * @return array
     */
    public static function attributesToArray(){}

    /**
     * Get an attribute array of all accessible attributes.
     *
     * @static
     * @return array
     */
    public static function getAccessibleAttributes(){}

    /**
     * Get the model's relationships in array form.
     *
     * @static
     * @return array
     */
    public static function relationsToArray(){}

    /**
     * Get an attribute from the model.
     *
     * @static
     * @param	string	$key
     * @return mixed
     */
    public static function getAttribute($key){}

    /**
     * Get a plain attribute (not a relationship).
     *
     * @static
     * @param	string	$key
     * @return mixed
     */
    public static function getAttributeValue($key){}

    /**
     * Get an attribute from the $attributes array.
     *
     * @static
     * @param	string	$key
     * @return mixed
     */
    public static function getAttributeFromArray($key){}

    /**
     * Determine if a get mutator exists for an attribute.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function hasGetMutator($key){}

    /**
     * Get the value of an attribute using its mutator.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @return mixed
     */
    public static function mutateAttribute($key, $value){}

    /**
     * Set a given attribute on the model.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @return void
     */
    public static function setAttribute($key, $value){}

    /**
     * Determine if a set mutator exists for an attribute.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function hasSetMutator($key){}

    /**
     * Convert a DateTime to a storable string.
     *
     * @static
     * @param	DateTime	$value
     * @return string
     */
    public static function fromDateTime($value){}

    /**
     * Return a timestamp as DateTime object.
     *
     * @static
     * @param	mixed	$value
     * @return DateTime
     */
    public static function asDateTime($value){}

    /**
     * Get the format for database stored dates.
     *
     * @static
     * @return string
     */
    public static function getDateFormat(){}

    /**
     * Get all of the current attributes on the model.
     *
     * @static
     * @return array
     */
    public static function getAttributes(){}

    /**
     * Set the array of model attributes. No checking is done.
     *
     * @static
     * @param	array	$attributes
     * @param	bool	$sync
     * @return void
     */
    public static function setRawAttributes($attributes, $sync = false){}

    /**
     * Get the model's original attribute values.
     *
     * @static
     * @param	string|null	$key
     * @param	mixed	$default
     * @return array
     */
    public static function getOriginal($key = null, $default = null){}

    /**
     * Sync the original attributes with the current.
     *
     * @static
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function syncOriginal(){}

    /**
     * Get the attributes that have been changed since last sync.
     *
     * @static
     * @return array
     */
    public static function getDirty(){}

    /**
     * Get a specified relationship.
     *
     * @static
     * @param	string	$relation
     * @return mixed
     */
    public static function getRelation($relation){}

    /**
     * Set the specific relationship in the model.
     *
     * @static
     * @param	string	$relation
     * @param	mixed	$value
     * @return void
     */
    public static function setRelation($relation, $value){}

    /**
     * Get the database connection for the model.
     *
     * @static
     * @return Illuminate\Database\Connection
     */
    public static function getConnection(){}

    /**
     * Get the current connection name for the model.
     *
     * @static
     * @return string
     */
    public static function getConnectionName(){}

    /**
     * Set the connection associated with the model.
     *
     * @static
     * @param	string	$name
     * @return void
     */
    public static function setConnection($name){}

    /**
     * Resolve a connection instance by name.
     *
     * @static
     * @param	string	$connection
     * @return Illuminate\Database\Connection
     */
    public static function resolveConnection($connection){}

    /**
     * Get the connection resolver instance.
     *
     * @static
     * @return Illuminate\Database\ConnectionResolverInterface
     */
    public static function getConnectionResolver(){}

    /**
     * Set the connection resolver instance.
     *
     * @static
     * @param	Illuminate\Database\ConnectionResolverInterface	$resolver
     * @return void
     */
    public static function setConnectionResolver($resolver){}

    /**
     * Get the event dispatcher instance.
     *
     * @static
     * @return Illuminate\Events\Dispatcher
     */
    public static function getEventDispatcher(){}

    /**
     * Set the event dispatcher instance.
     *
     * @static
     * @param	Illuminate\Events\Dispatcher
     * @return void
     */
    public static function setEventDispatcher($dispatcher){}

    /**
     * Unset the event dispatcher for models.
     *
     * @static
     * @return void
     */
    public static function unsetEventDispatcher(){}

    /**
     * Get the mutated attributes for a given instance.
     *
     * @static
     * @return array
     */
    public static function getMutatedAttributes(){}

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @static
     * @param	string	$key
     * @return mixed
     */
    public static function __get($key){}

    /**
     * Dynamically set attributes on the model.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @return void
     */
    public static function __set($key, $value){}

    /**
     * Determine if the given attribute exists.
     *
     * @static
     * @param	mixed	$offset
     * @return bool
     */
    public static function offsetExists($offset){}

    /**
     * Get the value for a given offset.
     *
     * @static
     * @param	mixed	$offset
     * @return mixed
     */
    public static function offsetGet($offset){}

    /**
     * Set the value for a given offset.
     *
     * @static
     * @param	mixed	$offset
     * @param	mixed	$value
     * @return void
     */
    public static function offsetSet($offset, $value){}

    /**
     * Unset the value for a given offset.
     *
     * @static
     * @param	mixed	$offset
     * @return void
     */
    public static function offsetUnset($offset){}

    /**
     * Determine if an attribute exists on the model.
     *
     * @static
     * @param	string	$key
     * @return void
     */
    public static function __isset($key){}

    /**
     * Unset an attribute on the model.
     *
     * @static
     * @param	string	$key
     * @return void
     */
    public static function __unset($key){}

    /**
     * Handle dynamic method calls into the method.
     *
     * @static
     * @param	string	$method
     * @param	array	$parameters
     * @return mixed
     */
    public static function __call($method, $parameters){}

    /**
     * Handle dynamic static method calls into the method.
     *
     * @static
     * @param	string	$method
     * @param	array	$parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters){}

    /**
     * Convert the model to its string representation.
     *
     * @static
     * @return string
     */
    public static function __toString(){}

}

class Event extends Illuminate\Events\Event{
    /**
     * Create a new event instance.
     *
     * @static
     * @param	mixed	$payload
     * @return void
     */
    public static function __construct($payload = array()){}

    /**
     * Stop the propagation of the event to other listeners.
     *
     * @static
     * @return void
     */
    public static function stop(){}

    /**
     * Determine if the event has been stopped from propagating.
     *
     * @static
     * @return bool
     */
    public static function isStopped(){}

    /**
     * Dynamically retrieve items from the payload.
     *
     * @static
     * @param	string	$key
     * @return mixed
     */
    public static function __get($key){}

    /**
     * Dynamically set items in the payload.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @return void
     */
    public static function __set($key, $value){}

    /**
     * Determine if payload item is set.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function __isset($key){}

    /**
     * Unset an item from the payload array.
     *
     * @static
     * @return void
     */
    public static function __unset($key){}

    /**
     * Returns whether further event listeners should be triggered.
     *
     * @static
     * @return Boolean Whether propagation was already stopped for this event.
     */
    public static function isPropagationStopped(){}

    /**
     * Stops the propagation of the event to further event listeners.
    If multiple event listeners are connected to the same event, no
    further event listener will be triggered once any trigger calls
    stopPropagation().
     *
     * @static
     * @return void
     */
    public static function stopPropagation(){}

    /**
     * Stores the EventDispatcher that dispatches this Event
     *
     * @static
     * @param	EventDispatcherInterface $dispatcher
     * @return void
     */
    public static function setDispatcher($dispatcher){}

    /**
     * Returns the EventDispatcher that dispatches this Event
     *
     * @static
     * @return EventDispatcherInterface
     */
    public static function getDispatcher(){}

    /**
     * Gets the event's name.
     *
     * @static
     * @return string
     */
    public static function getName(){}

    /**
     * Sets the event's name property.
     *
     * @static
     * @param	string $name The event name.
     * @return void
     */
    public static function setName($name){}

}

class File extends Illuminate\Filesystem\Filesystem{
    /**
     * Determine if a file exists.
     *
     * @static
     * @param	string	$path
     * @return bool
     */
    public static function exists($path){}

    /**
     * Get the contents of a file.
     *
     * @static
     * @param	string	$path
     * @return string
     */
    public static function get($path){}

    /**
     * Get the contents of a remote file.
     *
     * @static
     * @param	string	$path
     * @return string
     */
    public static function getRemote($path){}

    /**
     * Get the returned value of a file.
     *
     * @static
     * @param	string	$path
     * @return mixed
     */
    public static function getRequire($path){}

    /**
     * Require the given file once.
     *
     * @static
     * @param	string	$file
     * @return void
     */
    public static function requireOnce($file){}

    /**
     * Write the contents of a file.
     *
     * @static
     * @param	string	$path
     * @param	string	$contents
     * @return int
     */
    public static function put($path, $contents){}

    /**
     * Append to a file.
     *
     * @static
     * @param	string	$path
     * @param	string	$data
     * @return int
     */
    public static function append($path, $data){}

    /**
     * Delete the file at a given path.
     *
     * @static
     * @param	string	$path
     * @return bool
     */
    public static function delete($path){}

    /**
     * Move a file to a new location.
     *
     * @static
     * @param	string	$path
     * @param	string	$target
     * @return void
     */
    public static function move($path, $target){}

    /**
     * Copy a file to a new location.
     *
     * @static
     * @param	string	$path
     * @param	string	$target
     * @return void
     */
    public static function copy($path, $target){}

    /**
     * Extract the file extension from a file path.
     *
     * @static
     * @param	string	$path
     * @return string
     */
    public static function extension($path){}

    /**
     * Get the file type of a given file.
     *
     * @static
     * @param	string	$path
     * @return string
     */
    public static function type($path){}

    /**
     * Get the file size of a given file.
     *
     * @static
     * @param	string	$path
     * @return int
     */
    public static function size($path){}

    /**
     * Get the file's last modification time.
     *
     * @static
     * @param	string	$path
     * @return int
     */
    public static function lastModified($path){}

    /**
     * Determine if the given path is a directory.
     *
     * @static
     * @param	string	$directory
     * @return bool
     */
    public static function isDirectory($directory){}

    /**
     * Find path names matching a given pattern.
     *
     * @static
     * @param	string	$pattern
     * @param	int	$flags
     * @return array
     */
    public static function glob($pattern, $flags = '0'){}

    /**
     * Get an array of all files in a directory.
     *
     * @static
     * @param	string	$directory
     * @return array
     */
    public static function files($directory){}

    /**
     * Create a directory.
     *
     * @static
     * @param	string	$path
     * @param	int	$mode
     * @param	bool	$recursive
     * @return bool
     */
    public static function makeDirectory($path, $mode = '511', $recursive = false){}

    /**
     * Copy a directory from one location to another.
     *
     * @static
     * @param	string	$directory
     * @param	string	$destination
     * @param	int	$options
     * @return void
     */
    public static function copyDirectory($directory, $destination, $options = null){}

    /**
     * Recursively delete a directory.
    The directory itself may be optionally preserved.
     *
     * @static
     * @param	string	$directory
     * @param	bool	$preserve
     * @return void
     */
    public static function deleteDirectory($directory, $preserve = false){}

    /**
     * Empty the specified directory of all files and folders.
     *
     * @static
     * @param	string	$directory
     * @return void
     */
    public static function cleanDirectory($directory){}

}

class Form extends Illuminate\Support\Facades\Form{
    /**
     * Get the registered name of the component.
     *
     * @static
     * @return string
     */
    public static function getFacadeAccessor(){}

    /**
     * Hotswap the underlying instance behind the facade.
     *
     * @static
     * @param	mixed	$instance
     * @return void
     */
    public static function swap($instance){}

    /**
     * Initiate a mock expectation on the facade.
     *
     * @static
     * @param	dynamic
     * @return Mockery\Expectation
     */
    public static function shouldReceive(){}

    /**
     * Get the root object behind the facade.
     *
     * @static
     * @return mixed
     */
    public static function getFacadeRoot(){}

    /**
     * Resolve the facade root instance from the container.
     *
     * @static
     * @param	string	$name
     * @return mixed
     */
    public static function resolveFacadeInstance($name){}

    /**
     * Clear all of the resolved instances.
     *
     * @static
     * @return void
     */
    public static function clearResolvedInstances(){}

    /**
     * Get the application instance behind the facade.
     *
     * @static
     * @return Illuminate\Foundation\Application
     */
    public static function getFacadeApplication(){}

    /**
     * Set the application instance.
     *
     * @static
     * @param	Illuminate\Foundation\Application	$app
     * @return void
     */
    public static function setFacadeApplication($app){}

    /**
     * Handle dynamic, static calls to the object.
     *
     * @static
     * @param	string	$method
     * @param	array	$args
     * @return mixed
     */
    public static function __callStatic($method, $args){}

}

class Hash extends Illuminate\Hashing\BcryptHasher{
    /**
     * Hash the given value.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function make($value, $options = array()){}

    /**
     * Check the given plain value against a hash.
     *
     * @static
     * @param	string	$value
     * @param	string	$hashedValue
     * @param	array	$options
     * @return bool
     */
    public static function check($value, $hashedValue, $options = array()){}

}

class Html extends Illuminate\Html\HtmlBuilder{
    /**
     * Convert an HTML string to entities.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function entities($value){}

    /**
     * Convert entities to HTML characters.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function decode($value){}

    /**
     * Generate an ordered list of items.
     *
     * @static
     * @param	array	$items
     * @param	array	$attributes
     * @return string
     */
    public static function ol($list, $attributes = array()){}

    /**
     * Generate an un-ordered list of items.
     *
     * @static
     * @param	array	$items
     * @param	array	$attributes
     * @return string
     */
    public static function ul($list, $attributes = array()){}

    /**
     * Create a listing HTML element.
     *
     * @static
     * @param	string	$type
     * @param	array	$list
     * @param	array	$attributes
     * @return string
     */
    public static function listing($type, $list, $attributes){}

    /**
     * Create the HTML for a listing element.
     *
     * @static
     * @param	mixed	$key
     * @param	string	$type
     * @param	string	$value
     * @return string
     */
    public static function listingElement($key, $type, $value){}

    /**
     * Create the HTML for a nested listing attribute.
     *
     * @static
     * @param	mixed	$key
     * @param	string	$type
     * @param	string	$value
     * @return string
     */
    public static function nestedListing($key, $type, $value){}

    /**
     * Build an HTML attribute string from an array.
     *
     * @static
     * @param	array	$attributes
     * @return string
     */
    public static function attributes($attributes){}

    /**
     * Build a single attribute element.
     *
     * @static
     * @param	string	$key
     * @param	string	$value
     * @return string
     */
    public static function attributeElement($key, $value){}

}

class Input extends Illuminate\Http\Request{
    /**
     * Return the Request instance.
     *
     * @static
     * @return Illuminate\Http\Request
     */
    public static function instance(){}

    /**
     * Get the root URL for the application.
     *
     * @static
     * @return string
     */
    public static function root(){}

    /**
     * Get the URL (no query string) for the request.
     *
     * @static
     * @return string
     */
    public static function url(){}

    /**
     * Get the full URL for the request.
     *
     * @static
     * @return string
     */
    public static function fullUrl(){}

    /**
     * Get the current path info for the request.
     *
     * @static
     * @return string
     */
    public static function path(){}

    /**
     * Get a segment from the URI (1 based index).
     *
     * @static
     * @param	string	$index
     * @param	mixed	$default
     * @return string
     */
    public static function segment($index, $default = null){}

    /**
     * Get all of the segments for the request path.
     *
     * @static
     * @return array
     */
    public static function segments(){}

    /**
     * Determine if the current request URI matches a pattern.
     *
     * @static
     * @param	string	$pattern
     * @return bool
     */
    public static function is($pattern){}

    /**
     * Determine if the request is the result of an AJAX call.
     *
     * @static
     * @return bool
     */
    public static function ajax(){}

    /**
     * Determine if the request is over HTTPS.
     *
     * @static
     * @return bool
     */
    public static function secure(){}

    /**
     * Determine if the request contains a given input item.
     *
     * @static
     * @param	string|array	$key
     * @return bool
     */
    public static function has($key){}

    /**
     * Get all of the input and files for the request.
     *
     * @static
     * @return array
     */
    public static function all(){}

    /**
     * Retrieve an input item from the request.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return string
     */
    public static function input($key = null, $default = null){}

    /**
     * Get a subset of the items from the input data.
     *
     * @static
     * @param	array	$keys
     * @return array
     */
    public static function only($keys){}

    /**
     * Get all of the input except for a specified array of items.
     *
     * @static
     * @param	array	$keys
     * @return array
     */
    public static function except($keys){}

    /**
     * Retrieve a query string item from the request.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return string
     */
    public static function query($key = null, $default = null){}

    /**
     * Retrieve a cookie from the request.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return string
     */
    public static function cookie($key = null, $default = null){}

    /**
     * Retrieve a file from the request.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public static function file($key = null, $default = null){}

    /**
     * Determine if the uploaded data contains a file.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function hasFile($key){}

    /**
     * Retrieve a header from the request.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return string
     */
    public static function header($key = null, $default = null){}

    /**
     * Retrieve a server variable from the request.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return string
     */
    public static function server($key = null, $default = null){}

    /**
     * Retrieve an old input item.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return string
     */
    public static function old($key = null, $default = null){}

    /**
     * Flash the input for the current request to the session.
     *
     * @static
     * @param	string $filter
     * @param	array	$keys
     * @return void
     */
    public static function flash($filter = null, $keys = array()){}

    /**
     * Flash only some of the input to the session.
     *
     * @static
     * @param	dynamic	string
     * @return void
     */
    public static function flashOnly($keys){}

    /**
     * Flash only some of the input to the session.
     *
     * @static
     * @param	dynamic	string
     * @return void
     */
    public static function flashExcept($keys){}

    /**
     * Flush all of the old input from the session.
     *
     * @static
     * @return void
     */
    public static function flush(){}

    /**
     * Retrieve a parameter item from a given source.
     *
     * @static
     * @param	string	$source
     * @param	string	$key
     * @param	mixed	$default
     * @return string
     */
    public static function retrieveItem($source, $key, $default){}

    /**
     * Merge new input into the current request's input array.
     *
     * @static
     * @param	array	$input
     * @return void
     */
    public static function merge($input){}

    /**
     * Replace the input for the current request.
     *
     * @static
     * @param	array	$input
     * @return void
     */
    public static function replace($input){}

    /**
     * Get the JSON payload for the request.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return mixed
     */
    public static function json($key = null, $default = null){}

    /**
     * Get the input source for the request.
     *
     * @static
     * @return Symfony\Component\HttpFoundation\ParameterBag
     */
    public static function getInputSource(){}

    /**
     * Get the Illuminate session store implementation.
     *
     * @static
     * @return Illuminate\Session\Store
     */
    public static function getSessionStore(){}

    /**
     * Set the Illuminate session store implementation.
     *
     * @static
     * @param	Illuminate\Session\Store	$session
     * @return void
     */
    public static function setSessionStore($session){}

    /**
     * Determine if the session store has been set.
     *
     * @static
     * @return bool
     */
    public static function hasSessionStore(){}

    /**
     * Constructor.
     *
     * @static
     * @param	array	$query	The GET parameters
     * @param	array	$request	The POST parameters
     * @param	array	$attributes The request attributes (parameters parsed from the PATH_INFO, ...)
     * @param	array	$cookies	The COOKIE parameters
     * @param	array	$files	The FILES parameters
     * @param	array	$server	The SERVER parameters
     * @param	string $content	The raw body data
     * @return void
     */
    public static function __construct($query = array(), $request = array(), $attributes = array(), $cookies = array(), $files = array(), $server = array(), $content = null){}

    /**
     * Sets the parameters for this request.
    This method also re-initializes all properties.
     *
     * @static
     * @param	array	$query	The GET parameters
     * @param	array	$request	The POST parameters
     * @param	array	$attributes The request attributes (parameters parsed from the PATH_INFO, ...)
     * @param	array	$cookies	The COOKIE parameters
     * @param	array	$files	The FILES parameters
     * @param	array	$server	The SERVER parameters
     * @param	string $content	The raw body data
     * @return void
     */
    public static function initialize($query = array(), $request = array(), $attributes = array(), $cookies = array(), $files = array(), $server = array(), $content = null){}

    /**
     * Creates a new request with values from PHP's super globals.
     *
     * @static
     * @return Request A new request
     */
    public static function createFromGlobals(){}

    /**
     * Creates a Request based on a given URI and configuration.
    The information contained in the URI always take precedence
    over the other information (server and parameters).
     *
     * @static
     * @param	string $uri	The URI
     * @param	string $method	The HTTP method
     * @param	array	$parameters The query (GET) or request (POST) parameters
     * @param	array	$cookies	The request cookies ($_COOKIE)
     * @param	array	$files	The request files ($_FILES)
     * @param	array	$server	The server parameters ($_SERVER)
     * @param	string $content	The raw body data
     * @return Request A Request instance
     */
    public static function create($uri, $method = 'GET', $parameters = array(), $cookies = array(), $files = array(), $server = array(), $content = null){}

    /**
     * Clones a request and overrides some of its parameters.
     *
     * @static
     * @param	array $query	The GET parameters
     * @param	array $request	The POST parameters
     * @param	array $attributes The request attributes (parameters parsed from the PATH_INFO, ...)
     * @param	array $cookies	The COOKIE parameters
     * @param	array $files	The FILES parameters
     * @param	array $server	The SERVER parameters
     * @return Request The duplicated request
     */
    public static function duplicate($query = null, $request = null, $attributes = null, $cookies = null, $files = null, $server = null){}

    /**
     * Clones the current request.
    Note that the session is not cloned as duplicated requests
    are most of the time sub-requests of the main one.
     *
     * @static
     * @return void
     */
    public static function __clone(){}

    /**
     * Returns the request as a string.
     *
     * @static
     * @return string The request
     */
    public static function __toString(){}

    /**
     * Overrides the PHP global variables according to this request instance.
    It overrides $_GET, $_POST, $_REQUEST, $_SERVER, $_COOKIE.
    $_FILES is never override, see rfc1867
     *
     * @static
     * @return void
     */
    public static function overrideGlobals(){}

    /**
     * Trusts $_SERVER entries coming from proxies.
     *
     * @static
     * @return void
     */
    public static function trustProxyData(){}

    /**
     * Sets a list of trusted proxies.
    You should only list the reverse proxies that you manage directly.
     *
     * @static
     * @param	array $proxies A list of trusted proxies
     * @return void
     */
    public static function setTrustedProxies($proxies){}

    /**
     * Gets the list of trusted proxies.
     *
     * @static
     * @return array An array of trusted proxies.
     */
    public static function getTrustedProxies(){}

    /**
     * Sets the name for trusted headers.
    The following header keys are supported:
     * Request::HEADER_CLIENT_IP:    defaults to X-Forwarded-For   (see getClientIp())
     * Request::HEADER_CLIENT_HOST:  defaults to X-Forwarded-Host  (see getClientHost())
     * Request::HEADER_CLIENT_PORT:  defaults to X-Forwarded-Port  (see getClientPort())
     * Request::HEADER_CLIENT_PROTO: defaults to X-Forwarded-Proto (see getScheme() and isSecure())
    Setting an empty value allows to disable the trusted header for the given key.
     *
     * @static
     * @param	string $key	The header key
     * @param	string $value The header name
     * @return void
     */
    public static function setTrustedHeaderName($key, $value){}

    /**
     * Returns true if $_SERVER entries coming from proxies are trusted,
    false otherwise.
     *
     * @static
     * @return boolean
     */
    public static function isProxyTrusted(){}

    /**
     * Normalizes a query string.
    It builds a normalized query string, where keys/value pairs are alphabetized,
    have consistent escaping and unneeded delimiters are removed.
     *
     * @static
     * @param	string $qs Query string
     * @return string A normalized query string for the Request
     */
    public static function normalizeQueryString($qs){}

    /**
     * Enables support for the _method request parameter to determine the intended HTTP method.
    Be warned that enabling this feature might lead to CSRF issues in your code.
    Check that you are using CSRF tokens when required.
    The HTTP method can only be overridden when the real HTTP method is POST.
     *
     * @static
     * @return void
     */
    public static function enableHttpMethodParameterOverride(){}

    /**
     * Checks whether support for the _method request parameter is enabled.
     *
     * @static
     * @return Boolean True when the _method request parameter is enabled, false otherwise
     */
    public static function getHttpMethodParameterOverride(){}

    /**
     * Gets a "parameter" value.
    This method is mainly useful for libraries that want to provide some flexibility.
    Order of precedence: GET, PATH, POST
    Avoid using this method in controllers:
     * slow
     * prefer to get from a "named" source
    It is better to explicitly get request parameters from the appropriate
    public property instead (query, attributes, request).
     *
     * @static
     * @param	string	$key	the key
     * @param	mixed	$default the default value
     * @param	Boolean $deep	is parameter deep in multidimensional array
     * @return mixed
     */
    public static function get($key, $default = null, $deep = false){}

    /**
     * Gets the Session.
     *
     * @static
     * @return SessionInterface|null The session
     */
    public static function getSession(){}

    /**
     * Whether the request contains a Session which was started in one of the
    previous requests.
     *
     * @static
     * @return Boolean
     */
    public static function hasPreviousSession(){}

    /**
     * Whether the request contains a Session object.
    This method does not give any information about the state of the session object,
    like whether the session is started or not. It is just a way to check if this Request
    is associated with a Session instance.
     *
     * @static
     * @return Boolean true when the Request contains a Session object, false otherwise
     */
    public static function hasSession(){}

    /**
     * Sets the Session.
     *
     * @static
     * @param	SessionInterface $session The Session
     * @return void
     */
    public static function setSession($session){}

    /**
     * Returns the client IP address.
    This method can read the client IP address from the "X-Forwarded-For" header
    when trusted proxies were set via "setTrustedProxies()". The "X-Forwarded-For"
    header value is a comma+space separated list of IP addresses, the left-most
    being the original client, and each successive proxy that passed the request
    adding the IP address where it received the request from.
    If your reverse proxy uses a different header name than "X-Forwarded-For",
    ("Client-Ip" for instance), configure it via "setTrustedHeaderName()" with
    the "client-ip" key.
     *
     * @static
     * @return string The client IP address
     */
    public static function getClientIp(){}

    /**
     * Returns current script name.
     *
     * @static
     * @return string
     */
    public static function getScriptName(){}

    /**
     * Returns the path being requested relative to the executed script.
    The path info always starts with a /.
    Suppose this request is instantiated from /mysite on localhost:
     * http://localhost/mysite              returns an empty string
     * http://localhost/mysite/about        returns '/about'
     * http://localhost/mysite/enco%20ded   returns '/enco%20ded'
     * http://localhost/mysite/about?var=1  returns '/about'
     *
     * @static
     * @return string The raw path (i.e. not urldecoded)
     */
    public static function getPathInfo(){}

    /**
     * Returns the root path from which this request is executed.
    Suppose that an index.php file instantiates this request object:
     * http://localhost/index.php         returns an empty string
     * http://localhost/index.php/page    returns an empty string
     * http://localhost/web/index.php     returns '/web'
     * http://localhost/we%20b/index.php  returns '/we%20b'
     *
     * @static
     * @return string The raw path (i.e. not urldecoded)
     */
    public static function getBasePath(){}

    /**
     * Returns the root url from which this request is executed.
    The base URL never ends with a /.
    This is similar to getBasePath(), except that it also includes the
    script filename (e.g. index.php) if one exists.
     *
     * @static
     * @return string The raw url (i.e. not urldecoded)
     */
    public static function getBaseUrl(){}

    /**
     * Gets the request's scheme.
     *
     * @static
     * @return string
     */
    public static function getScheme(){}

    /**
     * Returns the port on which the request is made.
    This method can read the client port from the "X-Forwarded-Port" header
    when trusted proxies were set via "setTrustedProxies()".
    The "X-Forwarded-Port" header must contain the client port.
    If your reverse proxy uses a different header name than "X-Forwarded-Port",
    configure it via "setTrustedHeaderName()" with the "client-port" key.
     *
     * @static
     * @return string
     */
    public static function getPort(){}

    /**
     * Returns the user.
     *
     * @static
     * @return string|null
     */
    public static function getUser(){}

    /**
     * Returns the password.
     *
     * @static
     * @return string|null
     */
    public static function getPassword(){}

    /**
     * Gets the user info.
     *
     * @static
     * @return string A user name and, optionally, scheme-specific information about how to gain authorization to access the server
     */
    public static function getUserInfo(){}

    /**
     * Returns the HTTP host being requested.
    The port name will be appended to the host if it's non-standard.
     *
     * @static
     * @return string
     */
    public static function getHttpHost(){}

    /**
     * Returns the requested URI.
     *
     * @static
     * @return string The raw URI (i.e. not urldecoded)
     */
    public static function getRequestUri(){}

    /**
     * Gets the scheme and HTTP host.
    If the URL was called with basic authentication, the user
    and the password are not added to the generated string.
     *
     * @static
     * @return string The scheme and HTTP host
     */
    public static function getSchemeAndHttpHost(){}

    /**
     * Generates a normalized URI for the Request.
     *
     * @static
     * @return string A normalized URI for the Request
     */
    public static function getUri(){}

    /**
     * Generates a normalized URI for the given path.
     *
     * @static
     * @param	string $path A path to use instead of the current one
     * @return string The normalized URI for the path
     */
    public static function getUriForPath($path){}

    /**
     * Generates the normalized query string for the Request.
    It builds a normalized query string, where keys/value pairs are alphabetized
    and have consistent escaping.
     *
     * @static
     * @return string|null A normalized query string for the Request
     */
    public static function getQueryString(){}

    /**
     * Checks whether the request is secure or not.
    This method can read the client port from the "X-Forwarded-Proto" header
    when trusted proxies were set via "setTrustedProxies()".
    The "X-Forwarded-Proto" header must contain the protocol: "https" or "http".
    If your reverse proxy uses a different header name than "X-Forwarded-Proto"
    ("SSL_HTTPS" for instance), configure it via "setTrustedHeaderName()" with
    the "client-proto" key.
     *
     * @static
     * @return Boolean
     */
    public static function isSecure(){}

    /**
     * Returns the host name.
    This method can read the client port from the "X-Forwarded-Host" header
    when trusted proxies were set via "setTrustedProxies()".
    The "X-Forwarded-Host" header must contain the client host name.
    If your reverse proxy uses a different header name than "X-Forwarded-Host",
    configure it via "setTrustedHeaderName()" with the "client-host" key.
     *
     * @static
     * @return string
     */
    public static function getHost(){}

    /**
     * Sets the request method.
     *
     * @static
     * @param	string $method
     * @return void
     */
    public static function setMethod($method){}

    /**
     * Gets the request "intended" method.
    If the X-HTTP-Method-Override header is set, and if the method is a POST,
    then it is used to determine the "real" intended HTTP method.
    The _method request parameter can also be used to determine the HTTP method,
    but only if enableHttpMethodParameterOverride() has been called.
    The method is always an uppercased string.
     *
     * @static
     * @return string The request method
     */
    public static function getMethod(){}

    /**
     * Gets the "real" request method.
     *
     * @static
     * @return string The request method
     */
    public static function getRealMethod(){}

    /**
     * Gets the mime type associated with the format.
     *
     * @static
     * @param	string $format The format
     * @return string The associated mime type (null if not found)
     */
    public static function getMimeType($format){}

    /**
     * Gets the format associated with the mime type.
     *
     * @static
     * @param	string $mimeType The associated mime type
     * @return string|null The format (null if not found)
     */
    public static function getFormat($mimeType){}

    /**
     * Associates a format with mime types.
     *
     * @static
     * @param	string	$format	The format
     * @param	string|array $mimeTypes The associated mime types (the preferred one must be the first as it will be used as the content type)
     * @return void
     */
    public static function setFormat($format, $mimeTypes){}

    /**
     * Gets the request format.
    Here is the process to determine the format:
     * format defined by the user (with setRequestFormat())
     * _format request parameter
     * $default
     *
     * @static
     * @param	string $default The default format
     * @return string The request format
     */
    public static function getRequestFormat($default = 'html'){}

    /**
     * Sets the request format.
     *
     * @static
     * @param	string $format The request format.
     * @return void
     */
    public static function setRequestFormat($format){}

    /**
     * Gets the format associated with the request.
     *
     * @static
     * @return string|null The format (null if no content type is present)
     */
    public static function getContentType(){}

    /**
     * Sets the default locale.
     *
     * @static
     * @param	string $locale
     * @return void
     */
    public static function setDefaultLocale($locale){}

    /**
     * Sets the locale.
     *
     * @static
     * @param	string $locale
     * @return void
     */
    public static function setLocale($locale){}

    /**
     * Get the locale.
     *
     * @static
     * @return string
     */
    public static function getLocale(){}

    /**
     * Checks if the request method is of specified type.
     *
     * @static
     * @param	string $method Uppercase request method (GET, POST etc).
     * @return Boolean
     */
    public static function isMethod($method){}

    /**
     * Checks whether the method is safe or not.
     *
     * @static
     * @return Boolean
     */
    public static function isMethodSafe(){}

    /**
     * Returns the request body content.
     *
     * @static
     * @param	Boolean $asResource If true, a resource will be returned
     * @return string|resource The request body content or a resource to read the body stream.
     */
    public static function getContent($asResource = false){}

    /**
     * Gets the Etags.
     *
     * @static
     * @return array The entity tags
     */
    public static function getETags(){}

    /**
     *
     *
     * @static
     * @return Boolean
     */
    public static function isNoCache(){}

    /**
     * Returns the preferred language.
     *
     * @static
     * @param	array $locales An array of ordered available locales
     * @return string|null The preferred locale
     */
    public static function getPreferredLanguage($locales = null){}

    /**
     * Gets a list of languages acceptable by the client browser.
     *
     * @static
     * @return array Languages ordered in the user browser preferences
     */
    public static function getLanguages(){}

    /**
     * Gets a list of charsets acceptable by the client browser.
     *
     * @static
     * @return array List of charsets in preferable order
     */
    public static function getCharsets(){}

    /**
     * Gets a list of content types acceptable by the client browser
     *
     * @static
     * @return array List of content types in preferable order
     */
    public static function getAcceptableContentTypes(){}

    /**
     * Returns true if the request is a XMLHttpRequest.
    It works if your JavaScript library set an X-Requested-With HTTP header.
    It is known to work with common JavaScript frameworks:
     *
     * @static
     * @return Boolean true if the request is an XMLHttpRequest, false otherwise
     */
    public static function isXmlHttpRequest(){}

    /**
     * Splits an Accept-* HTTP header.
     *
     * @static
     * @param	string $header Header to split
     * @return array Array indexed by the values of the Accept-* header in preferred order
     */
    public static function splitHttpAcceptHeader($header){}

    /**
     *
     *
     * @static
     * @return void
     */
    public static function prepareRequestUri(){}

    /**
     * Prepares the base URL.
     *
     * @static
     * @return string
     */
    public static function prepareBaseUrl(){}

    /**
     * Prepares the base path.
     *
     * @static
     * @return string base path
     */
    public static function prepareBasePath(){}

    /**
     * Prepares the path info.
     *
     * @static
     * @return string path info
     */
    public static function preparePathInfo(){}

    /**
     * Initializes HTTP request formats.
     *
     * @static
     * @return void
     */
    public static function initializeFormats(){}

    /**
     * Sets the default PHP locale.
     *
     * @static
     * @param	string $locale
     * @return void
     */
    public static function setPhpDefaultLocale($locale){}

    /**
     *
     *
     * @static
     * @return void
     */
    public static function getUrlencodedPrefix($string, $prefix){}

}

class Lang extends Illuminate\Translation\Translator{
    /**
     * Create a new translator instance.
     *
     * @static
     * @param	Illuminate\Translation\LoaderInterface
     * @param	array	$locales
     * @param	string	$default
     * @param	string	$fallback
     * @return void
     */
    public static function __construct($loader, $default, $fallback){}

    /**
     * Create a new Symfony translator instance.
     *
     * @static
     * @param	string	$default
     * @param	string	$fallback
     * @return Symfony\Component\Translation\Translator
     */
    public static function createSymfonyTranslator($default, $fallback){}

    /**
     * Determine if a translation exists.
     *
     * @static
     * @param	string	$key
     * @param	string	$locale
     * @return bool
     */
    public static function has($key, $locale = null){}

    /**
     * Get the translation for a given key.
     *
     * @static
     * @param	string	$id
     * @param	array	$parameters
     * @param	string	$locale
     * @return string
     */
    public static function get($key, $parameters = array(), $locale = null){}

    /**
     * Get a translation according to an integer value.
     *
     * @static
     * @param	string	$id
     * @param	int	$number
     * @param	array	$parameters
     * @param	string	$locale
     * @return string
     */
    public static function choice($key, $number, $parameters = array(), $locale = null){}

    /**
     * Get the translation for a given key.
     *
     * @static
     * @param	string	$id
     * @param	array	$parameters
     * @param	string	$domain
     * @param	string	$locale
     * @return string
     */
    public static function trans($id, $parameters = array(), $domain = 'messages', $locale = null){}

    /**
     * Get a translation according to an integer value.
     *
     * @static
     * @param	string	$id
     * @param	int	$number
     * @param	array	$parameters
     * @param	string	$domain
     * @param	string	$locale
     * @return string
     */
    public static function transChoice($id, $number, $parameters = array(), $domain = 'messages', $locale = null){}

    /**
     * Load the specified language group.
     *
     * @static
     * @param	string	$group
     * @param	string	$namespace
     * @param	string	$locale
     * @return string
     */
    public static function load($group, $namespace, $locale){}

    /**
     * Get the locales to be loaded.
     *
     * @static
     * @param	string	$locale
     * @return array
     */
    public static function getLocales($locale){}

    /**
     * Add an array resource to the Symfony translator.
     *
     * @static
     * @param	array	$lines
     * @param	string	$locale
     * @param	string	$domain
     * @return void
     */
    public static function addResource($lines, $locale, $domain){}

    /**
     * Format the parameter array.
     *
     * @static
     * @param	array	$parameters
     * @return array
     */
    public static function formatParameters($parameters){}

    /**
     * Determine if the given group has been loaded.
     *
     * @static
     * @param	string	$group
     * @param	string	$namespace
     * @param	string	$locale
     * @return bool
     */
    public static function loaded($group, $namespace, $locale){}

    /**
     * Set the given translation group as being loaded.
     *
     * @static
     * @param	string	$group
     * @param	string	$namespace
     * @param	string	$locale
     * @return void
     */
    public static function setLoaded($group, $namespace, $locale){}

    /**
     * Add a new namespace to the loader.
     *
     * @static
     * @param	string	$namespace
     * @param	string	$hint
     * @return void
     */
    public static function addNamespace($namespace, $hint){}

    /**
     * Get the default locale being used.
     *
     * @static
     * @return string
     */
    public static function getLocale(){}

    /**
     * Set the default locale.
     *
     * @static
     * @param	string	$locale
     * @return void
     */
    public static function setLocale($locale){}

    /**
     * Get the base Symfony translator instance.
     *
     * @static
     * @return Symfony\Translation\Translator
     */
    public static function getSymfonyTranslator(){}

    /**
     * Get the base Symfony translator instance.
     *
     * @static
     * @param	Symfony\Translation\Translator	$trans
     * @return void
     */
    public static function setSymfonyTranslator($trans){}

    /**
     * Parse a key into namespace, group, and item.
     *
     * @static
     * @param	string	$key
     * @return array
     */
    public static function parseKey($key){}

    /**
     * Parse an array of basic segments.
     *
     * @static
     * @param	array	$segments
     * @return array
     */
    public static function parseBasicSegments($segments){}

    /**
     * Parse an array of namespaced segments.
     *
     * @static
     * @param	string	$key
     * @return array
     */
    public static function parseNamespacedSegments($key){}

    /**
     * Set the parsed value of a key.
     *
     * @static
     * @param	string	$key
     * @param	array	$parsed
     * @return void
     */
    public static function setParsedKey($key, $parsed){}

}

class Log extends Illuminate\Log\Writer{
    /**
     * Create a new log writer instance.
     *
     * @static
     * @param	Monolog\Logger	$monolog
     * @param	Illuminate\Events\Dispatcher	$dispatcher
     * @return void
     */
    public static function __construct($monolog, $dispatcher = null){}

    /**
     * Register a file log handler.
     *
     * @static
     * @param	string	$path
     * @param	string	$level
     * @return void
     */
    public static function useFiles($path, $level = 'debug'){}

    /**
     * Register a daily file log handler.
     *
     * @static
     * @param	string	$path
     * @param	int	$days
     * @param	string	$level
     * @return void
     */
    public static function useDailyFiles($path, $days = '0', $level = 'debug'){}

    /**
     * Parse the string level into a Monolog constant.
     *
     * @static
     * @param	string	$level
     * @return int
     */
    public static function parseLevel($level){}

    /**
     * Get the underlying Monolog instance.
     *
     * @static
     * @return Monolog\Logger
     */
    public static function getMonolog(){}

    /**
     * Register a new callback handler for when
    a log event is triggered.
     *
     * @static
     * @param	Closure	$callback
     * @return void
     */
    public static function listen($callback){}

    /**
     * Get the event dispatcher instance.
     *
     * @static
     * @return Illuminate\Events\Dispatcher
     */
    public static function getEventDispatcher(){}

    /**
     * Set the event dispatcher instance.
     *
     * @static
     * @param	Illuminate\Events\Dispatcher
     * @return void
     */
    public static function setEventDispatcher($dispatcher){}

    /**
     * Fires a log event.
     *
     * @static
     * @param	string	$level
     * @param	array	$parameters
     * @return void
     */
    public static function fireLogEvent($level, $message, $context = array()){}

    /**
     * Dynamically handle error additions.
     *
     * @static
     * @param	string	$method
     * @param	array	$parameters
     * @return mixed
     */
    public static function __call($method, $parameters){}

}

class Mail extends Illuminate\Mail\Mailer{
    /**
     * Create a new Mailer instance.
     *
     * @static
     * @param	Illuminate\View\Environment	$views
     * @param	Swift_Mailer	$swift
     * @return void
     */
    public static function __construct($views, $swift){}

    /**
     * Set the global from address and name.
     *
     * @static
     * @param	string	$address
     * @param	string	$name
     * @return void
     */
    public static function alwaysFrom($address, $name = null){}

    /**
     * Send a new message when only a plain part.
     *
     * @static
     * @param	string	$view
     * @param	array	$data
     * @param	mixed	$callback
     * @return void
     */
    public static function plain($view, $data, $callback){}

    /**
     * Send a new message using a view.
     *
     * @static
     * @param	string|array	$view
     * @param	array	$data
     * @param	Closure|string	$callback
     * @return void
     */
    public static function send($view, $data, $callback){}

    /**
     * Add the content to a given message.
     *
     * @static
     * @param	Illuminate\Mail\Message	$message
     * @param	string	$view
     * @param	string	$plain
     * @param	array	$data
     * @return void
     */
    public static function addContent($message, $view, $plain, $data){}

    /**
     * Parse the given view name or array.
     *
     * @static
     * @param	string|array	$view
     * @return array
     */
    public static function parseView($view){}

    /**
     * Send a Swift Message instance.
     *
     * @static
     * @param	Swift_Message	$message
     * @return void
     */
    public static function sendSwiftMessage($message){}

    /**
     * Log that a message was sent.
     *
     * @static
     * @param	Swift_Message	$message
     * @return void
     */
    public static function logMessage($message){}

    /**
     * Call the provided message builder.
     *
     * @static
     * @param	Closure|string	$callback
     * @param	Illuminate\Mail\Message	$message
     * @return void
     */
    public static function callMessageBuilder($callback, $message){}

    /**
     * Create a new message instance.
     *
     * @static
     * @return Illuminate\Mail\Message
     */
    public static function createMessage(){}

    /**
     * Render the given view.
     *
     * @static
     * @param	string	$view
     * @param	array	$data
     * @return Illuminate\View\View
     */
    public static function getView($view, $data){}

    /**
     * Tell the mailer to not really send messages.
     *
     * @static
     * @param	bool	$value
     * @return void
     */
    public static function pretend($value = true){}

    /**
     * Get the view environment instance.
     *
     * @static
     * @return Illuminate\View\Environment
     */
    public static function getViewEnvironment(){}

    /**
     * Get the Swift Mailer instance.
     *
     * @static
     * @return Swift_Mailer
     */
    public static function getSwiftMailer(){}

    /**
     * Set the Swift Mailer instance.
     *
     * @static
     * @param	Swift_Mailer	$swift
     * @return void
     */
    public static function setSwiftMailer($swift){}

    /**
     * Set the log writer instance.
     *
     * @static
     * @param	Illuminate\Log\Writer	$logger
     * @return void
     */
    public static function setLogger($logger){}

    /**
     * Set the IoC container instance.
     *
     * @static
     * @param	Illuminate\Container	$container
     * @return void
     */
    public static function setContainer($container){}

}

class Paginator extends Illuminate\Pagination\Paginator{
    /**
     * Create a new Paginator instance.
     *
     * @static
     * @param	Illuminate\Pagination\Environment	$env
     * @param	array	$items
     * @param	int	$total
     * @param	int	$perPage
     * @return void
     */
    public static function __construct($env, $items, $total, $perPage){}

    /**
     * Setup the pagination context (current and last page).
     *
     * @static
     * @return Illuminate\Pagination\Paginator
     */
    public static function setupPaginationContext(){}

    /**
     * Get the current page for the request.
     *
     * @static
     * @param	int	$lastPage
     * @return int
     */
    public static function calculateCurrentPage($lastPage){}

    /**
     * Determine if the given value is a valid page number.
     *
     * @static
     * @param	int	$page
     * @return bool
     */
    public static function isValidPageNumber($page){}

    /**
     * Get the pagination links view.
     *
     * @static
     * @return Illuminate\View\View
     */
    public static function links(){}

    /**
     * Get a URL for a given page number.
     *
     * @static
     * @param	int	$page
     * @return string
     */
    public static function getUrl($page){}

    /**
     * Add a query string value to the paginator.
     *
     * @static
     * @param	string	$key
     * @param	string	$value
     * @return Illuminate\Pagination\Paginator
     */
    public static function appends($key, $value){}

    /**
     * Add a query string value to the paginator.
     *
     * @static
     * @param	string	$key
     * @param	string	$value
     * @return Illuminate\Pagination\Paginator
     */
    public static function addQuery($key, $value){}

    /**
     * Get the current page for the request.
     *
     * @static
     * @return int
     */
    public static function getCurrentPage(){}

    /**
     * Get the last page that should be available.
     *
     * @static
     * @return int
     */
    public static function getLastPage(){}

    /**
     * Get the items being paginated.
     *
     * @static
     * @return array
     */
    public static function getItems(){}

    /**
     * Get the total number of items in the collection.
     *
     * @static
     * @return int
     */
    public static function getTotal(){}

    /**
     * Get an iterator for the items.
     *
     * @static
     * @return ArrayIterator
     */
    public static function getIterator(){}

    /**
     * Determine if the list of items is empty or not.
     *
     * @static
     * @return bool
     */
    public static function isEmpty(){}

    /**
     * Get the number of items for the current page.
     *
     * @static
     * @return int
     */
    public static function count(){}

    /**
     * Determine if the given item exists.
     *
     * @static
     * @param	mixed	$key
     * @return bool
     */
    public static function offsetExists($key){}

    /**
     * Get the item at the given offset.
     *
     * @static
     * @param	mixed	$key
     * @return mixed
     */
    public static function offsetGet($key){}

    /**
     * Set the item at the given offset.
     *
     * @static
     * @param	mixed	$key
     * @param	mixed	$value
     * @return void
     */
    public static function offsetSet($key, $value){}

    /**
     * Unset the item at the given key.
     *
     * @static
     * @param	mixed	$key
     * @return void
     */
    public static function offsetUnset($key){}

}

class Password extends Illuminate\Auth\Reminders\PasswordBroker{
    /**
     * Create a new password broker instance.
     *
     * @static
     * @param	Illuminate\Auth\ReminderRepositoryInterface	$reminders
     * @param	Illuminate\Auth\UserProviderInterface	$users
     * @param	Illuminate\Routing\Redirector	$redirector
     * @param	Illuminate\Mail\Mailer	$mailer
     * @param	string	$reminderView
     * @return void
     */
    public static function __construct($reminders, $users, $redirect, $mailer, $reminderView){}

    /**
     * Send a password reminder to a user.
     *
     * @static
     * @param	array	$credentials
     * @param	Closure	$callback
     * @return Illuminate\Http\RedirectResponse
     */
    public static function remind($credentials, $callback = null){}

    /**
     * Send the password reminder e-mail.
     *
     * @static
     * @param	Illuminate\Auth\RemindableInterface	$user
     * @param	string	$token
     * @param	Closure	$callback
     * @return void
     */
    public static function sendReminder($user, $token, $callback = null){}

    /**
     * Reset the password for the given token.
     *
     * @static
     * @param	string	$token
     * @param	string	$newPassword
     * @param	Closure	$callback
     * @return mixed
     */
    public static function reset($credentials, $callback){}

    /**
     * Validate a password reset for the given credentials.
     *
     * @static
     * @param	array	$credenitals
     * @return Illuminate\Auth\RemindableInterface
     */
    public static function validateReset($credentials){}

    /**
     * Determine if the passwords match for the request.
     *
     * @static
     * @return bool
     */
    public static function validNewPasswords(){}

    /**
     * Make an error redirect response.
     *
     * @static
     * @param	string	$reason
     * @return Illuminate\Http\RedirectResponse
     */
    public static function makeErrorRedirect($reason = ''){}

    /**
     * Get the user for the given credentials.
     *
     * @static
     * @param	array	$credentials
     * @return Illuminate\Auth\RemindableInterface
     */
    public static function getUser($credentials){}

    /**
     * Get the current request object.
     *
     * @static
     * @return Illuminate\Http\Request
     */
    public static function getRequest(){}

    /**
     * Get the reset token for the current request.
     *
     * @static
     * @return string
     */
    public static function getToken(){}

    /**
     * Get the password for the current request.
     *
     * @static
     * @return string
     */
    public static function getPassword(){}

    /**
     * Get the confirmed password.
     *
     * @static
     * @return string
     */
    public static function getConfirmedPassword(){}

}

class Queue extends Illuminate\Queue\QueueManager{
    /**
     * Create a new queue manager instance.
     *
     * @static
     * @param	Illuminate\Foundation\Application	$app
     * @return void
     */
    public static function __construct($app){}

    /**
     * Resolve a queue connection instance.
     *
     * @static
     * @param	string	$name
     * @return Illuminate\Queue\QueueInterface
     */
    public static function connection($name = null){}

    /**
     * Resolve a queue connection.
     *
     * @static
     * @param	string	$name
     * @return Illuminate\Queue\QueueInterface
     */
    public static function resolve($name){}

    /**
     * Get the connector for a given driver.
     *
     * @static
     * @param	string	$driver
     * @return Illuminate\Queue\Connectors\ConnectorInterface
     */
    public static function getConnector($driver){}

    /**
     * Add a queue connection resolver.
     *
     * @static
     * @param	string	$driver
     * @param	Closure	$resolver
     * @return void
     */
    public static function addConnector($driver, $resolver){}

    /**
     * Get the queue connection configuration.
     *
     * @static
     * @param	string	$name
     * @return array
     */
    public static function getConfig($name){}

    /**
     * Get the name of the default queue connection.
     *
     * @static
     * @return string
     */
    public static function getDefault(){}

    /**
     * Dynamically pass calls to the default connection.
     *
     * @static
     * @param	string	$method
     * @param	array	$parameters
     * @return mixed
     */
    public static function __call($method, $parameters){}

}

class Redirect extends Illuminate\Routing\Redirector{
    /**
     * Create a new Redirector instance.
     *
     * @static
     * @param	Illuminate\Routing\UrlGenerator	$generator
     * @return void
     */
    public static function __construct($generator){}

    /**
     * Create a new redirect response to the previous location.
     *
     * @static
     * @param	int	$status
     * @param	array	$headers
     * @return Illuminate\Http\RedirectResponse
     */
    public static function back($status = '302', $headers = array()){}

    /**
     * Create a new redirect response to the current URI.
     *
     * @static
     * @param	int	$status
     * @param	array	$headers
     * @return Illuminate\Http\RedirectResponse
     */
    public static function refresh($status = '302', $headers = array()){}

    /**
     * Create a new redirect response to the given path.
     *
     * @static
     * @param	string	$path
     * @param	int	$status
     * @param	array	$headers
     * @param	bool	$secure
     * @return Illuminate\Http\RedirectResponse
     */
    public static function to($path, $status = '302', $headers = array(), $secure = null){}

    /**
     * Create a new redirect response to the given HTTPS path.
     *
     * @static
     * @param	string	$path
     * @param	int	$status
     * @param	array	$headers
     * @return Illuminate\Http\RedirectResponse
     */
    public static function secure($path, $status = '302', $headers = array()){}

    /**
     * Create a new redirect response to a named route.
     *
     * @static
     * @param	string	$route
     * @param	array	$parameters
     * @param	int	$status
     * @param	array	$headers
     * @return Illuminate\Http\RedirectResponse
     */
    public static function route($route, $parameters = array(), $status = '302', $headers = array()){}

    /**
     * Create a new redirect response to a controller action.
     *
     * @static
     * @param	string	$action
     * @param	array	$parameters
     * @param	int	$status
     * @param	array	$headers
     * @return Illuminate\Http\RedirectResponse
     */
    public static function action($action, $parameters = array(), $status = '302', $headers = array()){}

    /**
     * Create a new redirect response.
     *
     * @static
     * @param	string	$path
     * @param	int	$status
     * @param	array	$headers
     * @return Illuminate\Http\RedirectResponse
     */
    public static function createRedirect($path, $status, $headers){}

    /**
     * Get the URL generator instance.
     *
     * @static
     * @return Illuminate\Routing\UrlGenerator
     */
    public static function getUrlGenerator(){}

    /**
     * Set the active session store.
     *
     * @static
     * @param	Illuminate\Session\Store	$session
     * @return void
     */
    public static function setSession($session){}

}

class Redis extends Illuminate\Redis\Database{
    /**
     * Create a new Redis connection instance.
     *
     * @static
     * @param	string	$host
     * @param	int	$port
     * @param	int	$database
     * @param	string	$password
     * @return void
     */
    public static function __construct($host, $port, $database = '0', $password = null){}

    /**
     * Connect to the Redis database.
     *
     * @static
     * @return void
     */
    public static function connect(){}

    /**
     * Run a command against the Redis database.
     *
     * @static
     * @param	string	$method
     * @param	array	$parameters
     * @return mixed
     */
    public static function command($method, $parameters = array()){}

    /**
     * Build the Redis command syntax.
    Redis protocol states that a command should conform to the following format:
     *<number of arguments> CR LF
    $<number of bytes of argument 1> CR LF
    <argument data> CR LF
    ...
    $<number of bytes of argument N> CR LF
    <argument data> CR LF
    More information regarding the Redis protocol: http://redis.io/topics/protocol
     *
     * @static
     * @param	string	$method
     * @param	array	$parameters
     * @return string
     */
    public static function buildCommand($method, $parameters){}

    /**
     * Parse the Redis database response.
     *
     * @static
     * @param	string	$response
     * @return mixed
     */
    public static function parseResponse($response){}

    /**
     * Parse an inline response from the database.
     *
     * @static
     * @param	string	$response
     * @return string
     */
    public static function parseInlineResponse($response){}

    /**
     * Parse a bulk response from the database.
     *
     * @static
     * @param	string	$response
     * @return string
     */
    public static function parseBulkResponse($response){}

    /**
     * Read the next block of bytes for a bulk response.
     *
     * @static
     * @param	int	$total
     * @param	int	$read
     * @return string
     */
    public static function readBulkBlock($total, $read){}

    /**
     * Parse a multi-bulk response from the database.
     *
     * @static
     * @param	string	$response
     * @return array
     */
    public static function parseMultiResponse($response){}

    /**
     * Get the socket connection to the database.
     *
     * @static
     * @return resource
     */
    public static function openSocket(){}

    /**
     * Read the specified number of bytes from the file resource.
     *
     * @static
     * @param	int	$bytes
     * @return string
     */
    public static function fileRead($bytes){}

    /**
     * Get the specified number of bytes from a file line.
     *
     * @static
     * @param	int	$bytes
     * @return string
     */
    public static function fileGet($bytes){}

    /**
     * Write the given command to the file resource.
     *
     * @static
     * @param	string	$command
     * @return void
     */
    public static function fileWrite($command){}

    /**
     * Get the Redis socket connection.
     *
     * @static
     * @return resource
     */
    public static function getConnection(){}

    /**
     * Dynamically make a Redis command.
     *
     * @static
     * @param	string	$method
     * @param	array	$parameters
     * @return mixed
     */
    public static function __call($method, $parameters){}

}

class Request extends Illuminate\Http\Request{
    /**
     * Return the Request instance.
     *
     * @static
     * @return Illuminate\Http\Request
     */
    public static function instance(){}

    /**
     * Get the root URL for the application.
     *
     * @static
     * @return string
     */
    public static function root(){}

    /**
     * Get the URL (no query string) for the request.
     *
     * @static
     * @return string
     */
    public static function url(){}

    /**
     * Get the full URL for the request.
     *
     * @static
     * @return string
     */
    public static function fullUrl(){}

    /**
     * Get the current path info for the request.
     *
     * @static
     * @return string
     */
    public static function path(){}

    /**
     * Get a segment from the URI (1 based index).
     *
     * @static
     * @param	string	$index
     * @param	mixed	$default
     * @return string
     */
    public static function segment($index, $default = null){}

    /**
     * Get all of the segments for the request path.
     *
     * @static
     * @return array
     */
    public static function segments(){}

    /**
     * Determine if the current request URI matches a pattern.
     *
     * @static
     * @param	string	$pattern
     * @return bool
     */
    public static function is($pattern){}

    /**
     * Determine if the request is the result of an AJAX call.
     *
     * @static
     * @return bool
     */
    public static function ajax(){}

    /**
     * Determine if the request is over HTTPS.
     *
     * @static
     * @return bool
     */
    public static function secure(){}

    /**
     * Determine if the request contains a given input item.
     *
     * @static
     * @param	string|array	$key
     * @return bool
     */
    public static function has($key){}

    /**
     * Get all of the input and files for the request.
     *
     * @static
     * @return array
     */
    public static function all(){}

    /**
     * Retrieve an input item from the request.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return string
     */
    public static function input($key = null, $default = null){}

    /**
     * Get a subset of the items from the input data.
     *
     * @static
     * @param	array	$keys
     * @return array
     */
    public static function only($keys){}

    /**
     * Get all of the input except for a specified array of items.
     *
     * @static
     * @param	array	$keys
     * @return array
     */
    public static function except($keys){}

    /**
     * Retrieve a query string item from the request.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return string
     */
    public static function query($key = null, $default = null){}

    /**
     * Retrieve a cookie from the request.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return string
     */
    public static function cookie($key = null, $default = null){}

    /**
     * Retrieve a file from the request.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public static function file($key = null, $default = null){}

    /**
     * Determine if the uploaded data contains a file.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function hasFile($key){}

    /**
     * Retrieve a header from the request.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return string
     */
    public static function header($key = null, $default = null){}

    /**
     * Retrieve a server variable from the request.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return string
     */
    public static function server($key = null, $default = null){}

    /**
     * Retrieve an old input item.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return string
     */
    public static function old($key = null, $default = null){}

    /**
     * Flash the input for the current request to the session.
     *
     * @static
     * @param	string $filter
     * @param	array	$keys
     * @return void
     */
    public static function flash($filter = null, $keys = array()){}

    /**
     * Flash only some of the input to the session.
     *
     * @static
     * @param	dynamic	string
     * @return void
     */
    public static function flashOnly($keys){}

    /**
     * Flash only some of the input to the session.
     *
     * @static
     * @param	dynamic	string
     * @return void
     */
    public static function flashExcept($keys){}

    /**
     * Flush all of the old input from the session.
     *
     * @static
     * @return void
     */
    public static function flush(){}

    /**
     * Retrieve a parameter item from a given source.
     *
     * @static
     * @param	string	$source
     * @param	string	$key
     * @param	mixed	$default
     * @return string
     */
    public static function retrieveItem($source, $key, $default){}

    /**
     * Merge new input into the current request's input array.
     *
     * @static
     * @param	array	$input
     * @return void
     */
    public static function merge($input){}

    /**
     * Replace the input for the current request.
     *
     * @static
     * @param	array	$input
     * @return void
     */
    public static function replace($input){}

    /**
     * Get the JSON payload for the request.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$default
     * @return mixed
     */
    public static function json($key = null, $default = null){}

    /**
     * Get the input source for the request.
     *
     * @static
     * @return Symfony\Component\HttpFoundation\ParameterBag
     */
    public static function getInputSource(){}

    /**
     * Get the Illuminate session store implementation.
     *
     * @static
     * @return Illuminate\Session\Store
     */
    public static function getSessionStore(){}

    /**
     * Set the Illuminate session store implementation.
     *
     * @static
     * @param	Illuminate\Session\Store	$session
     * @return void
     */
    public static function setSessionStore($session){}

    /**
     * Determine if the session store has been set.
     *
     * @static
     * @return bool
     */
    public static function hasSessionStore(){}

    /**
     * Constructor.
     *
     * @static
     * @param	array	$query	The GET parameters
     * @param	array	$request	The POST parameters
     * @param	array	$attributes The request attributes (parameters parsed from the PATH_INFO, ...)
     * @param	array	$cookies	The COOKIE parameters
     * @param	array	$files	The FILES parameters
     * @param	array	$server	The SERVER parameters
     * @param	string $content	The raw body data
     * @return void
     */
    public static function __construct($query = array(), $request = array(), $attributes = array(), $cookies = array(), $files = array(), $server = array(), $content = null){}

    /**
     * Sets the parameters for this request.
    This method also re-initializes all properties.
     *
     * @static
     * @param	array	$query	The GET parameters
     * @param	array	$request	The POST parameters
     * @param	array	$attributes The request attributes (parameters parsed from the PATH_INFO, ...)
     * @param	array	$cookies	The COOKIE parameters
     * @param	array	$files	The FILES parameters
     * @param	array	$server	The SERVER parameters
     * @param	string $content	The raw body data
     * @return void
     */
    public static function initialize($query = array(), $request = array(), $attributes = array(), $cookies = array(), $files = array(), $server = array(), $content = null){}

    /**
     * Creates a new request with values from PHP's super globals.
     *
     * @static
     * @return Request A new request
     */
    public static function createFromGlobals(){}

    /**
     * Creates a Request based on a given URI and configuration.
    The information contained in the URI always take precedence
    over the other information (server and parameters).
     *
     * @static
     * @param	string $uri	The URI
     * @param	string $method	The HTTP method
     * @param	array	$parameters The query (GET) or request (POST) parameters
     * @param	array	$cookies	The request cookies ($_COOKIE)
     * @param	array	$files	The request files ($_FILES)
     * @param	array	$server	The server parameters ($_SERVER)
     * @param	string $content	The raw body data
     * @return Request A Request instance
     */
    public static function create($uri, $method = 'GET', $parameters = array(), $cookies = array(), $files = array(), $server = array(), $content = null){}

    /**
     * Clones a request and overrides some of its parameters.
     *
     * @static
     * @param	array $query	The GET parameters
     * @param	array $request	The POST parameters
     * @param	array $attributes The request attributes (parameters parsed from the PATH_INFO, ...)
     * @param	array $cookies	The COOKIE parameters
     * @param	array $files	The FILES parameters
     * @param	array $server	The SERVER parameters
     * @return Request The duplicated request
     */
    public static function duplicate($query = null, $request = null, $attributes = null, $cookies = null, $files = null, $server = null){}

    /**
     * Clones the current request.
    Note that the session is not cloned as duplicated requests
    are most of the time sub-requests of the main one.
     *
     * @static
     * @return void
     */
    public static function __clone(){}

    /**
     * Returns the request as a string.
     *
     * @static
     * @return string The request
     */
    public static function __toString(){}

    /**
     * Overrides the PHP global variables according to this request instance.
    It overrides $_GET, $_POST, $_REQUEST, $_SERVER, $_COOKIE.
    $_FILES is never override, see rfc1867
     *
     * @static
     * @return void
     */
    public static function overrideGlobals(){}

    /**
     * Trusts $_SERVER entries coming from proxies.
     *
     * @static
     * @return void
     */
    public static function trustProxyData(){}

    /**
     * Sets a list of trusted proxies.
    You should only list the reverse proxies that you manage directly.
     *
     * @static
     * @param	array $proxies A list of trusted proxies
     * @return void
     */
    public static function setTrustedProxies($proxies){}

    /**
     * Gets the list of trusted proxies.
     *
     * @static
     * @return array An array of trusted proxies.
     */
    public static function getTrustedProxies(){}

    /**
     * Sets the name for trusted headers.
    The following header keys are supported:
     * Request::HEADER_CLIENT_IP:    defaults to X-Forwarded-For   (see getClientIp())
     * Request::HEADER_CLIENT_HOST:  defaults to X-Forwarded-Host  (see getClientHost())
     * Request::HEADER_CLIENT_PORT:  defaults to X-Forwarded-Port  (see getClientPort())
     * Request::HEADER_CLIENT_PROTO: defaults to X-Forwarded-Proto (see getScheme() and isSecure())
    Setting an empty value allows to disable the trusted header for the given key.
     *
     * @static
     * @param	string $key	The header key
     * @param	string $value The header name
     * @return void
     */
    public static function setTrustedHeaderName($key, $value){}

    /**
     * Returns true if $_SERVER entries coming from proxies are trusted,
    false otherwise.
     *
     * @static
     * @return boolean
     */
    public static function isProxyTrusted(){}

    /**
     * Normalizes a query string.
    It builds a normalized query string, where keys/value pairs are alphabetized,
    have consistent escaping and unneeded delimiters are removed.
     *
     * @static
     * @param	string $qs Query string
     * @return string A normalized query string for the Request
     */
    public static function normalizeQueryString($qs){}

    /**
     * Enables support for the _method request parameter to determine the intended HTTP method.
    Be warned that enabling this feature might lead to CSRF issues in your code.
    Check that you are using CSRF tokens when required.
    The HTTP method can only be overridden when the real HTTP method is POST.
     *
     * @static
     * @return void
     */
    public static function enableHttpMethodParameterOverride(){}

    /**
     * Checks whether support for the _method request parameter is enabled.
     *
     * @static
     * @return Boolean True when the _method request parameter is enabled, false otherwise
     */
    public static function getHttpMethodParameterOverride(){}

    /**
     * Gets a "parameter" value.
    This method is mainly useful for libraries that want to provide some flexibility.
    Order of precedence: GET, PATH, POST
    Avoid using this method in controllers:
     * slow
     * prefer to get from a "named" source
    It is better to explicitly get request parameters from the appropriate
    public property instead (query, attributes, request).
     *
     * @static
     * @param	string	$key	the key
     * @param	mixed	$default the default value
     * @param	Boolean $deep	is parameter deep in multidimensional array
     * @return mixed
     */
    public static function get($key, $default = null, $deep = false){}

    /**
     * Gets the Session.
     *
     * @static
     * @return SessionInterface|null The session
     */
    public static function getSession(){}

    /**
     * Whether the request contains a Session which was started in one of the
    previous requests.
     *
     * @static
     * @return Boolean
     */
    public static function hasPreviousSession(){}

    /**
     * Whether the request contains a Session object.
    This method does not give any information about the state of the session object,
    like whether the session is started or not. It is just a way to check if this Request
    is associated with a Session instance.
     *
     * @static
     * @return Boolean true when the Request contains a Session object, false otherwise
     */
    public static function hasSession(){}

    /**
     * Sets the Session.
     *
     * @static
     * @param	SessionInterface $session The Session
     * @return void
     */
    public static function setSession($session){}

    /**
     * Returns the client IP address.
    This method can read the client IP address from the "X-Forwarded-For" header
    when trusted proxies were set via "setTrustedProxies()". The "X-Forwarded-For"
    header value is a comma+space separated list of IP addresses, the left-most
    being the original client, and each successive proxy that passed the request
    adding the IP address where it received the request from.
    If your reverse proxy uses a different header name than "X-Forwarded-For",
    ("Client-Ip" for instance), configure it via "setTrustedHeaderName()" with
    the "client-ip" key.
     *
     * @static
     * @return string The client IP address
     */
    public static function getClientIp(){}

    /**
     * Returns current script name.
     *
     * @static
     * @return string
     */
    public static function getScriptName(){}

    /**
     * Returns the path being requested relative to the executed script.
    The path info always starts with a /.
    Suppose this request is instantiated from /mysite on localhost:
     * http://localhost/mysite              returns an empty string
     * http://localhost/mysite/about        returns '/about'
     * http://localhost/mysite/enco%20ded   returns '/enco%20ded'
     * http://localhost/mysite/about?var=1  returns '/about'
     *
     * @static
     * @return string The raw path (i.e. not urldecoded)
     */
    public static function getPathInfo(){}

    /**
     * Returns the root path from which this request is executed.
    Suppose that an index.php file instantiates this request object:
     * http://localhost/index.php         returns an empty string
     * http://localhost/index.php/page    returns an empty string
     * http://localhost/web/index.php     returns '/web'
     * http://localhost/we%20b/index.php  returns '/we%20b'
     *
     * @static
     * @return string The raw path (i.e. not urldecoded)
     */
    public static function getBasePath(){}

    /**
     * Returns the root url from which this request is executed.
    The base URL never ends with a /.
    This is similar to getBasePath(), except that it also includes the
    script filename (e.g. index.php) if one exists.
     *
     * @static
     * @return string The raw url (i.e. not urldecoded)
     */
    public static function getBaseUrl(){}

    /**
     * Gets the request's scheme.
     *
     * @static
     * @return string
     */
    public static function getScheme(){}

    /**
     * Returns the port on which the request is made.
    This method can read the client port from the "X-Forwarded-Port" header
    when trusted proxies were set via "setTrustedProxies()".
    The "X-Forwarded-Port" header must contain the client port.
    If your reverse proxy uses a different header name than "X-Forwarded-Port",
    configure it via "setTrustedHeaderName()" with the "client-port" key.
     *
     * @static
     * @return string
     */
    public static function getPort(){}

    /**
     * Returns the user.
     *
     * @static
     * @return string|null
     */
    public static function getUser(){}

    /**
     * Returns the password.
     *
     * @static
     * @return string|null
     */
    public static function getPassword(){}

    /**
     * Gets the user info.
     *
     * @static
     * @return string A user name and, optionally, scheme-specific information about how to gain authorization to access the server
     */
    public static function getUserInfo(){}

    /**
     * Returns the HTTP host being requested.
    The port name will be appended to the host if it's non-standard.
     *
     * @static
     * @return string
     */
    public static function getHttpHost(){}

    /**
     * Returns the requested URI.
     *
     * @static
     * @return string The raw URI (i.e. not urldecoded)
     */
    public static function getRequestUri(){}

    /**
     * Gets the scheme and HTTP host.
    If the URL was called with basic authentication, the user
    and the password are not added to the generated string.
     *
     * @static
     * @return string The scheme and HTTP host
     */
    public static function getSchemeAndHttpHost(){}

    /**
     * Generates a normalized URI for the Request.
     *
     * @static
     * @return string A normalized URI for the Request
     */
    public static function getUri(){}

    /**
     * Generates a normalized URI for the given path.
     *
     * @static
     * @param	string $path A path to use instead of the current one
     * @return string The normalized URI for the path
     */
    public static function getUriForPath($path){}

    /**
     * Generates the normalized query string for the Request.
    It builds a normalized query string, where keys/value pairs are alphabetized
    and have consistent escaping.
     *
     * @static
     * @return string|null A normalized query string for the Request
     */
    public static function getQueryString(){}

    /**
     * Checks whether the request is secure or not.
    This method can read the client port from the "X-Forwarded-Proto" header
    when trusted proxies were set via "setTrustedProxies()".
    The "X-Forwarded-Proto" header must contain the protocol: "https" or "http".
    If your reverse proxy uses a different header name than "X-Forwarded-Proto"
    ("SSL_HTTPS" for instance), configure it via "setTrustedHeaderName()" with
    the "client-proto" key.
     *
     * @static
     * @return Boolean
     */
    public static function isSecure(){}

    /**
     * Returns the host name.
    This method can read the client port from the "X-Forwarded-Host" header
    when trusted proxies were set via "setTrustedProxies()".
    The "X-Forwarded-Host" header must contain the client host name.
    If your reverse proxy uses a different header name than "X-Forwarded-Host",
    configure it via "setTrustedHeaderName()" with the "client-host" key.
     *
     * @static
     * @return string
     */
    public static function getHost(){}

    /**
     * Sets the request method.
     *
     * @static
     * @param	string $method
     * @return void
     */
    public static function setMethod($method){}

    /**
     * Gets the request "intended" method.
    If the X-HTTP-Method-Override header is set, and if the method is a POST,
    then it is used to determine the "real" intended HTTP method.
    The _method request parameter can also be used to determine the HTTP method,
    but only if enableHttpMethodParameterOverride() has been called.
    The method is always an uppercased string.
     *
     * @static
     * @return string The request method
     */
    public static function getMethod(){}

    /**
     * Gets the "real" request method.
     *
     * @static
     * @return string The request method
     */
    public static function getRealMethod(){}

    /**
     * Gets the mime type associated with the format.
     *
     * @static
     * @param	string $format The format
     * @return string The associated mime type (null if not found)
     */
    public static function getMimeType($format){}

    /**
     * Gets the format associated with the mime type.
     *
     * @static
     * @param	string $mimeType The associated mime type
     * @return string|null The format (null if not found)
     */
    public static function getFormat($mimeType){}

    /**
     * Associates a format with mime types.
     *
     * @static
     * @param	string	$format	The format
     * @param	string|array $mimeTypes The associated mime types (the preferred one must be the first as it will be used as the content type)
     * @return void
     */
    public static function setFormat($format, $mimeTypes){}

    /**
     * Gets the request format.
    Here is the process to determine the format:
     * format defined by the user (with setRequestFormat())
     * _format request parameter
     * $default
     *
     * @static
     * @param	string $default The default format
     * @return string The request format
     */
    public static function getRequestFormat($default = 'html'){}

    /**
     * Sets the request format.
     *
     * @static
     * @param	string $format The request format.
     * @return void
     */
    public static function setRequestFormat($format){}

    /**
     * Gets the format associated with the request.
     *
     * @static
     * @return string|null The format (null if no content type is present)
     */
    public static function getContentType(){}

    /**
     * Sets the default locale.
     *
     * @static
     * @param	string $locale
     * @return void
     */
    public static function setDefaultLocale($locale){}

    /**
     * Sets the locale.
     *
     * @static
     * @param	string $locale
     * @return void
     */
    public static function setLocale($locale){}

    /**
     * Get the locale.
     *
     * @static
     * @return string
     */
    public static function getLocale(){}

    /**
     * Checks if the request method is of specified type.
     *
     * @static
     * @param	string $method Uppercase request method (GET, POST etc).
     * @return Boolean
     */
    public static function isMethod($method){}

    /**
     * Checks whether the method is safe or not.
     *
     * @static
     * @return Boolean
     */
    public static function isMethodSafe(){}

    /**
     * Returns the request body content.
     *
     * @static
     * @param	Boolean $asResource If true, a resource will be returned
     * @return string|resource The request body content or a resource to read the body stream.
     */
    public static function getContent($asResource = false){}

    /**
     * Gets the Etags.
     *
     * @static
     * @return array The entity tags
     */
    public static function getETags(){}

    /**
     *
     *
     * @static
     * @return Boolean
     */
    public static function isNoCache(){}

    /**
     * Returns the preferred language.
     *
     * @static
     * @param	array $locales An array of ordered available locales
     * @return string|null The preferred locale
     */
    public static function getPreferredLanguage($locales = null){}

    /**
     * Gets a list of languages acceptable by the client browser.
     *
     * @static
     * @return array Languages ordered in the user browser preferences
     */
    public static function getLanguages(){}

    /**
     * Gets a list of charsets acceptable by the client browser.
     *
     * @static
     * @return array List of charsets in preferable order
     */
    public static function getCharsets(){}

    /**
     * Gets a list of content types acceptable by the client browser
     *
     * @static
     * @return array List of content types in preferable order
     */
    public static function getAcceptableContentTypes(){}

    /**
     * Returns true if the request is a XMLHttpRequest.
    It works if your JavaScript library set an X-Requested-With HTTP header.
    It is known to work with common JavaScript frameworks:
     *
     * @static
     * @return Boolean true if the request is an XMLHttpRequest, false otherwise
     */
    public static function isXmlHttpRequest(){}

    /**
     * Splits an Accept-* HTTP header.
     *
     * @static
     * @param	string $header Header to split
     * @return array Array indexed by the values of the Accept-* header in preferred order
     */
    public static function splitHttpAcceptHeader($header){}

    /**
     *
     *
     * @static
     * @return void
     */
    public static function prepareRequestUri(){}

    /**
     * Prepares the base URL.
     *
     * @static
     * @return string
     */
    public static function prepareBaseUrl(){}

    /**
     * Prepares the base path.
     *
     * @static
     * @return string base path
     */
    public static function prepareBasePath(){}

    /**
     * Prepares the path info.
     *
     * @static
     * @return string path info
     */
    public static function preparePathInfo(){}

    /**
     * Initializes HTTP request formats.
     *
     * @static
     * @return void
     */
    public static function initializeFormats(){}

    /**
     * Sets the default PHP locale.
     *
     * @static
     * @param	string $locale
     * @return void
     */
    public static function setPhpDefaultLocale($locale){}

    /**
     *
     *
     * @static
     * @return void
     */
    public static function getUrlencodedPrefix($string, $prefix){}

}

class Response extends Illuminate\Http\Response{
    /**
     * Add a cookie to the response.
     *
     * @static
     * @param	Symfony\Component\HttpFoundation\Cookie	$cookie
     * @return Illuminate\Http\Response
     */
    public static function withCookie($cookie){}

    /**
     * Set the content on the response.
     *
     * @static
     * @param	mixed	$content
     * @return void
     */
    public static function setContent($content){}

    /**
     * Get the original response content.
     *
     * @static
     * @return mixed
     */
    public static function getOriginalContent(){}

    /**
     * Constructor.
     *
     * @static
     * @param	string	$content The response content
     * @param	integer $status	The response status code
     * @param	array	$headers An array of response headers
     * @return void
     */
    public static function __construct($content = '', $status = '200', $headers = array()){}

    /**
     * Factory method for chainability
    Example:
    return Response::create($body, 200)
    ->setSharedMaxAge(300);
     *
     * @static
     * @param	string	$content The response content
     * @param	integer $status	The response status code
     * @param	array	$headers An array of response headers
     * @return Response
     */
    public static function create($content = '', $status = '200', $headers = array()){}

    /**
     * Returns the Response as an HTTP string.
    The string representation of the Response is the same as the
    one that will be sent to the client only if the prepare() method
    has been called before.
     *
     * @static
     * @return string The Response as an HTTP string
     */
    public static function __toString(){}

    /**
     * Clones the current Response instance.
     *
     * @static
     * @return void
     */
    public static function __clone(){}

    /**
     * Prepares the Response before it is sent to the client.
    This method tweaks the Response to ensure that it is
    compliant with RFC 2616. Most of the changes are based on
    the Request that is "associated" with this Response.
     *
     * @static
     * @param	Request $request A Request instance
     * @return Response The current response.
     */
    public static function prepare($request){}

    /**
     * Sends HTTP headers.
     *
     * @static
     * @return Response
     */
    public static function sendHeaders(){}

    /**
     * Sends content for the current web response.
     *
     * @static
     * @return Response
     */
    public static function sendContent(){}

    /**
     * Sends HTTP headers and content.
     *
     * @static
     * @return Response
     */
    public static function send(){}

    /**
     * Gets the current response content.
     *
     * @static
     * @return string Content
     */
    public static function getContent(){}

    /**
     * Sets the HTTP protocol version (1.0 or 1.1).
     *
     * @static
     * @param	string $version The HTTP protocol version
     * @return Response
     */
    public static function setProtocolVersion($version){}

    /**
     * Gets the HTTP protocol version.
     *
     * @static
     * @return string The HTTP protocol version
     */
    public static function getProtocolVersion(){}

    /**
     * Sets the response status code.
     *
     * @static
     * @param	integer $code HTTP status code
     * @param	mixed	$text HTTP status text
    If the status text is null it will be automatically populated for the known
    status codes and left empty otherwise.
     * @return Response
     */
    public static function setStatusCode($code, $text = null){}

    /**
     * Retrieves the status code for the current web response.
     *
     * @static
     * @return integer Status code
     */
    public static function getStatusCode(){}

    /**
     * Sets the response charset.
     *
     * @static
     * @param	string $charset Character set
     * @return Response
     */
    public static function setCharset($charset){}

    /**
     * Retrieves the response charset.
     *
     * @static
     * @return string Character set
     */
    public static function getCharset(){}

    /**
     * Returns true if the response is worth caching under any circumstance.
    Responses marked "private" with an explicit Cache-Control directive are
    considered uncacheable.
    Responses with neither a freshness lifetime (Expires, max-age) nor cache
    validator (Last-Modified, ETag) are considered uncacheable.
     *
     * @static
     * @return Boolean true if the response is worth caching, false otherwise
     */
    public static function isCacheable(){}

    /**
     * Returns true if the response is "fresh".
    Fresh responses may be served from cache without any interaction with the
    origin. A response is considered fresh when it includes a Cache-Control/max-age
    indicator or Expires header and the calculated age is less than the freshness lifetime.
     *
     * @static
     * @return Boolean true if the response is fresh, false otherwise
     */
    public static function isFresh(){}

    /**
     * Returns true if the response includes headers that can be used to validate
    the response with the origin server using a conditional GET request.
     *
     * @static
     * @return Boolean true if the response is validateable, false otherwise
     */
    public static function isValidateable(){}

    /**
     * Marks the response as "private".
    It makes the response ineligible for serving other clients.
     *
     * @static
     * @return Response
     */
    public static function setPrivate(){}

    /**
     * Marks the response as "public".
    It makes the response eligible for serving other clients.
     *
     * @static
     * @return Response
     */
    public static function setPublic(){}

    /**
     * Returns true if the response must be revalidated by caches.
    This method indicates that the response must not be served stale by a
    cache in any circumstance without first revalidating with the origin.
    When present, the TTL of the response should not be overridden to be
    greater than the value provided by the origin.
     *
     * @static
     * @return Boolean true if the response must be revalidated by a cache, false otherwise
     */
    public static function mustRevalidate(){}

    /**
     * Returns the Date header as a DateTime instance.
     *
     * @static
     * @return \DateTime A \DateTime instance
     */
    public static function getDate(){}

    /**
     * Sets the Date header.
     *
     * @static
     * @param	\DateTime $date A \DateTime instance
     * @return Response
     */
    public static function setDate($date){}

    /**
     * Returns the age of the response.
     *
     * @static
     * @return integer The age of the response in seconds
     */
    public static function getAge(){}

    /**
     * Marks the response stale by setting the Age header to be equal to the maximum age of the response.
     *
     * @static
     * @return Response
     */
    public static function expire(){}

    /**
     * Returns the value of the Expires header as a DateTime instance.
     *
     * @static
     * @return \DateTime|null A DateTime instance or null if the header does not exist
     */
    public static function getExpires(){}

    /**
     * Sets the Expires HTTP header with a DateTime instance.
    Passing null as value will remove the header.
     *
     * @static
     * @param	\DateTime|null $date A \DateTime instance or null to remove the header
     * @return Response
     */
    public static function setExpires($date = null){}

    /**
     * Returns the number of seconds after the time specified in the response's Date
    header when the the response should no longer be considered fresh.
    First, it checks for a s-maxage directive, then a max-age directive, and then it falls
    back on an expires header. It returns null when no maximum age can be established.
     *
     * @static
     * @return integer|null Number of seconds
     */
    public static function getMaxAge(){}

    /**
     * Sets the number of seconds after which the response should no longer be considered fresh.
    This methods sets the Cache-Control max-age directive.
     *
     * @static
     * @param	integer $value Number of seconds
     * @return Response
     */
    public static function setMaxAge($value){}

    /**
     * Sets the number of seconds after which the response should no longer be considered fresh by shared caches.
    This methods sets the Cache-Control s-maxage directive.
     *
     * @static
     * @param	integer $value Number of seconds
     * @return Response
     */
    public static function setSharedMaxAge($value){}

    /**
     * Returns the response's time-to-live in seconds.
    It returns null when no freshness information is present in the response.
    When the responses TTL is <= 0, the response may not be served from cache without first
    revalidating with the origin.
     *
     * @static
     * @return integer|null The TTL in seconds
     */
    public static function getTtl(){}

    /**
     * Sets the response's time-to-live for shared caches.
    This method adjusts the Cache-Control/s-maxage directive.
     *
     * @static
     * @param	integer $seconds Number of seconds
     * @return Response
     */
    public static function setTtl($seconds){}

    /**
     * Sets the response's time-to-live for private/client caches.
    This method adjusts the Cache-Control/max-age directive.
     *
     * @static
     * @param	integer $seconds Number of seconds
     * @return Response
     */
    public static function setClientTtl($seconds){}

    /**
     * Returns the Last-Modified HTTP header as a DateTime instance.
     *
     * @static
     * @return \DateTime|null A DateTime instance or null if the header does not exist
     */
    public static function getLastModified(){}

    /**
     * Sets the Last-Modified HTTP header with a DateTime instance.
    Passing null as value will remove the header.
     *
     * @static
     * @param	\DateTime|null $date A \DateTime instance or null to remove the header
     * @return Response
     */
    public static function setLastModified($date = null){}

    /**
     * Returns the literal value of the ETag HTTP header.
     *
     * @static
     * @return string|null The ETag HTTP header or null if it does not exist
     */
    public static function getEtag(){}

    /**
     * Sets the ETag value.
     *
     * @static
     * @param	string|null $etag The ETag unique identifier or null to remove the header
     * @param	Boolean	$weak Whether you want a weak ETag or not
     * @return Response
     */
    public static function setEtag($etag = null, $weak = false){}

    /**
     * Sets the response's cache headers (validation and/or expiration).
    Available options are: etag, last_modified, max_age, s_maxage, private, and public.
     *
     * @static
     * @param	array $options An array of cache options
     * @return Response
     */
    public static function setCache($options){}

    /**
     * Modifies the response so that it conforms to the rules defined for a 304 status code.
    This sets the status, removes the body, and discards any headers
    that MUST NOT be included in 304 responses.
     *
     * @static
     * @return Response
     */
    public static function setNotModified(){}

    /**
     * Returns true if the response includes a Vary header.
     *
     * @static
     * @return Boolean true if the response includes a Vary header, false otherwise
     */
    public static function hasVary(){}

    /**
     * Returns an array of header names given in the Vary header.
     *
     * @static
     * @return array An array of Vary names
     */
    public static function getVary(){}

    /**
     * Sets the Vary header.
     *
     * @static
     * @param	string|array $headers
     * @param	Boolean	$replace Whether to replace the actual value of not (true by default)
     * @return Response
     */
    public static function setVary($headers, $replace = true){}

    /**
     * Determines if the Response validators (ETag, Last-Modified) match
    a conditional value specified in the Request.
    If the Response is not modified, it sets the status code to 304 and
    removes the actual content by calling the setNotModified() method.
     *
     * @static
     * @param	Request $request A Request instance
     * @return Boolean true if the Response validators match the Request, false otherwise
     */
    public static function isNotModified($request){}

    /**
     * Is response invalid?
     *
     * @static
     * @return Boolean
     */
    public static function isInvalid(){}

    /**
     * Is response informative?
     *
     * @static
     * @return Boolean
     */
    public static function isInformational(){}

    /**
     * Is response successful?
     *
     * @static
     * @return Boolean
     */
    public static function isSuccessful(){}

    /**
     * Is the response a redirect?
     *
     * @static
     * @return Boolean
     */
    public static function isRedirection(){}

    /**
     * Is there a client error?
     *
     * @static
     * @return Boolean
     */
    public static function isClientError(){}

    /**
     * Was there a server side error?
     *
     * @static
     * @return Boolean
     */
    public static function isServerError(){}

    /**
     * Is the response OK?
     *
     * @static
     * @return Boolean
     */
    public static function isOk(){}

    /**
     * Is the response forbidden?
     *
     * @static
     * @return Boolean
     */
    public static function isForbidden(){}

    /**
     * Is the response a not found error?
     *
     * @static
     * @return Boolean
     */
    public static function isNotFound(){}

    /**
     * Is the response a redirect of some form?
     *
     * @static
     * @param	string $location
     * @return Boolean
     */
    public static function isRedirect($location = null){}

    /**
     * Is the response empty?
     *
     * @static
     * @return Boolean
     */
    public static function isEmpty(){}

}

class Route extends Illuminate\Routing\Router{
    /**
     * Create a new router instance.
     *
     * @static
     * @param	Illuminate\Container	$container
     * @return void
     */
    public static function __construct($container = null){}

    /**
     * Add a new route to the collection.
     *
     * @static
     * @param	string	$pattern
     * @param	mixed	$action
     * @return Illuminate\Routing\Route
     */
    public static function get($pattern, $action){}

    /**
     * Add a new route to the collection.
     *
     * @static
     * @param	string	$pattern
     * @param	mixed	$action
     * @return Illuminate\Routing\Route
     */
    public static function post($pattern, $action){}

    /**
     * Add a new route to the collection.
     *
     * @static
     * @param	string	$pattern
     * @param	mixed	$action
     * @return Illuminate\Routing\Route
     */
    public static function put($pattern, $action){}

    /**
     * Add a new route to the collection.
     *
     * @static
     * @param	string	$pattern
     * @param	mixed	$action
     * @return Illuminate\Routing\Route
     */
    public static function patch($pattern, $action){}

    /**
     * Add a new route to the collection.
     *
     * @static
     * @param	string	$pattern
     * @param	mixed	$action
     * @return Illuminate\Routing\Route
     */
    public static function delete($pattern, $action){}

    /**
     * Add a new route to the collection.
     *
     * @static
     * @param	string	$method
     * @param	string	$pattern
     * @param	mixed	$action
     * @return Illuminate\Routing\Route
     */
    public static function match($method, $pattern, $action){}

    /**
     * Add a new route to the collection.
     *
     * @static
     * @param	string	$pattern
     * @param	mixed	$action
     * @return Illuminate\Routing\Route
     */
    public static function any($pattern, $action){}

    /**
     * Register an array of controllers with wildcard routing.
     *
     * @static
     * @param	array	$controllers
     * @return void
     */
    public static function controllers($controllers){}

    /**
     * Route a controller to a URI with wildcard routing.
     *
     * @static
     * @param	string	$uri
     * @param	string	$controller
     * @return Illuminate\Routing\Route
     */
    public static function controller($uri, $controller){}

    /**
     * Add a fallthrough route for a controller.
     *
     * @static
     * @param	string	$controller
     * @param	string	$uri
     * @return void
     */
    public static function addFallthroughRoute($controller, $uri){}

    /**
     * Route a resource to a controller.
     *
     * @static
     * @param	string	$resource
     * @param	string	$controller
     * @param	array	$options
     * @return void
     */
    public static function resource($resource, $controller, $options = array()){}

    /**
     * Get the applicable resource methods.
     *
     * @static
     * @param	array	$defaults
     * @param	array	$options
     * @return array
     */
    public static function getResourceMethods($defaults, $options){}

    /**
     * Add the index method for a resourceful route.
     *
     * @static
     * @param	string	$name
     * @param	string	$base
     * @param	string	$controller
     * @return void
     */
    public static function addResourceIndex($name, $base, $controller){}

    /**
     * Add the create method for a resourceful route.
     *
     * @static
     * @param	string	$name
     * @param	string	$base
     * @param	string	$controller
     * @return void
     */
    public static function addResourceCreate($name, $base, $controller){}

    /**
     * Add the store method for a resourceful route.
     *
     * @static
     * @param	string	$name
     * @param	string	$base
     * @param	string	$controller
     * @return void
     */
    public static function addResourceStore($name, $base, $controller){}

    /**
     * Add the show method for a resourceful route.
     *
     * @static
     * @param	string	$name
     * @param	string	$base
     * @param	string	$controller
     * @return void
     */
    public static function addResourceShow($name, $base, $controller){}

    /**
     * Add the edit method for a resourceful route.
     *
     * @static
     * @param	string	$name
     * @param	string	$base
     * @param	string	$controller
     * @return void
     */
    public static function addResourceEdit($name, $base, $controller){}

    /**
     * Add the update method for a resourceful route.
     *
     * @static
     * @param	string	$name
     * @param	string	$base
     * @param	string	$controller
     * @return void
     */
    public static function addResourceUpdate($name, $base, $controller){}

    /**
     * Add the update method for a resourceful route.
     *
     * @static
     * @param	string	$name
     * @param	string	$base
     * @param	string	$controller
     * @return void
     */
    public static function addPutResourceUpdate($name, $base, $controller){}

    /**
     * Add the update method for a resourceful route.
     *
     * @static
     * @param	string	$name
     * @param	string	$base
     * @param	string	$controller
     * @return void
     */
    public static function addPatchResourceUpdate($name, $base, $controller){}

    /**
     * Add the destroy method for a resourceful route.
     *
     * @static
     * @param	string	$name
     * @param	string	$base
     * @param	string	$controller
     * @return void
     */
    public static function addResourceDestroy($name, $base, $controller){}

    /**
     * Get the base resource URI for a given resource.
     *
     * @static
     * @param	string	$resource
     * @return string
     */
    public static function getResourceUri($resource){}

    /**
     * Get the action array for a resource route.
     *
     * @static
     * @param	string	$resource
     * @param	string	$controller
     * @param	string	$method
     * @return array
     */
    public static function getResourceAction($resource, $controller, $method){}

    /**
     * Get the resource prefix for a resource route.
     *
     * @static
     * @param	string	$resource
     * @param	string	$method
     * @return string
     */
    public static function getResourcePrefix($resource, $method){}

    /**
     * Get the base resource from a resource name.
     *
     * @static
     * @param	string	$resource
     * @return string
     */
    public static function getBaseResource($resource){}

    /**
     * Create a route group with shared attributes.
     *
     * @static
     * @param	array	$attributes
     * @param	Closure	$callback
     * @return void
     */
    public static function group($attributes, $callback){}

    /**
     * Update the group stack array.
     *
     * @static
     * @param	array	$attributes
     * @return void
     */
    public static function updateGroupStack($attributes){}

    /**
     * Create a new route instance.
     *
     * @static
     * @param	string	$method
     * @param	string	$pattern
     * @param	mixed	$action
     * @return Illuminate\Routing\Route
     */
    public static function createRoute($method, $pattern, $action){}

    /**
     * Parse the given route action into array form.
     *
     * @static
     * @param	mixed	$action
     * @return array
     */
    public static function parseAction($action){}

    /**
     * Merge the current group stack into a given action.
     *
     * @static
     * @param	array	$action
     * @param	int	$index
     * @return array
     */
    public static function mergeGroup($action, $index){}

    /**
     * Get the full group prefix for the current stack.
     *
     * @static
     * @return string
     */
    public static function getGroupPrefix(){}

    /**
     * Get the fully merged prefix for a given action.
     *
     * @static
     * @param	array	$action
     * @return string
     */
    public static function mergeGroupPrefix($action){}

    /**
     * Add the given prefix to the given URI pattern.
     *
     * @static
     * @param	string	$pattern
     * @param	string	$prefix
     * @return string
     */
    public static function addPrefix($pattern, $prefix){}

    /**
     * Set the attributes and requirements on the route.
     *
     * @static
     * @param	Illuminate\Routing\Route	$route
     * @param	array	$action
     * @param	array	$optional
     * @return void
     */
    public static function setAttributes($route, $action, $optional){}

    /**
     * Modify the pattern and extract optional parameters.
     *
     * @static
     * @param	string	$pattern
     * @return array
     */
    public static function getOptional($pattern){}

    /**
     * Get the name of the route.
     *
     * @static
     * @param	string	$method
     * @param	string	$pattern
     * @param	array	$action
     * @return string
     */
    public static function getName($method, $pattern, $action){}

    /**
     * Get the callback from the given action array.
     *
     * @static
     * @param	array	$action
     * @return Closure
     */
    public static function getCallback($action){}

    /**
     * Create the controller callback for a route.
     *
     * @static
     * @param	string	$attribute
     * @return Closure
     */
    public static function createControllerCallback($attribute){}

    /**
     * Get the response for a given request.
     *
     * @static
     * @param	Symfony\Component\HttpFoundation\Request	$request
     * @return Symfony\Component\HttpFoundation\Response
     */
    public static function dispatch($request){}

    /**
     * Match the given request to a route object.
     *
     * @static
     * @param	Symfony\Component\HttpFoundation\Request	$request
     * @return Illuminate\Routing\Route
     */
    public static function findRoute($request){}

    /**
     * Format the request path info for routing.
     *
     * @static
     * @param	Illuminate\Http\Request	$request
     * @return string
     */
    public static function formatRequestPath($request){}

    /**
     * Register a "before" routing filter.
     *
     * @static
     * @param	Closure|string	$callback
     * @return void
     */
    public static function before($callback){}

    /**
     * Register an "after" routing filter.
     *
     * @static
     * @param	Closure|string	$callback
     * @return void
     */
    public static function after($callback){}

    /**
     * Register a "close" routing filter.
     *
     * @static
     * @param	Closure|string	$callback
     * @return void
     */
    public static function close($callback){}

    /**
     * Register a "finish" routing filters.
     *
     * @static
     * @param	Closure|string	$callback
     * @return void
     */
    public static function finish($callback){}

    /**
     * Build a global filter definition for the router.
     *
     * @static
     * @param	Closure|string	$callback
     * @return Closure
     */
    public static function buildGlobalFilter($callback){}

    /**
     * Register a new filter with the application.
     *
     * @static
     * @param	string	$name
     * @param	Closure|string	$callback
     * @return void
     */
    public static function addFilter($name, $callback){}

    /**
     * Get a registered filter callback.
     *
     * @static
     * @param	string	$name
     * @return Closure
     */
    public static function getFilter($name){}

    /**
     * Get a callable array for a class based filter.
     *
     * @static
     * @param	string	$filter
     * @return array
     */
    public static function getClassBasedFilter($filter){}

    /**
     * Tie a registered filter to a URI pattern.
     *
     * @static
     * @param	string	$pattern
     * @param	string|array	$names
     * @return void
     */
    public static function matchFilter($pattern, $names){}

    /**
     * Find the patterned filters matching a request.
     *
     * @static
     * @param	Illuminate\Foundation\Request	$request
     * @return array
     */
    public static function findPatternFilters($request){}

    /**
     * Call the "after" global filters.
     *
     * @static
     * @param	Symfony\Component\HttpFoundation\Request	$request
     * @param	Symfony\Component\HttpFoundation\Response	$response
     * @return mixed
     */
    public static function callAfterFilter($request, $response){}

    /**
     * Call the "finish" global filter.
     *
     * @static
     * @param	Symfony\Component\HttpFoundation\Request	$request
     * @param	Symfony\Component\HttpFoundation\Response	$response
     * @return mixed
     */
    public static function callFinishFilter($request, $response){}

    /**
     * Call a given global filter with the parameters.
     *
     * @static
     * @param	Symfony\Component\HttpFoundation\Request	$request
     * @param	string	$name
     * @param	array	$parameters
     * @return mixed
     */
    public static function callGlobalFilter($request, $name, $parameters = array()){}

    /**
     * Set a global where pattern on all routes
     *
     * @static
     * @param	string	$key
     * @param	string	$pattern
     * @return void
     */
    public static function pattern($key, $pattern){}

    /**
     * Register a model binder for a wildcard.
     *
     * @static
     * @param	string	$key
     * @param	string	$class
     * @return void
     */
    public static function model($key, $class){}

    /**
     * Register a custom parameter binder.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$binder
     * @return void
     */
    public static function bind($key, $binder){}

    /**
     * Determine if a given key has a registered binder.
     *
     * @static
     * @param	string	$key
     * @return bool
     */
    public static function hasBinder($key){}

    /**
     * Call a binder for a given wildcard.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @param	Illuminate\Routing\Route	$route
     * @return mixed
     */
    public static function performBinding($key, $value, $route){}

    /**
     * Prepare the given value as a Response object.
     *
     * @static
     * @param	mixed	$value
     * @param	Illuminate\Foundation\Request	$request
     * @return Symfony\Component\HttpFoundation\Response
     */
    public static function prepare($value, $request){}

    /**
     * Convert routing exception to HttpKernel version.
     *
     * @static
     * @param	Exception	$e
     * @return void
     */
    public static function handleRoutingException($e){}

    /**
     * Determine if the current route has a given name.
     *
     * @static
     * @param	string	$name
     * @return bool
     */
    public static function currentRouteNamed($name){}

    /**
     * Determine if the current route uses a given controller action.
     *
     * @static
     * @param	string	$action
     * @return bool
     */
    public static function currentRouteUses($action){}

    /**
     * Determine if route filters are enabled.
     *
     * @static
     * @return bool
     */
    public static function filtersEnabled(){}

    /**
     * Enable the running of filters.
     *
     * @static
     * @return void
     */
    public static function enableFilters(){}

    /**
     * Disable the running of all filters.
     *
     * @static
     * @return void
     */
    public static function disableFilters(){}

    /**
     * Retrieve the entire route collection.
     *
     * @static
     * @return Symfony\Component\Routing\RouteCollection
     */
    public static function getRoutes(){}

    /**
     * Get the current request being dispatched.
     *
     * @static
     * @return Symfony\Component\HttpFoundation\Request
     */
    public static function getRequest(){}

    /**
     * Get the current route being executed.
     *
     * @static
     * @return Illuminate\Routing\Route
     */
    public static function getCurrentRoute(){}

    /**
     * Set the current route on the router.
     *
     * @static
     * @param	Illuminate\Routing\Route	$route
     * @return void
     */
    public static function setCurrentRoute($route){}

    /**
     * Get the filters defined on the router.
     *
     * @static
     * @return array
     */
    public static function getFilters(){}

    /**
     * Get the global filters defined on the router.
     *
     * @static
     * @return array
     */
    public static function getGlobalFilters(){}

    /**
     * Create a new URL matcher instance.
     *
     * @static
     * @param	Symfony\Component\HttpFoundation\Request	$request
     * @return Symfony\Component\Routing\Matcher\UrlMatcher
     */
    public static function getUrlMatcher($request){}

    /**
     * Get the controller inspector instance.
     *
     * @static
     * @return Illuminate\Routing\Controllers\Inspector
     */
    public static function getInspector(){}

    /**
     * Set the controller inspector instance.
     *
     * @static
     * @param	Illuminate\Routing\Controllers\Inspector	$inspector
     * @return void
     */
    public static function setInspector($inspector){}

    /**
     * Get the container used by the router.
     *
     * @static
     * @return Illuminate\Container\Container
     */
    public static function getContainer(){}

    /**
     * Set the container instance on the router.
     *
     * @static
     * @param	Illuminate\Container\Container	$container
     * @return void
     */
    public static function setContainer($container){}

}

class Schema extends Illuminate\Database\Schema\Builder{
    /**
     * Create a new database Schema manager.
     *
     * @static
     * @param	Illuminate\Database\Connection	$connection
     * @return void
     */
    public static function __construct($connection){}

    /**
     * Determine if the given table exists.
     *
     * @static
     * @param	string	$table
     * @return bool
     */
    public static function hasTable($table){}

    /**
     * Modify a table on the schema.
     *
     * @static
     * @param	string	$table
     * @param	Closure	$callback
     * @return Illuminate\Database\Schema\Blueprint
     */
    public static function table($table, $callback){}

    /**
     * Create a new table on the schema.
     *
     * @static
     * @param	string	$table
     * @param	Closure	$callback
     * @return Illuminate\Database\Schema\Blueprint
     */
    public static function create($table, $callback){}

    /**
     * Drop a table from the schema.
     *
     * @static
     * @param	string	$table
     * @return Illuminate\Database\Schema\Blueprint
     */
    public static function drop($table){}

    /**
     * Drop a table from the schema if it exists.
     *
     * @static
     * @param	string	$table
     * @return Illuminate\Database\Schema\Blueprint
     */
    public static function dropIfExists($table){}

    /**
     * Rename a table on the schema.
     *
     * @static
     * @param	string	$from
     * @param	string	$to
     * @return Illuminate\Database\Schema\Blueprint
     */
    public static function rename($from, $to){}

    /**
     * Execute the blueprint to build / modify the table.
     *
     * @static
     * @param	Illuminate\Database\Schema\Blueprint	$blueprint
     * @return void
     */
    public static function build($blueprint){}

    /**
     * Create a new command set with a Closure.
     *
     * @static
     * @param	string	$table
     * @param	Closure	$callback
     * @return Illuminate\Database\Schema\Blueprint
     */
    public static function createBlueprint($table, $callback = null){}

    /**
     * Get the database connection instance.
     *
     * @static
     * @return Illuminate\Database\Connection
     */
    public static function getConnection(){}

    /**
     * Set the database connection instance.
     *
     * @static
     * @param	Illuminate\Database\Connection
     * @return Illuminate\Database\Schema
     */
    public static function setConnection($connection){}

}

class Seeder extends Illuminate\Database\Seeder{
    /**
     * Run the database seeds.
     *
     * @static
     * @return void
     */
    public static function run(){}

    /**
     * Seed the given connection from the given path.
     *
     * @static
     * @param	string	$class
     * @return void
     */
    public static function call($class){}

    /**
     * Resolve an instance of the given seeder class.
     *
     * @static
     * @param	string	$class
     * @return Illuminate\Database\Seeder
     */
    public static function resolve($class){}

    /**
     * Set the IoC container instance.
     *
     * @static
     * @param	Illuminate\Container\Container	$container
     * @return void
     */
    public static function setContainer($container){}

}

class Session extends Illuminate\Support\Facades\Session{
    /**
     * Get the registered name of the component.
     *
     * @static
     * @return string
     */
    public static function getFacadeAccessor(){}

    /**
     * Hotswap the underlying instance behind the facade.
     *
     * @static
     * @param	mixed	$instance
     * @return void
     */
    public static function swap($instance){}

    /**
     * Initiate a mock expectation on the facade.
     *
     * @static
     * @param	dynamic
     * @return Mockery\Expectation
     */
    public static function shouldReceive(){}

    /**
     * Get the root object behind the facade.
     *
     * @static
     * @return mixed
     */
    public static function getFacadeRoot(){}

    /**
     * Resolve the facade root instance from the container.
     *
     * @static
     * @param	string	$name
     * @return mixed
     */
    public static function resolveFacadeInstance($name){}

    /**
     * Clear all of the resolved instances.
     *
     * @static
     * @return void
     */
    public static function clearResolvedInstances(){}

    /**
     * Get the application instance behind the facade.
     *
     * @static
     * @return Illuminate\Foundation\Application
     */
    public static function getFacadeApplication(){}

    /**
     * Set the application instance.
     *
     * @static
     * @param	Illuminate\Foundation\Application	$app
     * @return void
     */
    public static function setFacadeApplication($app){}

    /**
     * Handle dynamic, static calls to the object.
     *
     * @static
     * @param	string	$method
     * @param	array	$args
     * @return mixed
     */
    public static function __callStatic($method, $args){}

}

class Str extends Illuminate\Support\Str{
    /**
     * Transliterate a UTF-8 value to ASCII.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function ascii($value){}

    /**
     * Convert a value to camel case.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function camel($value){}

    /**
     * Determine if a given string contains a given sub-string.
     *
     * @static
     * @param	string	$haystack
     * @param	string|array	$needle
     * @return bool
     */
    public static function contains($haystack, $needle){}

    /**
     * Determine if a given string ends with a given needle.
     *
     * @static
     * @param	string $haystack
     * @param	string $needle
     * @return bool
     */
    public static function endsWith($haystack, $needle){}

    /**
     * Cap a string with a single instance of a given value.
     *
     * @static
     * @param	string	$value
     * @param	string	$cap
     * @return string
     */
    public static function finish($value, $cap){}

    /**
     * Determine if a given string matches a given pattern.
     *
     * @static
     * @param	string	$pattern
     * @param	string	$value
     * @return bool
     */
    public static function is($pattern, $value){}

    /**
     * Limit the number of characters in a string.
     *
     * @static
     * @param	string	$value
     * @param	int	$limit
     * @param	string	$end
     * @return string
     */
    public static function limit($value, $limit = '100', $end = '...'){}

    /**
     * Get the plural form of an English word.
     *
     * @static
     * @param	string	$value
     * @param	int	$count
     * @return string
     */
    public static function plural($value, $count = '2'){}

    /**
     * Generate a more truly "random" alpha-numeric string.
     *
     * @static
     * @param	int	$length
     * @return string
     */
    public static function random($length = '16'){}

    /**
     * Generate a "random" alpha-numeric string.
    Should not be considered sufficient for cryptography, etc.
     *
     * @static
     * @param	int	$length
     * @return string
     */
    public static function quickRandom($length = '16'){}

    /**
     * Get the singular form of an English word.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function singular($value){}

    /**
     * Generate a URL friendly "slug" from a given string.
     *
     * @static
     * @param	string	$title
     * @param	string	$separator
     * @return string
     */
    public static function slug($title, $separator = '-'){}

    /**
     * Convert a string to snake case.
     *
     * @static
     * @param	string	$value
     * @param	string	$delimiter
     * @return string
     */
    public static function snake($value, $delimiter = '_'){}

    /**
     * Determine if a string starts with a given needle.
     *
     * @static
     * @param	string	$haystack
     * @param	string|array	$needle
     * @return bool
     */
    public static function startsWith($haystack, $needles){}

    /**
     * Convert a value to studly caps case.
     *
     * @static
     * @param	string	$value
     * @return string
     */
    public static function studly($value){}

}

class URL extends Illuminate\Routing\UrlGenerator{
    /**
     * Create a new URL Generator instance.
     *
     * @static
     * @param	Symfony\Component\Routing\RouteCollection	$routes
     * @param	Symfony\Component\HttpFoundation\Request	$request
     * @return void
     */
    public static function __construct($routes, $request){}

    /**
     * Get the current URL for the request.
     *
     * @static
     * @return string
     */
    public static function current(){}

    /**
     * Get the URL for the previous request.
     *
     * @static
     * @return string
     */
    public static function previous(){}

    /**
     * Generate a absolute URL to the given path.
     *
     * @static
     * @param	string	$path
     * @param	array	$parameters
     * @param	bool	$secure
     * @return string
     */
    public static function to($path, $parameters = array(), $secure = null){}

    /**
     * Generate a secure, absolute URL to the given path.
     *
     * @static
     * @param	string	$path
     * @return string
     */
    public static function secure($path, $parameters = array()){}

    /**
     * Generate a URL to an application asset.
     *
     * @static
     * @param	string	$path
     * @param	bool	$secure
     * @return string
     */
    public static function asset($path, $secure = null){}

    /**
     * Generate a URL to a secure asset.
     *
     * @static
     * @param	string	$path
     * @return string
     */
    public static function secureAsset($path){}

    /**
     * Get the scheme for a raw URL.
     *
     * @static
     * @param	bool	$secure
     * @return string
     */
    public static function getScheme($secure){}

    /**
     * Get the URL to a named route.
     *
     * @static
     * @param	string	$name
     * @param	array	$parameters
     * @param	bool	$absolute
     * @return string
     */
    public static function route($name, $parameters = array(), $absolute = true){}

    /**
     * Determine if we're short circuiting the parameter list.
     *
     * @static
     * @param	array	$parameters
     * @return bool
     */
    public static function usingQuickParameters($parameters){}

    /**
     * Build the parameter list for short circuit parameters.
     *
     * @static
     * @param	Illuminate\Routing\Route	$route
     * @param	array	$params
     * @return array
     */
    public static function buildParameterList($route, $params){}

    /**
     * Get the URL to a controller action.
     *
     * @static
     * @param	string	$action
     * @param	array	$parameters
     * @param	bool	$absolute
     * @return string
     */
    public static function action($action, $parameters = array(), $absolute = true){}

    /**
     * Get the base URL for the request.
     *
     * @static
     * @param	string	$scheme
     * @return string
     */
    public static function getRootUrl($scheme){}

    /**
     * Determine if the given path is a valid URL.
     *
     * @static
     * @param	string	$path
     * @return bool
     */
    public static function isValidUrl($path){}

    /**
     * Get the request instance.
     *
     * @static
     * @return Symfony\Component\HttpFoundation\Request
     */
    public static function getRequest(){}

    /**
     * Set the current request instance.
     *
     * @static
     * @param	Symfony\Component\HttpFoundation\Request	$request
     * @return void
     */
    public static function setRequest($request){}

    /**
     * Get the Symfony URL generator instance.
     *
     * @static
     * @return Symfony\Component\Routing\Generator\UrlGenerator
     */
    public static function getGenerator(){}

    /**
     * Get the Symfony URL generator instance.
     *
     * @static
     * @param	Symfony\Component\Routing\Generator\UrlGenerator	$generator
     * @return void
     */
    public static function setGenerator($generator){}

}

class Validator extends Illuminate\Validation\Factory{
    /**
     * Create a new Validator factory instance.
     *
     * @static
     * @param	Symfony\Component\Translation\TranslatorInterface	$translator
     * @return void
     */
    public static function __construct($translator){}

    /**
     * Create a new Validator instance.
     *
     * @static
     * @param	array	$data
     * @param	array	$rules
     * @param	array	$messages
     * @return Illuminate\Validation\Validator
     */
    public static function make($data, $rules, $messages = array()){}

    /**
     * Resolve a new Validator instance.
     *
     * @static
     * @param	array	$data
     * @param	array	$rules
     * @param	array	$messages
     * @return Illuminate\Validation\Validator
     */
    public static function resolve($data, $rules, $messages){}

    /**
     * Register a custom validator extension.
     *
     * @static
     * @param	string	$rule
     * @param	Closure	$extension
     * @return void
     */
    public static function extend($rule, $extension){}

    /**
     * Register a custom implicit validator extension.
     *
     * @static
     * @param	string	$rule
     * @param	Closure $extension
     * @return void
     */
    public static function extendImplicit($rule, $extension){}

    /**
     * Set the Validator instance resolver.
     *
     * @static
     * @param	Closure	$resolver
     * @return void
     */
    public static function resolver($resolver){}

    /**
     * Get the Translator implementation.
     *
     * @static
     * @return Symfony\Component\Translation\TranslatorInterface
     */
    public static function getTranslator(){}

    /**
     * Get the Presence Verifier implementation.
     *
     * @static
     * @return Illuminate\Validation\PresenceVerifierInterface
     */
    public static function getPresenceVerifier(){}

    /**
     * Set the Presence Verifier implementation.
     *
     * @static
     * @param	Illuminate\Validation\PresenceVerifierInterface	$presenceVerifier
     * @return void
     */
    public static function setPresenceVerifier($presenceVerifier){}

}

class View extends Illuminate\View\Environment{
    /**
     * Create a new view environment instance.
     *
     * @static
     * @param	Illuminate\View\Engines\EngineResolver	$engines
     * @param	Illuminate\View\ViewFinderInterface	$finder
     * @param	Illuminate\Events\Dispatcher	$events
     * @return void
     */
    public static function __construct($engines, $finder, $events){}

    /**
     * Get a evaluated view contents for the given view.
     *
     * @static
     * @param	string	$view
     * @param	array	$data
     * @return Illuminate\View\View
     */
    public static function make($view, $data = array()){}

    /**
     * Determine if a given view exists.
     *
     * @static
     * @param	string	$view
     * @return bool
     */
    public static function exists($view){}

    /**
     * Get the rendered contents of a partial from a loop.
     *
     * @static
     * @param	string	$view
     * @param	array	$data
     * @param	string	$iterator
     * @param	string	$empty
     * @return string
     */
    public static function renderEach($view, $data, $iterator, $empty = 'raw|'){}

    /**
     * Get the appropriate view engine for the given path.
     *
     * @static
     * @param	string	$path
     * @return Illuminate\View\Engines\EngineInterface
     */
    public static function getEngineFromPath($path){}

    /**
     * Get the extension used by the view file.
     *
     * @static
     * @param	string	$path
     * @return string
     */
    public static function getExtension($path){}

    /**
     * Add a piece of shared data to the environment.
     *
     * @static
     * @param	string	$key
     * @param	mixed	$value
     * @return void
     */
    public static function share($key, $value){}

    /**
     * Register a view composer event.
     *
     * @static
     * @param	array|string	$views
     * @param	Closure|string	$callback
     * @return Closure
     */
    public static function composer($views, $callback){}

    /**
     * Add a composer for a given view.
     *
     * @static
     * @param	string	$view
     * @param	Closure|string	$callback
     * @return Closure
     */
    public static function addComposer($view, $callback){}

    /**
     * Register a class based view composer.
     *
     * @static
     * @param	string	$view
     * @param	string	$class
     * @return Closure
     */
    public static function addClassComposer($view, $class){}

    /**
     * Build a class based container callback Closure.
     *
     * @static
     * @param	string	$class
     * @return Closure
     */
    public static function buildClassComposerCallback($class){}

    /**
     * Parse a class based composer name.
     *
     * @static
     * @param	string	$class
     * @return array
     */
    public static function parseClassComposer($class){}

    /**
     * Call the composer for a given view.
     *
     * @static
     * @param	Illuminate\View\View	$view
     * @return void
     */
    public static function callComposer($view){}

    /**
     * Start injecting content into a section.
     *
     * @static
     * @param	string	$section
     * @param	string	$content
     * @return void
     */
    public static function startSection($section, $content = ''){}

    /**
     * Inject inline content into a section.
     *
     * @static
     * @param	string	$section
     * @param	string	$content
     * @return void
     */
    public static function inject($section, $content){}

    /**
     * Stop injecting content into a section and return its contents.
     *
     * @static
     * @return string
     */
    public static function yieldSection(){}

    /**
     * Stop injecting content into a section.
     *
     * @static
     * @return string
     */
    public static function stopSection(){}

    /**
     * Append content to a given section.
     *
     * @static
     * @param	string	$section
     * @param	string	$content
     * @return void
     */
    public static function extendSection($section, $content){}

    /**
     * Get the string contents of a section.
     *
     * @static
     * @param	string	$section
     * @return string
     */
    public static function yieldContent($section){}

    /**
     * Flush all of the section contents.
     *
     * @static
     * @return void
     */
    public static function flushSections(){}

    /**
     * Increment the rendering counter.
     *
     * @static
     * @return void
     */
    public static function incrementRender(){}

    /**
     * Decrement the rendering counter.
     *
     * @static
     * @return void
     */
    public static function decrementRender(){}

    /**
     * Check if there are no active render operations.
     *
     * @static
     * @return bool
     */
    public static function doneRendering(){}

    /**
     * Add a location to the array of view locations.
     *
     * @static
     * @param	string	$location
     * @return void
     */
    public static function addLocation($location){}

    /**
     * Add a new namespace to the loader.
     *
     * @static
     * @param	string	$namespace
     * @param	string|array	$hints
     * @return void
     */
    public static function addNamespace($namespace, $hints){}

    /**
     * Register a valid view extension and its engine.
     *
     * @static
     * @param	string	$extension
     * @param	string	$engine
     * @param	Closure	$resolver
     * @return void
     */
    public static function addExtension($extension, $engine, $resolver = null){}

    /**
     * Get the extension to engine bindings.
     *
     * @static
     * @return array
     */
    public static function getExtensions(){}

    /**
     * Get the engine resolver instance.
     *
     * @static
     * @return Illuminate\View\Engines\EngineResolver
     */
    public static function getEngineResolver(){}

    /**
     * Get the view finder instance.
     *
     * @static
     * @return Illuminate\View\ViewFinder
     */
    public static function getFinder(){}

    /**
     * Get the event dispatcher instance.
     *
     * @static
     * @return Illuminate\Events\Dispatcher
     */
    public static function getDispatcher(){}

    /**
     * Get the IoC container instance.
     *
     * @static
     * @return Illuminate\Container
     */
    public static function getContainer(){}

    /**
     * Set the IoC container instance.
     *
     * @static
     * @param	Illuminate\Container	$container
     * @return void
     */
    public static function setContainer($container){}

    /**
     * Get all of the shared data for the environment.
     *
     * @static
     * @return array
     */
    public static function getShared(){}

    /**
     * Get the entire array of sections.
     *
     * @static
     * @return array
     */
    public static function getSections(){}

}

