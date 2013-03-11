<?php die('Only to be used as an helper for your IDE');


if ( ! function_exists('action'))
{
	/**
	 * Generate a URL to a controller action.
	 *
	 * @param  string  $name
	 * @param  string  $parameters
	 * @param  bool    $absolute
	 * @return string
	 */
	function action($name, $parameters = array(), $absolute = true)
	{
		return app('url')->action($name, $parameters, $absolute);
	}
}

if ( ! function_exists('app'))
{
	/**
	 * Get the root Facade application instance.
	 *
	 * @param  string  $make
	 * @return mixed
	 */
	function app($make = null)
	{
		if ($make !== null)
		{
			return app()->make($make);
		}

		return Illuminate\Support\Facades\Facade::getFacadeApplication();
	}
}

if ( ! function_exists('app_path'))
{
	/**
	 * Get the path to the application folder.
	 *
	 * @return  string
	 */
	function app_path()
	{
		return app('path');
	}
}

if ( ! function_exists('array_divide'))
{
	/**
	 * Divide an array into two arrays. One with keys and the other with values.
	 *
	 * @param  array  $array
	 * @return array
	 */
	function array_divide($array)
	{
		return array(array_keys($array), array_values($array));
	}
}

if ( ! function_exists('array_dot'))
{
	/**
	 * Flatten a multi-dimensional associative array with dots.
	 *
	 * @param  array   $array
	 * @param  string  $prepend
	 * @return array
	 */
	function array_dot($array, $prepend = '')
	{
		$results = array();

		foreach ($array as $key => $value)
		{
			if (is_array($value))
			{
				$results = array_merge($results, array_dot($value, $prepend.$key.'.'));
			}
			else
			{
				$results[$prepend.$key] = $value;
			}
		}

		return $results;
	}
}

if ( ! function_exists('array_except'))
{
	/**
	 * Get all of the given array except for a specified array of items.
	 *
	 * @param  array  $array
	 * @param  array  $keys
	 * @return array
	 */
	function array_except($array, $keys)
	{
		return array_diff_key($array, array_flip((array) $keys));
	}
}

if ( ! function_exists('array_first'))
{
	/**
	 * Return the first element in an array passing a given truth test.
	 *
	 * @param  array    $array
	 * @param  Closure  $callback
	 * @param  mixed    $default
	 * @return mixed
	 */
	function array_first($array, $callback, $default = null)
	{
		foreach ($array as $key => $value)
		{
			if (call_user_func($callback, $key, $value)) return $value;
		}

		return value($default);
	}
}

if ( ! function_exists('array_forget'))
{
	/**
	 * Remove an array item from a given array using "dot" notation.
	 *
	 * @param  array   $array
	 * @param  string  $key
	 * @return void
	 */
	function array_forget(&$array, $key)
	{
		$keys = explode('.', $key);

		while (count($keys) > 1)
		{
			$key = array_shift($keys);

			if ( ! isset($array[$key]) or ! is_array($array[$key]))
			{
				return;
			}

			$array =& $array[$key];
		}

		unset($array[array_shift($keys)]);
	}
}

if ( ! function_exists('array_get'))
{
	/**
	 * Get an item from an array using "dot" notation.
	 *
	 * @param  array   $array
	 * @param  string  $key
	 * @param  mixed   $default
	 * @return mixed
	 */
	function array_get($array, $key, $default = null)
	{
		if (is_null($key)) return $array;

		foreach (explode('.', $key) as $segment)
		{
			if ( ! is_array($array) or ! array_key_exists($segment, $array))
			{
				return value($default);
			}

			$array = $array[$segment];
		}

		return $array;
	}
}

if ( ! function_exists('array_only'))
{
	/**
	 * Get a subset of the items from the given array.
	 *
	 * @param  array  $array
	 * @param  array  $keys
	 * @return array
	 */
	function array_only($array, $keys)
	{
		return array_intersect_key($array, array_flip((array) $keys));
	}
}

if ( ! function_exists('array_pluck'))
{
	/**
	 * Pluck an array of values from an array.
	 *
	 * @param  array   $array
	 * @param  string  $key
	 * @return array
	 */
	function array_pluck($array, $key)
	{
		return array_map(function($v) use ($key)
		{
			return is_object($v) ? $v->$key : $v[$key];

		}, $array);
	}
}

if ( ! function_exists('array_set'))
{
	/**
	 * Set an array item to a given value using "dot" notation.
	 *
	 * If no key is given to the method, the entire array will be replaced.
	 *
	 * @param  array   $array
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return void
	 */
	function array_set(&$array, $key, $value)
	{
		if (is_null($key)) return $array = $value;

		$keys = explode('.', $key);

		while (count($keys) > 1)
		{
			$key = array_shift($keys);

			// If the key doesn't exist at this depth, we will just create an empty array
			// to hold the next value, allowing us to create the arrays to hold final
			// values at the correct depth. Then we'll keep digging into the array.
			if ( ! isset($array[$key]) or ! is_array($array[$key]))
			{
				$array[$key] = array();
			}

			$array =& $array[$key];
		}

		$array[array_shift($keys)] = $value;
	}
}

if ( ! function_exists('asset'))
{
	/**
	 * Generate an asset path for the application.
	 *
	 * @param  string  $path
	 * @param  bool    $secure
	 * @return string
	 */
	function asset($path, $secure = null)
	{
		$app = app();

		return $app['url']->asset($path, $secure);
	}
}

if ( ! function_exists('base_path'))
{
	/**
	 * Get the path to the base of the install.
	 *
	 * @return string
	 */
	function base_path()
	{
		return app()->make('path.base');
	}
}

if ( ! function_exists('camel_case'))
{
	/**
	 * Convert a value to camel case.
	 *
	 * @param  string  $value
	 * @return string
	 */
	function camel_case($value)
	{
		return Illuminate\Support\Str::camel($value);
	}
}

if ( ! function_exists('class_basename'))
{
	/**
	 * Get the class "basename" of the given object / class.
	 *
	 * @param  string|object  $class
	 * @return string
	 */
	function class_basename($class)
	{
		$class = is_object($class) ? get_class($class) : $class;

		return basename(str_replace('\\', '/', $class));
	}
}

if ( ! function_exists('csrf_token'))
{
	/**
	 * Get the CSRF token value.
	 *
	 * @return string
	 */
	function csrf_token()
	{
		$app = app();

		if (isset($app['session']))
		{
			return $app['session']->getToken();
		}
		else
		{
			throw new RuntimeException("Application session store not set.");
		}
	}
}

if ( ! function_exists('e'))
{
	/**
	 * Escape HTML entities in a string.
	 *
	 * @param  string  $value
	 * @return string
	 */
	function e($value)
	{
		return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
	}
}

if ( ! function_exists('ends_with'))
{
	/**
	 * Determine if a given string ends with a given needle.
	 *
	 * @param string $haystack
	 * @param string $needle
	 * @return bool
	 */
	function ends_with($haystack, $needle)
	{
		return Illuminate\Support\Str::endsWith($haystack, $needle);
	}
}

if ( ! function_exists('head'))
{
	/**
	 * Get the first element of an array. Useful for method chaining.
	 *
	 * @param  array  $array
	 * @return mixed
	 */
	function head($array)
	{
		return reset($array);
	}
}

if ( ! function_exists('public_path'))
{
	/**
	 * Get the path to the public folder.
	 *
	 * @return string
	 */
	function public_path()
	{
		return app()->make('path.public');
	}
}

if ( ! function_exists('route'))
{
	/**
	 * Generate a URL to a named route.
	 *
	 * @param  string  $route
	 * @param  string  $parameters
	 * @param  bool    $absolute
	 * @return string
	 */
	function route($route, $parameters = array(), $absolute = true)
	{
		$app = app();

		return $app['url']->route($route, $parameters, $absolute);
	}
}

if ( ! function_exists('secure_asset'))
{
	/**
	 * Generate an asset path for the application.
	 *
	 * @param  string  $path
	 * @return string
	 */
	function secure_asset($path)
	{
		return asset($path, true);
	}
}

if ( ! function_exists('secure_url'))
{
	/**
	 * Generate a HTTPS url for the application.
	 *
	 * @param  string  $path
	 * @param  array   $parameters
	 * @return string
	 */
	function secure_url($path, array $parameters = array())
	{
		return url($path, $parameters, true);
	}
}

if ( ! function_exists('snake_case'))
{
	/**
	 * Convert a string to snake case.
	 *
	 * @param  string  $value
	 * @param  string  $delimiter
	 * @return string
	 */
	function snake_case($value, $delimiter = '_')
	{
		return Illuminate\Support\Str::snake($value, $delimiter);
	}
}

if ( ! function_exists('starts_with'))
{
	/**
	 * Determine if a string starts with a given needle.
	 *
	 * @param  string  $haystack
	 * @param  string|array  $needle
	 * @return bool
	 */
	function starts_with($haystack, $needles)
	{
		return Illuminate\Support\Str::startsWith($haystack, $needles);
	}
}

if ( ! function_exists('str_contains'))
{
	/**
	 * Determine if a given string contains a given sub-string.
	 *
	 * @param  string        $haystack
	 * @param  string|array  $needle
	 * @return bool
	 */
	function str_contains($haystack, $needle)
	{
		return Illuminate\Support\Str::contains($haystack, $needle);
	}
}

if ( ! function_exists('str_finish'))
{
	/**
	 * Cap a string with a single instance of a given value.
	 *
	 * @param  string  $value
	 * @param  string  $cap
	 * @return string
	 */
	function str_finish($value, $cap)
	{
		return Illuminate\Support\Str::finish($value, $cap);
	}
}

if ( ! function_exists('str_is'))
{
	/**
	 * Determine if a given string matches a given pattern.
	 *
	 * @param  string  $pattern
	 * @param  string  $value
	 * @return bool
	 */
	function str_is($pattern, $value)
	{
		return Illuminate\Support\Str::is($pattern, $value);
	}
}

if ( ! function_exists('str_plural'))
{
	/**
	 * Get the plural form of an English word.
	 *
	 * @param  string  $value
	 * @param  int  $count
	 * @return string
	 */
	function str_plural($value, $count = 2)
	{
		return Illuminate\Support\Str::plural($value, $count);
	}
}

if ( ! function_exists('str_random'))
{
	/**
	 * Generate a "random" alpha-numeric string.
	 *
	 * Should not be considered sufficient for cryptography, etc.
	 *
	 * @param  int     $length
	 * @return string
	 */
	function str_random($length = 16)
	{
		return Illuminate\Support\Str::random($length);
	}
}

if ( ! function_exists('str_singular'))
{
	/**
	 * Get the singular form of an English word.
	 *
	 * @param  string  $value
	 * @return string
	 */
	function str_singular($value)
	{
		return Illuminate\Support\Str::singular($value);
	}
}

if ( ! function_exists('studly_case'))
{
	/**
	 * Convert a value to studly caps case.
	 *
	 * @param  string  $value
	 * @return string
	 */
	function studly_case($value)
	{
		return Illuminate\Support\Str::studly($value);
	}
}

if ( ! function_exists('trans'))
{
	/**
	 * Translate the given message.
	 *
	 * @param  string  $id
	 * @param  array   $parameters
	 * @param  string  $domain
	 * @param  string  $locale
	 * @return string
	 */
	function trans($id, $parameters = array(), $domain = 'messages', $locale = null)
	{
		$app = app();

		return $app['translator']->trans($id, $parameters, $domain, $locale);
	}
}

if ( ! function_exists('trans_choice'))
{
	/**
	 * Translates the given message based on a count.
	 *
	 * @param  string  $id
	 * @param  int     $number
	 * @param  array   $parameters
	 * @param  string  $domain
	 * @param  string  $locale
	 * @return string
	 */
	function trans_choice($id, $number, array $parameters = array(), $domain = 'messages', $locale = null)
	{
		$app = app();

		return $app['translator']->transChoice($id, $number, $parameters, $domain, $locale);
	}
}

if ( ! function_exists('url'))
{
	/**
	 * Generate a url for the application.
	 *
	 * @param  string  $path
	 * @param  array   $parameters
	 * @param  bool    $secure
	 * @return string
	 */
	function url($path = null, array $parameters = array(), $secure = null)
	{
		$app = app();

		return $app['url']->to($path, $parameters, $secure);
	}
}

if ( ! function_exists('value'))
{
	/**
	 * Return the default value of the given value.
	 *
	 * @param  mixed  $value
	 * @return mixed
	 */
	function value($value)
	{
		return $value instanceof Closure ? $value() : $value;
	}
}

if ( ! function_exists('with'))
{
	/**
	 * Return the given object. Useful for chaining.
	 *
	 * @param  mixed  $object
	 * @return mixed
	 */
	function with($object)
	{
		return $object;
	}
}
 class App{
	/**
	 * @var Illuminate\Foundation\Application $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new Illuminate application instance.
	 *
	 * @static
	 */
	 public static function __construct(){
		self::$realClass->__construct();
	 }

	/**
	 * Bind the installation paths to the application.
	 *
	 * @static
	 * @param	array	$paths
	 */
	 public static function bindInstallPaths($paths){
		self::$realClass->bindInstallPaths($paths);
	 }

	/**
	 * Get the application bootstrap file.
	 *
	 * @static
	 * @return string
	 */
	 public static function getBootstrapFile(){
		return self::$realClass->getBootstrapFile();
	 }

	/**
	 * Register the aliased class loader.
	 *
	 * @static
	 * @param	array	$aliases
	 */
	 public static function registerAliasLoader($aliases){
		self::$realClass->registerAliasLoader($aliases);
	 }

	/**
	 * Start the exception handling for the request.
	 *
	 * @static
	 */
	 public static function startExceptionHandling(){
		self::$realClass->startExceptionHandling();
	 }

	/**
	 * Get the current application environment.
	 *
	 * @static
	 * @return string
	 */
	 public static function environment(){
		return self::$realClass->environment();
	 }

	/**
	 * Detect the application's current environment.
	 *
	 * @static
	 * @param	array|string	$environments
	 * @return string
	 */
	 public static function detectEnvironment($environments){
		return self::$realClass->detectEnvironment($environments);
	 }

	/**
	 * Determine if we are running in the console.
	 *
	 * @static
	 * @return bool
	 */
	 public static function runningInConsole(){
		return self::$realClass->runningInConsole();
	 }

	/**
	 * Determine if we are running unit tests.
	 *
	 * @static
	 * @return bool
	 */
	 public static function runningUnitTests(){
		return self::$realClass->runningUnitTests();
	 }

	/**
	 * Register a service provider with the application.
	 *
	 * @static
	 * @param	Illuminate\Support\ServiceProvider	$provider
	 * @param	array	$options
	 */
	 public static function register($provider, $options = array()){
		self::$realClass->register($provider, $options);
	 }

	/**
	 * Load and boot all of the remaining deferred providers.
	 *
	 * @static
	 */
	 public static function loadDeferredProviders(){
		self::$realClass->loadDeferredProviders();
	 }

	/**
	 * Resolve the given type from the container.
	 * (Overriding Container::make)
	 *
	 * @static
	 * @param	string	$abstract
	 * @param	array	$parameters
	 * @return mixed
	 */
	 public static function make($abstract, $parameters = array()){
		return self::$realClass->make($abstract, $parameters);
	 }

	/**
	 * Register a "before" application filter.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function before($callback){
		self::$realClass->before($callback);
	 }

	/**
	 * Register an "after" application filter.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function after($callback){
		self::$realClass->after($callback);
	 }

	/**
	 * Register a "close" application filter.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function close($callback){
		self::$realClass->close($callback);
	 }

	/**
	 * Register a "finish" application filter.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function finish($callback){
		self::$realClass->finish($callback);
	 }

	/**
	 * Register a "shutdown" callback.
	 *
	 * @static
	 * @param	callable	$callback
	 */
	 public static function shutdown($callback = null){
		self::$realClass->shutdown($callback);
	 }

	/**
	 * Handles the given request and delivers the response.
	 *
	 * @static
	 */
	 public static function run(){
		self::$realClass->run();
	 }

	/**
	 * Handle the given request and get the response.
	 *
	 * @static
	 * @param	Illuminate\Foundation\Request	$request
	 * @return Symfony\Component\HttpFoundation\Response
	 */
	 public static function dispatch($request){
		return self::$realClass->dispatch($request);
	 }

	/**
	 * Handle the given request and get the response.
	 * Provides compatibility with BrowserKit functional testing.
	 *
	 * @static
	 * @param	Illuminate\Foundation\Request	$request
	 * @param	int	$type
	 * @param	bool	$catch
	 * @return Symfony\Component\HttpFoundation\Response
	 */
	 public static function handle($request, $type = '1', $catch = true){
		return self::$realClass->handle($request, $type, $catch);
	 }

	/**
	 * Boot the application's service providers.
	 *
	 * @static
	 */
	 public static function boot(){
		self::$realClass->boot();
	 }

	/**
	 * Register a new boot listener.
	 *
	 * @static
	 * @param	mixed	$callback
	 */
	 public static function booting($callback){
		self::$realClass->booting($callback);
	 }

	/**
	 * Register a new "booted" listener.
	 *
	 * @static
	 * @param	mixed	$callback
	 */
	 public static function booted($callback){
		self::$realClass->booted($callback);
	 }

	/**
	 * Prepare the request by injecting any services.
	 *
	 * @static
	 * @param	Illuminate\Foundation\Request	$request
	 * @return Illuminate\Foundation\Request
	 */
	 public static function prepareRequest($request){
		return self::$realClass->prepareRequest($request);
	 }

	/**
	 * Prepare the given value as a Response object.
	 *
	 * @static
	 * @param	mixed	$value
	 * @param	Illuminate\Foundation\Request	$request
	 * @return Symfony\Component\HttpFoundation\Response
	 */
	 public static function prepareResponse($value, $request){
		return self::$realClass->prepareResponse($value, $request);
	 }

	/**
	 * Set the current application locale.
	 *
	 * @static
	 * @param	string	$locale
	 */
	 public static function setLocale($locale){
		self::$realClass->setLocale($locale);
	 }

	/**
	 * Throw an HttpException with the given data.
	 *
	 * @static
	 * @param	int	$code
	 * @param	string	$message
	 * @param	array	$headers
	 */
	 public static function abort($code, $message = '', $headers = array()){
		self::$realClass->abort($code, $message, $headers);
	 }

	/**
	 * Register a 404 error handler.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function missing($callback){
		self::$realClass->missing($callback);
	 }

	/**
	 * Register an application error handler.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function error($callback){
		self::$realClass->error($callback);
	 }

	/**
	 * Register an error handler for fatal errors.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function fatal($callback){
		self::$realClass->fatal($callback);
	 }

	/**
	 * Get the service providers that have been loaded.
	 *
	 * @static
	 * @return array
	 */
	 public static function getLoadedProviders(){
		return self::$realClass->getLoadedProviders();
	 }

	/**
	 * Set the application's deferred services.
	 *
	 * @static
	 * @param	array	$services
	 */
	 public static function setDeferredServices($services){
		self::$realClass->setDeferredServices($services);
	 }

	/**
	 * Dynamically access application services.
	 *
	 * @static
	 * @param	string	$key
	 * @return mixed
	 */
	 public static function __get($key){
		return self::$realClass->__get($key);
	 }

	/**
	 * Dynamically set application services.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function __set($key, $value){
		self::$realClass->__set($key, $value);
	 }

	/**
	 * Determine if the given abstract type has been bound.
	 *
	 * @static
	 * @param	string	$abstract
	 * @return bool
	 */
	 public static function bound($abstract){
		return self::$realClass->bound($abstract);
	 }

	/**
	 * Register a binding with the container.
	 *
	 * @static
	 * @param	string	$abstract
	 * @param	Closure|string|null	$concrete
	 * @param	bool	$shared
	 */
	 public static function bind($abstract, $concrete = null, $shared = false){
		self::$realClass->bind($abstract, $concrete, $shared);
	 }

	/**
	 * Register a binding if it hasn't already been registered.
	 *
	 * @static
	 * @param	string	$abstract
	 * @param	Closure|string|null	$concrete
	 * @param	bool	$shared
	 * @return bool
	 */
	 public static function bindIf($abstract, $concrete = null, $shared = false){
		return self::$realClass->bindIf($abstract, $concrete, $shared);
	 }

	/**
	 * Register a shared binding in the container.
	 *
	 * @static
	 * @param	string	$abstract
	 * @param	Closure|string|null	$concrete
	 */
	 public static function singleton($abstract, $concrete = null){
		self::$realClass->singleton($abstract, $concrete);
	 }

	/**
	 * Wrap a Closure such that it is shared.
	 *
	 * @static
	 * @param	Closure	$closure
	 * @return Closure
	 */
	 public static function share($closure){
		return self::$realClass->share($closure);
	 }

	/**
	 * "Extend" an abstract type in the container.
	 *
	 * @static
	 * @param	string	$abstract
	 * @param	Closure	$closure
	 */
	 public static function extend($abstract, $closure){
		self::$realClass->extend($abstract, $closure);
	 }

	/**
	 * Register an existing instance as shared in the container.
	 *
	 * @static
	 * @param	string	$abstract
	 * @param	mixed	$instance
	 */
	 public static function instance($abstract, $instance){
		self::$realClass->instance($abstract, $instance);
	 }

	/**
	 * Alias a type to a shorter name.
	 *
	 * @static
	 * @param	string	$abstract
	 * @param	string	$alias
	 */
	 public static function alias($abstract, $alias){
		self::$realClass->alias($abstract, $alias);
	 }

	/**
	 * Instantiate a concrete instance of the given type.
	 *
	 * @static
	 * @param	string	$concrete
	 * @param	array	$parameters
	 * @return mixed
	 */
	 public static function build($concrete, $parameters = array()){
		return self::$realClass->build($concrete, $parameters);
	 }

	/**
	 * Register a new resolving callback.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function resolving($callback){
		self::$realClass->resolving($callback);
	 }

	/**
	 * Get the container's bindings.
	 *
	 * @static
	 * @return array
	 */
	 public static function getBindings(){
		return self::$realClass->getBindings();
	 }

	/**
	 * Determine if a given offset exists.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function offsetExists($key){
		return self::$realClass->offsetExists($key);
	 }

	/**
	 * Get the value at a given offset.
	 *
	 * @static
	 * @param	string	$key
	 * @return mixed
	 */
	 public static function offsetGet($key){
		return self::$realClass->offsetGet($key);
	 }

	/**
	 * Set the value at a given offset.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function offsetSet($key, $value){
		self::$realClass->offsetSet($key, $value);
	 }

	/**
	 * Unset the value at a given offset.
	 *
	 * @static
	 * @param	string	$key
	 */
	 public static function offsetUnset($key){
		self::$realClass->offsetUnset($key);
	 }

}

 class Artisan{
	/**
	 * @var Illuminate\Foundation\Artisan $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new Artisan command runner instance.
	 *
	 * @static
	 * @param	Illuminate\Foundation\Application	$app
	 */
	 public static function __construct($app){
		self::$realClass->__construct($app);
	 }

	/**
	 * Run an Artisan console command by name.
	 *
	 * @static
	 * @param	string	$command
	 * @param	array	$parameters
	 * @param	Symfony\Component\Console\Output\OutputInterface	$output
	 */
	 public static function call($command, $parameters = array(), $output = null){
		self::$realClass->call($command, $parameters, $output);
	 }

	/**
	 * Dynamically pass all missing methods to console Artisan.
	 *
	 * @static
	 * @param	string	$method
	 * @param	array	$parameters
	 * @return mixed
	 */
	 public static function __call($method, $parameters){
		return self::$realClass->__call($method, $parameters);
	 }

}

 class Auth{
	/**
	 * @var Illuminate\Auth\Guard $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new authentication guard.
	 *
	 * @static
	 * @param	Illuminate\Auth\UserProviderInterface	$provider
	 * @param	Illuminate\Session\Store	$session
	 */
	 public static function __construct($provider, $session){
		self::$realClass->__construct($provider, $session);
	 }

	/**
	 * Determine if the current user is authenticated.
	 *
	 * @static
	 * @return bool
	 */
	 public static function check(){
		return self::$realClass->check();
	 }

	/**
	 * Determine if the current user is a guest.
	 *
	 * @static
	 * @return bool
	 */
	 public static function guest(){
		return self::$realClass->guest();
	 }

	/**
	 * Get the currently authenticated user.
	 *
	 * @static
	 * @return Illuminate\Auth\UserInterface|null
	 */
	 public static function user(){
		return self::$realClass->user();
	 }

	/**
	 * Log a user into the application without sessions or cookies.
	 *
	 * @static
	 * @param	array	$credentials
	 * @return bool
	 */
	 public static function stateless($credentials = array()){
		return self::$realClass->stateless($credentials);
	 }

	/**
	 * Validate a user's credentials.
	 *
	 * @static
	 * @param	array	$credentials
	 * @return bool
	 */
	 public static function validate($credentials = array()){
		return self::$realClass->validate($credentials);
	 }

	/**
	 * Attempt to authenticate a user using the given credentials.
	 *
	 * @static
	 * @param	array	$credentials
	 * @param	bool	$remember
	 * @param	bool	$login
	 * @return bool
	 */
	 public static function attempt($credentials = array(), $remember = false, $login = true){
		return self::$realClass->attempt($credentials, $remember, $login);
	 }

	/**
	 * Log a user into the application.
	 *
	 * @static
	 * @param	Illuminate\Auth\UserInterface	$user
	 * @param	bool	$remember
	 */
	 public static function login($user, $remember = false){
		self::$realClass->login($user, $remember);
	 }

	/**
	 * Log the given user ID into the application.
	 *
	 * @static
	 * @param	mixed	$id
	 * @param	bool	$remember
	 * @return Illuminate\Auth\UserInterface
	 */
	 public static function loginUsingId($id, $remember = false){
		return self::$realClass->loginUsingId($id, $remember);
	 }

	/**
	 * Log the user out of the application.
	 *
	 * @static
	 */
	 public static function logout(){
		self::$realClass->logout();
	 }

	/**
	 * Get the cookie creator instance used by the guard.
	 *
	 * @static
	 * @return Illuminate\CookieJar
	 */
	 public static function getCookieJar(){
		return self::$realClass->getCookieJar();
	 }

	/**
	 * Set the cookie creator instance used by the guard.
	 *
	 * @static
	 * @param	Illuminate\CookieJar	$cookie
	 */
	 public static function setCookieJar($cookie){
		self::$realClass->setCookieJar($cookie);
	 }

	/**
	 * Get the event dispatcher instance.
	 *
	 * @static
	 * @return Illuminate\Events\Dispatcher
	 */
	 public static function getDispatcher(){
		return self::$realClass->getDispatcher();
	 }

	/**
	 * Set the event dispatcher instance.
	 *
	 * @static
	 * @param	Illuminate\Events\Dispatcher
	 */
	 public static function setDispatcher($events){
		self::$realClass->setDispatcher($events);
	 }

	/**
	 * Get the session store used by the guard.
	 *
	 * @static
	 * @return Illuminate\Session\Store
	 */
	 public static function getSession(){
		return self::$realClass->getSession();
	 }

	/**
	 * Get the cookies queued by the guard.
	 *
	 * @static
	 * @return array
	 */
	 public static function getQueuedCookies(){
		return self::$realClass->getQueuedCookies();
	 }

	/**
	 * Get the user provider used by the guard.
	 *
	 * @static
	 * @return Illuminate\Auth\UserProviderInterface
	 */
	 public static function getProvider(){
		return self::$realClass->getProvider();
	 }

	/**
	 * Return the currently cached user of the application.
	 *
	 * @static
	 * @return Illuminate\Auth\UserInterface|null
	 */
	 public static function getUser(){
		return self::$realClass->getUser();
	 }

	/**
	 * Set the current user of the application.
	 *
	 * @static
	 * @param	Illuminate\Auth\UserInterface	$user
	 */
	 public static function setUser($user){
		self::$realClass->setUser($user);
	 }

	/**
	 * Get a unique identifier for the auth session value.
	 *
	 * @static
	 * @return string
	 */
	 public static function getName(){
		return self::$realClass->getName();
	 }

	/**
	 * Get the name of the cookie used to store the "recaller".
	 *
	 * @static
	 * @return string
	 */
	 public static function getRecallerName(){
		return self::$realClass->getRecallerName();
	 }

}

 class Blade{
	/**
	 * @var Illuminate\View\Compilers\BladeCompiler $realClass
	 */
	 static private $realClass;

	/**
	 * Compile the view at the given path.
	 *
	 * @static
	 * @param	string	$path
	 */
	 public static function compile($path){
		self::$realClass->compile($path);
	 }

	/**
	 * Compile the given Blade template contents.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function compileString($value){
		return self::$realClass->compileString($value);
	 }

	/**
	 * Register a custom Blade compiler.
	 *
	 * @static
	 * @param	Closure	$compiler
	 */
	 public static function extend($compiler){
		self::$realClass->extend($compiler);
	 }

	/**
	 * Get the regular expression for a generic Blade function.
	 *
	 * @static
	 * @param	string	$function
	 * @return string
	 */
	 public static function createMatcher($function){
		return self::$realClass->createMatcher($function);
	 }

	/**
	 * Get the regular expression for a generic Blade function.
	 *
	 * @static
	 * @param	string	$function
	 * @return string
	 */
	 public static function createOpenMatcher($function){
		return self::$realClass->createOpenMatcher($function);
	 }

	/**
	 * Create a plain Blade matcher.
	 *
	 * @static
	 * @param	string	$function
	 * @return string
	 */
	 public static function createPlainMatcher($function){
		return self::$realClass->createPlainMatcher($function);
	 }

	/**
	 * Sets the content tags used for the compiler.
	 *
	 * @static
	 * @param	string	$openTag
	 * @param	string	$closeTag
	 * @param	array	$raw
	 */
	 public static function setContentTags($openTag, $closeTag, $raw = false){
		self::$realClass->setContentTags($openTag, $closeTag, $raw);
	 }

	/**
	 * Sets the raw content tags used for the compiler.
	 *
	 * @static
	 * @param	string	$openTag
	 * @param	string	$closeTag
	 */
	 public static function setEscapedContentTags($openTag, $closeTag){
		self::$realClass->setEscapedContentTags($openTag, $closeTag);
	 }

	/**
	 * Create a new compiler instance.
	 *
	 * @static
	 * @param	string	$cachePath
	 */
	 public static function __construct($files, $cachePath){
		self::$realClass->__construct($files, $cachePath);
	 }

	/**
	 * Get the path to the compiled version of a view.
	 *
	 * @static
	 * @param	string	$path
	 * @return string
	 */
	 public static function getCompiledPath($path){
		return self::$realClass->getCompiledPath($path);
	 }

	/**
	 * Determine if the view at the given path is expired.
	 *
	 * @static
	 * @param	string	$path
	 * @return bool
	 */
	 public static function isExpired($path){
		return self::$realClass->isExpired($path);
	 }

}

 class Cache{
	/**
	 * @var Illuminate\Cache\Store $realClass
	 */
	 static private $realClass;

	/**
	 * Determine if an item exists in the cache.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function has($key){
		return self::$realClass->has($key);
	 }

	/**
	 * Retrieve an item from the cache by key.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return mixed
	 */
	 public static function get($key, $default = null){
		return self::$realClass->get($key, $default);
	 }

	/**
	 * Store an item in the cache.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 * @param	int	$minutes
	 */
	 public static function put($key, $value, $minutes){
		self::$realClass->put($key, $value, $minutes);
	 }

	/**
	 * Store an item in the cache indefinitely.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function forever($key, $value){
		self::$realClass->forever($key, $value);
	 }

	/**
	 * Get an item from the cache, or store the default value.
	 *
	 * @static
	 * @param	string	$key
	 * @param	int	$minutes
	 * @param	Closure	$callback
	 * @return 
	 */
	 public static function remember($key, $minutes, $callback){
		return self::$realClass->remember($key, $minutes, $callback);
	 }

	/**
	 * Get an item from the cache, or store the default value forever.
	 *
	 * @static
	 * @param	string	$key
	 * @param	Closure	$callback
	 * @return 
	 */
	 public static function rememberForever($key, $callback){
		return self::$realClass->rememberForever($key, $callback);
	 }

	/**
	 * Remove an item from the cache.
	 *
	 * @static
	 * @param	string	$key
	 */
	 public static function forget($key){
		self::$realClass->forget($key);
	 }

	/**
	 * Remove all items from the cache.
	 *
	 * @static
	 */
	 public static function flush(){
		self::$realClass->flush();
	 }

	/**
	 * Get the default cache time.
	 *
	 * @static
	 * @return int
	 */
	 public static function getDefaultCacheTime(){
		return self::$realClass->getDefaultCacheTime();
	 }

	/**
	 * Set the default cache time in minutes.
	 *
	 * @static
	 * @param	int	$minutes
	 */
	 public static function setDefaultCacheTime($minutes){
		self::$realClass->setDefaultCacheTime($minutes);
	 }

	/**
	 * Determine if an item is in memory.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function existsInMemory($key){
		return self::$realClass->existsInMemory($key);
	 }

	/**
	 * Get all of the values in memory.
	 *
	 * @static
	 * @return array
	 */
	 public static function getMemory(){
		return self::$realClass->getMemory();
	 }

	/**
	 * Get the value of an item in memory.
	 *
	 * @static
	 * @param	string	$key
	 * @return mixed
	 */
	 public static function getFromMemory($key){
		return self::$realClass->getFromMemory($key);
	 }

	/**
	 * Set the value of an item in memory.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function setInMemory($key, $value){
		self::$realClass->setInMemory($key, $value);
	 }

	/**
	 * Determine if a cached value exists.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function offsetExists($key){
		return self::$realClass->offsetExists($key);
	 }

	/**
	 * Retrieve an item from the cache by key.
	 *
	 * @static
	 * @param	string	$key
	 * @return mixed
	 */
	 public static function offsetGet($key){
		return self::$realClass->offsetGet($key);
	 }

	/**
	 * Store an item in the cache for the default time.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function offsetSet($key, $value){
		self::$realClass->offsetSet($key, $value);
	 }

	/**
	 * Remove an item from the cache.
	 *
	 * @static
	 * @param	string	$key
	 */
	 public static function offsetUnset($key){
		self::$realClass->offsetUnset($key);
	 }

}

 class ClassLoader{
	/**
	 * @var Illuminate\Support\ClassLoader $realClass
	 */
	 static private $realClass;

	/**
	 * Load the given class file.
	 *
	 * @static
	 * @param	string	$class
	 */
	 public static function load($class){
		self::$realClass->load($class);
	 }

	/**
	 * Get the normal file name for a class.
	 *
	 * @static
	 * @param	string	$class
	 * @return string
	 */
	 public static function normalizeClass($class){
		return self::$realClass->normalizeClass($class);
	 }

	/**
	 * Register the given class loader on the auto-loader stack.
	 *
	 * @static
	 */
	 public static function register(){
		self::$realClass->register();
	 }

	/**
	 * Add directories to the class loader.
	 *
	 * @static
	 * @param	string|array	$directories
	 */
	 public static function addDirectories($directories){
		self::$realClass->addDirectories($directories);
	 }

	/**
	 * Remove directories from the class loader.
	 *
	 * @static
	 * @param	string|array	$directories
	 */
	 public static function removeDirectories($directories = null){
		self::$realClass->removeDirectories($directories);
	 }

	/**
	 * Gets all the directories registered with the loader.
	 *
	 * @static
	 * @return array
	 */
	 public static function getDirectories(){
		return self::$realClass->getDirectories();
	 }

}

 class Config{
	/**
	 * @var Illuminate\Config\Repository $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new configuration repository.
	 *
	 * @static
	 * @param	Illuminate\Config\LoaderInterface	$loader
	 * @param	string	$environment
	 */
	 public static function __construct($loader, $environment){
		self::$realClass->__construct($loader, $environment);
	 }

	/**
	 * Determine if the given configuration value exists.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function has($key){
		return self::$realClass->has($key);
	 }

	/**
	 * Determine if a configuration group exists.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function hasGroup($key){
		return self::$realClass->hasGroup($key);
	 }

	/**
	 * Get the specified configuration value.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return mixed
	 */
	 public static function get($key, $default = null){
		return self::$realClass->get($key, $default);
	 }

	/**
	 * Set a given configuration value.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function set($key, $value){
		self::$realClass->set($key, $value);
	 }

	/**
	 * Register a package for cascading configuration.
	 *
	 * @static
	 * @param	string	$package
	 * @param	string	$hint
	 * @param	string	$namespace
	 */
	 public static function package($package, $hint, $namespace = null){
		self::$realClass->package($package, $hint, $namespace);
	 }

	/**
	 * Register an after load callback for a given namespace.
	 *
	 * @static
	 * @param	string	$namespace
	 * @param	Closure	$callback
	 */
	 public static function afterLoading($namespace, $callback){
		self::$realClass->afterLoading($namespace, $callback);
	 }

	/**
	 * Add a new namespace to the loader.
	 *
	 * @static
	 * @param	string	$namespace
	 * @param	string	$hint
	 */
	 public static function addNamespace($namespace, $hint){
		self::$realClass->addNamespace($namespace, $hint);
	 }

	/**
	 * Returns all registered namespaces with the config
	 * loader.
	 *
	 * @static
	 * @return array
	 */
	 public static function getNamespaces(){
		return self::$realClass->getNamespaces();
	 }

	/**
	 * Get the loader implementation.
	 *
	 * @static
	 * @return Illuminate\Config\LoaderInterface
	 */
	 public static function getLoader(){
		return self::$realClass->getLoader();
	 }

	/**
	 * Set the loader implementation.
	 *
	 * @static
	 * @return Illuminate\Config\LoaderInterface
	 */
	 public static function setLoader($loader){
		return self::$realClass->setLoader($loader);
	 }

	/**
	 * Get the current configuration environment.
	 *
	 * @static
	 * @return string
	 */
	 public static function getEnvironment(){
		return self::$realClass->getEnvironment();
	 }

	/**
	 * Get the after load callback array.
	 *
	 * @static
	 * @return array
	 */
	 public static function getAfterLoadCallbacks(){
		return self::$realClass->getAfterLoadCallbacks();
	 }

	/**
	 * Get all of the configuration items.
	 *
	 * @static
	 * @return array
	 */
	 public static function getItems(){
		return self::$realClass->getItems();
	 }

	/**
	 * Determine if the given configuration option exists.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function offsetExists($key){
		return self::$realClass->offsetExists($key);
	 }

	/**
	 * Get a configuration option.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function offsetGet($key){
		return self::$realClass->offsetGet($key);
	 }

	/**
	 * Set a configuration option.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function offsetSet($key, $value){
		return self::$realClass->offsetSet($key, $value);
	 }

	/**
	 * Unset a configuration option.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function offsetUnset($key){
		return self::$realClass->offsetUnset($key);
	 }

	/**
	 * Parse a key into namespace, group, and item.
	 *
	 * @static
	 * @param	string	$key
	 * @return array
	 */
	 public static function parseKey($key){
		return self::$realClass->parseKey($key);
	 }

	/**
	 * Set the parsed value of a key.
	 *
	 * @static
	 * @param	string	$key
	 * @param	array	$parsed
	 */
	 public static function setParsedKey($key, $parsed){
		self::$realClass->setParsedKey($key, $parsed);
	 }

}

 class Controller{
	/**
	 * @var Illuminate\Routing\Controllers\Controller $realClass
	 */
	 static private $realClass;

	/**
	 * Register a new "before" filter on the controller.
	 *
	 * @static
	 * @param	string	$filter
	 * @param	array	$options
	 */
	 public static function beforeFilter($filter, $options = array()){
		self::$realClass->beforeFilter($filter, $options);
	 }

	/**
	 * Register a new "after" filter on the controller.
	 *
	 * @static
	 * @param	string	$filter
	 * @param	array	$options
	 */
	 public static function afterFilter($filter, $options = array()){
		self::$realClass->afterFilter($filter, $options);
	 }

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
	 public static function callAction($container, $router, $method, $parameters){
		return self::$realClass->callAction($container, $router, $method, $parameters);
	 }

	/**
	 * Get the code registered filters.
	 *
	 * @static
	 * @return array
	 */
	 public static function getControllerFilters(){
		return self::$realClass->getControllerFilters();
	 }

	/**
	 * Handle calls to missing methods on the controller.
	 *
	 * @static
	 * @param	array	$parameters
	 * @return mixed
	 */
	 public static function missingMethod($parameters){
		return self::$realClass->missingMethod($parameters);
	 }

	/**
	 * Handle calls to missing methods on the controller.
	 *
	 * @static
	 * @param	string	$method
	 * @param	array	$parameters
	 * @return mixed
	 */
	 public static function __call($method, $parameters){
		return self::$realClass->__call($method, $parameters);
	 }

}

 class Cookie{
	/**
	 * @var Illuminate\Cookie\CookieJar $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new cookie manager instance.
	 *
	 * @static
	 * @param	Symfony\Component\HttpFoundation\Request	$request
	 * @param	Illuminate\Encryption\Encrypter	$encrypter
	 * @param	array	$defaults
	 */
	 public static function __construct($request, $encrypter, $defaults){
		self::$realClass->__construct($request, $encrypter, $defaults);
	 }

	/**
	 * Determine if a cookie exists and is not null.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function has($key){
		return self::$realClass->has($key);
	 }

	/**
	 * Get the value of the given cookie.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return mixed
	 */
	 public static function get($key, $default = null){
		return self::$realClass->get($key, $default);
	 }

	/**
	 * Create a new cookie instance.
	 *
	 * @static
	 * @param	string	$name
	 * @param	string	$value
	 * @param	int	$minutes
	 * @return Symfony\Component\HttpFoundation\Cookie
	 */
	 public static function make($name, $value, $minutes = '0'){
		return self::$realClass->make($name, $value, $minutes);
	 }

	/**
	 * Create a cookie that lasts "forever" (five years).
	 *
	 * @static
	 * @param	string	$name
	 * @param	string	$value
	 * @return Symfony\Component\HttpFoundation\Cookie
	 */
	 public static function forever($name, $value){
		return self::$realClass->forever($name, $value);
	 }

	/**
	 * Expire the given cookie.
	 *
	 * @static
	 * @param	string	$name
	 * @return Symfony\Component\HttpFoundation\Cookie
	 */
	 public static function forget($name){
		return self::$realClass->forget($name);
	 }

	/**
	 * Set the value of a cookie option.
	 *
	 * @static
	 * @param	string	$option
	 * @param	string	$value
	 */
	 public static function setDefault($option, $value){
		self::$realClass->setDefault($option, $value);
	 }

	/**
	 * Get the request instance.
	 *
	 * @static
	 * @return Symfony\Component\HttpFoundation\Request
	 */
	 public static function getRequest(){
		return self::$realClass->getRequest();
	 }

	/**
	 * Get the encrypter instance.
	 *
	 * @static
	 * @return Illuminate\Encrypter
	 */
	 public static function getEncrypter(){
		return self::$realClass->getEncrypter();
	 }

}

 class Crypt{
	/**
	 * @var Illuminate\Encryption\Encrypter $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new encrypter instance.
	 *
	 * @static
	 * @param	string	$key
	 */
	 public static function __construct($key){
		self::$realClass->__construct($key);
	 }

	/**
	 * Encrypt the given value.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function encrypt($value){
		return self::$realClass->encrypt($value);
	 }

	/**
	 * Decrypt the given value.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function decrypt($payload){
		return self::$realClass->decrypt($payload);
	 }

}

 class DB{
	/**
	 * @var Illuminate\Database\Connection $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new database connection instance.
	 *
	 * @static
	 * @param	PDO	$pdo
	 * @param	string	$database
	 * @param	string	$tablePrefix
	 * @param	string	$name
	 */
	 public static function __construct($pdo, $database = '', $tablePrefix = '', $name = null){
		self::$realClass->__construct($pdo, $database, $tablePrefix, $name);
	 }

	/**
	 * Set the query grammar to the default implementation.
	 *
	 * @static
	 */
	 public static function useDefaultQueryGrammar(){
		self::$realClass->useDefaultQueryGrammar();
	 }

	/**
	 * Set the schema grammar to the default implementation.
	 *
	 * @static
	 */
	 public static function useDefaultSchemaGrammar(){
		self::$realClass->useDefaultSchemaGrammar();
	 }

	/**
	 * Set the query post processor to the default implementation.
	 *
	 * @static
	 */
	 public static function useDefaultPostProcessor(){
		self::$realClass->useDefaultPostProcessor();
	 }

	/**
	 * Get a schema builder instance for the connection.
	 *
	 * @static
	 * @return Illuminate\Database\Schema\Builder
	 */
	 public static function getSchemaBuilder(){
		return self::$realClass->getSchemaBuilder();
	 }

	/**
	 * Begin a fluent query against a database table.
	 *
	 * @static
	 * @param	string	$table
	 * @return Illuminate\Database\Query\Builder
	 */
	 public static function table($table){
		return self::$realClass->table($table);
	 }

	/**
	 * Get a new raw query expression.
	 *
	 * @static
	 * @param	mixed	$value
	 * @return Illuminate\Database\Query\Expression
	 */
	 public static function raw($value){
		return self::$realClass->raw($value);
	 }

	/**
	 * Run a select statement and return a single result.
	 *
	 * @static
	 * @param	string	$query
	 * @param	array	$bindings
	 * @return mixed
	 */
	 public static function selectOne($query, $bindings = array()){
		return self::$realClass->selectOne($query, $bindings);
	 }

	/**
	 * Run a select statement against the database.
	 *
	 * @static
	 * @param	string	$query
	 * @param	array	$bindings
	 * @return array
	 */
	 public static function select($query, $bindings = array()){
		return self::$realClass->select($query, $bindings);
	 }

	/**
	 * Run an insert statement against the database.
	 *
	 * @static
	 * @param	string	$query
	 * @param	array	$bindings
	 * @return bool
	 */
	 public static function insert($query, $bindings = array()){
		return self::$realClass->insert($query, $bindings);
	 }

	/**
	 * Run an update statement against the database.
	 *
	 * @static
	 * @param	string	$query
	 * @param	array	$bindings
	 * @return int
	 */
	 public static function update($query, $bindings = array()){
		return self::$realClass->update($query, $bindings);
	 }

	/**
	 * Run a delete statement against the database.
	 *
	 * @static
	 * @param	string	$query
	 * @param	array	$bindings
	 * @return int
	 */
	 public static function delete($query, $bindings = array()){
		return self::$realClass->delete($query, $bindings);
	 }

	/**
	 * Execute an SQL statement and return the boolean result.
	 *
	 * @static
	 * @param	string	$query
	 * @param	array	$bindings
	 * @return bool
	 */
	 public static function statement($query, $bindings = array()){
		return self::$realClass->statement($query, $bindings);
	 }

	/**
	 * Run an SQL statement and get the number of rows affected.
	 *
	 * @static
	 * @param	string	$query
	 * @param	array	$bindings
	 * @return int
	 */
	 public static function affectingStatement($query, $bindings = array()){
		return self::$realClass->affectingStatement($query, $bindings);
	 }

	/**
	 * Run a raw, unprepared query against the PDO connection.
	 *
	 * @static
	 * @param	string	$query
	 * @return bool
	 */
	 public static function unprepared($query){
		return self::$realClass->unprepared($query);
	 }

	/**
	 * Prepare the query bindings for execution.
	 *
	 * @static
	 * @param	array	$bindings
	 * @return array
	 */
	 public static function prepareBindings($bindings){
		return self::$realClass->prepareBindings($bindings);
	 }

	/**
	 * Execute a Closure within a transaction.
	 *
	 * @static
	 * @param	Closure	$callback
	 * @return mixed
	 */
	 public static function transaction($callback){
		return self::$realClass->transaction($callback);
	 }

	/**
	 * Execute the given callback in "dry run" mode.
	 *
	 * @static
	 * @param	Closure	$callback
	 * @return array
	 */
	 public static function pretend($callback){
		return self::$realClass->pretend($callback);
	 }

	/**
	 * Log a query in the connection's query log.
	 *
	 * @static
	 * @param	string	$query
	 * @param	array	$bindings
	 */
	 public static function logQuery($query, $bindings, $time = null){
		self::$realClass->logQuery($query, $bindings, $time);
	 }

	/**
	 * Get the currently used PDO connection.
	 *
	 * @static
	 * @return PDO
	 */
	 public static function getPdo(){
		return self::$realClass->getPdo();
	 }

	/**
	 * Get the database connection name.
	 *
	 * @static
	 * @return string|null
	 */
	 public static function getName(){
		return self::$realClass->getName();
	 }

	/**
	 * Get the PDO driver name.
	 *
	 * @static
	 * @return string
	 */
	 public static function getDriverName(){
		return self::$realClass->getDriverName();
	 }

	/**
	 * Get the query grammar used by the connection.
	 *
	 * @static
	 * @return Illuminate\Database\Query\Grammars\Grammar
	 */
	 public static function getQueryGrammar(){
		return self::$realClass->getQueryGrammar();
	 }

	/**
	 * Set the query grammar used by the connection.
	 *
	 * @static
	 * @param	Illuminate\Database\Query\Grammars\Grammar
	 */
	 public static function setQueryGrammar($grammar){
		self::$realClass->setQueryGrammar($grammar);
	 }

	/**
	 * Get the schema grammar used by the connection.
	 *
	 * @static
	 * @return Illuminate\Database\Query\Grammars\Grammar
	 */
	 public static function getSchemaGrammar(){
		return self::$realClass->getSchemaGrammar();
	 }

	/**
	 * Set the schema grammar used by the connection.
	 *
	 * @static
	 * @param	Illuminate\Database\Schema\Grammars\Grammar
	 */
	 public static function setSchemaGrammar($grammar){
		self::$realClass->setSchemaGrammar($grammar);
	 }

	/**
	 * Get the query post processor used by the connection.
	 *
	 * @static
	 * @return Illuminate\Database\Query\Processors\Processor
	 */
	 public static function getPostProcessor(){
		return self::$realClass->getPostProcessor();
	 }

	/**
	 * Set the query post processor used by the connection.
	 *
	 * @static
	 * @param	Illuminate\Database\Query\Processors\Processor
	 */
	 public static function setPostProcessor($processor){
		self::$realClass->setPostProcessor($processor);
	 }

	/**
	 * Get the event dispatcher used by the connection.
	 *
	 * @static
	 * @return Illuminate\Events\Dispatcher
	 */
	 public static function getEventDispatcher(){
		return self::$realClass->getEventDispatcher();
	 }

	/**
	 * Set the event dispatcher instance on the connection.
	 *
	 * @static
	 * @param	Illuminate\Events\Dispatcher
	 */
	 public static function setEventDispatcher($events){
		self::$realClass->setEventDispatcher($events);
	 }

	/**
	 * Get the paginator environment instance.
	 *
	 * @static
	 * @return Illuminate\Pagination\Environment
	 */
	 public static function getPaginator(){
		return self::$realClass->getPaginator();
	 }

	/**
	 * Set the pagination environment instance.
	 *
	 * @static
	 * @param	Illuminate\Pagination\Environment|Closure	$paginator
	 */
	 public static function setPaginator($paginator){
		self::$realClass->setPaginator($paginator);
	 }

	/**
	 * Determine if the connection in a "dry run".
	 *
	 * @static
	 * @return bool
	 */
	 public static function pretending(){
		return self::$realClass->pretending();
	 }

	/**
	 * Get the default fetch mode for the connection.
	 *
	 * @static
	 * @return int
	 */
	 public static function getFetchMode(){
		return self::$realClass->getFetchMode();
	 }

	/**
	 * Set the default fetch mode for the connection.
	 *
	 * @static
	 * @param	int	$fetchMode
	 * @return int
	 */
	 public static function setFetchMode($fetchMode){
		return self::$realClass->setFetchMode($fetchMode);
	 }

	/**
	 * Get the connection query log.
	 *
	 * @static
	 * @return array
	 */
	 public static function getQueryLog(){
		return self::$realClass->getQueryLog();
	 }

	/**
	 * Clear the query log.
	 *
	 * @static
	 */
	 public static function flushQueryLog(){
		self::$realClass->flushQueryLog();
	 }

	/**
	 * Get the name of the connected database.
	 *
	 * @static
	 * @return string
	 */
	 public static function getDatabaseName(){
		return self::$realClass->getDatabaseName();
	 }

	/**
	 * Set the name of the connected database.
	 *
	 * @static
	 * @param	string	$database
	 * @return string
	 */
	 public static function setDatabaseName($database){
		return self::$realClass->setDatabaseName($database);
	 }

	/**
	 * Get the table prefix for the connection.
	 *
	 * @static
	 * @return string
	 */
	 public static function getTablePrefix(){
		return self::$realClass->getTablePrefix();
	 }

	/**
	 * Set the table prefix in use by the connection.
	 *
	 * @static
	 * @param	string	$prefix
	 */
	 public static function setTablePrefix($prefix){
		self::$realClass->setTablePrefix($prefix);
	 }

	/**
	 * Set the table prefix and return the grammar.
	 *
	 * @static
	 * @param	Illuminate\Database\Grammar	$grammar
	 * @return Illuminate\Database\Grammar
	 */
	 public static function withTablePrefix($grammar){
		return self::$realClass->withTablePrefix($grammar);
	 }

}

 class Eloquent{
	/**
	 * @var Illuminate\Database\Eloquent\Model $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new Eloquent model instance.
	 *
	 * @static
	 * @param	array	$attributes
	 */
	 public static function __construct($attributes = array()){
		self::$realClass->__construct($attributes);
	 }

	/**
	 * Fill the model with an array of attributes.
	 *
	 * @static
	 * @param	array	$attributes
	 * @return Illuminate\Database\Eloquent\Model
	 */
	 public static function fill($attributes){
		return self::$realClass->fill($attributes);
	 }

	/**
	 * Create a new instance of the given model.
	 *
	 * @static
	 * @param	array	$attributes
	 * @param	bool	$exists
	 * @return Illuminate\Database\Eloquent\Model
	 */
	 public static function newInstance($attributes = array(), $exists = false){
		return self::$realClass->newInstance($attributes, $exists);
	 }

	/**
	 * Create a new model instance that is existing.
	 *
	 * @static
	 * @param	array	$attributes
	 * @return Illuminate\Database\Eloquent\Model
	 */
	 public static function newExisting($attributes = array()){
		return self::$realClass->newExisting($attributes);
	 }

	/**
	 * Save a new model and return the instance.
	 *
	 * @static
	 * @param	array	$attributes
	 * @return Illuminate\Database\Eloquent\Model
	 */
	 public static function create($attributes){
		return self::$realClass->create($attributes);
	 }

	/**
	 * Begin querying the model on a given connection.
	 *
	 * @static
	 * @param	string	$connection
	 * @return Illuminate\Database\Eloquent\Builder
	 */
	 public static function on($connection){
		return self::$realClass->on($connection);
	 }

	/**
	 * Get all of the models from the database.
	 *
	 * @static
	 * @param	array	$columns
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	 public static function all($columns = array()){
		return self::$realClass->all($columns);
	 }

	/**
	 * Find a model by its primary key.
	 *
	 * @static
	 * @param	mixed	$id
	 * @param	array	$columns
	 * @return Illuminate\Database\Eloquent\Model|Collection
	 */
	 public static function find($id, $columns = array()){
		return self::$realClass->find($id, $columns);
	 }

	/**
	 * Being querying a model with eager loading.
	 *
	 * @static
	 * @param	array	$relations
	 * @return Illuminate\Database\Eloquent\Builder
	 */
	 public static function with($relations){
		return self::$realClass->with($relations);
	 }

	/**
	 * Define a one-to-one relationship.
	 *
	 * @static
	 * @param	string	$related
	 * @param	string	$foreignKey
	 * @return Illuminate\Database\Eloquent\Relation\HasOne
	 */
	 public static function hasOne($related, $foreignKey = null){
		return self::$realClass->hasOne($related, $foreignKey);
	 }

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
	 public static function morphOne($related, $name, $type = null, $id = null){
		return self::$realClass->morphOne($related, $name, $type, $id);
	 }

	/**
	 * Define an inverse one-to-one or many relationship.
	 *
	 * @static
	 * @param	string	$related
	 * @param	string	$foreignKey
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	 public static function belongsTo($related, $foreignKey = null){
		return self::$realClass->belongsTo($related, $foreignKey);
	 }

	/**
	 * Define an polymorphic, inverse one-to-one or many relationship.
	 *
	 * @static
	 * @param	string	$name
	 * @param	string	$type
	 * @param	string	$id
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	 public static function morphTo($name = null, $type = null, $id = null){
		return self::$realClass->morphTo($name, $type, $id);
	 }

	/**
	 * Define a one-to-many relationship.
	 *
	 * @static
	 * @param	string	$related
	 * @param	string	$foreignKey
	 * @return Illuminate\Database\Eloquent\Relations\HasMany
	 */
	 public static function hasMany($related, $foreignKey = null){
		return self::$realClass->hasMany($related, $foreignKey);
	 }

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
	 public static function morphMany($related, $name, $type = null, $id = null){
		return self::$realClass->morphMany($related, $name, $type, $id);
	 }

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
	 public static function belongsToMany($related, $table = null, $foreignKey = null, $otherKey = null){
		return self::$realClass->belongsToMany($related, $table, $foreignKey, $otherKey);
	 }

	/**
	 * Get the joining table name for a many-to-many relation.
	 *
	 * @static
	 * @param	string	$related
	 * @return string
	 */
	 public static function joiningTable($related){
		return self::$realClass->joiningTable($related);
	 }

	/**
	 * Delete the model from the database.
	 *
	 * @static
	 */
	 public static function delete(){
		self::$realClass->delete();
	 }

	/**
	 * Register an updating model event with the dispatcher.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function updating($callback){
		self::$realClass->updating($callback);
	 }

	/**
	 * Register an updated model event with the dispatcher.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function updated($callback){
		self::$realClass->updated($callback);
	 }

	/**
	 * Register a creating model event with the dispatcher.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function creating($callback){
		self::$realClass->creating($callback);
	 }

	/**
	 * Register a created model event with the dispatcher.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function created($callback){
		self::$realClass->created($callback);
	 }

	/**
	 * Save the model to the database.
	 *
	 * @static
	 * @return bool
	 */
	 public static function save(){
		return self::$realClass->save();
	 }

	/**
	 * Update the model's update timestamp.
	 *
	 * @static
	 * @return bool
	 */
	 public static function touch(){
		return self::$realClass->touch();
	 }

	/**
	 * Set the value of the "created at" attribute.
	 *
	 * @static
	 * @param	mixed	$value
	 */
	 public static function setCreatedAt($value){
		self::$realClass->setCreatedAt($value);
	 }

	/**
	 * Set the value of the "updated at" attribute.
	 *
	 * @static
	 * @param	mixed	$value
	 */
	 public static function setUpdatedAt($value){
		self::$realClass->setUpdatedAt($value);
	 }

	/**
	 * Get the name of the "created at" column.
	 *
	 * @static
	 * @return string
	 */
	 public static function getCreatedAtColumn(){
		return self::$realClass->getCreatedAtColumn();
	 }

	/**
	 * Get the name of the "updated at" column.
	 *
	 * @static
	 * @return string
	 */
	 public static function getUpdatedAtColumn(){
		return self::$realClass->getUpdatedAtColumn();
	 }

	/**
	 * Get a fresh timestamp for the model.
	 *
	 * @static
	 * @return mixed
	 */
	 public static function freshTimestamp(){
		return self::$realClass->freshTimestamp();
	 }

	/**
	 * Get a new query builder for the model's table.
	 *
	 * @static
	 * @return Illuminate\Database\Eloquent\Builder
	 */
	 public static function newQuery(){
		return self::$realClass->newQuery();
	 }

	/**
	 * Create a new Eloquent Collection instance.
	 *
	 * @static
	 * @param	array	$models
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	 public static function newCollection($models = array()){
		return self::$realClass->newCollection($models);
	 }

	/**
	 * Get the table associated with the model.
	 *
	 * @static
	 * @return string
	 */
	 public static function getTable(){
		return self::$realClass->getTable();
	 }

	/**
	 * Set the table associated with the model.
	 *
	 * @static
	 * @param	string	$table
	 */
	 public static function setTable($table){
		self::$realClass->setTable($table);
	 }

	/**
	 * Get the value of the model's primary key.
	 *
	 * @static
	 * @return mixed
	 */
	 public static function getKey(){
		return self::$realClass->getKey();
	 }

	/**
	 * Get the primary key for the model.
	 *
	 * @static
	 * @return string
	 */
	 public static function getKeyName(){
		return self::$realClass->getKeyName();
	 }

	/**
	 * Determine if the model uses timestamps.
	 *
	 * @static
	 * @return bool
	 */
	 public static function usesTimestamps(){
		return self::$realClass->usesTimestamps();
	 }

	/**
	 * Get the number of models to return per page.
	 *
	 * @static
	 * @return int
	 */
	 public static function getPerPage(){
		return self::$realClass->getPerPage();
	 }

	/**
	 * Set the number of models ot return per page.
	 *
	 * @static
	 * @param	int	$perPage
	 */
	 public static function setPerPage($perPage){
		self::$realClass->setPerPage($perPage);
	 }

	/**
	 * Get the default foreign key name for the model.
	 *
	 * @static
	 * @return string
	 */
	 public static function getForeignKey(){
		return self::$realClass->getForeignKey();
	 }

	/**
	 * Get the hidden attributes for the model.
	 *
	 * @static
	 * @return array
	 */
	 public static function getHidden(){
		return self::$realClass->getHidden();
	 }

	/**
	 * Set the hidden attributes for the model.
	 *
	 * @static
	 * @param	array	$hidden
	 */
	 public static function setHidden($hidden){
		self::$realClass->setHidden($hidden);
	 }

	/**
	 * Get the fillable attributes for the model.
	 *
	 * @static
	 * @return array
	 */
	 public static function getFillable(){
		return self::$realClass->getFillable();
	 }

	/**
	 * Set the fillable attributes for the model.
	 *
	 * @static
	 * @param	array	$fillable
	 * @return Illuminate\Database\Eloquent\Model
	 */
	 public static function fillable($fillable){
		return self::$realClass->fillable($fillable);
	 }

	/**
	 * Set the guarded attributes for the model.
	 *
	 * @static
	 * @param	array	$guarded
	 * @return Illuminate\Database\Eloquent\Model
	 */
	 public static function guard($guarded){
		return self::$realClass->guard($guarded);
	 }

	/**
	 * Determine if the given attribute may be mass assigned.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function isFillable($key){
		return self::$realClass->isFillable($key);
	 }

	/**
	 * Get the value indicating whether the IDs are incrementing.
	 *
	 * @static
	 * @return bool
	 */
	 public static function getIncrementing(){
		return self::$realClass->getIncrementing();
	 }

	/**
	 * Set whether IDs are incrementing.
	 *
	 * @static
	 * @param	bool	$value
	 */
	 public static function setIncrementing($value){
		self::$realClass->setIncrementing($value);
	 }

	/**
	 * Convert the model instance to JSON.
	 *
	 * @static
	 * @param	int	$options
	 * @return string
	 */
	 public static function toJson($options = '0'){
		return self::$realClass->toJson($options);
	 }

	/**
	 * Convert the model instance to an array.
	 *
	 * @static
	 * @return array
	 */
	 public static function toArray(){
		return self::$realClass->toArray();
	 }

	/**
	 * Convert the model's attributes to an array.
	 *
	 * @static
	 * @return array
	 */
	 public static function attributesToArray(){
		return self::$realClass->attributesToArray();
	 }

	/**
	 * Get the model's relationships in array form.
	 *
	 * @static
	 * @return array
	 */
	 public static function relationsToArray(){
		return self::$realClass->relationsToArray();
	 }

	/**
	 * Get an attribute from the model.
	 *
	 * @static
	 * @param	string	$key
	 * @return mixed
	 */
	 public static function getAttribute($key){
		return self::$realClass->getAttribute($key);
	 }

	/**
	 * Determine if a get mutator exists for an attribute.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function hasGetMutator($key){
		return self::$realClass->hasGetMutator($key);
	 }

	/**
	 * Set a given attribute on the model.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function setAttribute($key, $value){
		self::$realClass->setAttribute($key, $value);
	 }

	/**
	 * Determine if a set mutator exists for an attribute.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function hasSetMutator($key){
		return self::$realClass->hasSetMutator($key);
	 }

	/**
	 * Get all of the current attributes on the model.
	 *
	 * @static
	 * @return array
	 */
	 public static function getAttributes(){
		return self::$realClass->getAttributes();
	 }

	/**
	 * Set the array of model attributes. No checking is done.
	 *
	 * @static
	 * @param	array	$attributes
	 * @param	bool	$sync
	 */
	 public static function setRawAttributes($attributes, $sync = false){
		self::$realClass->setRawAttributes($attributes, $sync);
	 }

	/**
	 * Get the model's original attribute values.
	 *
	 * @static
	 * @param	string|null	$key
	 * @param	mixed	$default
	 * @return array
	 */
	 public static function getOriginal($key = null, $default = null){
		return self::$realClass->getOriginal($key, $default);
	 }

	/**
	 * Sync the original attributes with the current.
	 *
	 * @static
	 * @return Illuminate\Database\Eloquent\Model
	 */
	 public static function syncOriginal(){
		return self::$realClass->syncOriginal();
	 }

	/**
	 * Get the attributes that have been changed since last sync.
	 *
	 * @static
	 * @return array
	 */
	 public static function getDirty(){
		return self::$realClass->getDirty();
	 }

	/**
	 * Get a specified relationship.
	 *
	 * @static
	 * @param	string	$relation
	 * @return mixed
	 */
	 public static function getRelation($relation){
		return self::$realClass->getRelation($relation);
	 }

	/**
	 * Set the specific relationship in the model.
	 *
	 * @static
	 * @param	string	$relation
	 * @param	mixed	$value
	 */
	 public static function setRelation($relation, $value){
		self::$realClass->setRelation($relation, $value);
	 }

	/**
	 * Get the database connection for the model.
	 *
	 * @static
	 * @return Illuminate\Database\Connection
	 */
	 public static function getConnection(){
		return self::$realClass->getConnection();
	 }

	/**
	 * Get the current connection name for the model.
	 *
	 * @static
	 * @return string
	 */
	 public static function getConnectionName(){
		return self::$realClass->getConnectionName();
	 }

	/**
	 * Set the connection associated with the model.
	 *
	 * @static
	 * @param	string	$name
	 */
	 public static function setConnection($name){
		self::$realClass->setConnection($name);
	 }

	/**
	 * Resolve a connection instance by name.
	 *
	 * @static
	 * @param	string	$connection
	 * @return Illuminate\Database\Connection
	 */
	 public static function resolveConnection($connection){
		return self::$realClass->resolveConnection($connection);
	 }

	/**
	 * Get the connection resolver instance.
	 *
	 * @static
	 * @return Illuminate\Database\ConnectionResolverInterface
	 */
	 public static function getConnectionResolver(){
		return self::$realClass->getConnectionResolver();
	 }

	/**
	 * Set the connection resolver instance.
	 *
	 * @static
	 * @param	Illuminate\Database\ConnectionResolverInterface	$resolver
	 */
	 public static function setConnectionResolver($resolver){
		self::$realClass->setConnectionResolver($resolver);
	 }

	/**
	 * Get the event dispatcher instance.
	 *
	 * @static
	 * @return Illuminate\Events\Dispatcher
	 */
	 public static function getEventDispatcher(){
		return self::$realClass->getEventDispatcher();
	 }

	/**
	 * Set the event dispatcher instance.
	 *
	 * @static
	 * @param	Illuminate\Events\Dispatcher
	 */
	 public static function setEventDispatcher($dispatcher){
		self::$realClass->setEventDispatcher($dispatcher);
	 }

	/**
	 * Unset the event dispatcher for models.
	 *
	 * @static
	 */
	 public static function unsetEventDispatcher(){
		self::$realClass->unsetEventDispatcher();
	 }

	/**
	 * Get the mutated attributes for a given instance.
	 *
	 * @static
	 * @return array
	 */
	 public static function getMutatedAttributes(){
		return self::$realClass->getMutatedAttributes();
	 }

	/**
	 * Dynamically retrieve attributes on the model.
	 *
	 * @static
	 * @param	string	$key
	 * @return mixed
	 */
	 public static function __get($key){
		return self::$realClass->__get($key);
	 }

	/**
	 * Dynamically set attributes on the model.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function __set($key, $value){
		self::$realClass->__set($key, $value);
	 }

	/**
	 * Determine if the given attribute exists.
	 *
	 * @static
	 * @param	mixed	$offset
	 * @return bool
	 */
	 public static function offsetExists($offset){
		return self::$realClass->offsetExists($offset);
	 }

	/**
	 * Get the value for a given offset.
	 *
	 * @static
	 * @param	mixed	$offset
	 * @return mixed
	 */
	 public static function offsetGet($offset){
		return self::$realClass->offsetGet($offset);
	 }

	/**
	 * Set the value for a given offset.
	 *
	 * @static
	 * @param	mixed	$offset
	 * @param	mixed	$value
	 */
	 public static function offsetSet($offset, $value){
		self::$realClass->offsetSet($offset, $value);
	 }

	/**
	 * Unset the value for a given offset.
	 *
	 * @static
	 * @param	mixed	$offset
	 */
	 public static function offsetUnset($offset){
		self::$realClass->offsetUnset($offset);
	 }

	/**
	 * Determine if an attribute exists on the model.
	 *
	 * @static
	 * @param	string	$key
	 */
	 public static function __isset($key){
		self::$realClass->__isset($key);
	 }

	/**
	 * Unset an attribute on the model.
	 *
	 * @static
	 * @param	string	$key
	 */
	 public static function __unset($key){
		self::$realClass->__unset($key);
	 }

	/**
	 * Handle dynamic method calls into the method.
	 *
	 * @static
	 * @param	string	$method
	 * @param	array	$parameters
	 * @return mixed
	 */
	 public static function __call($method, $parameters){
		return self::$realClass->__call($method, $parameters);
	 }

	/**
	 * Handle dynamic static method calls into the method.
	 *
	 * @static
	 * @param	string	$method
	 * @param	array	$parameters
	 * @return mixed
	 */
	 public static function __callStatic($method, $parameters){
		return self::$realClass->__callStatic($method, $parameters);
	 }

	/**
	 * Convert the model to its string representation.
	 *
	 * @static
	 * @return string
	 */
	 public static function __toString(){
		return self::$realClass->__toString();
	 }

}

 class Event{
	/**
	 * @var Illuminate\Events\Event $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new event instance.
	 *
	 * @static
	 * @param	mixed	$payload
	 */
	 public static function __construct($payload = array()){
		self::$realClass->__construct($payload);
	 }

	/**
	 * Stop the propagation of the event to other listeners.
	 *
	 * @static
	 */
	 public static function stop(){
		self::$realClass->stop();
	 }

	/**
	 * Determine if the event has been stopped from propagating.
	 *
	 * @static
	 * @return bool
	 */
	 public static function isStopped(){
		return self::$realClass->isStopped();
	 }

	/**
	 * Dynamically retrieve items from the payload.
	 *
	 * @static
	 * @param	string	$key
	 * @return mixed
	 */
	 public static function __get($key){
		return self::$realClass->__get($key);
	 }

	/**
	 * Dynamically set items in the payload.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function __set($key, $value){
		self::$realClass->__set($key, $value);
	 }

	/**
	 * Determine if payload item is set.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function __isset($key){
		return self::$realClass->__isset($key);
	 }

	/**
	 * Unset an item from the payload array.
	 *
	 * @static
	 */
	 public static function __unset($key){
		self::$realClass->__unset($key);
	 }

	/**
	 * Returns whether further event listeners should be triggered.
	 *
	 * @static
	 * @return Boolean Whether propagation was already stopped for this event.
	 */
	 public static function isPropagationStopped(){
		return self::$realClass->isPropagationStopped();
	 }

	/**
	 * Stops the propagation of the event to further event listeners.
	 * If multiple event listeners are connected to the same event, no
	 * further event listener will be triggered once any trigger calls
	 * stopPropagation().
	 *
	 * @static
	 */
	 public static function stopPropagation(){
		self::$realClass->stopPropagation();
	 }

	/**
	 * Stores the EventDispatcher that dispatches this Event
	 *
	 * @static
	 * @param	EventDispatcherInterface $dispatcher
	 */
	 public static function setDispatcher($dispatcher){
		self::$realClass->setDispatcher($dispatcher);
	 }

	/**
	 * Returns the EventDispatcher that dispatches this Event
	 *
	 * @static
	 * @return EventDispatcherInterface
	 */
	 public static function getDispatcher(){
		return self::$realClass->getDispatcher();
	 }

	/**
	 * Gets the event's name.
	 *
	 * @static
	 * @return string
	 */
	 public static function getName(){
		return self::$realClass->getName();
	 }

	/**
	 * Sets the event's name property.
	 *
	 * @static
	 * @param	string $name The event name.
	 */
	 public static function setName($name){
		self::$realClass->setName($name);
	 }

}

 class File{
	/**
	 * @var Illuminate\Filesystem\Filesystem $realClass
	 */
	 static private $realClass;

	/**
	 * Determine if a file exists.
	 *
	 * @static
	 * @param	string	$path
	 * @return bool
	 */
	 public static function exists($path){
		return self::$realClass->exists($path);
	 }

	/**
	 * Get the contents of a file.
	 *
	 * @static
	 * @param	string	$path
	 * @return string
	 */
	 public static function get($path){
		return self::$realClass->get($path);
	 }

	/**
	 * Get the contents of a remote file.
	 *
	 * @static
	 * @param	string	$path
	 * @return string
	 */
	 public static function getRemote($path){
		return self::$realClass->getRemote($path);
	 }

	/**
	 * Get the returned value of a file.
	 *
	 * @static
	 * @param	string	$path
	 * @return mixed
	 */
	 public static function getRequire($path){
		return self::$realClass->getRequire($path);
	 }

	/**
	 * Require the given file once.
	 *
	 * @static
	 * @param	string	$file
	 */
	 public static function requireOnce($file){
		self::$realClass->requireOnce($file);
	 }

	/**
	 * Write the contents of a file.
	 *
	 * @static
	 * @param	string	$path
	 * @param	string	$contents
	 * @return int
	 */
	 public static function put($path, $contents){
		return self::$realClass->put($path, $contents);
	 }

	/**
	 * Append to a file.
	 *
	 * @static
	 * @param	string	$path
	 * @param	string	$data
	 * @return int
	 */
	 public static function append($path, $data){
		return self::$realClass->append($path, $data);
	 }

	/**
	 * Delete the file at a given path.
	 *
	 * @static
	 * @param	string	$path
	 * @return bool
	 */
	 public static function delete($path){
		return self::$realClass->delete($path);
	 }

	/**
	 * Move a file to a new location.
	 *
	 * @static
	 * @param	string	$path
	 * @param	string	$target
	 */
	 public static function move($path, $target){
		self::$realClass->move($path, $target);
	 }

	/**
	 * Copy a file to a new location.
	 *
	 * @static
	 * @param	string	$path
	 * @param	string	$target
	 */
	 public static function copy($path, $target){
		self::$realClass->copy($path, $target);
	 }

	/**
	 * Extract the file extension from a file path.
	 *
	 * @static
	 * @param	string	$path
	 * @return string
	 */
	 public static function extension($path){
		return self::$realClass->extension($path);
	 }

	/**
	 * Get the file type of a given file.
	 *
	 * @static
	 * @param	string	$path
	 * @return string
	 */
	 public static function type($path){
		return self::$realClass->type($path);
	 }

	/**
	 * Get the file size of a given file.
	 *
	 * @static
	 * @param	string	$path
	 * @return int
	 */
	 public static function size($path){
		return self::$realClass->size($path);
	 }

	/**
	 * Get the file's last modification time.
	 *
	 * @static
	 * @param	string	$path
	 * @return int
	 */
	 public static function lastModified($path){
		return self::$realClass->lastModified($path);
	 }

	/**
	 * Determine if the given path is a directory.
	 *
	 * @static
	 * @param	string	$directory
	 * @return bool
	 */
	 public static function isDirectory($directory){
		return self::$realClass->isDirectory($directory);
	 }

	/**
	 * Find path names matching a given pattern.
	 *
	 * @static
	 * @param	string	$pattern
	 * @param	int	$flags
	 * @return array
	 */
	 public static function glob($pattern, $flags = '0'){
		return self::$realClass->glob($pattern, $flags);
	 }

	/**
	 * Get an array of all files in a directory.
	 *
	 * @static
	 * @param	string	$directory
	 * @return array
	 */
	 public static function files($directory){
		return self::$realClass->files($directory);
	 }

	/**
	 * Create a directory.
	 *
	 * @static
	 * @param	string	$path
	 * @param	int	$mode
	 * @param	bool	$recursive
	 * @return bool
	 */
	 public static function makeDirectory($path, $mode = '511', $recursive = false){
		return self::$realClass->makeDirectory($path, $mode, $recursive);
	 }

	/**
	 * Copy a directory from one location to another.
	 *
	 * @static
	 * @param	string	$directory
	 * @param	string	$destination
	 * @param	int	$options
	 */
	 public static function copyDirectory($directory, $destination, $options = null){
		self::$realClass->copyDirectory($directory, $destination, $options);
	 }

	/**
	 * Recursively delete a directory.
	 * The directory itself may be optionally preserved.
	 *
	 * @static
	 * @param	string	$directory
	 * @param	bool	$preserve
	 */
	 public static function deleteDirectory($directory, $preserve = false){
		self::$realClass->deleteDirectory($directory, $preserve);
	 }

	/**
	 * Empty the specified directory of all files and folders.
	 *
	 * @static
	 * @param	string	$directory
	 */
	 public static function cleanDirectory($directory){
		self::$realClass->cleanDirectory($directory);
	 }

}

 class Form{
	/**
	 * @var Illuminate\Support\Facades\Form $realClass
	 */
	 static private $realClass;

	/**
	 * Hotswap the underlying instance behind the facade.
	 *
	 * @static
	 * @param	mixed	$instance
	 */
	 public static function swap($instance){
		self::$realClass->swap($instance);
	 }

	/**
	 * Initiate a mock expectation on the facade.
	 *
	 * @static
	 * @param	dynamic
	 * @return Mockery\Expectation
	 */
	 public static function shouldReceive(){
		return self::$realClass->shouldReceive();
	 }

	/**
	 * Get the root object behind the facade.
	 *
	 * @static
	 * @return mixed
	 */
	 public static function getFacadeRoot(){
		return self::$realClass->getFacadeRoot();
	 }

	/**
	 * Clear all of the resolved instances.
	 *
	 * @static
	 */
	 public static function clearResolvedInstances(){
		self::$realClass->clearResolvedInstances();
	 }

	/**
	 * Get the application instance behind the facade.
	 *
	 * @static
	 * @return Illuminate\Foundation\Application
	 */
	 public static function getFacadeApplication(){
		return self::$realClass->getFacadeApplication();
	 }

	/**
	 * Set the application instance.
	 *
	 * @static
	 * @param	Illuminate\Foundation\Application	$app
	 */
	 public static function setFacadeApplication($app){
		self::$realClass->setFacadeApplication($app);
	 }

	/**
	 * Handle dynamic, static calls to the object.
	 *
	 * @static
	 * @param	string	$method
	 * @param	array	$args
	 * @return mixed
	 */
	 public static function __callStatic($method, $args){
		return self::$realClass->__callStatic($method, $args);
	 }

}

 class Hash{
	/**
	 * @var Illuminate\Hashing\BcryptHasher $realClass
	 */
	 static private $realClass;

	/**
	 * Hash the given value.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function make($value, $options = array()){
		return self::$realClass->make($value, $options);
	 }

	/**
	 * Check the given plain value against a hash.
	 *
	 * @static
	 * @param	string	$value
	 * @param	string	$hashedValue
	 * @param	array	$options
	 * @return bool
	 */
	 public static function check($value, $hashedValue, $options = array()){
		return self::$realClass->check($value, $hashedValue, $options);
	 }

}

 class Html{
	/**
	 * @var Illuminate\Html\HtmlBuilder $realClass
	 */
	 static private $realClass;

	/**
	 * Convert an HTML string to entities.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function entities($value){
		return self::$realClass->entities($value);
	 }

	/**
	 * Convert entities to HTML characters.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function decode($value){
		return self::$realClass->decode($value);
	 }

	/**
	 * Generate an ordered list of items.
	 *
	 * @static
	 * @param	array	$items
	 * @param	array	$attributes
	 * @return string
	 */
	 public static function ol($list, $attributes = array()){
		return self::$realClass->ol($list, $attributes);
	 }

	/**
	 * Generate an un-ordered list of items.
	 *
	 * @static
	 * @param	array	$items
	 * @param	array	$attributes
	 * @return string
	 */
	 public static function ul($list, $attributes = array()){
		return self::$realClass->ul($list, $attributes);
	 }

	/**
	 * Build an HTML attribute string from an array.
	 *
	 * @static
	 * @param	array	$attributes
	 * @return string
	 */
	 public static function attributes($attributes){
		return self::$realClass->attributes($attributes);
	 }

}

 class Input{
	/**
	 * @var Illuminate\Http\Request $realClass
	 */
	 static private $realClass;

	/**
	 * Return the Request instance.
	 *
	 * @static
	 * @return Illuminate\Http\Request
	 */
	 public static function instance(){
		return self::$realClass->instance();
	 }

	/**
	 * Get the root URL for the application.
	 *
	 * @static
	 * @return string
	 */
	 public static function root(){
		return self::$realClass->root();
	 }

	/**
	 * Get the URL (no query string) for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function url(){
		return self::$realClass->url();
	 }

	/**
	 * Get the full URL for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function fullUrl(){
		return self::$realClass->fullUrl();
	 }

	/**
	 * Get the current path info for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function path(){
		return self::$realClass->path();
	 }

	/**
	 * Get a segment from the URI (1 based index).
	 *
	 * @static
	 * @param	string	$index
	 * @param	mixed	$default
	 * @return string
	 */
	 public static function segment($index, $default = null){
		return self::$realClass->segment($index, $default);
	 }

	/**
	 * Get all of the segments for the request path.
	 *
	 * @static
	 * @return array
	 */
	 public static function segments(){
		return self::$realClass->segments();
	 }

	/**
	 * Determine if the current request URI matches a pattern.
	 *
	 * @static
	 * @param	string	$pattern
	 * @return bool
	 */
	 public static function is($pattern){
		return self::$realClass->is($pattern);
	 }

	/**
	 * Determine if the request is the result of an AJAX call.
	 *
	 * @static
	 * @return bool
	 */
	 public static function ajax(){
		return self::$realClass->ajax();
	 }

	/**
	 * Determine if the request is over HTTPS.
	 *
	 * @static
	 * @return bool
	 */
	 public static function secure(){
		return self::$realClass->secure();
	 }

	/**
	 * Determine if the request contains a given input item.
	 *
	 * @static
	 * @param	string|array	$key
	 * @return bool
	 */
	 public static function has($key){
		return self::$realClass->has($key);
	 }

	/**
	 * Get all of the input and files for the request.
	 *
	 * @static
	 * @return array
	 */
	 public static function all(){
		return self::$realClass->all();
	 }

	/**
	 * Retrieve an input item from the request.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return string
	 */
	 public static function input($key = null, $default = null){
		return self::$realClass->input($key, $default);
	 }

	/**
	 * Get a subset of the items from the input data.
	 *
	 * @static
	 * @param	array	$keys
	 * @return array
	 */
	 public static function only($keys){
		return self::$realClass->only($keys);
	 }

	/**
	 * Get all of the input except for a specified array of items.
	 *
	 * @static
	 * @param	array	$keys
	 * @return array
	 */
	 public static function except($keys){
		return self::$realClass->except($keys);
	 }

	/**
	 * Retrieve a query string item from the request.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return string
	 */
	 public static function query($key = null, $default = null){
		return self::$realClass->query($key, $default);
	 }

	/**
	 * Retrieve a cookie from the request.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return string
	 */
	 public static function cookie($key = null, $default = null){
		return self::$realClass->cookie($key, $default);
	 }

	/**
	 * Retrieve a file from the request.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return Symfony\Component\HttpFoundation\File\UploadedFile
	 */
	 public static function file($key = null, $default = null){
		return self::$realClass->file($key, $default);
	 }

	/**
	 * Determine if the uploaded data contains a file.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function hasFile($key){
		return self::$realClass->hasFile($key);
	 }

	/**
	 * Retrieve a header from the request.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return string
	 */
	 public static function header($key = null, $default = null){
		return self::$realClass->header($key, $default);
	 }

	/**
	 * Retrieve a server variable from the request.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return string
	 */
	 public static function server($key = null, $default = null){
		return self::$realClass->server($key, $default);
	 }

	/**
	 * Retrieve an old input item.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return string
	 */
	 public static function old($key = null, $default = null){
		return self::$realClass->old($key, $default);
	 }

	/**
	 * Flash the input for the current request to the session.
	 *
	 * @static
	 * @param	string $filter
	 * @param	array	$keys
	 */
	 public static function flash($filter = null, $keys = array()){
		self::$realClass->flash($filter, $keys);
	 }

	/**
	 * Flash only some of the input to the session.
	 *
	 * @static
	 * @param	dynamic	string
	 */
	 public static function flashOnly($keys){
		self::$realClass->flashOnly($keys);
	 }

	/**
	 * Flash only some of the input to the session.
	 *
	 * @static
	 * @param	dynamic	string
	 */
	 public static function flashExcept($keys){
		self::$realClass->flashExcept($keys);
	 }

	/**
	 * Flush all of the old input from the session.
	 *
	 * @static
	 */
	 public static function flush(){
		self::$realClass->flush();
	 }

	/**
	 * Merge new input into the current request's input array.
	 *
	 * @static
	 * @param	array	$input
	 */
	 public static function merge($input){
		self::$realClass->merge($input);
	 }

	/**
	 * Replace the input for the current request.
	 *
	 * @static
	 * @param	array	$input
	 */
	 public static function replace($input){
		self::$realClass->replace($input);
	 }

	/**
	 * Get the JSON payload for the request.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return mixed
	 */
	 public static function json($key = null, $default = null){
		return self::$realClass->json($key, $default);
	 }

	/**
	 * Get the Illuminate session store implementation.
	 *
	 * @static
	 * @return Illuminate\Session\Store
	 */
	 public static function getSessionStore(){
		return self::$realClass->getSessionStore();
	 }

	/**
	 * Set the Illuminate session store implementation.
	 *
	 * @static
	 * @param	Illuminate\Session\Store	$session
	 */
	 public static function setSessionStore($session){
		self::$realClass->setSessionStore($session);
	 }

	/**
	 * Determine if the session store has been set.
	 *
	 * @static
	 * @return bool
	 */
	 public static function hasSessionStore(){
		return self::$realClass->hasSessionStore();
	 }

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
	 */
	 public static function __construct($query = array(), $request = array(), $attributes = array(), $cookies = array(), $files = array(), $server = array(), $content = null){
		self::$realClass->__construct($query, $request, $attributes, $cookies, $files, $server, $content);
	 }

	/**
	 * Sets the parameters for this request.
	 * This method also re-initializes all properties.
	 *
	 * @static
	 * @param	array	$query	The GET parameters
	 * @param	array	$request	The POST parameters
	 * @param	array	$attributes The request attributes (parameters parsed from the PATH_INFO, ...)
	 * @param	array	$cookies	The COOKIE parameters
	 * @param	array	$files	The FILES parameters
	 * @param	array	$server	The SERVER parameters
	 * @param	string $content	The raw body data
	 */
	 public static function initialize($query = array(), $request = array(), $attributes = array(), $cookies = array(), $files = array(), $server = array(), $content = null){
		self::$realClass->initialize($query, $request, $attributes, $cookies, $files, $server, $content);
	 }

	/**
	 * Creates a new request with values from PHP's super globals.
	 *
	 * @static
	 * @return Request A new request
	 */
	 public static function createFromGlobals(){
		return self::$realClass->createFromGlobals();
	 }

	/**
	 * Creates a Request based on a given URI and configuration.
	 * The information contained in the URI always take precedence
	 * over the other information (server and parameters).
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
	 public static function create($uri, $method = 'GET', $parameters = array(), $cookies = array(), $files = array(), $server = array(), $content = null){
		return self::$realClass->create($uri, $method, $parameters, $cookies, $files, $server, $content);
	 }

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
	 public static function duplicate($query = null, $request = null, $attributes = null, $cookies = null, $files = null, $server = null){
		return self::$realClass->duplicate($query, $request, $attributes, $cookies, $files, $server);
	 }

	/**
	 * Clones the current request.
	 * Note that the session is not cloned as duplicated requests
	 * are most of the time sub-requests of the main one.
	 *
	 * @static
	 */
	 public static function __clone(){
		self::$realClass->__clone();
	 }

	/**
	 * Returns the request as a string.
	 *
	 * @static
	 * @return string The request
	 */
	 public static function __toString(){
		return self::$realClass->__toString();
	 }

	/**
	 * Overrides the PHP global variables according to this request instance.
	 * It overrides $_GET, $_POST, $_REQUEST, $_SERVER, $_COOKIE.
	 * $_FILES is never override, see rfc1867
	 *
	 * @static
	 */
	 public static function overrideGlobals(){
		self::$realClass->overrideGlobals();
	 }

	/**
	 * Trusts $_SERVER entries coming from proxies.
	 *
	 * @static
	 */
	 public static function trustProxyData(){
		self::$realClass->trustProxyData();
	 }

	/**
	 * Sets a list of trusted proxies.
	 * You should only list the reverse proxies that you manage directly.
	 *
	 * @static
	 * @param	array $proxies A list of trusted proxies
	 */
	 public static function setTrustedProxies($proxies){
		self::$realClass->setTrustedProxies($proxies);
	 }

	/**
	 * Gets the list of trusted proxies.
	 *
	 * @static
	 * @return array An array of trusted proxies.
	 */
	 public static function getTrustedProxies(){
		return self::$realClass->getTrustedProxies();
	 }

	/**
	 * Sets the name for trusted headers.
	 * The following header keys are supported:
	 * * Request::HEADER_CLIENT_IP:    defaults to X-Forwarded-For   (see getClientIp())
	 * * Request::HEADER_CLIENT_HOST:  defaults to X-Forwarded-Host  (see getClientHost())
	 * * Request::HEADER_CLIENT_PORT:  defaults to X-Forwarded-Port  (see getClientPort())
	 * * Request::HEADER_CLIENT_PROTO: defaults to X-Forwarded-Proto (see getScheme() and isSecure())
	 * Setting an empty value allows to disable the trusted header for the given key.
	 *
	 * @static
	 * @param	string $key	The header key
	 * @param	string $value The header name
	 */
	 public static function setTrustedHeaderName($key, $value){
		self::$realClass->setTrustedHeaderName($key, $value);
	 }

	/**
	 * Returns true if $_SERVER entries coming from proxies are trusted,
	 * false otherwise.
	 *
	 * @static
	 * @return boolean
	 */
	 public static function isProxyTrusted(){
		return self::$realClass->isProxyTrusted();
	 }

	/**
	 * Normalizes a query string.
	 * It builds a normalized query string, where keys/value pairs are alphabetized,
	 * have consistent escaping and unneeded delimiters are removed.
	 *
	 * @static
	 * @param	string $qs Query string
	 * @return string A normalized query string for the Request
	 */
	 public static function normalizeQueryString($qs){
		return self::$realClass->normalizeQueryString($qs);
	 }

	/**
	 * Enables support for the _method request parameter to determine the intended HTTP method.
	 * Be warned that enabling this feature might lead to CSRF issues in your code.
	 * Check that you are using CSRF tokens when required.
	 * The HTTP method can only be overridden when the real HTTP method is POST.
	 *
	 * @static
	 */
	 public static function enableHttpMethodParameterOverride(){
		self::$realClass->enableHttpMethodParameterOverride();
	 }

	/**
	 * Checks whether support for the _method request parameter is enabled.
	 *
	 * @static
	 * @return Boolean True when the _method request parameter is enabled, false otherwise
	 */
	 public static function getHttpMethodParameterOverride(){
		return self::$realClass->getHttpMethodParameterOverride();
	 }

	/**
	 * Gets a "parameter" value.
	 * This method is mainly useful for libraries that want to provide some flexibility.
	 * Order of precedence: GET, PATH, POST
	 * Avoid using this method in controllers:
	 * * slow
	 * * prefer to get from a "named" source
	 * It is better to explicitly get request parameters from the appropriate
	 * public property instead (query, attributes, request).
	 *
	 * @static
	 * @param	string	$key	the key
	 * @param	mixed	$default the default value
	 * @param	Boolean $deep	is parameter deep in multidimensional array
	 * @return mixed
	 */
	 public static function get($key, $default = null, $deep = false){
		return self::$realClass->get($key, $default, $deep);
	 }

	/**
	 * Gets the Session.
	 *
	 * @static
	 * @return SessionInterface|null The session
	 */
	 public static function getSession(){
		return self::$realClass->getSession();
	 }

	/**
	 * Whether the request contains a Session which was started in one of the
	 * previous requests.
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function hasPreviousSession(){
		return self::$realClass->hasPreviousSession();
	 }

	/**
	 * Whether the request contains a Session object.
	 * This method does not give any information about the state of the session object,
	 * like whether the session is started or not. It is just a way to check if this Request
	 * is associated with a Session instance.
	 *
	 * @static
	 * @return Boolean true when the Request contains a Session object, false otherwise
	 */
	 public static function hasSession(){
		return self::$realClass->hasSession();
	 }

	/**
	 * Sets the Session.
	 *
	 * @static
	 * @param	SessionInterface $session The Session
	 */
	 public static function setSession($session){
		self::$realClass->setSession($session);
	 }

	/**
	 * Returns the client IP address.
	 * This method can read the client IP address from the "X-Forwarded-For" header
	 * when trusted proxies were set via "setTrustedProxies()". The "X-Forwarded-For"
	 * header value is a comma+space separated list of IP addresses, the left-most
	 * being the original client, and each successive proxy that passed the request
	 * adding the IP address where it received the request from.
	 * If your reverse proxy uses a different header name than "X-Forwarded-For",
	 * ("Client-Ip" for instance), configure it via "setTrustedHeaderName()" with
	 * the "client-ip" key.
	 *
	 * @static
	 * @return string The client IP address
	 */
	 public static function getClientIp(){
		return self::$realClass->getClientIp();
	 }

	/**
	 * Returns current script name.
	 *
	 * @static
	 * @return string
	 */
	 public static function getScriptName(){
		return self::$realClass->getScriptName();
	 }

	/**
	 * Returns the path being requested relative to the executed script.
	 * The path info always starts with a /.
	 * Suppose this request is instantiated from /mysite on localhost:
	 * * http://localhost/mysite              returns an empty string
	 * * http://localhost/mysite/about        returns '/about'
	 * * http://localhost/mysite/enco%20ded   returns '/enco%20ded'
	 * * http://localhost/mysite/about?var=1  returns '/about'
	 *
	 * @static
	 * @return string The raw path (i.e. not urldecoded)
	 */
	 public static function getPathInfo(){
		return self::$realClass->getPathInfo();
	 }

	/**
	 * Returns the root path from which this request is executed.
	 * Suppose that an index.php file instantiates this request object:
	 * * http://localhost/index.php         returns an empty string
	 * * http://localhost/index.php/page    returns an empty string
	 * * http://localhost/web/index.php     returns '/web'
	 * * http://localhost/we%20b/index.php  returns '/we%20b'
	 *
	 * @static
	 * @return string The raw path (i.e. not urldecoded)
	 */
	 public static function getBasePath(){
		return self::$realClass->getBasePath();
	 }

	/**
	 * Returns the root url from which this request is executed.
	 * The base URL never ends with a /.
	 * This is similar to getBasePath(), except that it also includes the
	 * script filename (e.g. index.php) if one exists.
	 *
	 * @static
	 * @return string The raw url (i.e. not urldecoded)
	 */
	 public static function getBaseUrl(){
		return self::$realClass->getBaseUrl();
	 }

	/**
	 * Gets the request's scheme.
	 *
	 * @static
	 * @return string
	 */
	 public static function getScheme(){
		return self::$realClass->getScheme();
	 }

	/**
	 * Returns the port on which the request is made.
	 * This method can read the client port from the "X-Forwarded-Port" header
	 * when trusted proxies were set via "setTrustedProxies()".
	 * The "X-Forwarded-Port" header must contain the client port.
	 * If your reverse proxy uses a different header name than "X-Forwarded-Port",
	 * configure it via "setTrustedHeaderName()" with the "client-port" key.
	 *
	 * @static
	 * @return string
	 */
	 public static function getPort(){
		return self::$realClass->getPort();
	 }

	/**
	 * Returns the user.
	 *
	 * @static
	 * @return string|null
	 */
	 public static function getUser(){
		return self::$realClass->getUser();
	 }

	/**
	 * Returns the password.
	 *
	 * @static
	 * @return string|null
	 */
	 public static function getPassword(){
		return self::$realClass->getPassword();
	 }

	/**
	 * Gets the user info.
	 *
	 * @static
	 * @return string A user name and, optionally, scheme-specific information about how to gain authorization to access the server
	 */
	 public static function getUserInfo(){
		return self::$realClass->getUserInfo();
	 }

	/**
	 * Returns the HTTP host being requested.
	 * The port name will be appended to the host if it's non-standard.
	 *
	 * @static
	 * @return string
	 */
	 public static function getHttpHost(){
		return self::$realClass->getHttpHost();
	 }

	/**
	 * Returns the requested URI.
	 *
	 * @static
	 * @return string The raw URI (i.e. not urldecoded)
	 */
	 public static function getRequestUri(){
		return self::$realClass->getRequestUri();
	 }

	/**
	 * Gets the scheme and HTTP host.
	 * If the URL was called with basic authentication, the user
	 * and the password are not added to the generated string.
	 *
	 * @static
	 * @return string The scheme and HTTP host
	 */
	 public static function getSchemeAndHttpHost(){
		return self::$realClass->getSchemeAndHttpHost();
	 }

	/**
	 * Generates a normalized URI for the Request.
	 *
	 * @static
	 * @return string A normalized URI for the Request
	 */
	 public static function getUri(){
		return self::$realClass->getUri();
	 }

	/**
	 * Generates a normalized URI for the given path.
	 *
	 * @static
	 * @param	string $path A path to use instead of the current one
	 * @return string The normalized URI for the path
	 */
	 public static function getUriForPath($path){
		return self::$realClass->getUriForPath($path);
	 }

	/**
	 * Generates the normalized query string for the Request.
	 * It builds a normalized query string, where keys/value pairs are alphabetized
	 * and have consistent escaping.
	 *
	 * @static
	 * @return string|null A normalized query string for the Request
	 */
	 public static function getQueryString(){
		return self::$realClass->getQueryString();
	 }

	/**
	 * Checks whether the request is secure or not.
	 * This method can read the client port from the "X-Forwarded-Proto" header
	 * when trusted proxies were set via "setTrustedProxies()".
	 * The "X-Forwarded-Proto" header must contain the protocol: "https" or "http".
	 * If your reverse proxy uses a different header name than "X-Forwarded-Proto"
	 * ("SSL_HTTPS" for instance), configure it via "setTrustedHeaderName()" with
	 * the "client-proto" key.
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isSecure(){
		return self::$realClass->isSecure();
	 }

	/**
	 * Returns the host name.
	 * This method can read the client port from the "X-Forwarded-Host" header
	 * when trusted proxies were set via "setTrustedProxies()".
	 * The "X-Forwarded-Host" header must contain the client host name.
	 * If your reverse proxy uses a different header name than "X-Forwarded-Host",
	 * configure it via "setTrustedHeaderName()" with the "client-host" key.
	 *
	 * @static
	 * @return string
	 */
	 public static function getHost(){
		return self::$realClass->getHost();
	 }

	/**
	 * Sets the request method.
	 *
	 * @static
	 * @param	string $method
	 */
	 public static function setMethod($method){
		self::$realClass->setMethod($method);
	 }

	/**
	 * Gets the request "intended" method.
	 * If the X-HTTP-Method-Override header is set, and if the method is a POST,
	 * then it is used to determine the "real" intended HTTP method.
	 * The _method request parameter can also be used to determine the HTTP method,
	 * but only if enableHttpMethodParameterOverride() has been called.
	 * The method is always an uppercased string.
	 *
	 * @static
	 * @return string The request method
	 */
	 public static function getMethod(){
		return self::$realClass->getMethod();
	 }

	/**
	 * Gets the "real" request method.
	 *
	 * @static
	 * @return string The request method
	 */
	 public static function getRealMethod(){
		return self::$realClass->getRealMethod();
	 }

	/**
	 * Gets the mime type associated with the format.
	 *
	 * @static
	 * @param	string $format The format
	 * @return string The associated mime type (null if not found)
	 */
	 public static function getMimeType($format){
		return self::$realClass->getMimeType($format);
	 }

	/**
	 * Gets the format associated with the mime type.
	 *
	 * @static
	 * @param	string $mimeType The associated mime type
	 * @return string|null The format (null if not found)
	 */
	 public static function getFormat($mimeType){
		return self::$realClass->getFormat($mimeType);
	 }

	/**
	 * Associates a format with mime types.
	 *
	 * @static
	 * @param	string	$format	The format
	 * @param	string|array $mimeTypes The associated mime types (the preferred one must be the first as it will be used as the content type)
	 */
	 public static function setFormat($format, $mimeTypes){
		self::$realClass->setFormat($format, $mimeTypes);
	 }

	/**
	 * Gets the request format.
	 * Here is the process to determine the format:
	 * * format defined by the user (with setRequestFormat())
	 * * _format request parameter
	 * * $default
	 *
	 * @static
	 * @param	string $default The default format
	 * @return string The request format
	 */
	 public static function getRequestFormat($default = 'html'){
		return self::$realClass->getRequestFormat($default);
	 }

	/**
	 * Sets the request format.
	 *
	 * @static
	 * @param	string $format The request format.
	 */
	 public static function setRequestFormat($format){
		self::$realClass->setRequestFormat($format);
	 }

	/**
	 * Gets the format associated with the request.
	 *
	 * @static
	 * @return string|null The format (null if no content type is present)
	 */
	 public static function getContentType(){
		return self::$realClass->getContentType();
	 }

	/**
	 * Sets the default locale.
	 *
	 * @static
	 * @param	string $locale
	 */
	 public static function setDefaultLocale($locale){
		self::$realClass->setDefaultLocale($locale);
	 }

	/**
	 * Sets the locale.
	 *
	 * @static
	 * @param	string $locale
	 */
	 public static function setLocale($locale){
		self::$realClass->setLocale($locale);
	 }

	/**
	 * Get the locale.
	 *
	 * @static
	 * @return string
	 */
	 public static function getLocale(){
		return self::$realClass->getLocale();
	 }

	/**
	 * Checks if the request method is of specified type.
	 *
	 * @static
	 * @param	string $method Uppercase request method (GET, POST etc).
	 * @return Boolean
	 */
	 public static function isMethod($method){
		return self::$realClass->isMethod($method);
	 }

	/**
	 * Checks whether the method is safe or not.
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isMethodSafe(){
		return self::$realClass->isMethodSafe();
	 }

	/**
	 * Returns the request body content.
	 *
	 * @static
	 * @param	Boolean $asResource If true, a resource will be returned
	 * @return string|resource The request body content or a resource to read the body stream.
	 */
	 public static function getContent($asResource = false){
		return self::$realClass->getContent($asResource);
	 }

	/**
	 * Gets the Etags.
	 *
	 * @static
	 * @return array The entity tags
	 */
	 public static function getETags(){
		return self::$realClass->getETags();
	 }

	/**
	 * 
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isNoCache(){
		return self::$realClass->isNoCache();
	 }

	/**
	 * Returns the preferred language.
	 *
	 * @static
	 * @param	array $locales An array of ordered available locales
	 * @return string|null The preferred locale
	 */
	 public static function getPreferredLanguage($locales = null){
		return self::$realClass->getPreferredLanguage($locales);
	 }

	/**
	 * Gets a list of languages acceptable by the client browser.
	 *
	 * @static
	 * @return array Languages ordered in the user browser preferences
	 */
	 public static function getLanguages(){
		return self::$realClass->getLanguages();
	 }

	/**
	 * Gets a list of charsets acceptable by the client browser.
	 *
	 * @static
	 * @return array List of charsets in preferable order
	 */
	 public static function getCharsets(){
		return self::$realClass->getCharsets();
	 }

	/**
	 * Gets a list of content types acceptable by the client browser
	 *
	 * @static
	 * @return array List of content types in preferable order
	 */
	 public static function getAcceptableContentTypes(){
		return self::$realClass->getAcceptableContentTypes();
	 }

	/**
	 * Returns true if the request is a XMLHttpRequest.
	 * It works if your JavaScript library set an X-Requested-With HTTP header.
	 * It is known to work with common JavaScript frameworks:
	 *
	 * @static
	 * @return Boolean true if the request is an XMLHttpRequest, false otherwise
	 */
	 public static function isXmlHttpRequest(){
		return self::$realClass->isXmlHttpRequest();
	 }

	/**
	 * Splits an Accept-* HTTP header.
	 *
	 * @static
	 * @param	string $header Header to split
	 * @return array Array indexed by the values of the Accept-* header in preferred order
	 */
	 public static function splitHttpAcceptHeader($header){
		return self::$realClass->splitHttpAcceptHeader($header);
	 }

}

 class Lang{
	/**
	 * @var Illuminate\Translation\Translator $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new translator instance.
	 *
	 * @static
	 * @param	Illuminate\Translation\LoaderInterface
	 * @param	array	$locales
	 * @param	string	$default
	 * @param	string	$fallback
	 */
	 public static function __construct($loader, $default, $fallback){
		self::$realClass->__construct($loader, $default, $fallback);
	 }

	/**
	 * Determine if a translation exists.
	 *
	 * @static
	 * @param	string	$key
	 * @param	string	$locale
	 * @return bool
	 */
	 public static function has($key, $locale = null){
		return self::$realClass->has($key, $locale);
	 }

	/**
	 * Get the translation for a given key.
	 *
	 * @static
	 * @param	string	$id
	 * @param	array	$parameters
	 * @param	string	$locale
	 * @return string
	 */
	 public static function get($key, $parameters = array(), $locale = null){
		return self::$realClass->get($key, $parameters, $locale);
	 }

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
	 public static function choice($key, $number, $parameters = array(), $locale = null){
		return self::$realClass->choice($key, $number, $parameters, $locale);
	 }

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
	 public static function trans($id, $parameters = array(), $domain = 'messages', $locale = null){
		return self::$realClass->trans($id, $parameters, $domain, $locale);
	 }

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
	 public static function transChoice($id, $number, $parameters = array(), $domain = 'messages', $locale = null){
		return self::$realClass->transChoice($id, $number, $parameters, $domain, $locale);
	 }

	/**
	 * Load the specified language group.
	 *
	 * @static
	 * @param	string	$group
	 * @param	string	$namespace
	 * @param	string	$locale
	 * @return string
	 */
	 public static function load($group, $namespace, $locale){
		return self::$realClass->load($group, $namespace, $locale);
	 }

	/**
	 * Add a new namespace to the loader.
	 *
	 * @static
	 * @param	string	$namespace
	 * @param	string	$hint
	 */
	 public static function addNamespace($namespace, $hint){
		self::$realClass->addNamespace($namespace, $hint);
	 }

	/**
	 * Get the default locale being used.
	 *
	 * @static
	 * @return string
	 */
	 public static function getLocale(){
		return self::$realClass->getLocale();
	 }

	/**
	 * Set the default locale.
	 *
	 * @static
	 * @param	string	$locale
	 */
	 public static function setLocale($locale){
		self::$realClass->setLocale($locale);
	 }

	/**
	 * Get the base Symfony translator instance.
	 *
	 * @static
	 * @return Symfony\Translation\Translator
	 */
	 public static function getSymfonyTranslator(){
		return self::$realClass->getSymfonyTranslator();
	 }

	/**
	 * Get the base Symfony translator instance.
	 *
	 * @static
	 * @param	Symfony\Translation\Translator	$trans
	 */
	 public static function setSymfonyTranslator($trans){
		self::$realClass->setSymfonyTranslator($trans);
	 }

	/**
	 * Parse a key into namespace, group, and item.
	 *
	 * @static
	 * @param	string	$key
	 * @return array
	 */
	 public static function parseKey($key){
		return self::$realClass->parseKey($key);
	 }

	/**
	 * Set the parsed value of a key.
	 *
	 * @static
	 * @param	string	$key
	 * @param	array	$parsed
	 */
	 public static function setParsedKey($key, $parsed){
		self::$realClass->setParsedKey($key, $parsed);
	 }

}

 class Log{
	/**
	 * @var Illuminate\Log\Writer $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new log writer instance.
	 *
	 * @static
	 * @param	Monolog\Logger	$monolog
	 * @param	Illuminate\Events\Dispatcher	$dispatcher
	 */
	 public static function __construct($monolog, $dispatcher = null){
		self::$realClass->__construct($monolog, $dispatcher);
	 }

	/**
	 * Register a file log handler.
	 *
	 * @static
	 * @param	string	$path
	 * @param	string	$level
	 */
	 public static function useFiles($path, $level = 'debug'){
		self::$realClass->useFiles($path, $level);
	 }

	/**
	 * Register a daily file log handler.
	 *
	 * @static
	 * @param	string	$path
	 * @param	int	$days
	 * @param	string	$level
	 */
	 public static function useDailyFiles($path, $days = '0', $level = 'debug'){
		self::$realClass->useDailyFiles($path, $days, $level);
	 }

	/**
	 * Get the underlying Monolog instance.
	 *
	 * @static
	 * @return Monolog\Logger
	 */
	 public static function getMonolog(){
		return self::$realClass->getMonolog();
	 }

	/**
	 * Register a new callback handler for when
	 * a log event is triggered.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function listen($callback){
		self::$realClass->listen($callback);
	 }

	/**
	 * Get the event dispatcher instance.
	 *
	 * @static
	 * @return Illuminate\Events\Dispatcher
	 */
	 public static function getEventDispatcher(){
		return self::$realClass->getEventDispatcher();
	 }

	/**
	 * Set the event dispatcher instance.
	 *
	 * @static
	 * @param	Illuminate\Events\Dispatcher
	 */
	 public static function setEventDispatcher($dispatcher){
		self::$realClass->setEventDispatcher($dispatcher);
	 }

	/**
	 * Dynamically handle error additions.
	 *
	 * @static
	 * @param	string	$method
	 * @param	array	$parameters
	 * @return mixed
	 */
	 public static function __call($method, $parameters){
		return self::$realClass->__call($method, $parameters);
	 }

}

 class Mail{
	/**
	 * @var Illuminate\Mail\Mailer $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new Mailer instance.
	 *
	 * @static
	 * @param	Illuminate\View\Environment	$views
	 * @param	Swift_Mailer	$swift
	 */
	 public static function __construct($views, $swift){
		self::$realClass->__construct($views, $swift);
	 }

	/**
	 * Set the global from address and name.
	 *
	 * @static
	 * @param	string	$address
	 * @param	string	$name
	 */
	 public static function alwaysFrom($address, $name = null){
		self::$realClass->alwaysFrom($address, $name);
	 }

	/**
	 * Send a new message when only a plain part.
	 *
	 * @static
	 * @param	string	$view
	 * @param	array	$data
	 * @param	mixed	$callback
	 */
	 public static function plain($view, $data, $callback){
		self::$realClass->plain($view, $data, $callback);
	 }

	/**
	 * Send a new message using a view.
	 *
	 * @static
	 * @param	string|array	$view
	 * @param	array	$data
	 * @param	Closure|string	$callback
	 */
	 public static function send($view, $data, $callback){
		self::$realClass->send($view, $data, $callback);
	 }

	/**
	 * Tell the mailer to not really send messages.
	 *
	 * @static
	 * @param	bool	$value
	 */
	 public static function pretend($value = true){
		self::$realClass->pretend($value);
	 }

	/**
	 * Get the view environment instance.
	 *
	 * @static
	 * @return Illuminate\View\Environment
	 */
	 public static function getViewEnvironment(){
		return self::$realClass->getViewEnvironment();
	 }

	/**
	 * Get the Swift Mailer instance.
	 *
	 * @static
	 * @return Swift_Mailer
	 */
	 public static function getSwiftMailer(){
		return self::$realClass->getSwiftMailer();
	 }

	/**
	 * Set the Swift Mailer instance.
	 *
	 * @static
	 * @param	Swift_Mailer	$swift
	 */
	 public static function setSwiftMailer($swift){
		self::$realClass->setSwiftMailer($swift);
	 }

	/**
	 * Set the log writer instance.
	 *
	 * @static
	 * @param	Illuminate\Log\Writer	$logger
	 */
	 public static function setLogger($logger){
		self::$realClass->setLogger($logger);
	 }

	/**
	 * Set the IoC container instance.
	 *
	 * @static
	 * @param	Illuminate\Container	$container
	 */
	 public static function setContainer($container){
		self::$realClass->setContainer($container);
	 }

}

 class Paginator{
	/**
	 * @var Illuminate\Pagination\Paginator $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new Paginator instance.
	 *
	 * @static
	 * @param	Illuminate\Pagination\Environment	$env
	 * @param	array	$items
	 * @param	int	$total
	 * @param	int	$perPage
	 */
	 public static function __construct($env, $items, $total, $perPage){
		self::$realClass->__construct($env, $items, $total, $perPage);
	 }

	/**
	 * Setup the pagination context (current and last page).
	 *
	 * @static
	 * @return Illuminate\Pagination\Paginator
	 */
	 public static function setupPaginationContext(){
		return self::$realClass->setupPaginationContext();
	 }

	/**
	 * Get the pagination links view.
	 *
	 * @static
	 * @return Illuminate\View\View
	 */
	 public static function links(){
		return self::$realClass->links();
	 }

	/**
	 * Get a URL for a given page number.
	 *
	 * @static
	 * @param	int	$page
	 * @return string
	 */
	 public static function getUrl($page){
		return self::$realClass->getUrl($page);
	 }

	/**
	 * Add a query string value to the paginator.
	 *
	 * @static
	 * @param	string	$key
	 * @param	string	$value
	 * @return Illuminate\Pagination\Paginator
	 */
	 public static function appends($key, $value){
		return self::$realClass->appends($key, $value);
	 }

	/**
	 * Add a query string value to the paginator.
	 *
	 * @static
	 * @param	string	$key
	 * @param	string	$value
	 * @return Illuminate\Pagination\Paginator
	 */
	 public static function addQuery($key, $value){
		return self::$realClass->addQuery($key, $value);
	 }

	/**
	 * Get the current page for the request.
	 *
	 * @static
	 * @return int
	 */
	 public static function getCurrentPage(){
		return self::$realClass->getCurrentPage();
	 }

	/**
	 * Get the last page that should be available.
	 *
	 * @static
	 * @return int
	 */
	 public static function getLastPage(){
		return self::$realClass->getLastPage();
	 }

	/**
	 * Get the items being paginated.
	 *
	 * @static
	 * @return array
	 */
	 public static function getItems(){
		return self::$realClass->getItems();
	 }

	/**
	 * Get the total number of items in the collection.
	 *
	 * @static
	 * @return int
	 */
	 public static function getTotal(){
		return self::$realClass->getTotal();
	 }

	/**
	 * Get an iterator for the items.
	 *
	 * @static
	 * @return ArrayIterator
	 */
	 public static function getIterator(){
		return self::$realClass->getIterator();
	 }

	/**
	 * Determine if the list of items is empty or not.
	 *
	 * @static
	 * @return bool
	 */
	 public static function isEmpty(){
		return self::$realClass->isEmpty();
	 }

	/**
	 * Get the number of items for the current page.
	 *
	 * @static
	 * @return int
	 */
	 public static function count(){
		return self::$realClass->count();
	 }

	/**
	 * Determine if the given item exists.
	 *
	 * @static
	 * @param	mixed	$key
	 * @return bool
	 */
	 public static function offsetExists($key){
		return self::$realClass->offsetExists($key);
	 }

	/**
	 * Get the item at the given offset.
	 *
	 * @static
	 * @param	mixed	$key
	 * @return mixed
	 */
	 public static function offsetGet($key){
		return self::$realClass->offsetGet($key);
	 }

	/**
	 * Set the item at the given offset.
	 *
	 * @static
	 * @param	mixed	$key
	 * @param	mixed	$value
	 */
	 public static function offsetSet($key, $value){
		self::$realClass->offsetSet($key, $value);
	 }

	/**
	 * Unset the item at the given key.
	 *
	 * @static
	 * @param	mixed	$key
	 */
	 public static function offsetUnset($key){
		self::$realClass->offsetUnset($key);
	 }

}

 class Password{
	/**
	 * @var Illuminate\Auth\Reminders\PasswordBroker $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new password broker instance.
	 *
	 * @static
	 * @param	Illuminate\Auth\ReminderRepositoryInterface	$reminders
	 * @param	Illuminate\Auth\UserProviderInterface	$users
	 * @param	Illuminate\Routing\Redirector	$redirector
	 * @param	Illuminate\Mail\Mailer	$mailer
	 * @param	string	$reminderView
	 */
	 public static function __construct($reminders, $users, $redirect, $mailer, $reminderView){
		self::$realClass->__construct($reminders, $users, $redirect, $mailer, $reminderView);
	 }

	/**
	 * Send a password reminder to a user.
	 *
	 * @static
	 * @param	array	$credentials
	 * @param	Closure	$callback
	 * @return Illuminate\Http\RedirectResponse
	 */
	 public static function remind($credentials, $callback = null){
		return self::$realClass->remind($credentials, $callback);
	 }

	/**
	 * Send the password reminder e-mail.
	 *
	 * @static
	 * @param	Illuminate\Auth\RemindableInterface	$user
	 * @param	string	$token
	 * @param	Closure	$callback
	 */
	 public static function sendReminder($user, $token, $callback = null){
		self::$realClass->sendReminder($user, $token, $callback);
	 }

	/**
	 * Reset the password for the given token.
	 *
	 * @static
	 * @param	string	$token
	 * @param	string	$newPassword
	 * @param	Closure	$callback
	 * @return mixed
	 */
	 public static function reset($credentials, $callback){
		return self::$realClass->reset($credentials, $callback);
	 }

	/**
	 * Get the user for the given credentials.
	 *
	 * @static
	 * @param	array	$credentials
	 * @return Illuminate\Auth\RemindableInterface
	 */
	 public static function getUser($credentials){
		return self::$realClass->getUser($credentials);
	 }

}

 class Queue{
	/**
	 * @var Illuminate\Queue\QueueManager $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new queue manager instance.
	 *
	 * @static
	 * @param	Illuminate\Foundation\Application	$app
	 */
	 public static function __construct($app){
		self::$realClass->__construct($app);
	 }

	/**
	 * Resolve a queue connection instance.
	 *
	 * @static
	 * @param	string	$name
	 * @return Illuminate\Queue\QueueInterface
	 */
	 public static function connection($name = null){
		return self::$realClass->connection($name);
	 }

	/**
	 * Add a queue connection resolver.
	 *
	 * @static
	 * @param	string	$driver
	 * @param	Closure	$resolver
	 */
	 public static function addConnector($driver, $resolver){
		self::$realClass->addConnector($driver, $resolver);
	 }

	/**
	 * Dynamically pass calls to the default connection.
	 *
	 * @static
	 * @param	string	$method
	 * @param	array	$parameters
	 * @return mixed
	 */
	 public static function __call($method, $parameters){
		return self::$realClass->__call($method, $parameters);
	 }

}

 class Redirect{
	/**
	 * @var Illuminate\Routing\Redirector $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new Redirector instance.
	 *
	 * @static
	 * @param	Illuminate\Routing\UrlGenerator	$generator
	 */
	 public static function __construct($generator){
		self::$realClass->__construct($generator);
	 }

	/**
	 * Create a new redirect response to the previous location.
	 *
	 * @static
	 * @param	int	$status
	 * @param	array	$headers
	 * @return Illuminate\Http\RedirectResponse
	 */
	 public static function back($status = '302', $headers = array()){
		return self::$realClass->back($status, $headers);
	 }

	/**
	 * Create a new redirect response to the current URI.
	 *
	 * @static
	 * @param	int	$status
	 * @param	array	$headers
	 * @return Illuminate\Http\RedirectResponse
	 */
	 public static function refresh($status = '302', $headers = array()){
		return self::$realClass->refresh($status, $headers);
	 }

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
	 public static function to($path, $status = '302', $headers = array(), $secure = null){
		return self::$realClass->to($path, $status, $headers, $secure);
	 }

	/**
	 * Create a new redirect response to the given HTTPS path.
	 *
	 * @static
	 * @param	string	$path
	 * @param	int	$status
	 * @param	array	$headers
	 * @return Illuminate\Http\RedirectResponse
	 */
	 public static function secure($path, $status = '302', $headers = array()){
		return self::$realClass->secure($path, $status, $headers);
	 }

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
	 public static function route($route, $parameters = array(), $status = '302', $headers = array()){
		return self::$realClass->route($route, $parameters, $status, $headers);
	 }

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
	 public static function action($action, $parameters = array(), $status = '302', $headers = array()){
		return self::$realClass->action($action, $parameters, $status, $headers);
	 }

	/**
	 * Get the URL generator instance.
	 *
	 * @static
	 * @return Illuminate\Routing\UrlGenerator
	 */
	 public static function getUrlGenerator(){
		return self::$realClass->getUrlGenerator();
	 }

	/**
	 * Set the active session store.
	 *
	 * @static
	 * @param	Illuminate\Session\Store	$session
	 */
	 public static function setSession($session){
		self::$realClass->setSession($session);
	 }

}

 class Redis{
	/**
	 * @var Illuminate\Redis\Database $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new Redis connection instance.
	 *
	 * @static
	 * @param	string	$host
	 * @param	int	$port
	 * @param	int	$database
	 * @param	string	$password
	 */
	 public static function __construct($host, $port, $database = '0', $password = null){
		self::$realClass->__construct($host, $port, $database, $password);
	 }

	/**
	 * Connect to the Redis database.
	 *
	 * @static
	 */
	 public static function connect(){
		self::$realClass->connect();
	 }

	/**
	 * Run a command against the Redis database.
	 *
	 * @static
	 * @param	string	$method
	 * @param	array	$parameters
	 * @return mixed
	 */
	 public static function command($method, $parameters = array()){
		return self::$realClass->command($method, $parameters);
	 }

	/**
	 * Build the Redis command syntax.
	 * Redis protocol states that a command should conform to the following format:
	 * *<number of arguments> CR LF
	 * $<number of bytes of argument 1> CR LF
	 * <argument data> CR LF
	 * ...
	 * $<number of bytes of argument N> CR LF
	 * <argument data> CR LF
	 * More information regarding the Redis protocol: http://redis.io/topics/protocol
	 *
	 * @static
	 * @param	string	$method
	 * @param	array	$parameters
	 * @return string
	 */
	 public static function buildCommand($method, $parameters){
		return self::$realClass->buildCommand($method, $parameters);
	 }

	/**
	 * Parse the Redis database response.
	 *
	 * @static
	 * @param	string	$response
	 * @return mixed
	 */
	 public static function parseResponse($response){
		return self::$realClass->parseResponse($response);
	 }

	/**
	 * Read the specified number of bytes from the file resource.
	 *
	 * @static
	 * @param	int	$bytes
	 * @return string
	 */
	 public static function fileRead($bytes){
		return self::$realClass->fileRead($bytes);
	 }

	/**
	 * Get the specified number of bytes from a file line.
	 *
	 * @static
	 * @param	int	$bytes
	 * @return string
	 */
	 public static function fileGet($bytes){
		return self::$realClass->fileGet($bytes);
	 }

	/**
	 * Write the given command to the file resource.
	 *
	 * @static
	 * @param	string	$command
	 */
	 public static function fileWrite($command){
		self::$realClass->fileWrite($command);
	 }

	/**
	 * Get the Redis socket connection.
	 *
	 * @static
	 * @return resource
	 */
	 public static function getConnection(){
		return self::$realClass->getConnection();
	 }

	/**
	 * Dynamically make a Redis command.
	 *
	 * @static
	 * @param	string	$method
	 * @param	array	$parameters
	 * @return mixed
	 */
	 public static function __call($method, $parameters){
		return self::$realClass->__call($method, $parameters);
	 }

}

 class Request{
	/**
	 * @var Illuminate\Http\Request $realClass
	 */
	 static private $realClass;

	/**
	 * Return the Request instance.
	 *
	 * @static
	 * @return Illuminate\Http\Request
	 */
	 public static function instance(){
		return self::$realClass->instance();
	 }

	/**
	 * Get the root URL for the application.
	 *
	 * @static
	 * @return string
	 */
	 public static function root(){
		return self::$realClass->root();
	 }

	/**
	 * Get the URL (no query string) for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function url(){
		return self::$realClass->url();
	 }

	/**
	 * Get the full URL for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function fullUrl(){
		return self::$realClass->fullUrl();
	 }

	/**
	 * Get the current path info for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function path(){
		return self::$realClass->path();
	 }

	/**
	 * Get a segment from the URI (1 based index).
	 *
	 * @static
	 * @param	string	$index
	 * @param	mixed	$default
	 * @return string
	 */
	 public static function segment($index, $default = null){
		return self::$realClass->segment($index, $default);
	 }

	/**
	 * Get all of the segments for the request path.
	 *
	 * @static
	 * @return array
	 */
	 public static function segments(){
		return self::$realClass->segments();
	 }

	/**
	 * Determine if the current request URI matches a pattern.
	 *
	 * @static
	 * @param	string	$pattern
	 * @return bool
	 */
	 public static function is($pattern){
		return self::$realClass->is($pattern);
	 }

	/**
	 * Determine if the request is the result of an AJAX call.
	 *
	 * @static
	 * @return bool
	 */
	 public static function ajax(){
		return self::$realClass->ajax();
	 }

	/**
	 * Determine if the request is over HTTPS.
	 *
	 * @static
	 * @return bool
	 */
	 public static function secure(){
		return self::$realClass->secure();
	 }

	/**
	 * Determine if the request contains a given input item.
	 *
	 * @static
	 * @param	string|array	$key
	 * @return bool
	 */
	 public static function has($key){
		return self::$realClass->has($key);
	 }

	/**
	 * Get all of the input and files for the request.
	 *
	 * @static
	 * @return array
	 */
	 public static function all(){
		return self::$realClass->all();
	 }

	/**
	 * Retrieve an input item from the request.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return string
	 */
	 public static function input($key = null, $default = null){
		return self::$realClass->input($key, $default);
	 }

	/**
	 * Get a subset of the items from the input data.
	 *
	 * @static
	 * @param	array	$keys
	 * @return array
	 */
	 public static function only($keys){
		return self::$realClass->only($keys);
	 }

	/**
	 * Get all of the input except for a specified array of items.
	 *
	 * @static
	 * @param	array	$keys
	 * @return array
	 */
	 public static function except($keys){
		return self::$realClass->except($keys);
	 }

	/**
	 * Retrieve a query string item from the request.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return string
	 */
	 public static function query($key = null, $default = null){
		return self::$realClass->query($key, $default);
	 }

	/**
	 * Retrieve a cookie from the request.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return string
	 */
	 public static function cookie($key = null, $default = null){
		return self::$realClass->cookie($key, $default);
	 }

	/**
	 * Retrieve a file from the request.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return Symfony\Component\HttpFoundation\File\UploadedFile
	 */
	 public static function file($key = null, $default = null){
		return self::$realClass->file($key, $default);
	 }

	/**
	 * Determine if the uploaded data contains a file.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function hasFile($key){
		return self::$realClass->hasFile($key);
	 }

	/**
	 * Retrieve a header from the request.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return string
	 */
	 public static function header($key = null, $default = null){
		return self::$realClass->header($key, $default);
	 }

	/**
	 * Retrieve a server variable from the request.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return string
	 */
	 public static function server($key = null, $default = null){
		return self::$realClass->server($key, $default);
	 }

	/**
	 * Retrieve an old input item.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return string
	 */
	 public static function old($key = null, $default = null){
		return self::$realClass->old($key, $default);
	 }

	/**
	 * Flash the input for the current request to the session.
	 *
	 * @static
	 * @param	string $filter
	 * @param	array	$keys
	 */
	 public static function flash($filter = null, $keys = array()){
		self::$realClass->flash($filter, $keys);
	 }

	/**
	 * Flash only some of the input to the session.
	 *
	 * @static
	 * @param	dynamic	string
	 */
	 public static function flashOnly($keys){
		self::$realClass->flashOnly($keys);
	 }

	/**
	 * Flash only some of the input to the session.
	 *
	 * @static
	 * @param	dynamic	string
	 */
	 public static function flashExcept($keys){
		self::$realClass->flashExcept($keys);
	 }

	/**
	 * Flush all of the old input from the session.
	 *
	 * @static
	 */
	 public static function flush(){
		self::$realClass->flush();
	 }

	/**
	 * Merge new input into the current request's input array.
	 *
	 * @static
	 * @param	array	$input
	 */
	 public static function merge($input){
		self::$realClass->merge($input);
	 }

	/**
	 * Replace the input for the current request.
	 *
	 * @static
	 * @param	array	$input
	 */
	 public static function replace($input){
		self::$realClass->replace($input);
	 }

	/**
	 * Get the JSON payload for the request.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return mixed
	 */
	 public static function json($key = null, $default = null){
		return self::$realClass->json($key, $default);
	 }

	/**
	 * Get the Illuminate session store implementation.
	 *
	 * @static
	 * @return Illuminate\Session\Store
	 */
	 public static function getSessionStore(){
		return self::$realClass->getSessionStore();
	 }

	/**
	 * Set the Illuminate session store implementation.
	 *
	 * @static
	 * @param	Illuminate\Session\Store	$session
	 */
	 public static function setSessionStore($session){
		self::$realClass->setSessionStore($session);
	 }

	/**
	 * Determine if the session store has been set.
	 *
	 * @static
	 * @return bool
	 */
	 public static function hasSessionStore(){
		return self::$realClass->hasSessionStore();
	 }

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
	 */
	 public static function __construct($query = array(), $request = array(), $attributes = array(), $cookies = array(), $files = array(), $server = array(), $content = null){
		self::$realClass->__construct($query, $request, $attributes, $cookies, $files, $server, $content);
	 }

	/**
	 * Sets the parameters for this request.
	 * This method also re-initializes all properties.
	 *
	 * @static
	 * @param	array	$query	The GET parameters
	 * @param	array	$request	The POST parameters
	 * @param	array	$attributes The request attributes (parameters parsed from the PATH_INFO, ...)
	 * @param	array	$cookies	The COOKIE parameters
	 * @param	array	$files	The FILES parameters
	 * @param	array	$server	The SERVER parameters
	 * @param	string $content	The raw body data
	 */
	 public static function initialize($query = array(), $request = array(), $attributes = array(), $cookies = array(), $files = array(), $server = array(), $content = null){
		self::$realClass->initialize($query, $request, $attributes, $cookies, $files, $server, $content);
	 }

	/**
	 * Creates a new request with values from PHP's super globals.
	 *
	 * @static
	 * @return Request A new request
	 */
	 public static function createFromGlobals(){
		return self::$realClass->createFromGlobals();
	 }

	/**
	 * Creates a Request based on a given URI and configuration.
	 * The information contained in the URI always take precedence
	 * over the other information (server and parameters).
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
	 public static function create($uri, $method = 'GET', $parameters = array(), $cookies = array(), $files = array(), $server = array(), $content = null){
		return self::$realClass->create($uri, $method, $parameters, $cookies, $files, $server, $content);
	 }

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
	 public static function duplicate($query = null, $request = null, $attributes = null, $cookies = null, $files = null, $server = null){
		return self::$realClass->duplicate($query, $request, $attributes, $cookies, $files, $server);
	 }

	/**
	 * Clones the current request.
	 * Note that the session is not cloned as duplicated requests
	 * are most of the time sub-requests of the main one.
	 *
	 * @static
	 */
	 public static function __clone(){
		self::$realClass->__clone();
	 }

	/**
	 * Returns the request as a string.
	 *
	 * @static
	 * @return string The request
	 */
	 public static function __toString(){
		return self::$realClass->__toString();
	 }

	/**
	 * Overrides the PHP global variables according to this request instance.
	 * It overrides $_GET, $_POST, $_REQUEST, $_SERVER, $_COOKIE.
	 * $_FILES is never override, see rfc1867
	 *
	 * @static
	 */
	 public static function overrideGlobals(){
		self::$realClass->overrideGlobals();
	 }

	/**
	 * Trusts $_SERVER entries coming from proxies.
	 *
	 * @static
	 */
	 public static function trustProxyData(){
		self::$realClass->trustProxyData();
	 }

	/**
	 * Sets a list of trusted proxies.
	 * You should only list the reverse proxies that you manage directly.
	 *
	 * @static
	 * @param	array $proxies A list of trusted proxies
	 */
	 public static function setTrustedProxies($proxies){
		self::$realClass->setTrustedProxies($proxies);
	 }

	/**
	 * Gets the list of trusted proxies.
	 *
	 * @static
	 * @return array An array of trusted proxies.
	 */
	 public static function getTrustedProxies(){
		return self::$realClass->getTrustedProxies();
	 }

	/**
	 * Sets the name for trusted headers.
	 * The following header keys are supported:
	 * * Request::HEADER_CLIENT_IP:    defaults to X-Forwarded-For   (see getClientIp())
	 * * Request::HEADER_CLIENT_HOST:  defaults to X-Forwarded-Host  (see getClientHost())
	 * * Request::HEADER_CLIENT_PORT:  defaults to X-Forwarded-Port  (see getClientPort())
	 * * Request::HEADER_CLIENT_PROTO: defaults to X-Forwarded-Proto (see getScheme() and isSecure())
	 * Setting an empty value allows to disable the trusted header for the given key.
	 *
	 * @static
	 * @param	string $key	The header key
	 * @param	string $value The header name
	 */
	 public static function setTrustedHeaderName($key, $value){
		self::$realClass->setTrustedHeaderName($key, $value);
	 }

	/**
	 * Returns true if $_SERVER entries coming from proxies are trusted,
	 * false otherwise.
	 *
	 * @static
	 * @return boolean
	 */
	 public static function isProxyTrusted(){
		return self::$realClass->isProxyTrusted();
	 }

	/**
	 * Normalizes a query string.
	 * It builds a normalized query string, where keys/value pairs are alphabetized,
	 * have consistent escaping and unneeded delimiters are removed.
	 *
	 * @static
	 * @param	string $qs Query string
	 * @return string A normalized query string for the Request
	 */
	 public static function normalizeQueryString($qs){
		return self::$realClass->normalizeQueryString($qs);
	 }

	/**
	 * Enables support for the _method request parameter to determine the intended HTTP method.
	 * Be warned that enabling this feature might lead to CSRF issues in your code.
	 * Check that you are using CSRF tokens when required.
	 * The HTTP method can only be overridden when the real HTTP method is POST.
	 *
	 * @static
	 */
	 public static function enableHttpMethodParameterOverride(){
		self::$realClass->enableHttpMethodParameterOverride();
	 }

	/**
	 * Checks whether support for the _method request parameter is enabled.
	 *
	 * @static
	 * @return Boolean True when the _method request parameter is enabled, false otherwise
	 */
	 public static function getHttpMethodParameterOverride(){
		return self::$realClass->getHttpMethodParameterOverride();
	 }

	/**
	 * Gets a "parameter" value.
	 * This method is mainly useful for libraries that want to provide some flexibility.
	 * Order of precedence: GET, PATH, POST
	 * Avoid using this method in controllers:
	 * * slow
	 * * prefer to get from a "named" source
	 * It is better to explicitly get request parameters from the appropriate
	 * public property instead (query, attributes, request).
	 *
	 * @static
	 * @param	string	$key	the key
	 * @param	mixed	$default the default value
	 * @param	Boolean $deep	is parameter deep in multidimensional array
	 * @return mixed
	 */
	 public static function get($key, $default = null, $deep = false){
		return self::$realClass->get($key, $default, $deep);
	 }

	/**
	 * Gets the Session.
	 *
	 * @static
	 * @return SessionInterface|null The session
	 */
	 public static function getSession(){
		return self::$realClass->getSession();
	 }

	/**
	 * Whether the request contains a Session which was started in one of the
	 * previous requests.
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function hasPreviousSession(){
		return self::$realClass->hasPreviousSession();
	 }

	/**
	 * Whether the request contains a Session object.
	 * This method does not give any information about the state of the session object,
	 * like whether the session is started or not. It is just a way to check if this Request
	 * is associated with a Session instance.
	 *
	 * @static
	 * @return Boolean true when the Request contains a Session object, false otherwise
	 */
	 public static function hasSession(){
		return self::$realClass->hasSession();
	 }

	/**
	 * Sets the Session.
	 *
	 * @static
	 * @param	SessionInterface $session The Session
	 */
	 public static function setSession($session){
		self::$realClass->setSession($session);
	 }

	/**
	 * Returns the client IP address.
	 * This method can read the client IP address from the "X-Forwarded-For" header
	 * when trusted proxies were set via "setTrustedProxies()". The "X-Forwarded-For"
	 * header value is a comma+space separated list of IP addresses, the left-most
	 * being the original client, and each successive proxy that passed the request
	 * adding the IP address where it received the request from.
	 * If your reverse proxy uses a different header name than "X-Forwarded-For",
	 * ("Client-Ip" for instance), configure it via "setTrustedHeaderName()" with
	 * the "client-ip" key.
	 *
	 * @static
	 * @return string The client IP address
	 */
	 public static function getClientIp(){
		return self::$realClass->getClientIp();
	 }

	/**
	 * Returns current script name.
	 *
	 * @static
	 * @return string
	 */
	 public static function getScriptName(){
		return self::$realClass->getScriptName();
	 }

	/**
	 * Returns the path being requested relative to the executed script.
	 * The path info always starts with a /.
	 * Suppose this request is instantiated from /mysite on localhost:
	 * * http://localhost/mysite              returns an empty string
	 * * http://localhost/mysite/about        returns '/about'
	 * * http://localhost/mysite/enco%20ded   returns '/enco%20ded'
	 * * http://localhost/mysite/about?var=1  returns '/about'
	 *
	 * @static
	 * @return string The raw path (i.e. not urldecoded)
	 */
	 public static function getPathInfo(){
		return self::$realClass->getPathInfo();
	 }

	/**
	 * Returns the root path from which this request is executed.
	 * Suppose that an index.php file instantiates this request object:
	 * * http://localhost/index.php         returns an empty string
	 * * http://localhost/index.php/page    returns an empty string
	 * * http://localhost/web/index.php     returns '/web'
	 * * http://localhost/we%20b/index.php  returns '/we%20b'
	 *
	 * @static
	 * @return string The raw path (i.e. not urldecoded)
	 */
	 public static function getBasePath(){
		return self::$realClass->getBasePath();
	 }

	/**
	 * Returns the root url from which this request is executed.
	 * The base URL never ends with a /.
	 * This is similar to getBasePath(), except that it also includes the
	 * script filename (e.g. index.php) if one exists.
	 *
	 * @static
	 * @return string The raw url (i.e. not urldecoded)
	 */
	 public static function getBaseUrl(){
		return self::$realClass->getBaseUrl();
	 }

	/**
	 * Gets the request's scheme.
	 *
	 * @static
	 * @return string
	 */
	 public static function getScheme(){
		return self::$realClass->getScheme();
	 }

	/**
	 * Returns the port on which the request is made.
	 * This method can read the client port from the "X-Forwarded-Port" header
	 * when trusted proxies were set via "setTrustedProxies()".
	 * The "X-Forwarded-Port" header must contain the client port.
	 * If your reverse proxy uses a different header name than "X-Forwarded-Port",
	 * configure it via "setTrustedHeaderName()" with the "client-port" key.
	 *
	 * @static
	 * @return string
	 */
	 public static function getPort(){
		return self::$realClass->getPort();
	 }

	/**
	 * Returns the user.
	 *
	 * @static
	 * @return string|null
	 */
	 public static function getUser(){
		return self::$realClass->getUser();
	 }

	/**
	 * Returns the password.
	 *
	 * @static
	 * @return string|null
	 */
	 public static function getPassword(){
		return self::$realClass->getPassword();
	 }

	/**
	 * Gets the user info.
	 *
	 * @static
	 * @return string A user name and, optionally, scheme-specific information about how to gain authorization to access the server
	 */
	 public static function getUserInfo(){
		return self::$realClass->getUserInfo();
	 }

	/**
	 * Returns the HTTP host being requested.
	 * The port name will be appended to the host if it's non-standard.
	 *
	 * @static
	 * @return string
	 */
	 public static function getHttpHost(){
		return self::$realClass->getHttpHost();
	 }

	/**
	 * Returns the requested URI.
	 *
	 * @static
	 * @return string The raw URI (i.e. not urldecoded)
	 */
	 public static function getRequestUri(){
		return self::$realClass->getRequestUri();
	 }

	/**
	 * Gets the scheme and HTTP host.
	 * If the URL was called with basic authentication, the user
	 * and the password are not added to the generated string.
	 *
	 * @static
	 * @return string The scheme and HTTP host
	 */
	 public static function getSchemeAndHttpHost(){
		return self::$realClass->getSchemeAndHttpHost();
	 }

	/**
	 * Generates a normalized URI for the Request.
	 *
	 * @static
	 * @return string A normalized URI for the Request
	 */
	 public static function getUri(){
		return self::$realClass->getUri();
	 }

	/**
	 * Generates a normalized URI for the given path.
	 *
	 * @static
	 * @param	string $path A path to use instead of the current one
	 * @return string The normalized URI for the path
	 */
	 public static function getUriForPath($path){
		return self::$realClass->getUriForPath($path);
	 }

	/**
	 * Generates the normalized query string for the Request.
	 * It builds a normalized query string, where keys/value pairs are alphabetized
	 * and have consistent escaping.
	 *
	 * @static
	 * @return string|null A normalized query string for the Request
	 */
	 public static function getQueryString(){
		return self::$realClass->getQueryString();
	 }

	/**
	 * Checks whether the request is secure or not.
	 * This method can read the client port from the "X-Forwarded-Proto" header
	 * when trusted proxies were set via "setTrustedProxies()".
	 * The "X-Forwarded-Proto" header must contain the protocol: "https" or "http".
	 * If your reverse proxy uses a different header name than "X-Forwarded-Proto"
	 * ("SSL_HTTPS" for instance), configure it via "setTrustedHeaderName()" with
	 * the "client-proto" key.
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isSecure(){
		return self::$realClass->isSecure();
	 }

	/**
	 * Returns the host name.
	 * This method can read the client port from the "X-Forwarded-Host" header
	 * when trusted proxies were set via "setTrustedProxies()".
	 * The "X-Forwarded-Host" header must contain the client host name.
	 * If your reverse proxy uses a different header name than "X-Forwarded-Host",
	 * configure it via "setTrustedHeaderName()" with the "client-host" key.
	 *
	 * @static
	 * @return string
	 */
	 public static function getHost(){
		return self::$realClass->getHost();
	 }

	/**
	 * Sets the request method.
	 *
	 * @static
	 * @param	string $method
	 */
	 public static function setMethod($method){
		self::$realClass->setMethod($method);
	 }

	/**
	 * Gets the request "intended" method.
	 * If the X-HTTP-Method-Override header is set, and if the method is a POST,
	 * then it is used to determine the "real" intended HTTP method.
	 * The _method request parameter can also be used to determine the HTTP method,
	 * but only if enableHttpMethodParameterOverride() has been called.
	 * The method is always an uppercased string.
	 *
	 * @static
	 * @return string The request method
	 */
	 public static function getMethod(){
		return self::$realClass->getMethod();
	 }

	/**
	 * Gets the "real" request method.
	 *
	 * @static
	 * @return string The request method
	 */
	 public static function getRealMethod(){
		return self::$realClass->getRealMethod();
	 }

	/**
	 * Gets the mime type associated with the format.
	 *
	 * @static
	 * @param	string $format The format
	 * @return string The associated mime type (null if not found)
	 */
	 public static function getMimeType($format){
		return self::$realClass->getMimeType($format);
	 }

	/**
	 * Gets the format associated with the mime type.
	 *
	 * @static
	 * @param	string $mimeType The associated mime type
	 * @return string|null The format (null if not found)
	 */
	 public static function getFormat($mimeType){
		return self::$realClass->getFormat($mimeType);
	 }

	/**
	 * Associates a format with mime types.
	 *
	 * @static
	 * @param	string	$format	The format
	 * @param	string|array $mimeTypes The associated mime types (the preferred one must be the first as it will be used as the content type)
	 */
	 public static function setFormat($format, $mimeTypes){
		self::$realClass->setFormat($format, $mimeTypes);
	 }

	/**
	 * Gets the request format.
	 * Here is the process to determine the format:
	 * * format defined by the user (with setRequestFormat())
	 * * _format request parameter
	 * * $default
	 *
	 * @static
	 * @param	string $default The default format
	 * @return string The request format
	 */
	 public static function getRequestFormat($default = 'html'){
		return self::$realClass->getRequestFormat($default);
	 }

	/**
	 * Sets the request format.
	 *
	 * @static
	 * @param	string $format The request format.
	 */
	 public static function setRequestFormat($format){
		self::$realClass->setRequestFormat($format);
	 }

	/**
	 * Gets the format associated with the request.
	 *
	 * @static
	 * @return string|null The format (null if no content type is present)
	 */
	 public static function getContentType(){
		return self::$realClass->getContentType();
	 }

	/**
	 * Sets the default locale.
	 *
	 * @static
	 * @param	string $locale
	 */
	 public static function setDefaultLocale($locale){
		self::$realClass->setDefaultLocale($locale);
	 }

	/**
	 * Sets the locale.
	 *
	 * @static
	 * @param	string $locale
	 */
	 public static function setLocale($locale){
		self::$realClass->setLocale($locale);
	 }

	/**
	 * Get the locale.
	 *
	 * @static
	 * @return string
	 */
	 public static function getLocale(){
		return self::$realClass->getLocale();
	 }

	/**
	 * Checks if the request method is of specified type.
	 *
	 * @static
	 * @param	string $method Uppercase request method (GET, POST etc).
	 * @return Boolean
	 */
	 public static function isMethod($method){
		return self::$realClass->isMethod($method);
	 }

	/**
	 * Checks whether the method is safe or not.
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isMethodSafe(){
		return self::$realClass->isMethodSafe();
	 }

	/**
	 * Returns the request body content.
	 *
	 * @static
	 * @param	Boolean $asResource If true, a resource will be returned
	 * @return string|resource The request body content or a resource to read the body stream.
	 */
	 public static function getContent($asResource = false){
		return self::$realClass->getContent($asResource);
	 }

	/**
	 * Gets the Etags.
	 *
	 * @static
	 * @return array The entity tags
	 */
	 public static function getETags(){
		return self::$realClass->getETags();
	 }

	/**
	 * 
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isNoCache(){
		return self::$realClass->isNoCache();
	 }

	/**
	 * Returns the preferred language.
	 *
	 * @static
	 * @param	array $locales An array of ordered available locales
	 * @return string|null The preferred locale
	 */
	 public static function getPreferredLanguage($locales = null){
		return self::$realClass->getPreferredLanguage($locales);
	 }

	/**
	 * Gets a list of languages acceptable by the client browser.
	 *
	 * @static
	 * @return array Languages ordered in the user browser preferences
	 */
	 public static function getLanguages(){
		return self::$realClass->getLanguages();
	 }

	/**
	 * Gets a list of charsets acceptable by the client browser.
	 *
	 * @static
	 * @return array List of charsets in preferable order
	 */
	 public static function getCharsets(){
		return self::$realClass->getCharsets();
	 }

	/**
	 * Gets a list of content types acceptable by the client browser
	 *
	 * @static
	 * @return array List of content types in preferable order
	 */
	 public static function getAcceptableContentTypes(){
		return self::$realClass->getAcceptableContentTypes();
	 }

	/**
	 * Returns true if the request is a XMLHttpRequest.
	 * It works if your JavaScript library set an X-Requested-With HTTP header.
	 * It is known to work with common JavaScript frameworks:
	 *
	 * @static
	 * @return Boolean true if the request is an XMLHttpRequest, false otherwise
	 */
	 public static function isXmlHttpRequest(){
		return self::$realClass->isXmlHttpRequest();
	 }

	/**
	 * Splits an Accept-* HTTP header.
	 *
	 * @static
	 * @param	string $header Header to split
	 * @return array Array indexed by the values of the Accept-* header in preferred order
	 */
	 public static function splitHttpAcceptHeader($header){
		return self::$realClass->splitHttpAcceptHeader($header);
	 }

}

 class Response{
	/**
	 * @var Illuminate\Http\Response $realClass
	 */
	 static private $realClass;

	/**
	 * Add a cookie to the response.
	 *
	 * @static
	 * @param	Symfony\Component\HttpFoundation\Cookie	$cookie
	 * @return Illuminate\Http\Response
	 */
	 public static function withCookie($cookie){
		return self::$realClass->withCookie($cookie);
	 }

	/**
	 * Set the content on the response.
	 *
	 * @static
	 * @param	mixed	$content
	 */
	 public static function setContent($content){
		self::$realClass->setContent($content);
	 }

	/**
	 * Get the original response content.
	 *
	 * @static
	 * @return mixed
	 */
	 public static function getOriginalContent(){
		return self::$realClass->getOriginalContent();
	 }

	/**
	 * Constructor.
	 *
	 * @static
	 * @param	string	$content The response content
	 * @param	integer $status	The response status code
	 * @param	array	$headers An array of response headers
	 */
	 public static function __construct($content = '', $status = '200', $headers = array()){
		self::$realClass->__construct($content, $status, $headers);
	 }

	/**
	 * Factory method for chainability
	 * Example:
	 * return Response::create($body, 200)
	 * ->setSharedMaxAge(300);
	 *
	 * @static
	 * @param	string	$content The response content
	 * @param	integer $status	The response status code
	 * @param	array	$headers An array of response headers
	 * @return Response
	 */
	 public static function create($content = '', $status = '200', $headers = array()){
		return self::$realClass->create($content, $status, $headers);
	 }

	/**
	 * Returns the Response as an HTTP string.
	 * The string representation of the Response is the same as the
	 * one that will be sent to the client only if the prepare() method
	 * has been called before.
	 *
	 * @static
	 * @return string The Response as an HTTP string
	 */
	 public static function __toString(){
		return self::$realClass->__toString();
	 }

	/**
	 * Clones the current Response instance.
	 *
	 * @static
	 */
	 public static function __clone(){
		self::$realClass->__clone();
	 }

	/**
	 * Prepares the Response before it is sent to the client.
	 * This method tweaks the Response to ensure that it is
	 * compliant with RFC 2616. Most of the changes are based on
	 * the Request that is "associated" with this Response.
	 *
	 * @static
	 * @param	Request $request A Request instance
	 * @return Response The current response.
	 */
	 public static function prepare($request){
		return self::$realClass->prepare($request);
	 }

	/**
	 * Sends HTTP headers.
	 *
	 * @static
	 * @return Response
	 */
	 public static function sendHeaders(){
		return self::$realClass->sendHeaders();
	 }

	/**
	 * Sends content for the current web response.
	 *
	 * @static
	 * @return Response
	 */
	 public static function sendContent(){
		return self::$realClass->sendContent();
	 }

	/**
	 * Sends HTTP headers and content.
	 *
	 * @static
	 * @return Response
	 */
	 public static function send(){
		return self::$realClass->send();
	 }

	/**
	 * Gets the current response content.
	 *
	 * @static
	 * @return string Content
	 */
	 public static function getContent(){
		return self::$realClass->getContent();
	 }

	/**
	 * Sets the HTTP protocol version (1.0 or 1.1).
	 *
	 * @static
	 * @param	string $version The HTTP protocol version
	 * @return Response
	 */
	 public static function setProtocolVersion($version){
		return self::$realClass->setProtocolVersion($version);
	 }

	/**
	 * Gets the HTTP protocol version.
	 *
	 * @static
	 * @return string The HTTP protocol version
	 */
	 public static function getProtocolVersion(){
		return self::$realClass->getProtocolVersion();
	 }

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
	 public static function setStatusCode($code, $text = null){
		return self::$realClass->setStatusCode($code, $text);
	 }

	/**
	 * Retrieves the status code for the current web response.
	 *
	 * @static
	 * @return integer Status code
	 */
	 public static function getStatusCode(){
		return self::$realClass->getStatusCode();
	 }

	/**
	 * Sets the response charset.
	 *
	 * @static
	 * @param	string $charset Character set
	 * @return Response
	 */
	 public static function setCharset($charset){
		return self::$realClass->setCharset($charset);
	 }

	/**
	 * Retrieves the response charset.
	 *
	 * @static
	 * @return string Character set
	 */
	 public static function getCharset(){
		return self::$realClass->getCharset();
	 }

	/**
	 * Returns true if the response is worth caching under any circumstance.
	 * Responses marked "private" with an explicit Cache-Control directive are
	 * considered uncacheable.
	 * Responses with neither a freshness lifetime (Expires, max-age) nor cache
	 * validator (Last-Modified, ETag) are considered uncacheable.
	 *
	 * @static
	 * @return Boolean true if the response is worth caching, false otherwise
	 */
	 public static function isCacheable(){
		return self::$realClass->isCacheable();
	 }

	/**
	 * Returns true if the response is "fresh".
	 * Fresh responses may be served from cache without any interaction with the
	 * origin. A response is considered fresh when it includes a Cache-Control/max-age
	 * indicator or Expires header and the calculated age is less than the freshness lifetime.
	 *
	 * @static
	 * @return Boolean true if the response is fresh, false otherwise
	 */
	 public static function isFresh(){
		return self::$realClass->isFresh();
	 }

	/**
	 * Returns true if the response includes headers that can be used to validate
	 * the response with the origin server using a conditional GET request.
	 *
	 * @static
	 * @return Boolean true if the response is validateable, false otherwise
	 */
	 public static function isValidateable(){
		return self::$realClass->isValidateable();
	 }

	/**
	 * Marks the response as "private".
	 * It makes the response ineligible for serving other clients.
	 *
	 * @static
	 * @return Response
	 */
	 public static function setPrivate(){
		return self::$realClass->setPrivate();
	 }

	/**
	 * Marks the response as "public".
	 * It makes the response eligible for serving other clients.
	 *
	 * @static
	 * @return Response
	 */
	 public static function setPublic(){
		return self::$realClass->setPublic();
	 }

	/**
	 * Returns true if the response must be revalidated by caches.
	 * This method indicates that the response must not be served stale by a
	 * cache in any circumstance without first revalidating with the origin.
	 * When present, the TTL of the response should not be overridden to be
	 * greater than the value provided by the origin.
	 *
	 * @static
	 * @return Boolean true if the response must be revalidated by a cache, false otherwise
	 */
	 public static function mustRevalidate(){
		return self::$realClass->mustRevalidate();
	 }

	/**
	 * Returns the Date header as a DateTime instance.
	 *
	 * @static
	 * @return \DateTime A \DateTime instance
	 */
	 public static function getDate(){
		return self::$realClass->getDate();
	 }

	/**
	 * Sets the Date header.
	 *
	 * @static
	 * @param	\DateTime $date A \DateTime instance
	 * @return Response
	 */
	 public static function setDate($date){
		return self::$realClass->setDate($date);
	 }

	/**
	 * Returns the age of the response.
	 *
	 * @static
	 * @return integer The age of the response in seconds
	 */
	 public static function getAge(){
		return self::$realClass->getAge();
	 }

	/**
	 * Marks the response stale by setting the Age header to be equal to the maximum age of the response.
	 *
	 * @static
	 * @return Response
	 */
	 public static function expire(){
		return self::$realClass->expire();
	 }

	/**
	 * Returns the value of the Expires header as a DateTime instance.
	 *
	 * @static
	 * @return \DateTime|null A DateTime instance or null if the header does not exist
	 */
	 public static function getExpires(){
		return self::$realClass->getExpires();
	 }

	/**
	 * Sets the Expires HTTP header with a DateTime instance.
	 * Passing null as value will remove the header.
	 *
	 * @static
	 * @param	\DateTime|null $date A \DateTime instance or null to remove the header
	 * @return Response
	 */
	 public static function setExpires($date = null){
		return self::$realClass->setExpires($date);
	 }

	/**
	 * Returns the number of seconds after the time specified in the response's Date
	 * header when the the response should no longer be considered fresh.
	 * First, it checks for a s-maxage directive, then a max-age directive, and then it falls
	 * back on an expires header. It returns null when no maximum age can be established.
	 *
	 * @static
	 * @return integer|null Number of seconds
	 */
	 public static function getMaxAge(){
		return self::$realClass->getMaxAge();
	 }

	/**
	 * Sets the number of seconds after which the response should no longer be considered fresh.
	 * This methods sets the Cache-Control max-age directive.
	 *
	 * @static
	 * @param	integer $value Number of seconds
	 * @return Response
	 */
	 public static function setMaxAge($value){
		return self::$realClass->setMaxAge($value);
	 }

	/**
	 * Sets the number of seconds after which the response should no longer be considered fresh by shared caches.
	 * This methods sets the Cache-Control s-maxage directive.
	 *
	 * @static
	 * @param	integer $value Number of seconds
	 * @return Response
	 */
	 public static function setSharedMaxAge($value){
		return self::$realClass->setSharedMaxAge($value);
	 }

	/**
	 * Returns the response's time-to-live in seconds.
	 * It returns null when no freshness information is present in the response.
	 * When the responses TTL is <= 0, the response may not be served from cache without first
	 * revalidating with the origin.
	 *
	 * @static
	 * @return integer|null The TTL in seconds
	 */
	 public static function getTtl(){
		return self::$realClass->getTtl();
	 }

	/**
	 * Sets the response's time-to-live for shared caches.
	 * This method adjusts the Cache-Control/s-maxage directive.
	 *
	 * @static
	 * @param	integer $seconds Number of seconds
	 * @return Response
	 */
	 public static function setTtl($seconds){
		return self::$realClass->setTtl($seconds);
	 }

	/**
	 * Sets the response's time-to-live for private/client caches.
	 * This method adjusts the Cache-Control/max-age directive.
	 *
	 * @static
	 * @param	integer $seconds Number of seconds
	 * @return Response
	 */
	 public static function setClientTtl($seconds){
		return self::$realClass->setClientTtl($seconds);
	 }

	/**
	 * Returns the Last-Modified HTTP header as a DateTime instance.
	 *
	 * @static
	 * @return \DateTime|null A DateTime instance or null if the header does not exist
	 */
	 public static function getLastModified(){
		return self::$realClass->getLastModified();
	 }

	/**
	 * Sets the Last-Modified HTTP header with a DateTime instance.
	 * Passing null as value will remove the header.
	 *
	 * @static
	 * @param	\DateTime|null $date A \DateTime instance or null to remove the header
	 * @return Response
	 */
	 public static function setLastModified($date = null){
		return self::$realClass->setLastModified($date);
	 }

	/**
	 * Returns the literal value of the ETag HTTP header.
	 *
	 * @static
	 * @return string|null The ETag HTTP header or null if it does not exist
	 */
	 public static function getEtag(){
		return self::$realClass->getEtag();
	 }

	/**
	 * Sets the ETag value.
	 *
	 * @static
	 * @param	string|null $etag The ETag unique identifier or null to remove the header
	 * @param	Boolean	$weak Whether you want a weak ETag or not
	 * @return Response
	 */
	 public static function setEtag($etag = null, $weak = false){
		return self::$realClass->setEtag($etag, $weak);
	 }

	/**
	 * Sets the response's cache headers (validation and/or expiration).
	 * Available options are: etag, last_modified, max_age, s_maxage, private, and public.
	 *
	 * @static
	 * @param	array $options An array of cache options
	 * @return Response
	 */
	 public static function setCache($options){
		return self::$realClass->setCache($options);
	 }

	/**
	 * Modifies the response so that it conforms to the rules defined for a 304 status code.
	 * This sets the status, removes the body, and discards any headers
	 * that MUST NOT be included in 304 responses.
	 *
	 * @static
	 * @return Response
	 */
	 public static function setNotModified(){
		return self::$realClass->setNotModified();
	 }

	/**
	 * Returns true if the response includes a Vary header.
	 *
	 * @static
	 * @return Boolean true if the response includes a Vary header, false otherwise
	 */
	 public static function hasVary(){
		return self::$realClass->hasVary();
	 }

	/**
	 * Returns an array of header names given in the Vary header.
	 *
	 * @static
	 * @return array An array of Vary names
	 */
	 public static function getVary(){
		return self::$realClass->getVary();
	 }

	/**
	 * Sets the Vary header.
	 *
	 * @static
	 * @param	string|array $headers
	 * @param	Boolean	$replace Whether to replace the actual value of not (true by default)
	 * @return Response
	 */
	 public static function setVary($headers, $replace = true){
		return self::$realClass->setVary($headers, $replace);
	 }

	/**
	 * Determines if the Response validators (ETag, Last-Modified) match
	 * a conditional value specified in the Request.
	 * If the Response is not modified, it sets the status code to 304 and
	 * removes the actual content by calling the setNotModified() method.
	 *
	 * @static
	 * @param	Request $request A Request instance
	 * @return Boolean true if the Response validators match the Request, false otherwise
	 */
	 public static function isNotModified($request){
		return self::$realClass->isNotModified($request);
	 }

	/**
	 * Is response invalid?
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isInvalid(){
		return self::$realClass->isInvalid();
	 }

	/**
	 * Is response informative?
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isInformational(){
		return self::$realClass->isInformational();
	 }

	/**
	 * Is response successful?
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isSuccessful(){
		return self::$realClass->isSuccessful();
	 }

	/**
	 * Is the response a redirect?
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isRedirection(){
		return self::$realClass->isRedirection();
	 }

	/**
	 * Is there a client error?
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isClientError(){
		return self::$realClass->isClientError();
	 }

	/**
	 * Was there a server side error?
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isServerError(){
		return self::$realClass->isServerError();
	 }

	/**
	 * Is the response OK?
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isOk(){
		return self::$realClass->isOk();
	 }

	/**
	 * Is the response forbidden?
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isForbidden(){
		return self::$realClass->isForbidden();
	 }

	/**
	 * Is the response a not found error?
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isNotFound(){
		return self::$realClass->isNotFound();
	 }

	/**
	 * Is the response a redirect of some form?
	 *
	 * @static
	 * @param	string $location
	 * @return Boolean
	 */
	 public static function isRedirect($location = null){
		return self::$realClass->isRedirect($location);
	 }

	/**
	 * Is the response empty?
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isEmpty(){
		return self::$realClass->isEmpty();
	 }

}

 class Route{
	/**
	 * @var Illuminate\Routing\Router $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new router instance.
	 *
	 * @static
	 * @param	Illuminate\Container	$container
	 */
	 public static function __construct($container = null){
		self::$realClass->__construct($container);
	 }

	/**
	 * Add a new route to the collection.
	 *
	 * @static
	 * @param	string	$pattern
	 * @param	mixed	$action
	 * @return Illuminate\Routing\Route
	 */
	 public static function get($pattern, $action){
		return self::$realClass->get($pattern, $action);
	 }

	/**
	 * Add a new route to the collection.
	 *
	 * @static
	 * @param	string	$pattern
	 * @param	mixed	$action
	 * @return Illuminate\Routing\Route
	 */
	 public static function post($pattern, $action){
		return self::$realClass->post($pattern, $action);
	 }

	/**
	 * Add a new route to the collection.
	 *
	 * @static
	 * @param	string	$pattern
	 * @param	mixed	$action
	 * @return Illuminate\Routing\Route
	 */
	 public static function put($pattern, $action){
		return self::$realClass->put($pattern, $action);
	 }

	/**
	 * Add a new route to the collection.
	 *
	 * @static
	 * @param	string	$pattern
	 * @param	mixed	$action
	 * @return Illuminate\Routing\Route
	 */
	 public static function patch($pattern, $action){
		return self::$realClass->patch($pattern, $action);
	 }

	/**
	 * Add a new route to the collection.
	 *
	 * @static
	 * @param	string	$pattern
	 * @param	mixed	$action
	 * @return Illuminate\Routing\Route
	 */
	 public static function delete($pattern, $action){
		return self::$realClass->delete($pattern, $action);
	 }

	/**
	 * Add a new route to the collection.
	 *
	 * @static
	 * @param	string	$method
	 * @param	string	$pattern
	 * @param	mixed	$action
	 * @return Illuminate\Routing\Route
	 */
	 public static function match($method, $pattern, $action){
		return self::$realClass->match($method, $pattern, $action);
	 }

	/**
	 * Add a new route to the collection.
	 *
	 * @static
	 * @param	string	$pattern
	 * @param	mixed	$action
	 * @return Illuminate\Routing\Route
	 */
	 public static function any($pattern, $action){
		return self::$realClass->any($pattern, $action);
	 }

	/**
	 * Register an array of controllers with wildcard routing.
	 *
	 * @static
	 * @param	array	$controllers
	 */
	 public static function controllers($controllers){
		self::$realClass->controllers($controllers);
	 }

	/**
	 * Route a controller to a URI with wildcard routing.
	 *
	 * @static
	 * @param	string	$uri
	 * @param	string	$controller
	 * @return Illuminate\Routing\Route
	 */
	 public static function controller($uri, $controller){
		return self::$realClass->controller($uri, $controller);
	 }

	/**
	 * Route a resource to a controller.
	 *
	 * @static
	 * @param	string	$resource
	 * @param	string	$controller
	 * @param	array	$options
	 */
	 public static function resource($resource, $controller, $options = array()){
		self::$realClass->resource($resource, $controller, $options);
	 }

	/**
	 * Get the base resource URI for a given resource.
	 *
	 * @static
	 * @param	string	$resource
	 * @return string
	 */
	 public static function getResourceUri($resource){
		return self::$realClass->getResourceUri($resource);
	 }

	/**
	 * Create a route group with shared attributes.
	 *
	 * @static
	 * @param	array	$attributes
	 * @param	Closure	$callback
	 */
	 public static function group($attributes, $callback){
		self::$realClass->group($attributes, $callback);
	 }

	/**
	 * Get the response for a given request.
	 *
	 * @static
	 * @param	Symfony\Component\HttpFoundation\Request	$request
	 * @return Symfony\Component\HttpFoundation\Response
	 */
	 public static function dispatch($request){
		return self::$realClass->dispatch($request);
	 }

	/**
	 * Register a "before" routing filter.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function before($callback){
		self::$realClass->before($callback);
	 }

	/**
	 * Register an "after" routing filter.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function after($callback){
		self::$realClass->after($callback);
	 }

	/**
	 * Register a "close" routing filter.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function close($callback){
		self::$realClass->close($callback);
	 }

	/**
	 * Register a "finish" routing filters.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function finish($callback){
		self::$realClass->finish($callback);
	 }

	/**
	 * Register a new filter with the application.
	 *
	 * @static
	 * @param	string	$name
	 * @param	Closure|string	$callback
	 */
	 public static function addFilter($name, $callback){
		self::$realClass->addFilter($name, $callback);
	 }

	/**
	 * Get a registered filter callback.
	 *
	 * @static
	 * @param	string	$name
	 * @return Closure
	 */
	 public static function getFilter($name){
		return self::$realClass->getFilter($name);
	 }

	/**
	 * Tie a registered filter to a URI pattern.
	 *
	 * @static
	 * @param	string	$pattern
	 * @param	string|array	$names
	 */
	 public static function matchFilter($pattern, $names){
		self::$realClass->matchFilter($pattern, $names);
	 }

	/**
	 * Find the patterned filters matching a request.
	 *
	 * @static
	 * @param	Illuminate\Foundation\Request	$request
	 * @return array
	 */
	 public static function findPatternFilters($request){
		return self::$realClass->findPatternFilters($request);
	 }

	/**
	 * Call the "finish" global filter.
	 *
	 * @static
	 * @param	Symfony\Component\HttpFoundation\Request	$request
	 * @param	Symfony\Component\HttpFoundation\Response	$response
	 * @return mixed
	 */
	 public static function callFinishFilter($request, $response){
		return self::$realClass->callFinishFilter($request, $response);
	 }

	/**
	 * Set a global where pattern on all routes
	 *
	 * @static
	 * @param	string	$key
	 * @param	string	$pattern
	 */
	 public static function pattern($key, $pattern){
		self::$realClass->pattern($key, $pattern);
	 }

	/**
	 * Register a model binder for a wildcard.
	 *
	 * @static
	 * @param	string	$key
	 * @param	string	$class
	 */
	 public static function model($key, $class){
		self::$realClass->model($key, $class);
	 }

	/**
	 * Register a custom parameter binder.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$binder
	 */
	 public static function bind($key, $binder){
		self::$realClass->bind($key, $binder);
	 }

	/**
	 * Determine if a given key has a registered binder.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function hasBinder($key){
		return self::$realClass->hasBinder($key);
	 }

	/**
	 * Call a binder for a given wildcard.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 * @param	Illuminate\Routing\Route	$route
	 * @return mixed
	 */
	 public static function performBinding($key, $value, $route){
		return self::$realClass->performBinding($key, $value, $route);
	 }

	/**
	 * Prepare the given value as a Response object.
	 *
	 * @static
	 * @param	mixed	$value
	 * @param	Illuminate\Foundation\Request	$request
	 * @return Symfony\Component\HttpFoundation\Response
	 */
	 public static function prepare($value, $request){
		return self::$realClass->prepare($value, $request);
	 }

	/**
	 * Determine if the current route has a given name.
	 *
	 * @static
	 * @param	string	$name
	 * @return bool
	 */
	 public static function currentRouteNamed($name){
		return self::$realClass->currentRouteNamed($name);
	 }

	/**
	 * Determine if the current route uses a given controller action.
	 *
	 * @static
	 * @param	string	$action
	 * @return bool
	 */
	 public static function currentRouteUses($action){
		return self::$realClass->currentRouteUses($action);
	 }

	/**
	 * Determine if route filters are enabled.
	 *
	 * @static
	 * @return bool
	 */
	 public static function filtersEnabled(){
		return self::$realClass->filtersEnabled();
	 }

	/**
	 * Enable the running of filters.
	 *
	 * @static
	 */
	 public static function enableFilters(){
		self::$realClass->enableFilters();
	 }

	/**
	 * Disable the running of all filters.
	 *
	 * @static
	 */
	 public static function disableFilters(){
		self::$realClass->disableFilters();
	 }

	/**
	 * Retrieve the entire route collection.
	 *
	 * @static
	 * @return Symfony\Component\Routing\RouteCollection
	 */
	 public static function getRoutes(){
		return self::$realClass->getRoutes();
	 }

	/**
	 * Get the current request being dispatched.
	 *
	 * @static
	 * @return Symfony\Component\HttpFoundation\Request
	 */
	 public static function getRequest(){
		return self::$realClass->getRequest();
	 }

	/**
	 * Get the current route being executed.
	 *
	 * @static
	 * @return Illuminate\Routing\Route
	 */
	 public static function getCurrentRoute(){
		return self::$realClass->getCurrentRoute();
	 }

	/**
	 * Set the current route on the router.
	 *
	 * @static
	 * @param	Illuminate\Routing\Route	$route
	 */
	 public static function setCurrentRoute($route){
		self::$realClass->setCurrentRoute($route);
	 }

	/**
	 * Get the filters defined on the router.
	 *
	 * @static
	 * @return array
	 */
	 public static function getFilters(){
		return self::$realClass->getFilters();
	 }

	/**
	 * Get the global filters defined on the router.
	 *
	 * @static
	 * @return array
	 */
	 public static function getGlobalFilters(){
		return self::$realClass->getGlobalFilters();
	 }

	/**
	 * Get the controller inspector instance.
	 *
	 * @static
	 * @return Illuminate\Routing\Controllers\Inspector
	 */
	 public static function getInspector(){
		return self::$realClass->getInspector();
	 }

	/**
	 * Set the controller inspector instance.
	 *
	 * @static
	 * @param	Illuminate\Routing\Controllers\Inspector	$inspector
	 */
	 public static function setInspector($inspector){
		self::$realClass->setInspector($inspector);
	 }

	/**
	 * Get the container used by the router.
	 *
	 * @static
	 * @return Illuminate\Container\Container
	 */
	 public static function getContainer(){
		return self::$realClass->getContainer();
	 }

	/**
	 * Set the container instance on the router.
	 *
	 * @static
	 * @param	Illuminate\Container\Container	$container
	 */
	 public static function setContainer($container){
		self::$realClass->setContainer($container);
	 }

}

 class Schema{
	/**
	 * @var Illuminate\Database\Schema\Builder $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new database Schema manager.
	 *
	 * @static
	 * @param	Illuminate\Database\Connection	$connection
	 */
	 public static function __construct($connection){
		self::$realClass->__construct($connection);
	 }

	/**
	 * Determine if the given table exists.
	 *
	 * @static
	 * @param	string	$table
	 * @return bool
	 */
	 public static function hasTable($table){
		return self::$realClass->hasTable($table);
	 }

	/**
	 * Modify a table on the schema.
	 *
	 * @static
	 * @param	string	$table
	 * @param	Closure	$callback
	 * @return Illuminate\Database\Schema\Blueprint
	 */
	 public static function table($table, $callback){
		return self::$realClass->table($table, $callback);
	 }

	/**
	 * Create a new table on the schema.
	 *
	 * @static
	 * @param	string	$table
	 * @param	Closure	$callback
	 * @return Illuminate\Database\Schema\Blueprint
	 */
	 public static function create($table, $callback){
		return self::$realClass->create($table, $callback);
	 }

	/**
	 * Drop a table from the schema.
	 *
	 * @static
	 * @param	string	$table
	 * @return Illuminate\Database\Schema\Blueprint
	 */
	 public static function drop($table){
		return self::$realClass->drop($table);
	 }

	/**
	 * Drop a table from the schema if it exists.
	 *
	 * @static
	 * @param	string	$table
	 * @return Illuminate\Database\Schema\Blueprint
	 */
	 public static function dropIfExists($table){
		return self::$realClass->dropIfExists($table);
	 }

	/**
	 * Rename a table on the schema.
	 *
	 * @static
	 * @param	string	$from
	 * @param	string	$to
	 * @return Illuminate\Database\Schema\Blueprint
	 */
	 public static function rename($from, $to){
		return self::$realClass->rename($from, $to);
	 }

	/**
	 * Get the database connection instance.
	 *
	 * @static
	 * @return Illuminate\Database\Connection
	 */
	 public static function getConnection(){
		return self::$realClass->getConnection();
	 }

	/**
	 * Set the database connection instance.
	 *
	 * @static
	 * @param	Illuminate\Database\Connection
	 * @return Illuminate\Database\Schema
	 */
	 public static function setConnection($connection){
		return self::$realClass->setConnection($connection);
	 }

}

 class Seeder{
	/**
	 * @var Illuminate\Database\Seeder $realClass
	 */
	 static private $realClass;

	/**
	 * Run the database seeds.
	 *
	 * @static
	 */
	 public static function run(){
		self::$realClass->run();
	 }

	/**
	 * Seed the given connection from the given path.
	 *
	 * @static
	 * @param	string	$class
	 */
	 public static function call($class){
		self::$realClass->call($class);
	 }

	/**
	 * Set the IoC container instance.
	 *
	 * @static
	 * @param	Illuminate\Container\Container	$container
	 */
	 public static function setContainer($container){
		self::$realClass->setContainer($container);
	 }

}

 class Session{
	/**
	 * @var Illuminate\Support\Facades\Session $realClass
	 */
	 static private $realClass;

	/**
	 * Hotswap the underlying instance behind the facade.
	 *
	 * @static
	 * @param	mixed	$instance
	 */
	 public static function swap($instance){
		self::$realClass->swap($instance);
	 }

	/**
	 * Initiate a mock expectation on the facade.
	 *
	 * @static
	 * @param	dynamic
	 * @return Mockery\Expectation
	 */
	 public static function shouldReceive(){
		return self::$realClass->shouldReceive();
	 }

	/**
	 * Get the root object behind the facade.
	 *
	 * @static
	 * @return mixed
	 */
	 public static function getFacadeRoot(){
		return self::$realClass->getFacadeRoot();
	 }

	/**
	 * Clear all of the resolved instances.
	 *
	 * @static
	 */
	 public static function clearResolvedInstances(){
		self::$realClass->clearResolvedInstances();
	 }

	/**
	 * Get the application instance behind the facade.
	 *
	 * @static
	 * @return Illuminate\Foundation\Application
	 */
	 public static function getFacadeApplication(){
		return self::$realClass->getFacadeApplication();
	 }

	/**
	 * Set the application instance.
	 *
	 * @static
	 * @param	Illuminate\Foundation\Application	$app
	 */
	 public static function setFacadeApplication($app){
		self::$realClass->setFacadeApplication($app);
	 }

	/**
	 * Handle dynamic, static calls to the object.
	 *
	 * @static
	 * @param	string	$method
	 * @param	array	$args
	 * @return mixed
	 */
	 public static function __callStatic($method, $args){
		return self::$realClass->__callStatic($method, $args);
	 }

}

 class Str{
	/**
	 * @var Illuminate\Support\Str $realClass
	 */
	 static private $realClass;

	/**
	 * Transliterate a UTF-8 value to ASCII.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function ascii($value){
		return self::$realClass->ascii($value);
	 }

	/**
	 * Convert a value to camel case.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function camel($value){
		return self::$realClass->camel($value);
	 }

	/**
	 * Determine if a given string contains a given sub-string.
	 *
	 * @static
	 * @param	string	$haystack
	 * @param	string|array	$needle
	 * @return bool
	 */
	 public static function contains($haystack, $needle){
		return self::$realClass->contains($haystack, $needle);
	 }

	/**
	 * Determine if a given string ends with a given needle.
	 *
	 * @static
	 * @param	string $haystack
	 * @param	string $needle
	 * @return bool
	 */
	 public static function endsWith($haystack, $needle){
		return self::$realClass->endsWith($haystack, $needle);
	 }

	/**
	 * Cap a string with a single instance of a given value.
	 *
	 * @static
	 * @param	string	$value
	 * @param	string	$cap
	 * @return string
	 */
	 public static function finish($value, $cap){
		return self::$realClass->finish($value, $cap);
	 }

	/**
	 * Determine if a given string matches a given pattern.
	 *
	 * @static
	 * @param	string	$pattern
	 * @param	string	$value
	 * @return bool
	 */
	 public static function is($pattern, $value){
		return self::$realClass->is($pattern, $value);
	 }

	/**
	 * Limit the number of characters in a string.
	 *
	 * @static
	 * @param	string	$value
	 * @param	int	$limit
	 * @param	string	$end
	 * @return string
	 */
	 public static function limit($value, $limit = '100', $end = '...'){
		return self::$realClass->limit($value, $limit, $end);
	 }

	/**
	 * Get the plural form of an English word.
	 *
	 * @static
	 * @param	string	$value
	 * @param	int	$count
	 * @return string
	 */
	 public static function plural($value, $count = '2'){
		return self::$realClass->plural($value, $count);
	 }

	/**
	 * Generate a more truly "random" alpha-numeric string.
	 *
	 * @static
	 * @param	int	$length
	 * @return string
	 */
	 public static function random($length = '16'){
		return self::$realClass->random($length);
	 }

	/**
	 * Generate a "random" alpha-numeric string.
	 * Should not be considered sufficient for cryptography, etc.
	 *
	 * @static
	 * @param	int	$length
	 * @return string
	 */
	 public static function quickRandom($length = '16'){
		return self::$realClass->quickRandom($length);
	 }

	/**
	 * Get the singular form of an English word.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function singular($value){
		return self::$realClass->singular($value);
	 }

	/**
	 * Generate a URL friendly "slug" from a given string.
	 *
	 * @static
	 * @param	string	$title
	 * @param	string	$separator
	 * @return string
	 */
	 public static function slug($title, $separator = '-'){
		return self::$realClass->slug($title, $separator);
	 }

	/**
	 * Convert a string to snake case.
	 *
	 * @static
	 * @param	string	$value
	 * @param	string	$delimiter
	 * @return string
	 */
	 public static function snake($value, $delimiter = '_'){
		return self::$realClass->snake($value, $delimiter);
	 }

	/**
	 * Determine if a string starts with a given needle.
	 *
	 * @static
	 * @param	string	$haystack
	 * @param	string|array	$needle
	 * @return bool
	 */
	 public static function startsWith($haystack, $needles){
		return self::$realClass->startsWith($haystack, $needles);
	 }

	/**
	 * Convert a value to studly caps case.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function studly($value){
		return self::$realClass->studly($value);
	 }

}

 class URL{
	/**
	 * @var Illuminate\Routing\UrlGenerator $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new URL Generator instance.
	 *
	 * @static
	 * @param	Symfony\Component\Routing\RouteCollection	$routes
	 * @param	Symfony\Component\HttpFoundation\Request	$request
	 */
	 public static function __construct($routes, $request){
		self::$realClass->__construct($routes, $request);
	 }

	/**
	 * Get the current URL for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function current(){
		return self::$realClass->current();
	 }

	/**
	 * Get the URL for the previous request.
	 *
	 * @static
	 * @return string
	 */
	 public static function previous(){
		return self::$realClass->previous();
	 }

	/**
	 * Generate a absolute URL to the given path.
	 *
	 * @static
	 * @param	string	$path
	 * @param	array	$parameters
	 * @param	bool	$secure
	 * @return string
	 */
	 public static function to($path, $parameters = array(), $secure = null){
		return self::$realClass->to($path, $parameters, $secure);
	 }

	/**
	 * Generate a secure, absolute URL to the given path.
	 *
	 * @static
	 * @param	string	$path
	 * @return string
	 */
	 public static function secure($path, $parameters = array()){
		return self::$realClass->secure($path, $parameters);
	 }

	/**
	 * Generate a URL to an application asset.
	 *
	 * @static
	 * @param	string	$path
	 * @param	bool	$secure
	 * @return string
	 */
	 public static function asset($path, $secure = null){
		return self::$realClass->asset($path, $secure);
	 }

	/**
	 * Generate a URL to a secure asset.
	 *
	 * @static
	 * @param	string	$path
	 * @return string
	 */
	 public static function secureAsset($path){
		return self::$realClass->secureAsset($path);
	 }

	/**
	 * Get the URL to a named route.
	 *
	 * @static
	 * @param	string	$name
	 * @param	array	$parameters
	 * @param	bool	$absolute
	 * @return string
	 */
	 public static function route($name, $parameters = array(), $absolute = true){
		return self::$realClass->route($name, $parameters, $absolute);
	 }

	/**
	 * Get the URL to a controller action.
	 *
	 * @static
	 * @param	string	$action
	 * @param	array	$parameters
	 * @param	bool	$absolute
	 * @return string
	 */
	 public static function action($action, $parameters = array(), $absolute = true){
		return self::$realClass->action($action, $parameters, $absolute);
	 }

	/**
	 * Determine if the given path is a valid URL.
	 *
	 * @static
	 * @param	string	$path
	 * @return bool
	 */
	 public static function isValidUrl($path){
		return self::$realClass->isValidUrl($path);
	 }

	/**
	 * Get the request instance.
	 *
	 * @static
	 * @return Symfony\Component\HttpFoundation\Request
	 */
	 public static function getRequest(){
		return self::$realClass->getRequest();
	 }

	/**
	 * Set the current request instance.
	 *
	 * @static
	 * @param	Symfony\Component\HttpFoundation\Request	$request
	 */
	 public static function setRequest($request){
		self::$realClass->setRequest($request);
	 }

	/**
	 * Get the Symfony URL generator instance.
	 *
	 * @static
	 * @return Symfony\Component\Routing\Generator\UrlGenerator
	 */
	 public static function getGenerator(){
		return self::$realClass->getGenerator();
	 }

	/**
	 * Get the Symfony URL generator instance.
	 *
	 * @static
	 * @param	Symfony\Component\Routing\Generator\UrlGenerator	$generator
	 */
	 public static function setGenerator($generator){
		self::$realClass->setGenerator($generator);
	 }

}

 class Validator{
	/**
	 * @var Illuminate\Validation\Factory $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new Validator factory instance.
	 *
	 * @static
	 * @param	Symfony\Component\Translation\TranslatorInterface	$translator
	 */
	 public static function __construct($translator){
		self::$realClass->__construct($translator);
	 }

	/**
	 * Create a new Validator instance.
	 *
	 * @static
	 * @param	array	$data
	 * @param	array	$rules
	 * @param	array	$messages
	 * @return Illuminate\Validation\Validator
	 */
	 public static function make($data, $rules, $messages = array()){
		return self::$realClass->make($data, $rules, $messages);
	 }

	/**
	 * Register a custom validator extension.
	 *
	 * @static
	 * @param	string	$rule
	 * @param	Closure	$extension
	 */
	 public static function extend($rule, $extension){
		self::$realClass->extend($rule, $extension);
	 }

	/**
	 * Register a custom implicit validator extension.
	 *
	 * @static
	 * @param	string	$rule
	 * @param	Closure $extension
	 */
	 public static function extendImplicit($rule, $extension){
		self::$realClass->extendImplicit($rule, $extension);
	 }

	/**
	 * Set the Validator instance resolver.
	 *
	 * @static
	 * @param	Closure	$resolver
	 */
	 public static function resolver($resolver){
		self::$realClass->resolver($resolver);
	 }

	/**
	 * Get the Translator implementation.
	 *
	 * @static
	 * @return Symfony\Component\Translation\TranslatorInterface
	 */
	 public static function getTranslator(){
		return self::$realClass->getTranslator();
	 }

	/**
	 * Get the Presence Verifier implementation.
	 *
	 * @static
	 * @return Illuminate\Validation\PresenceVerifierInterface
	 */
	 public static function getPresenceVerifier(){
		return self::$realClass->getPresenceVerifier();
	 }

	/**
	 * Set the Presence Verifier implementation.
	 *
	 * @static
	 * @param	Illuminate\Validation\PresenceVerifierInterface	$presenceVerifier
	 */
	 public static function setPresenceVerifier($presenceVerifier){
		self::$realClass->setPresenceVerifier($presenceVerifier);
	 }

}

 class View{
	/**
	 * @var Illuminate\View\Environment $realClass
	 */
	 static private $realClass;

	/**
	 * Create a new view environment instance.
	 *
	 * @static
	 * @param	Illuminate\View\Engines\EngineResolver	$engines
	 * @param	Illuminate\View\ViewFinderInterface	$finder
	 * @param	Illuminate\Events\Dispatcher	$events
	 */
	 public static function __construct($engines, $finder, $events){
		self::$realClass->__construct($engines, $finder, $events);
	 }

	/**
	 * Get a evaluated view contents for the given view.
	 *
	 * @static
	 * @param	string	$view
	 * @param	array	$data
	 * @return Illuminate\View\View
	 */
	 public static function make($view, $data = array()){
		return self::$realClass->make($view, $data);
	 }

	/**
	 * Determine if a given view exists.
	 *
	 * @static
	 * @param	string	$view
	 * @return bool
	 */
	 public static function exists($view){
		return self::$realClass->exists($view);
	 }

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
	 public static function renderEach($view, $data, $iterator, $empty = 'raw|'){
		return self::$realClass->renderEach($view, $data, $iterator, $empty);
	 }

	/**
	 * Add a piece of shared data to the environment.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function share($key, $value){
		self::$realClass->share($key, $value);
	 }

	/**
	 * Register a view composer event.
	 *
	 * @static
	 * @param	array|string	$views
	 * @param	Closure|string	$callback
	 * @return Closure
	 */
	 public static function composer($views, $callback){
		return self::$realClass->composer($views, $callback);
	 }

	/**
	 * Call the composer for a given view.
	 *
	 * @static
	 * @param	Illuminate\View\View	$view
	 */
	 public static function callComposer($view){
		self::$realClass->callComposer($view);
	 }

	/**
	 * Start injecting content into a section.
	 *
	 * @static
	 * @param	string	$section
	 * @param	string	$content
	 */
	 public static function startSection($section, $content = ''){
		self::$realClass->startSection($section, $content);
	 }

	/**
	 * Inject inline content into a section.
	 *
	 * @static
	 * @param	string	$section
	 * @param	string	$content
	 */
	 public static function inject($section, $content){
		self::$realClass->inject($section, $content);
	 }

	/**
	 * Stop injecting content into a section and return its contents.
	 *
	 * @static
	 * @return string
	 */
	 public static function yieldSection(){
		return self::$realClass->yieldSection();
	 }

	/**
	 * Stop injecting content into a section.
	 *
	 * @static
	 * @return string
	 */
	 public static function stopSection(){
		return self::$realClass->stopSection();
	 }

	/**
	 * Get the string contents of a section.
	 *
	 * @static
	 * @param	string	$section
	 * @return string
	 */
	 public static function yieldContent($section){
		return self::$realClass->yieldContent($section);
	 }

	/**
	 * Flush all of the section contents.
	 *
	 * @static
	 */
	 public static function flushSections(){
		self::$realClass->flushSections();
	 }

	/**
	 * Increment the rendering counter.
	 *
	 * @static
	 */
	 public static function incrementRender(){
		self::$realClass->incrementRender();
	 }

	/**
	 * Decrement the rendering counter.
	 *
	 * @static
	 */
	 public static function decrementRender(){
		self::$realClass->decrementRender();
	 }

	/**
	 * Check if there are no active render operations.
	 *
	 * @static
	 * @return bool
	 */
	 public static function doneRendering(){
		return self::$realClass->doneRendering();
	 }

	/**
	 * Add a location to the array of view locations.
	 *
	 * @static
	 * @param	string	$location
	 */
	 public static function addLocation($location){
		self::$realClass->addLocation($location);
	 }

	/**
	 * Add a new namespace to the loader.
	 *
	 * @static
	 * @param	string	$namespace
	 * @param	string|array	$hints
	 */
	 public static function addNamespace($namespace, $hints){
		self::$realClass->addNamespace($namespace, $hints);
	 }

	/**
	 * Register a valid view extension and its engine.
	 *
	 * @static
	 * @param	string	$extension
	 * @param	string	$engine
	 * @param	Closure	$resolver
	 */
	 public static function addExtension($extension, $engine, $resolver = null){
		self::$realClass->addExtension($extension, $engine, $resolver);
	 }

	/**
	 * Get the extension to engine bindings.
	 *
	 * @static
	 * @return array
	 */
	 public static function getExtensions(){
		return self::$realClass->getExtensions();
	 }

	/**
	 * Get the engine resolver instance.
	 *
	 * @static
	 * @return Illuminate\View\Engines\EngineResolver
	 */
	 public static function getEngineResolver(){
		return self::$realClass->getEngineResolver();
	 }

	/**
	 * Get the view finder instance.
	 *
	 * @static
	 * @return Illuminate\View\ViewFinder
	 */
	 public static function getFinder(){
		return self::$realClass->getFinder();
	 }

	/**
	 * Get the event dispatcher instance.
	 *
	 * @static
	 * @return Illuminate\Events\Dispatcher
	 */
	 public static function getDispatcher(){
		return self::$realClass->getDispatcher();
	 }

	/**
	 * Get the IoC container instance.
	 *
	 * @static
	 * @return Illuminate\Container
	 */
	 public static function getContainer(){
		return self::$realClass->getContainer();
	 }

	/**
	 * Set the IoC container instance.
	 *
	 * @static
	 * @param	Illuminate\Container	$container
	 */
	 public static function setContainer($container){
		self::$realClass->setContainer($container);
	 }

	/**
	 * Get all of the shared data for the environment.
	 *
	 * @static
	 * @return array
	 */
	 public static function getShared(){
		return self::$realClass->getShared();
	 }

	/**
	 * Get the entire array of sections.
	 *
	 * @static
	 * @return array
	 */
	 public static function getSections(){
		return self::$realClass->getSections();
	 }

}

