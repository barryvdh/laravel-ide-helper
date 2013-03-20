<?php die('Only to be used as an helper for your IDE');

namespace  {
 class Auth{
	/**
	 * @var Illuminate\Auth\Guard $root
	 */
	 static private $root;

	/**
	 * Create a new authentication guard.
	 *
	 * @static
	 * @param	Illuminate\Auth\UserProviderInterface	$provider
	 * @param	Illuminate\Session\Store	$session
	 */
	 public static function __construct($provider, $session){
		self::$root->__construct($provider, $session);
	 }

	/**
	 * Determine if the current user is authenticated.
	 *
	 * @static
	 * @return bool
	 */
	 public static function check(){
		return self::$root->check();
	 }

	/**
	 * Determine if the current user is a guest.
	 *
	 * @static
	 * @return bool
	 */
	 public static function guest(){
		return self::$root->guest();
	 }

	/**
	 * Get the currently authenticated user.
	 *
	 * @static
	 * @return Illuminate\Auth\UserInterface|null
	 */
	 public static function user(){
		return self::$root->user();
	 }

	/**
	 * Log a user into the application without sessions or cookies.
	 *
	 * @static
	 * @param	array	$credentials
	 * @return bool
	 */
	 public static function stateless($credentials = array()){
		return self::$root->stateless($credentials);
	 }

	/**
	 * Validate a user's credentials.
	 *
	 * @static
	 * @param	array	$credentials
	 * @return bool
	 */
	 public static function validate($credentials = array()){
		return self::$root->validate($credentials);
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
		return self::$root->attempt($credentials, $remember, $login);
	 }

	/**
	 * Log a user into the application.
	 *
	 * @static
	 * @param	Illuminate\Auth\UserInterface	$user
	 * @param	bool	$remember
	 */
	 public static function login($user, $remember = false){
		self::$root->login($user, $remember);
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
		return self::$root->loginUsingId($id, $remember);
	 }

	/**
	 * Log the user out of the application.
	 *
	 * @static
	 */
	 public static function logout(){
		self::$root->logout();
	 }

	/**
	 * Get the cookie creator instance used by the guard.
	 *
	 * @static
	 * @return Illuminate\CookieJar
	 */
	 public static function getCookieJar(){
		return self::$root->getCookieJar();
	 }

	/**
	 * Set the cookie creator instance used by the guard.
	 *
	 * @static
	 * @param	Illuminate\CookieJar	$cookie
	 */
	 public static function setCookieJar($cookie){
		self::$root->setCookieJar($cookie);
	 }

	/**
	 * Get the event dispatcher instance.
	 *
	 * @static
	 * @return Illuminate\Events\Dispatcher
	 */
	 public static function getDispatcher(){
		return self::$root->getDispatcher();
	 }

	/**
	 * Set the event dispatcher instance.
	 *
	 * @static
	 * @param	Illuminate\Events\Dispatcher
	 */
	 public static function setDispatcher($events){
		self::$root->setDispatcher($events);
	 }

	/**
	 * Get the session store used by the guard.
	 *
	 * @static
	 * @return Illuminate\Session\Store
	 */
	 public static function getSession(){
		return self::$root->getSession();
	 }

	/**
	 * Get the cookies queued by the guard.
	 *
	 * @static
	 * @return array
	 */
	 public static function getQueuedCookies(){
		return self::$root->getQueuedCookies();
	 }

	/**
	 * Get the user provider used by the guard.
	 *
	 * @static
	 * @return Illuminate\Auth\UserProviderInterface
	 */
	 public static function getProvider(){
		return self::$root->getProvider();
	 }

	/**
	 * Return the currently cached user of the application.
	 *
	 * @static
	 * @return Illuminate\Auth\UserInterface|null
	 */
	 public static function getUser(){
		return self::$root->getUser();
	 }

	/**
	 * Set the current user of the application.
	 *
	 * @static
	 * @param	Illuminate\Auth\UserInterface	$user
	 */
	 public static function setUser($user){
		self::$root->setUser($user);
	 }

	/**
	 * Get a unique identifier for the auth session value.
	 *
	 * @static
	 * @return string
	 */
	 public static function getName(){
		return self::$root->getName();
	 }

	/**
	 * Get the name of the cookie used to store the "recaller".
	 *
	 * @static
	 * @return string
	 */
	 public static function getRecallerName(){
		return self::$root->getRecallerName();
	 }

 }
}

namespace  {
 class Cache{
	/**
	 * @var Illuminate\Cache\Store $root
	 */
	 static private $root;

	/**
	 * Determine if an item exists in the cache.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function has($key){
		return self::$root->has($key);
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
		return self::$root->get($key, $default);
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
		self::$root->put($key, $value, $minutes);
	 }

	/**
	 * Store an item in the cache if the key does not exist.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 * @param	int	$minutes
	 */
	 public static function add($key, $value, $minutes){
		self::$root->add($key, $value, $minutes);
	 }

	/**
	 * Increment the value at a given key.
	 *
	 * @static
	 * @param	string	$key
	 * @param	int	$value
	 */
	 public static function increment($key, $value = '1'){
		self::$root->increment($key, $value);
	 }

	/**
	 * Decrement the value at a given key.
	 *
	 * @static
	 * @param	string	$key
	 * @param	int	$value
	 */
	 public static function decrement($key, $value = '1'){
		self::$root->decrement($key, $value);
	 }

	/**
	 * Store an item in the cache indefinitely.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function forever($key, $value){
		self::$root->forever($key, $value);
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
		return self::$root->remember($key, $minutes, $callback);
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
		return self::$root->rememberForever($key, $callback);
	 }

	/**
	 * Remove an item from the cache.
	 *
	 * @static
	 * @param	string	$key
	 */
	 public static function forget($key){
		self::$root->forget($key);
	 }

	/**
	 * Remove all items from the cache.
	 *
	 * @static
	 */
	 public static function flush(){
		self::$root->flush();
	 }

	/**
	 * Get the default cache time.
	 *
	 * @static
	 * @return int
	 */
	 public static function getDefaultCacheTime(){
		return self::$root->getDefaultCacheTime();
	 }

	/**
	 * Set the default cache time in minutes.
	 *
	 * @static
	 * @param	int	$minutes
	 */
	 public static function setDefaultCacheTime($minutes){
		self::$root->setDefaultCacheTime($minutes);
	 }

	/**
	 * Determine if an item is in memory.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function existsInMemory($key){
		return self::$root->existsInMemory($key);
	 }

	/**
	 * Get all of the values in memory.
	 *
	 * @static
	 * @return array
	 */
	 public static function getMemory(){
		return self::$root->getMemory();
	 }

	/**
	 * Determine if a cached value exists.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function offsetExists($key){
		return self::$root->offsetExists($key);
	 }

	/**
	 * Retrieve an item from the cache by key.
	 *
	 * @static
	 * @param	string	$key
	 * @return mixed
	 */
	 public static function offsetGet($key){
		return self::$root->offsetGet($key);
	 }

	/**
	 * Store an item in the cache for the default time.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function offsetSet($key, $value){
		self::$root->offsetSet($key, $value);
	 }

	/**
	 * Remove an item from the cache.
	 *
	 * @static
	 * @param	string	$key
	 */
	 public static function offsetUnset($key){
		self::$root->offsetUnset($key);
	 }

 }
}

namespace  {
 class DB{
	/**
	 * @var Illuminate\Database\Connection $root
	 */
	 static private $root;

	/**
	 * Create a new database connection instance.
	 *
	 * @static
	 * @param	PDO	$pdo
	 * @param	string	$database
	 * @param	string	$tablePrefix
	 * @param	array	$config
	 */
	 public static function __construct($pdo, $database = '', $tablePrefix = '', $config = array()){
		self::$root->__construct($pdo, $database, $tablePrefix, $config);
	 }

	/**
	 * Set the query grammar to the default implementation.
	 *
	 * @static
	 */
	 public static function useDefaultQueryGrammar(){
		self::$root->useDefaultQueryGrammar();
	 }

	/**
	 * Set the schema grammar to the default implementation.
	 *
	 * @static
	 */
	 public static function useDefaultSchemaGrammar(){
		self::$root->useDefaultSchemaGrammar();
	 }

	/**
	 * Set the query post processor to the default implementation.
	 *
	 * @static
	 */
	 public static function useDefaultPostProcessor(){
		self::$root->useDefaultPostProcessor();
	 }

	/**
	 * Get a schema builder instance for the connection.
	 *
	 * @static
	 * @return Illuminate\Database\Schema\Builder
	 */
	 public static function getSchemaBuilder(){
		return self::$root->getSchemaBuilder();
	 }

	/**
	 * Begin a fluent query against a database table.
	 *
	 * @static
	 * @param	string	$table
	 * @return Illuminate\Database\Query\Builder
	 */
	 public static function table($table){
		return self::$root->table($table);
	 }

	/**
	 * Get a new raw query expression.
	 *
	 * @static
	 * @param	mixed	$value
	 * @return Illuminate\Database\Query\Expression
	 */
	 public static function raw($value){
		return self::$root->raw($value);
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
		return self::$root->selectOne($query, $bindings);
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
		return self::$root->select($query, $bindings);
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
		return self::$root->insert($query, $bindings);
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
		return self::$root->update($query, $bindings);
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
		return self::$root->delete($query, $bindings);
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
		return self::$root->statement($query, $bindings);
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
		return self::$root->affectingStatement($query, $bindings);
	 }

	/**
	 * Run a raw, unprepared query against the PDO connection.
	 *
	 * @static
	 * @param	string	$query
	 * @return bool
	 */
	 public static function unprepared($query){
		return self::$root->unprepared($query);
	 }

	/**
	 * Prepare the query bindings for execution.
	 *
	 * @static
	 * @param	array	$bindings
	 * @return array
	 */
	 public static function prepareBindings($bindings){
		return self::$root->prepareBindings($bindings);
	 }

	/**
	 * Execute a Closure within a transaction.
	 *
	 * @static
	 * @param	Closure	$callback
	 * @return mixed
	 */
	 public static function transaction($callback){
		return self::$root->transaction($callback);
	 }

	/**
	 * Execute the given callback in "dry run" mode.
	 *
	 * @static
	 * @param	Closure	$callback
	 * @return array
	 */
	 public static function pretend($callback){
		return self::$root->pretend($callback);
	 }

	/**
	 * Log a query in the connection's query log.
	 *
	 * @static
	 * @param	string	$query
	 * @param	array	$bindings
	 */
	 public static function logQuery($query, $bindings, $time = null){
		self::$root->logQuery($query, $bindings, $time);
	 }

	/**
	 * Get the currently used PDO connection.
	 *
	 * @static
	 * @return PDO
	 */
	 public static function getPdo(){
		return self::$root->getPdo();
	 }

	/**
	 * Get the database connection name.
	 *
	 * @static
	 * @return string|null
	 */
	 public static function getName(){
		return self::$root->getName();
	 }

	/**
	 * Get an option from the configuration options.
	 *
	 * @static
	 * @param	string	$option
	 * @return mixed
	 */
	 public static function getConfig($option){
		return self::$root->getConfig($option);
	 }

	/**
	 * Get the PDO driver name.
	 *
	 * @static
	 * @return string
	 */
	 public static function getDriverName(){
		return self::$root->getDriverName();
	 }

	/**
	 * Get the query grammar used by the connection.
	 *
	 * @static
	 * @return Illuminate\Database\Query\Grammars\Grammar
	 */
	 public static function getQueryGrammar(){
		return self::$root->getQueryGrammar();
	 }

	/**
	 * Set the query grammar used by the connection.
	 *
	 * @static
	 * @param	Illuminate\Database\Query\Grammars\Grammar
	 */
	 public static function setQueryGrammar($grammar){
		self::$root->setQueryGrammar($grammar);
	 }

	/**
	 * Get the schema grammar used by the connection.
	 *
	 * @static
	 * @return Illuminate\Database\Query\Grammars\Grammar
	 */
	 public static function getSchemaGrammar(){
		return self::$root->getSchemaGrammar();
	 }

	/**
	 * Set the schema grammar used by the connection.
	 *
	 * @static
	 * @param	Illuminate\Database\Schema\Grammars\Grammar
	 */
	 public static function setSchemaGrammar($grammar){
		self::$root->setSchemaGrammar($grammar);
	 }

	/**
	 * Get the query post processor used by the connection.
	 *
	 * @static
	 * @return Illuminate\Database\Query\Processors\Processor
	 */
	 public static function getPostProcessor(){
		return self::$root->getPostProcessor();
	 }

	/**
	 * Set the query post processor used by the connection.
	 *
	 * @static
	 * @param	Illuminate\Database\Query\Processors\Processor
	 */
	 public static function setPostProcessor($processor){
		self::$root->setPostProcessor($processor);
	 }

	/**
	 * Get the event dispatcher used by the connection.
	 *
	 * @static
	 * @return Illuminate\Events\Dispatcher
	 */
	 public static function getEventDispatcher(){
		return self::$root->getEventDispatcher();
	 }

	/**
	 * Set the event dispatcher instance on the connection.
	 *
	 * @static
	 * @param	Illuminate\Events\Dispatcher
	 */
	 public static function setEventDispatcher($events){
		self::$root->setEventDispatcher($events);
	 }

	/**
	 * Get the paginator environment instance.
	 *
	 * @static
	 * @return Illuminate\Pagination\Environment
	 */
	 public static function getPaginator(){
		return self::$root->getPaginator();
	 }

	/**
	 * Set the pagination environment instance.
	 *
	 * @static
	 * @param	Illuminate\Pagination\Environment|Closure	$paginator
	 */
	 public static function setPaginator($paginator){
		self::$root->setPaginator($paginator);
	 }

	/**
	 * Determine if the connection in a "dry run".
	 *
	 * @static
	 * @return bool
	 */
	 public static function pretending(){
		return self::$root->pretending();
	 }

	/**
	 * Get the default fetch mode for the connection.
	 *
	 * @static
	 * @return int
	 */
	 public static function getFetchMode(){
		return self::$root->getFetchMode();
	 }

	/**
	 * Set the default fetch mode for the connection.
	 *
	 * @static
	 * @param	int	$fetchMode
	 * @return int
	 */
	 public static function setFetchMode($fetchMode){
		return self::$root->setFetchMode($fetchMode);
	 }

	/**
	 * Get the connection query log.
	 *
	 * @static
	 * @return array
	 */
	 public static function getQueryLog(){
		return self::$root->getQueryLog();
	 }

	/**
	 * Clear the query log.
	 *
	 * @static
	 */
	 public static function flushQueryLog(){
		self::$root->flushQueryLog();
	 }

	/**
	 * Get the name of the connected database.
	 *
	 * @static
	 * @return string
	 */
	 public static function getDatabaseName(){
		return self::$root->getDatabaseName();
	 }

	/**
	 * Set the name of the connected database.
	 *
	 * @static
	 * @param	string	$database
	 * @return string
	 */
	 public static function setDatabaseName($database){
		return self::$root->setDatabaseName($database);
	 }

	/**
	 * Get the table prefix for the connection.
	 *
	 * @static
	 * @return string
	 */
	 public static function getTablePrefix(){
		return self::$root->getTablePrefix();
	 }

	/**
	 * Set the table prefix in use by the connection.
	 *
	 * @static
	 * @param	string	$prefix
	 */
	 public static function setTablePrefix($prefix){
		self::$root->setTablePrefix($prefix);
	 }

	/**
	 * Set the table prefix and return the grammar.
	 *
	 * @static
	 * @param	Illuminate\Database\Grammar	$grammar
	 * @return Illuminate\Database\Grammar
	 */
	 public static function withTablePrefix($grammar){
		return self::$root->withTablePrefix($grammar);
	 }

 }
}

namespace  {
 class Queue{
	/**
	 * @var Illuminate\Queue\QueueInterface $root
	 */
	 static private $root;

	/**
	 * Push a new job onto the queue.
	 *
	 * @static
	 * @param	string	$job
	 * @param	mixed	$data
	 * @param	string	$queue
	 */
	 public static function push($job, $data = '', $queue = null){
		self::$root->push($job, $data, $queue);
	 }

	/**
	 * Push a new job onto the queue after a delay.
	 *
	 * @static
	 * @param	int	$delay
	 * @param	string	$job
	 * @param	mixed	$data
	 * @param	string	$queue
	 */
	 public static function later($delay, $job, $data = '', $queue = null){
		self::$root->later($delay, $job, $data, $queue);
	 }

	/**
	 * Pop the next job off of the queue.
	 *
	 * @static
	 * @param	string	$queue
	 * @return Illuminate\Queue\Jobs\Job|nul
	 */
	 public static function pop($queue = null){
		return self::$root->pop($queue);
	 }

 }
}

namespace  {
 class Redis{
	/**
	 * @var Illuminate\Redis\Database $root
	 */
	 static private $root;

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
		self::$root->__construct($host, $port, $database, $password);
	 }

	/**
	 * Connect to the Redis database.
	 *
	 * @static
	 */
	 public static function connect(){
		self::$root->connect();
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
		return self::$root->command($method, $parameters);
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
		return self::$root->buildCommand($method, $parameters);
	 }

	/**
	 * Parse the Redis database response.
	 *
	 * @static
	 * @param	string	$response
	 * @return mixed
	 */
	 public static function parseResponse($response){
		return self::$root->parseResponse($response);
	 }

	/**
	 * Read the specified number of bytes from the file resource.
	 *
	 * @static
	 * @param	int	$bytes
	 * @return string
	 */
	 public static function fileRead($bytes){
		return self::$root->fileRead($bytes);
	 }

	/**
	 * Get the specified number of bytes from a file line.
	 *
	 * @static
	 * @param	int	$bytes
	 * @return string
	 */
	 public static function fileGet($bytes){
		return self::$root->fileGet($bytes);
	 }

	/**
	 * Write the given command to the file resource.
	 *
	 * @static
	 * @param	string	$command
	 */
	 public static function fileWrite($command){
		self::$root->fileWrite($command);
	 }

	/**
	 * Get the Redis socket connection.
	 *
	 * @static
	 * @return resource
	 */
	 public static function getConnection(){
		return self::$root->getConnection();
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
		return self::$root->__call($method, $parameters);
	 }

 }
}

namespace  {
 class App{
	/**
	 * @var Illuminate\Foundation\Application $root
	 */
	 static private $root;

	/**
	 * Create a new Illuminate application instance.
	 *
	 * @static
	 */
	 public static function __construct(){
		self::$root->__construct();
	 }

	/**
	 * Bind the installation paths to the application.
	 *
	 * @static
	 * @param	array	$paths
	 */
	 public static function bindInstallPaths($paths){
		self::$root->bindInstallPaths($paths);
	 }

	/**
	 * Get the application bootstrap file.
	 *
	 * @static
	 * @return string
	 */
	 public static function getBootstrapFile(){
		return self::$root->getBootstrapFile();
	 }

	/**
	 * Register the aliased class loader.
	 *
	 * @static
	 * @param	array	$aliases
	 */
	 public static function registerAliasLoader($aliases){
		self::$root->registerAliasLoader($aliases);
	 }

	/**
	 * Start the exception handling for the request.
	 *
	 * @static
	 */
	 public static function startExceptionHandling(){
		self::$root->startExceptionHandling();
	 }

	/**
	 * Get the current application environment.
	 *
	 * @static
	 * @return string
	 */
	 public static function environment(){
		return self::$root->environment();
	 }

	/**
	 * Detect the application's current environment.
	 *
	 * @static
	 * @param	array|string	$environments
	 * @return string
	 */
	 public static function detectEnvironment($environments){
		return self::$root->detectEnvironment($environments);
	 }

	/**
	 * Determine if we are running in the console.
	 *
	 * @static
	 * @return bool
	 */
	 public static function runningInConsole(){
		return self::$root->runningInConsole();
	 }

	/**
	 * Determine if we are running unit tests.
	 *
	 * @static
	 * @return bool
	 */
	 public static function runningUnitTests(){
		return self::$root->runningUnitTests();
	 }

	/**
	 * Register a service provider with the application.
	 *
	 * @static
	 * @param	Illuminate\Support\ServiceProvider|string	$provider
	 * @param	array	$options
	 */
	 public static function register($provider, $options = array()){
		self::$root->register($provider, $options);
	 }

	/**
	 * Load and boot all of the remaining deferred providers.
	 *
	 * @static
	 */
	 public static function loadDeferredProviders(){
		self::$root->loadDeferredProviders();
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
		return self::$root->make($abstract, $parameters);
	 }

	/**
	 * Register a "before" application filter.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function before($callback){
		self::$root->before($callback);
	 }

	/**
	 * Register an "after" application filter.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function after($callback){
		self::$root->after($callback);
	 }

	/**
	 * Register a "close" application filter.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function close($callback){
		self::$root->close($callback);
	 }

	/**
	 * Register a "finish" application filter.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function finish($callback){
		self::$root->finish($callback);
	 }

	/**
	 * Register a "shutdown" callback.
	 *
	 * @static
	 * @param	callable	$callback
	 */
	 public static function shutdown($callback = null){
		self::$root->shutdown($callback);
	 }

	/**
	 * Handles the given request and delivers the response.
	 *
	 * @static
	 */
	 public static function run(){
		self::$root->run();
	 }

	/**
	 * Handle the given request and get the response.
	 *
	 * @static
	 * @param	Illuminate\Foundation\Request	$request
	 * @return Symfony\Component\HttpFoundation\Response
	 */
	 public static function dispatch($request){
		return self::$root->dispatch($request);
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
		return self::$root->handle($request, $type, $catch);
	 }

	/**
	 * Boot the application's service providers.
	 *
	 * @static
	 */
	 public static function boot(){
		self::$root->boot();
	 }

	/**
	 * Register a new boot listener.
	 *
	 * @static
	 * @param	mixed	$callback
	 */
	 public static function booting($callback){
		self::$root->booting($callback);
	 }

	/**
	 * Register a new "booted" listener.
	 *
	 * @static
	 * @param	mixed	$callback
	 */
	 public static function booted($callback){
		self::$root->booted($callback);
	 }

	/**
	 * Prepare the request by injecting any services.
	 *
	 * @static
	 * @param	Illuminate\Foundation\Request	$request
	 * @return Illuminate\Foundation\Request
	 */
	 public static function prepareRequest($request){
		return self::$root->prepareRequest($request);
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
		return self::$root->prepareResponse($value, $request);
	 }

	/**
	 * Set the current application locale.
	 *
	 * @static
	 * @param	string	$locale
	 */
	 public static function setLocale($locale){
		self::$root->setLocale($locale);
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
		self::$root->abort($code, $message, $headers);
	 }

	/**
	 * Register a 404 error handler.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function missing($callback){
		self::$root->missing($callback);
	 }

	/**
	 * Register an application error handler.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function error($callback){
		self::$root->error($callback);
	 }

	/**
	 * Register an error handler for fatal errors.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function fatal($callback){
		self::$root->fatal($callback);
	 }

	/**
	 * Get the service providers that have been loaded.
	 *
	 * @static
	 * @return array
	 */
	 public static function getLoadedProviders(){
		return self::$root->getLoadedProviders();
	 }

	/**
	 * Set the application's deferred services.
	 *
	 * @static
	 * @param	array	$services
	 */
	 public static function setDeferredServices($services){
		self::$root->setDeferredServices($services);
	 }

	/**
	 * Dynamically access application services.
	 *
	 * @static
	 * @param	string	$key
	 * @return mixed
	 */
	 public static function __get($key){
		return self::$root->__get($key);
	 }

	/**
	 * Dynamically set application services.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function __set($key, $value){
		self::$root->__set($key, $value);
	 }

	/**
	 * Determine if the given abstract type has been bound.
	 *
	 * @static
	 * @param	string	$abstract
	 * @return bool
	 */
	 public static function bound($abstract){
		return self::$root->bound($abstract);
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
		self::$root->bind($abstract, $concrete, $shared);
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
		return self::$root->bindIf($abstract, $concrete, $shared);
	 }

	/**
	 * Register a shared binding in the container.
	 *
	 * @static
	 * @param	string	$abstract
	 * @param	Closure|string|null	$concrete
	 */
	 public static function singleton($abstract, $concrete = null){
		self::$root->singleton($abstract, $concrete);
	 }

	/**
	 * Wrap a Closure such that it is shared.
	 *
	 * @static
	 * @param	Closure	$closure
	 * @return Closure
	 */
	 public static function share($closure){
		return self::$root->share($closure);
	 }

	/**
	 * "Extend" an abstract type in the container.
	 *
	 * @static
	 * @param	string	$abstract
	 * @param	Closure	$closure
	 */
	 public static function extend($abstract, $closure){
		self::$root->extend($abstract, $closure);
	 }

	/**
	 * Register an existing instance as shared in the container.
	 *
	 * @static
	 * @param	string	$abstract
	 * @param	mixed	$instance
	 */
	 public static function instance($abstract, $instance){
		self::$root->instance($abstract, $instance);
	 }

	/**
	 * Alias a type to a shorter name.
	 *
	 * @static
	 * @param	string	$abstract
	 * @param	string	$alias
	 */
	 public static function alias($abstract, $alias){
		self::$root->alias($abstract, $alias);
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
		return self::$root->build($concrete, $parameters);
	 }

	/**
	 * Register a new resolving callback.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function resolving($callback){
		self::$root->resolving($callback);
	 }

	/**
	 * Get the container's bindings.
	 *
	 * @static
	 * @return array
	 */
	 public static function getBindings(){
		return self::$root->getBindings();
	 }

	/**
	 * Determine if a given offset exists.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function offsetExists($key){
		return self::$root->offsetExists($key);
	 }

	/**
	 * Get the value at a given offset.
	 *
	 * @static
	 * @param	string	$key
	 * @return mixed
	 */
	 public static function offsetGet($key){
		return self::$root->offsetGet($key);
	 }

	/**
	 * Set the value at a given offset.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function offsetSet($key, $value){
		self::$root->offsetSet($key, $value);
	 }

	/**
	 * Unset the value at a given offset.
	 *
	 * @static
	 * @param	string	$key
	 */
	 public static function offsetUnset($key){
		self::$root->offsetUnset($key);
	 }

 }
}

namespace  {
 class Artisan{
	/**
	 * @var Illuminate\Console\Application $root
	 */
	 static private $root;

	/**
	 * Start a new Console application.
	 *
	 * @static
	 * @param	Illuminate\Foundation\Application	$app
	 * @return Illuminate\Console\Application
	 */
	 public static function start($app){
		return self::$root->start($app);
	 }

	/**
	 * Add a command to the console.
	 *
	 * @static
	 * @param	Symfony\Component\Console\Command\Command	$command
	 * @return Symfony\Component\Console\Command\Command
	 */
	 public static function add($command){
		return self::$root->add($command);
	 }

	/**
	 * Add a command, resolving through the application.
	 *
	 * @static
	 * @param	string	$command
	 */
	 public static function resolve($command){
		self::$root->resolve($command);
	 }

	/**
	 * Resolve an array of commands through the application.
	 *
	 * @static
	 * @param	array|dynamic	$commands
	 */
	 public static function resolveCommands($commands){
		self::$root->resolveCommands($commands);
	 }

	/**
	 * Render the given exception.
	 *
	 * @static
	 * @param	Exception	$e
	 * @param	Symfony\Component\Console\Output\OutputInterface	$output
	 */
	 public static function renderException($e, $output){
		self::$root->renderException($e, $output);
	 }

	/**
	 * Set the exception handler instance.
	 *
	 * @static
	 * @param	Illuminate\Exception\Handler	$handler
	 */
	 public static function setExceptionHandler($handler){
		self::$root->setExceptionHandler($handler);
	 }

	/**
	 * Set the Laravel application instance.
	 *
	 * @static
	 * @param	Illuminate\Foundation\Application	$laravel
	 */
	 public static function setLaravel($laravel){
		self::$root->setLaravel($laravel);
	 }

	/**
	 * Constructor.
	 *
	 * @static
	 * @param	string $name	The name of the application
	 * @param	string $version The version of the application
	 */
	 public static function __construct($name = 'UNKNOWN', $version = 'UNKNOWN'){
		self::$root->__construct($name, $version);
	 }

	/**
	 * Runs the current application.
	 *
	 * @static
	 * @param	InputInterface	$input	An Input instance
	 * @param	OutputInterface $output An Output instance
	 * @return integer 0 if everything went fine, or an error code
	 */
	 public static function run($input = null, $output = null){
		return self::$root->run($input, $output);
	 }

	/**
	 * Runs the current application.
	 *
	 * @static
	 * @param	InputInterface	$input	An Input instance
	 * @param	OutputInterface $output An Output instance
	 * @return integer 0 if everything went fine, or an error code
	 */
	 public static function doRun($input, $output){
		return self::$root->doRun($input, $output);
	 }

	/**
	 * Set a helper set to be used with the command.
	 *
	 * @static
	 * @param	HelperSet $helperSet The helper set
	 */
	 public static function setHelperSet($helperSet){
		self::$root->setHelperSet($helperSet);
	 }

	/**
	 * Get the helper set associated with the command.
	 *
	 * @static
	 * @return HelperSet The HelperSet instance associated with this command
	 */
	 public static function getHelperSet(){
		return self::$root->getHelperSet();
	 }

	/**
	 * Set an input definition set to be used with this application
	 *
	 * @static
	 * @param	InputDefinition $definition The input definition
	 */
	 public static function setDefinition($definition){
		self::$root->setDefinition($definition);
	 }

	/**
	 * Gets the InputDefinition related to this Application.
	 *
	 * @static
	 * @return InputDefinition The InputDefinition instance
	 */
	 public static function getDefinition(){
		return self::$root->getDefinition();
	 }

	/**
	 * Gets the help message.
	 *
	 * @static
	 * @return string A help message.
	 */
	 public static function getHelp(){
		return self::$root->getHelp();
	 }

	/**
	 * Sets whether to catch exceptions or not during commands execution.
	 *
	 * @static
	 * @param	Boolean $boolean Whether to catch exceptions or not during commands execution
	 */
	 public static function setCatchExceptions($boolean){
		self::$root->setCatchExceptions($boolean);
	 }

	/**
	 * Sets whether to automatically exit after a command execution or not.
	 *
	 * @static
	 * @param	Boolean $boolean Whether to automatically exit after a command execution or not
	 */
	 public static function setAutoExit($boolean){
		self::$root->setAutoExit($boolean);
	 }

	/**
	 * Gets the name of the application.
	 *
	 * @static
	 * @return string The application name
	 */
	 public static function getName(){
		return self::$root->getName();
	 }

	/**
	 * Sets the application name.
	 *
	 * @static
	 * @param	string $name The application name
	 */
	 public static function setName($name){
		self::$root->setName($name);
	 }

	/**
	 * Gets the application version.
	 *
	 * @static
	 * @return string The application version
	 */
	 public static function getVersion(){
		return self::$root->getVersion();
	 }

	/**
	 * Sets the application version.
	 *
	 * @static
	 * @param	string $version The application version
	 */
	 public static function setVersion($version){
		self::$root->setVersion($version);
	 }

	/**
	 * Returns the long version of the application.
	 *
	 * @static
	 * @return string The long application version
	 */
	 public static function getLongVersion(){
		return self::$root->getLongVersion();
	 }

	/**
	 * Registers a new command.
	 *
	 * @static
	 * @param	string $name The command name
	 * @return Command The newly created command
	 */
	 public static function register($name){
		return self::$root->register($name);
	 }

	/**
	 * Adds an array of command objects.
	 *
	 * @static
	 * @param	Command[] $commands An array of commands
	 */
	 public static function addCommands($commands){
		self::$root->addCommands($commands);
	 }

	/**
	 * Returns a registered command by name or alias.
	 *
	 * @static
	 * @param	string $name The command name or alias
	 * @return Command A Command object
	 */
	 public static function get($name){
		return self::$root->get($name);
	 }

	/**
	 * Returns true if the command exists, false otherwise.
	 *
	 * @static
	 * @param	string $name The command name or alias
	 * @return Boolean true if the command exists, false otherwise
	 */
	 public static function has($name){
		return self::$root->has($name);
	 }

	/**
	 * Returns an array of all unique namespaces used by currently registered commands.
	 * It does not returns the global namespace which always exists.
	 *
	 * @static
	 * @return array An array of namespaces
	 */
	 public static function getNamespaces(){
		return self::$root->getNamespaces();
	 }

	/**
	 * Finds a registered namespace by a name or an abbreviation.
	 *
	 * @static
	 * @param	string $namespace A namespace or abbreviation to search for
	 * @return string A registered namespace
	 */
	 public static function findNamespace($namespace){
		return self::$root->findNamespace($namespace);
	 }

	/**
	 * Finds a command by name or alias.
	 * Contrary to get, this command tries to find the best
	 * match if you give it an abbreviation of a name or alias.
	 *
	 * @static
	 * @param	string $name A command name or a command alias
	 * @return Command A Command instance
	 */
	 public static function find($name){
		return self::$root->find($name);
	 }

	/**
	 * Gets the commands (registered in the given namespace if provided).
	 * The array keys are the full names and the values the command instances.
	 *
	 * @static
	 * @param	string $namespace A namespace name
	 * @return Command[] An array of Command instances
	 */
	 public static function all($namespace = null){
		return self::$root->all($namespace);
	 }

	/**
	 * Returns an array of possible abbreviations given a set of names.
	 *
	 * @static
	 * @param	array $names An array of names
	 * @return array An array of abbreviations
	 */
	 public static function getAbbreviations($names){
		return self::$root->getAbbreviations($names);
	 }

	/**
	 * Returns a text representation of the Application.
	 *
	 * @static
	 * @param	string	$namespace An optional namespace name
	 * @param	boolean $raw	Whether to return raw command list
	 * @return string A string representing the Application
	 */
	 public static function asText($namespace = null, $raw = false){
		return self::$root->asText($namespace, $raw);
	 }

	/**
	 * Returns an XML representation of the Application.
	 *
	 * @static
	 * @param	string	$namespace An optional namespace name
	 * @param	Boolean $asDom	Whether to return a DOM or an XML string
	 * @return string|DOMDocument An XML string representing the Application
	 */
	 public static function asXml($namespace = null, $asDom = false){
		return self::$root->asXml($namespace, $asDom);
	 }

	/**
	 * Tries to figure out the terminal dimensions based on the current environment
	 *
	 * @static
	 * @return array Array containing width and height
	 */
	 public static function getTerminalDimensions(){
		return self::$root->getTerminalDimensions();
	 }

 }
}

namespace  {
 class Blade{
	/**
	 * @var Illuminate\View\Compilers\BladeCompiler $root
	 */
	 static private $root;

	/**
	 * Compile the view at the given path.
	 *
	 * @static
	 * @param	string	$path
	 */
	 public static function compile($path){
		self::$root->compile($path);
	 }

	/**
	 * Compile the given Blade template contents.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function compileString($value){
		return self::$root->compileString($value);
	 }

	/**
	 * Register a custom Blade compiler.
	 *
	 * @static
	 * @param	Closure	$compiler
	 */
	 public static function extend($compiler){
		self::$root->extend($compiler);
	 }

	/**
	 * Get the regular expression for a generic Blade function.
	 *
	 * @static
	 * @param	string	$function
	 * @return string
	 */
	 public static function createMatcher($function){
		return self::$root->createMatcher($function);
	 }

	/**
	 * Get the regular expression for a generic Blade function.
	 *
	 * @static
	 * @param	string	$function
	 * @return string
	 */
	 public static function createOpenMatcher($function){
		return self::$root->createOpenMatcher($function);
	 }

	/**
	 * Create a plain Blade matcher.
	 *
	 * @static
	 * @param	string	$function
	 * @return string
	 */
	 public static function createPlainMatcher($function){
		return self::$root->createPlainMatcher($function);
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
		self::$root->setContentTags($openTag, $closeTag, $raw);
	 }

	/**
	 * Sets the raw content tags used for the compiler.
	 *
	 * @static
	 * @param	string	$openTag
	 * @param	string	$closeTag
	 */
	 public static function setEscapedContentTags($openTag, $closeTag){
		self::$root->setEscapedContentTags($openTag, $closeTag);
	 }

	/**
	 * Create a new compiler instance.
	 *
	 * @static
	 * @param	string	$cachePath
	 */
	 public static function __construct($files, $cachePath){
		self::$root->__construct($files, $cachePath);
	 }

	/**
	 * Get the path to the compiled version of a view.
	 *
	 * @static
	 * @param	string	$path
	 * @return string
	 */
	 public static function getCompiledPath($path){
		return self::$root->getCompiledPath($path);
	 }

	/**
	 * Determine if the view at the given path is expired.
	 *
	 * @static
	 * @param	string	$path
	 * @return bool
	 */
	 public static function isExpired($path){
		return self::$root->isExpired($path);
	 }

 }
}

namespace  {
 class ClassLoader{
	/**
	 * @var Illuminate\Support\ClassLoader $root
	 */
	 static private $root;

	/**
	 * Load the given class file.
	 *
	 * @static
	 * @param	string	$class
	 */
	 public static function load($class){
		self::$root->load($class);
	 }

	/**
	 * Get the normal file name for a class.
	 *
	 * @static
	 * @param	string	$class
	 * @return string
	 */
	 public static function normalizeClass($class){
		return self::$root->normalizeClass($class);
	 }

	/**
	 * Register the given class loader on the auto-loader stack.
	 *
	 * @static
	 */
	 public static function register(){
		self::$root->register();
	 }

	/**
	 * Add directories to the class loader.
	 *
	 * @static
	 * @param	string|array	$directories
	 */
	 public static function addDirectories($directories){
		self::$root->addDirectories($directories);
	 }

	/**
	 * Remove directories from the class loader.
	 *
	 * @static
	 * @param	string|array	$directories
	 */
	 public static function removeDirectories($directories = null){
		self::$root->removeDirectories($directories);
	 }

	/**
	 * Gets all the directories registered with the loader.
	 *
	 * @static
	 * @return array
	 */
	 public static function getDirectories(){
		return self::$root->getDirectories();
	 }

 }
}

namespace  {
 class Config{
	/**
	 * @var Illuminate\Config\Repository $root
	 */
	 static private $root;

	/**
	 * Create a new configuration repository.
	 *
	 * @static
	 * @param	Illuminate\Config\LoaderInterface	$loader
	 * @param	string	$environment
	 */
	 public static function __construct($loader, $environment){
		self::$root->__construct($loader, $environment);
	 }

	/**
	 * Determine if the given configuration value exists.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function has($key){
		return self::$root->has($key);
	 }

	/**
	 * Determine if a configuration group exists.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function hasGroup($key){
		return self::$root->hasGroup($key);
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
		return self::$root->get($key, $default);
	 }

	/**
	 * Set a given configuration value.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function set($key, $value){
		self::$root->set($key, $value);
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
		self::$root->package($package, $hint, $namespace);
	 }

	/**
	 * Register an after load callback for a given namespace.
	 *
	 * @static
	 * @param	string	$namespace
	 * @param	Closure	$callback
	 */
	 public static function afterLoading($namespace, $callback){
		self::$root->afterLoading($namespace, $callback);
	 }

	/**
	 * Add a new namespace to the loader.
	 *
	 * @static
	 * @param	string	$namespace
	 * @param	string	$hint
	 */
	 public static function addNamespace($namespace, $hint){
		self::$root->addNamespace($namespace, $hint);
	 }

	/**
	 * Returns all registered namespaces with the config
	 * loader.
	 *
	 * @static
	 * @return array
	 */
	 public static function getNamespaces(){
		return self::$root->getNamespaces();
	 }

	/**
	 * Get the loader implementation.
	 *
	 * @static
	 * @return Illuminate\Config\LoaderInterface
	 */
	 public static function getLoader(){
		return self::$root->getLoader();
	 }

	/**
	 * Set the loader implementation.
	 *
	 * @static
	 * @return Illuminate\Config\LoaderInterface
	 */
	 public static function setLoader($loader){
		return self::$root->setLoader($loader);
	 }

	/**
	 * Get the current configuration environment.
	 *
	 * @static
	 * @return string
	 */
	 public static function getEnvironment(){
		return self::$root->getEnvironment();
	 }

	/**
	 * Get the after load callback array.
	 *
	 * @static
	 * @return array
	 */
	 public static function getAfterLoadCallbacks(){
		return self::$root->getAfterLoadCallbacks();
	 }

	/**
	 * Get all of the configuration items.
	 *
	 * @static
	 * @return array
	 */
	 public static function getItems(){
		return self::$root->getItems();
	 }

	/**
	 * Determine if the given configuration option exists.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function offsetExists($key){
		return self::$root->offsetExists($key);
	 }

	/**
	 * Get a configuration option.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function offsetGet($key){
		return self::$root->offsetGet($key);
	 }

	/**
	 * Set a configuration option.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function offsetSet($key, $value){
		return self::$root->offsetSet($key, $value);
	 }

	/**
	 * Unset a configuration option.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function offsetUnset($key){
		return self::$root->offsetUnset($key);
	 }

	/**
	 * Parse a key into namespace, group, and item.
	 *
	 * @static
	 * @param	string	$key
	 * @return array
	 */
	 public static function parseKey($key){
		return self::$root->parseKey($key);
	 }

	/**
	 * Set the parsed value of a key.
	 *
	 * @static
	 * @param	string	$key
	 * @param	array	$parsed
	 */
	 public static function setParsedKey($key, $parsed){
		self::$root->setParsedKey($key, $parsed);
	 }

 }
}

namespace  {
 class Controller{
	/**
	 * @var Illuminate\Routing\Controllers\Controller $root
	 */
	 static private $root;

	/**
	 * Register a new "before" filter on the controller.
	 *
	 * @static
	 * @param	string	$filter
	 * @param	array	$options
	 */
	 public static function beforeFilter($filter, $options = array()){
		self::$root->beforeFilter($filter, $options);
	 }

	/**
	 * Register a new "after" filter on the controller.
	 *
	 * @static
	 * @param	string	$filter
	 * @param	array	$options
	 */
	 public static function afterFilter($filter, $options = array()){
		self::$root->afterFilter($filter, $options);
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
		return self::$root->callAction($container, $router, $method, $parameters);
	 }

	/**
	 * Get the code registered filters.
	 *
	 * @static
	 * @return array
	 */
	 public static function getControllerFilters(){
		return self::$root->getControllerFilters();
	 }

	/**
	 * Handle calls to missing methods on the controller.
	 *
	 * @static
	 * @param	array	$parameters
	 * @return mixed
	 */
	 public static function missingMethod($parameters){
		return self::$root->missingMethod($parameters);
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
		return self::$root->__call($method, $parameters);
	 }

 }
}

namespace  {
 class Cookie{
	/**
	 * @var Illuminate\Cookie\CookieJar $root
	 */
	 static private $root;

	/**
	 * Create a new cookie manager instance.
	 *
	 * @static
	 * @param	Symfony\Component\HttpFoundation\Request	$request
	 * @param	Illuminate\Encryption\Encrypter	$encrypter
	 */
	 public static function __construct($request, $encrypter){
		self::$root->__construct($request, $encrypter);
	 }

	/**
	 * Determine if a cookie exists and is not null.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function has($key){
		return self::$root->has($key);
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
		return self::$root->get($key, $default);
	 }

	/**
	 * Create a new cookie instance.
	 *
	 * @static
	 * @param	string	$name
	 * @param	string	$value
	 * @param	int	$minutes
	 * @param	string	$path
	 * @param	string	$domain
	 * @param	bool	$secure
	 * @param	bool	$httpOnly
	 * @return Symfony\Component\HttpFoundation\Cookie
	 */
	 public static function make($name, $value, $minutes = '0', $path = '/', $domain = null, $secure = false, $httpOnly = true){
		return self::$root->make($name, $value, $minutes, $path, $domain, $secure, $httpOnly);
	 }

	/**
	 * Create a cookie that lasts "forever" (five years).
	 *
	 * @static
	 * @param	string	$name
	 * @param	string	$value
	 * @param	string	$path
	 * @param	string	$domain
	 * @param	bool	$secure
	 * @param	bool	$httpOnly
	 * @return Symfony\Component\HttpFoundation\Cookie
	 */
	 public static function forever($name, $value, $path = '/', $domain = null, $secure = false, $httpOnly = true){
		return self::$root->forever($name, $value, $path, $domain, $secure, $httpOnly);
	 }

	/**
	 * Expire the given cookie.
	 *
	 * @static
	 * @param	string	$name
	 * @return Symfony\Component\HttpFoundation\Cookie
	 */
	 public static function forget($name){
		return self::$root->forget($name);
	 }

	/**
	 * Get the request instance.
	 *
	 * @static
	 * @return Symfony\Component\HttpFoundation\Request
	 */
	 public static function getRequest(){
		return self::$root->getRequest();
	 }

	/**
	 * Get the encrypter instance.
	 *
	 * @static
	 * @return Illuminate\Encrypter
	 */
	 public static function getEncrypter(){
		return self::$root->getEncrypter();
	 }

 }
}

namespace  {
 class Crypt{
	/**
	 * @var Illuminate\Encryption\Encrypter $root
	 */
	 static private $root;

	/**
	 * Create a new encrypter instance.
	 *
	 * @static
	 * @param	string	$key
	 */
	 public static function __construct($key){
		self::$root->__construct($key);
	 }

	/**
	 * Encrypt the given value.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function encrypt($value){
		return self::$root->encrypt($value);
	 }

	/**
	 * Decrypt the given value.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function decrypt($payload){
		return self::$root->decrypt($payload);
	 }

 }
}

namespace  {
 class Eloquent{
	/**
	 * @var Illuminate\Database\Eloquent\Model $root
	 */
	 static private $root;

	/**
	 * Create a new Eloquent model instance.
	 *
	 * @static
	 * @param	array	$attributes
	 */
	 public static function __construct($attributes = array()){
		self::$root->__construct($attributes);
	 }

	/**
	 * Fill the model with an array of attributes.
	 *
	 * @static
	 * @param	array	$attributes
	 * @return Illuminate\Database\Eloquent\Model
	 */
	 public static function fill($attributes){
		return self::$root->fill($attributes);
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
		return self::$root->newInstance($attributes, $exists);
	 }

	/**
	 * Create a new model instance that is existing.
	 *
	 * @static
	 * @param	array	$attributes
	 * @return Illuminate\Database\Eloquent\Model
	 */
	 public static function newFromBuilder($attributes = array()){
		return self::$root->newFromBuilder($attributes);
	 }

	/**
	 * Save a new model and return the instance.
	 *
	 * @static
	 * @param	array	$attributes
	 * @return Illuminate\Database\Eloquent\Model
	 */
	 public static function create($attributes){
		return self::$root->create($attributes);
	 }

	/**
	 * Begin querying the model on a given connection.
	 *
	 * @static
	 * @param	string	$connection
	 * @return Illuminate\Database\Eloquent\Builder
	 */
	 public static function on($connection){
		return self::$root->on($connection);
	 }

	/**
	 * Get all of the models from the database.
	 *
	 * @static
	 * @param	array	$columns
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	 public static function all($columns = array()){
		return self::$root->all($columns);
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
		return self::$root->find($id, $columns);
	 }

	/**
	 * Being querying a model with eager loading.
	 *
	 * @static
	 * @param	array	$relations
	 * @return Illuminate\Database\Eloquent\Builder
	 */
	 public static function with($relations){
		return self::$root->with($relations);
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
		return self::$root->hasOne($related, $foreignKey);
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
		return self::$root->morphOne($related, $name, $type, $id);
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
		return self::$root->belongsTo($related, $foreignKey);
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
		return self::$root->morphTo($name, $type, $id);
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
		return self::$root->hasMany($related, $foreignKey);
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
		return self::$root->morphMany($related, $name, $type, $id);
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
		return self::$root->belongsToMany($related, $table, $foreignKey, $otherKey);
	 }

	/**
	 * Get the joining table name for a many-to-many relation.
	 *
	 * @static
	 * @param	string	$related
	 * @return string
	 */
	 public static function joiningTable($related){
		return self::$root->joiningTable($related);
	 }

	/**
	 * Delete the model from the database.
	 *
	 * @static
	 */
	 public static function delete(){
		self::$root->delete();
	 }

	/**
	 * Register an updating model event with the dispatcher.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function updating($callback){
		self::$root->updating($callback);
	 }

	/**
	 * Register an updated model event with the dispatcher.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function updated($callback){
		self::$root->updated($callback);
	 }

	/**
	 * Register a creating model event with the dispatcher.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function creating($callback){
		self::$root->creating($callback);
	 }

	/**
	 * Register a created model event with the dispatcher.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function created($callback){
		self::$root->created($callback);
	 }

	/**
	 * Save the model to the database.
	 *
	 * @static
	 * @return bool
	 */
	 public static function save(){
		return self::$root->save();
	 }

	/**
	 * Update the model's update timestamp.
	 *
	 * @static
	 * @return bool
	 */
	 public static function touch(){
		return self::$root->touch();
	 }

	/**
	 * Set the value of the "created at" attribute.
	 *
	 * @static
	 * @param	mixed	$value
	 */
	 public static function setCreatedAt($value){
		self::$root->setCreatedAt($value);
	 }

	/**
	 * Set the value of the "updated at" attribute.
	 *
	 * @static
	 * @param	mixed	$value
	 */
	 public static function setUpdatedAt($value){
		self::$root->setUpdatedAt($value);
	 }

	/**
	 * Get the name of the "created at" column.
	 *
	 * @static
	 * @return string
	 */
	 public static function getCreatedAtColumn(){
		return self::$root->getCreatedAtColumn();
	 }

	/**
	 * Get the name of the "updated at" column.
	 *
	 * @static
	 * @return string
	 */
	 public static function getUpdatedAtColumn(){
		return self::$root->getUpdatedAtColumn();
	 }

	/**
	 * Get a fresh timestamp for the model.
	 *
	 * @static
	 * @return mixed
	 */
	 public static function freshTimestamp(){
		return self::$root->freshTimestamp();
	 }

	/**
	 * Get a new query builder for the model's table.
	 *
	 * @static
	 * @return Illuminate\Database\Eloquent\Builder
	 */
	 public static function newQuery(){
		return self::$root->newQuery();
	 }

	/**
	 * Create a new Eloquent Collection instance.
	 *
	 * @static
	 * @param	array	$models
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	 public static function newCollection($models = array()){
		return self::$root->newCollection($models);
	 }

	/**
	 * Get the table associated with the model.
	 *
	 * @static
	 * @return string
	 */
	 public static function getTable(){
		return self::$root->getTable();
	 }

	/**
	 * Set the table associated with the model.
	 *
	 * @static
	 * @param	string	$table
	 */
	 public static function setTable($table){
		self::$root->setTable($table);
	 }

	/**
	 * Get the value of the model's primary key.
	 *
	 * @static
	 * @return mixed
	 */
	 public static function getKey(){
		return self::$root->getKey();
	 }

	/**
	 * Get the primary key for the model.
	 *
	 * @static
	 * @return string
	 */
	 public static function getKeyName(){
		return self::$root->getKeyName();
	 }

	/**
	 * Determine if the model uses timestamps.
	 *
	 * @static
	 * @return bool
	 */
	 public static function usesTimestamps(){
		return self::$root->usesTimestamps();
	 }

	/**
	 * Get the number of models to return per page.
	 *
	 * @static
	 * @return int
	 */
	 public static function getPerPage(){
		return self::$root->getPerPage();
	 }

	/**
	 * Set the number of models ot return per page.
	 *
	 * @static
	 * @param	int	$perPage
	 */
	 public static function setPerPage($perPage){
		self::$root->setPerPage($perPage);
	 }

	/**
	 * Get the default foreign key name for the model.
	 *
	 * @static
	 * @return string
	 */
	 public static function getForeignKey(){
		return self::$root->getForeignKey();
	 }

	/**
	 * Get the hidden attributes for the model.
	 *
	 * @static
	 * @return array
	 */
	 public static function getHidden(){
		return self::$root->getHidden();
	 }

	/**
	 * Set the hidden attributes for the model.
	 *
	 * @static
	 * @param	array	$hidden
	 */
	 public static function setHidden($hidden){
		self::$root->setHidden($hidden);
	 }

	/**
	 * Get the fillable attributes for the model.
	 *
	 * @static
	 * @return array
	 */
	 public static function getFillable(){
		return self::$root->getFillable();
	 }

	/**
	 * Set the fillable attributes for the model.
	 *
	 * @static
	 * @param	array	$fillable
	 * @return Illuminate\Database\Eloquent\Model
	 */
	 public static function fillable($fillable){
		return self::$root->fillable($fillable);
	 }

	/**
	 * Set the guarded attributes for the model.
	 *
	 * @static
	 * @param	array	$guarded
	 * @return Illuminate\Database\Eloquent\Model
	 */
	 public static function guard($guarded){
		return self::$root->guard($guarded);
	 }

	/**
	 * Determine if the given attribute may be mass assigned.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function isFillable($key){
		return self::$root->isFillable($key);
	 }

	/**
	 * Get the value indicating whether the IDs are incrementing.
	 *
	 * @static
	 * @return bool
	 */
	 public static function getIncrementing(){
		return self::$root->getIncrementing();
	 }

	/**
	 * Set whether IDs are incrementing.
	 *
	 * @static
	 * @param	bool	$value
	 */
	 public static function setIncrementing($value){
		self::$root->setIncrementing($value);
	 }

	/**
	 * Convert the model instance to JSON.
	 *
	 * @static
	 * @param	int	$options
	 * @return string
	 */
	 public static function toJson($options = '0'){
		return self::$root->toJson($options);
	 }

	/**
	 * Convert the model instance to an array.
	 *
	 * @static
	 * @return array
	 */
	 public static function toArray(){
		return self::$root->toArray();
	 }

	/**
	 * Convert the model's attributes to an array.
	 *
	 * @static
	 * @return array
	 */
	 public static function attributesToArray(){
		return self::$root->attributesToArray();
	 }

	/**
	 * Get the model's relationships in array form.
	 *
	 * @static
	 * @return array
	 */
	 public static function relationsToArray(){
		return self::$root->relationsToArray();
	 }

	/**
	 * Get an attribute from the model.
	 *
	 * @static
	 * @param	string	$key
	 * @return mixed
	 */
	 public static function getAttribute($key){
		return self::$root->getAttribute($key);
	 }

	/**
	 * Determine if a get mutator exists for an attribute.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function hasGetMutator($key){
		return self::$root->hasGetMutator($key);
	 }

	/**
	 * Set a given attribute on the model.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function setAttribute($key, $value){
		self::$root->setAttribute($key, $value);
	 }

	/**
	 * Determine if a set mutator exists for an attribute.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function hasSetMutator($key){
		return self::$root->hasSetMutator($key);
	 }

	/**
	 * Get all of the current attributes on the model.
	 *
	 * @static
	 * @return array
	 */
	 public static function getAttributes(){
		return self::$root->getAttributes();
	 }

	/**
	 * Set the array of model attributes. No checking is done.
	 *
	 * @static
	 * @param	array	$attributes
	 * @param	bool	$sync
	 */
	 public static function setRawAttributes($attributes, $sync = false){
		self::$root->setRawAttributes($attributes, $sync);
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
		return self::$root->getOriginal($key, $default);
	 }

	/**
	 * Sync the original attributes with the current.
	 *
	 * @static
	 * @return Illuminate\Database\Eloquent\Model
	 */
	 public static function syncOriginal(){
		return self::$root->syncOriginal();
	 }

	/**
	 * Get the attributes that have been changed since last sync.
	 *
	 * @static
	 * @return array
	 */
	 public static function getDirty(){
		return self::$root->getDirty();
	 }

	/**
	 * Get a specified relationship.
	 *
	 * @static
	 * @param	string	$relation
	 * @return mixed
	 */
	 public static function getRelation($relation){
		return self::$root->getRelation($relation);
	 }

	/**
	 * Set the specific relationship in the model.
	 *
	 * @static
	 * @param	string	$relation
	 * @param	mixed	$value
	 */
	 public static function setRelation($relation, $value){
		self::$root->setRelation($relation, $value);
	 }

	/**
	 * Get the database connection for the model.
	 *
	 * @static
	 * @return Illuminate\Database\Connection
	 */
	 public static function getConnection(){
		return self::$root->getConnection();
	 }

	/**
	 * Get the current connection name for the model.
	 *
	 * @static
	 * @return string
	 */
	 public static function getConnectionName(){
		return self::$root->getConnectionName();
	 }

	/**
	 * Set the connection associated with the model.
	 *
	 * @static
	 * @param	string	$name
	 */
	 public static function setConnection($name){
		self::$root->setConnection($name);
	 }

	/**
	 * Resolve a connection instance by name.
	 *
	 * @static
	 * @param	string	$connection
	 * @return Illuminate\Database\Connection
	 */
	 public static function resolveConnection($connection){
		return self::$root->resolveConnection($connection);
	 }

	/**
	 * Get the connection resolver instance.
	 *
	 * @static
	 * @return Illuminate\Database\ConnectionResolverInterface
	 */
	 public static function getConnectionResolver(){
		return self::$root->getConnectionResolver();
	 }

	/**
	 * Set the connection resolver instance.
	 *
	 * @static
	 * @param	Illuminate\Database\ConnectionResolverInterface	$resolver
	 */
	 public static function setConnectionResolver($resolver){
		self::$root->setConnectionResolver($resolver);
	 }

	/**
	 * Get the event dispatcher instance.
	 *
	 * @static
	 * @return Illuminate\Events\Dispatcher
	 */
	 public static function getEventDispatcher(){
		return self::$root->getEventDispatcher();
	 }

	/**
	 * Set the event dispatcher instance.
	 *
	 * @static
	 * @param	Illuminate\Events\Dispatcher
	 */
	 public static function setEventDispatcher($dispatcher){
		self::$root->setEventDispatcher($dispatcher);
	 }

	/**
	 * Unset the event dispatcher for models.
	 *
	 * @static
	 */
	 public static function unsetEventDispatcher(){
		self::$root->unsetEventDispatcher();
	 }

	/**
	 * Get the mutated attributes for a given instance.
	 *
	 * @static
	 * @return array
	 */
	 public static function getMutatedAttributes(){
		return self::$root->getMutatedAttributes();
	 }

	/**
	 * Dynamically retrieve attributes on the model.
	 *
	 * @static
	 * @param	string	$key
	 * @return mixed
	 */
	 public static function __get($key){
		return self::$root->__get($key);
	 }

	/**
	 * Dynamically set attributes on the model.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function __set($key, $value){
		self::$root->__set($key, $value);
	 }

	/**
	 * Determine if the given attribute exists.
	 *
	 * @static
	 * @param	mixed	$offset
	 * @return bool
	 */
	 public static function offsetExists($offset){
		return self::$root->offsetExists($offset);
	 }

	/**
	 * Get the value for a given offset.
	 *
	 * @static
	 * @param	mixed	$offset
	 * @return mixed
	 */
	 public static function offsetGet($offset){
		return self::$root->offsetGet($offset);
	 }

	/**
	 * Set the value for a given offset.
	 *
	 * @static
	 * @param	mixed	$offset
	 * @param	mixed	$value
	 */
	 public static function offsetSet($offset, $value){
		self::$root->offsetSet($offset, $value);
	 }

	/**
	 * Unset the value for a given offset.
	 *
	 * @static
	 * @param	mixed	$offset
	 */
	 public static function offsetUnset($offset){
		self::$root->offsetUnset($offset);
	 }

	/**
	 * Determine if an attribute exists on the model.
	 *
	 * @static
	 * @param	string	$key
	 */
	 public static function __isset($key){
		self::$root->__isset($key);
	 }

	/**
	 * Unset an attribute on the model.
	 *
	 * @static
	 * @param	string	$key
	 */
	 public static function __unset($key){
		self::$root->__unset($key);
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
		return self::$root->__call($method, $parameters);
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
		return self::$root->__callStatic($method, $parameters);
	 }

	/**
	 * Convert the model to its string representation.
	 *
	 * @static
	 * @return string
	 */
	 public static function __toString(){
		return self::$root->__toString();
	 }

 }
}

namespace  {
 class Event{
	/**
	 * @var Illuminate\Events\Dispatcher $root
	 */
	 static private $root;

	/**
	 * Create a new event dispatcher instance.
	 *
	 * @static
	 * @param	Illuminate\Container	$container
	 */
	 public static function __construct($container = null){
		self::$root->__construct($container);
	 }

	/**
	 * Register an event listener with the dispatcher.
	 *
	 * @static
	 * @param	string	$event
	 * @param	mixed	$listener
	 * @param	int	$priority
	 */
	 public static function listen($event, $listener, $priority = '0'){
		self::$root->listen($event, $listener, $priority);
	 }

	/**
	 * Determine if a given event has listeners.
	 *
	 * @static
	 * @param	string	$eventName
	 * @return bool
	 */
	 public static function hasListeners($eventName){
		return self::$root->hasListeners($eventName);
	 }

	/**
	 * Register a queued event and payload.
	 *
	 * @static
	 * @param	string	$event
	 * @param	array	$payload
	 */
	 public static function queue($event, $payload = array()){
		self::$root->queue($event, $payload);
	 }

	/**
	 * Register an event subscriber with the dispatcher.
	 *
	 * @static
	 * @param	string	$subscriber
	 */
	 public static function subscribe($subscriber){
		self::$root->subscribe($subscriber);
	 }

	/**
	 * Fire an event until the first non-null response is returned.
	 *
	 * @static
	 * @param	string	$event
	 * @param	array	$payload
	 * @return mixed
	 */
	 public static function until($event, $payload = array()){
		return self::$root->until($event, $payload);
	 }

	/**
	 * Flush a set of queued events.
	 *
	 * @static
	 * @param	string	$event
	 */
	 public static function flush($event){
		self::$root->flush($event);
	 }

	/**
	 * Fire an event and call the listeners.
	 *
	 * @static
	 * @param	string	$event
	 * @param	mixed	$payload
	 */
	 public static function fire($event, $payload = array(), $halt = false){
		self::$root->fire($event, $payload, $halt);
	 }

	/**
	 * Get all of the listeners for a given event name.
	 *
	 * @static
	 * @param	string	$eventName
	 * @return array
	 */
	 public static function getListeners($eventName){
		return self::$root->getListeners($eventName);
	 }

	/**
	 * Register an event listener with the dispatcher.
	 *
	 * @static
	 * @param	mixed	$listener
	 */
	 public static function makeListener($listener){
		self::$root->makeListener($listener);
	 }

	/**
	 * Create a class based listener using the IoC container.
	 *
	 * @static
	 * @param	mixed	$listener
	 * @return Closure
	 */
	 public static function createClassListener($listener){
		return self::$root->createClassListener($listener);
	 }

 }
}

namespace  {
 class File{
	/**
	 * @var Illuminate\Filesystem\Filesystem $root
	 */
	 static private $root;

	/**
	 * Determine if a file exists.
	 *
	 * @static
	 * @param	string	$path
	 * @return bool
	 */
	 public static function exists($path){
		return self::$root->exists($path);
	 }

	/**
	 * Get the contents of a file.
	 *
	 * @static
	 * @param	string	$path
	 * @return string
	 */
	 public static function get($path){
		return self::$root->get($path);
	 }

	/**
	 * Get the contents of a remote file.
	 *
	 * @static
	 * @param	string	$path
	 * @return string
	 */
	 public static function getRemote($path){
		return self::$root->getRemote($path);
	 }

	/**
	 * Get the returned value of a file.
	 *
	 * @static
	 * @param	string	$path
	 * @return mixed
	 */
	 public static function getRequire($path){
		return self::$root->getRequire($path);
	 }

	/**
	 * Require the given file once.
	 *
	 * @static
	 * @param	string	$file
	 */
	 public static function requireOnce($file){
		self::$root->requireOnce($file);
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
		return self::$root->put($path, $contents);
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
		return self::$root->append($path, $data);
	 }

	/**
	 * Delete the file at a given path.
	 *
	 * @static
	 * @param	string	$path
	 * @return bool
	 */
	 public static function delete($path){
		return self::$root->delete($path);
	 }

	/**
	 * Move a file to a new location.
	 *
	 * @static
	 * @param	string	$path
	 * @param	string	$target
	 */
	 public static function move($path, $target){
		self::$root->move($path, $target);
	 }

	/**
	 * Copy a file to a new location.
	 *
	 * @static
	 * @param	string	$path
	 * @param	string	$target
	 */
	 public static function copy($path, $target){
		self::$root->copy($path, $target);
	 }

	/**
	 * Extract the file extension from a file path.
	 *
	 * @static
	 * @param	string	$path
	 * @return string
	 */
	 public static function extension($path){
		return self::$root->extension($path);
	 }

	/**
	 * Get the file type of a given file.
	 *
	 * @static
	 * @param	string	$path
	 * @return string
	 */
	 public static function type($path){
		return self::$root->type($path);
	 }

	/**
	 * Get the file size of a given file.
	 *
	 * @static
	 * @param	string	$path
	 * @return int
	 */
	 public static function size($path){
		return self::$root->size($path);
	 }

	/**
	 * Get the file's last modification time.
	 *
	 * @static
	 * @param	string	$path
	 * @return int
	 */
	 public static function lastModified($path){
		return self::$root->lastModified($path);
	 }

	/**
	 * Determine if the given path is a directory.
	 *
	 * @static
	 * @param	string	$directory
	 * @return bool
	 */
	 public static function isDirectory($directory){
		return self::$root->isDirectory($directory);
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
		return self::$root->glob($pattern, $flags);
	 }

	/**
	 * Get an array of all files in a directory.
	 *
	 * @static
	 * @param	string	$directory
	 * @return array
	 */
	 public static function files($directory){
		return self::$root->files($directory);
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
		return self::$root->makeDirectory($path, $mode, $recursive);
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
		self::$root->copyDirectory($directory, $destination, $options);
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
		self::$root->deleteDirectory($directory, $preserve);
	 }

	/**
	 * Empty the specified directory of all files and folders.
	 *
	 * @static
	 * @param	string	$directory
	 */
	 public static function cleanDirectory($directory){
		self::$root->cleanDirectory($directory);
	 }

 }
}

namespace  {
 class Form{
	/**
	 * @var Illuminate\Html\FormBuilder $root
	 */
	 static private $root;

	/**
	 * Create a new form builder instance.
	 *
	 * @static
	 * @param	Illuminate\Routing\UrlGenerator	$url
	 * @param	string	$csrfToken
	 */
	 public static function __construct($url, $csrfToken){
		self::$root->__construct($url, $csrfToken);
	 }

	/**
	 * Open up a new HTML form.
	 *
	 * @static
	 * @param	array	$options
	 * @return string
	 */
	 public static function open($options = array()){
		return self::$root->open($options);
	 }

	/**
	 * Create a new model based form builder.
	 *
	 * @static
	 * @param	mixed	$model
	 * @param	array	$options
	 * @return string
	 */
	 public static function model($model, $options = array()){
		return self::$root->model($model, $options);
	 }

	/**
	 * Close the current form.
	 *
	 * @static
	 * @return string
	 */
	 public static function close(){
		return self::$root->close();
	 }

	/**
	 * Generate a hidden field with the current CSRF token.
	 *
	 * @static
	 * @return string
	 */
	 public static function token(){
		return self::$root->token();
	 }

	/**
	 * Create a form label element.
	 *
	 * @static
	 * @param	string	$name
	 * @param	string	$value
	 * @param	array	$options
	 * @return string
	 */
	 public static function label($name, $value, $options = array()){
		return self::$root->label($name, $value, $options);
	 }

	/**
	 * Create a form input field.
	 *
	 * @static
	 * @param	string	$type
	 * @param	string	$name
	 * @param	string	$value
	 * @param	array	$options
	 * @return string
	 */
	 public static function input($type, $name, $value = null, $options = array()){
		return self::$root->input($type, $name, $value, $options);
	 }

	/**
	 * Create a text input field.
	 *
	 * @static
	 * @param	string	$name
	 * @param	string	$value
	 * @param	array	$options
	 * @return string
	 */
	 public static function text($name, $value = null, $options = array()){
		return self::$root->text($name, $value, $options);
	 }

	/**
	 * Create a password input field.
	 *
	 * @static
	 * @param	string	$name
	 * @param	array	$options
	 * @return string
	 */
	 public static function password($name, $options = array()){
		return self::$root->password($name, $options);
	 }

	/**
	 * Create a hidden input field.
	 *
	 * @static
	 * @param	string	$name
	 * @param	string	$value
	 * @param	array	$options
	 * @return string
	 */
	 public static function hidden($name, $value = null, $options = array()){
		return self::$root->hidden($name, $value, $options);
	 }

	/**
	 * Create an e-mail input field.
	 *
	 * @static
	 * @param	string	$name
	 * @param	string	$value
	 * @param	array	$options
	 * @return string
	 */
	 public static function email($name, $value = null, $options = array()){
		return self::$root->email($name, $value, $options);
	 }

	/**
	 * Create a file input field.
	 *
	 * @static
	 * @param	string	$name
	 * @param	array	$options
	 * @return string
	 */
	 public static function file($name, $options = array()){
		return self::$root->file($name, $options);
	 }

	/**
	 * Create a textarea input field.
	 *
	 * @static
	 * @param	string	$name
	 * @param	string	$value
	 * @param	array	$options
	 * @return string
	 */
	 public static function textarea($name, $value = null, $options = array()){
		return self::$root->textarea($name, $value, $options);
	 }

	/**
	 * Create a select box field.
	 *
	 * @static
	 * @param	string	$name
	 * @param	array	$list
	 * @param	string	$selected
	 * @param	array	$options
	 * @return string
	 */
	 public static function select($name, $list = array(), $selected = null, $options = array()){
		return self::$root->select($name, $list, $selected, $options);
	 }

	/**
	 * Create a checkbox input field.
	 *
	 * @static
	 * @param	string	$name
	 * @param	mixed	$value
	 * @param	bool	$checked
	 * @param	array	$options
	 * @return string
	 */
	 public static function checkbox($name, $value = '1', $checked = null, $options = array()){
		return self::$root->checkbox($name, $value, $checked, $options);
	 }

	/**
	 * Create a radio button input field.
	 *
	 * @static
	 * @param	string	$name
	 * @param	mixed	$value
	 * @param	bool	$checked
	 * @param	array	$options
	 * @return string
	 */
	 public static function radio($name, $value = null, $checked = null, $options = array()){
		return self::$root->radio($name, $value, $checked, $options);
	 }

	/**
	 * Create a submit button element.
	 *
	 * @static
	 * @param	string	$value
	 * @param	array	$options
	 * @return string
	 */
	 public static function submit($value = null, $options = array()){
		return self::$root->submit($value, $options);
	 }

	/**
	 * Create a button element.
	 *
	 * @static
	 * @param	string	$value
	 * @param	array	$options
	 * @return string
	 */
	 public static function button($value = null, $options = array()){
		return self::$root->button($value, $options);
	 }

	/**
	 * Register a custom form macro.
	 *
	 * @static
	 * @param	string	$name
	 * @param	callable	$macro
	 */
	 public static function macro($name, $macro){
		self::$root->macro($name, $macro);
	 }

	/**
	 * Get the session store implementation.
	 *
	 * @static
	 * @param	Illuminate\Session\Store	$session
	 */
	 public static function getSessionStore(){
		self::$root->getSessionStore();
	 }

	/**
	 * Set the session store implementation.
	 *
	 * @static
	 * @param	Illuminate\Session\Store	$session
	 */
	 public static function setSessionStore($session){
		self::$root->setSessionStore($session);
	 }

	/**
	 * Dynamically handle calls to the form builder.
	 *
	 * @static
	 * @param	string	$method
	 * @param	array	$parameters
	 * @return mixed
	 */
	 public static function __call($method, $parameters){
		return self::$root->__call($method, $parameters);
	 }

 }
}

namespace  {
 class Hash{
	/**
	 * @var Illuminate\Hashing\BcryptHasher $root
	 */
	 static private $root;

	/**
	 * Hash the given value.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function make($value, $options = array()){
		return self::$root->make($value, $options);
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
		return self::$root->check($value, $hashedValue, $options);
	 }

 }
}

namespace  {
 class Html{
	/**
	 * @var Illuminate\Html\HtmlBuilder $root
	 */
	 static private $root;

	/**
	 * Convert an HTML string to entities.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function entities($value){
		return self::$root->entities($value);
	 }

	/**
	 * Convert entities to HTML characters.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function decode($value){
		return self::$root->decode($value);
	 }

	/**
	 * Generate an ordered list of items.
	 *
	 * @static
	 * @param	array	$list
	 * @param	array	$attributes
	 * @return string
	 */
	 public static function ol($list, $attributes = array()){
		return self::$root->ol($list, $attributes);
	 }

	/**
	 * Generate an un-ordered list of items.
	 *
	 * @static
	 * @param	array	$list
	 * @param	array	$attributes
	 * @return string
	 */
	 public static function ul($list, $attributes = array()){
		return self::$root->ul($list, $attributes);
	 }

	/**
	 * Build an HTML attribute string from an array.
	 *
	 * @static
	 * @param	array	$attributes
	 * @return string
	 */
	 public static function attributes($attributes){
		return self::$root->attributes($attributes);
	 }

 }
}

namespace  {
 class Input{
	/**
	 * @var Illuminate\Http\Request $root
	 */
	 static private $root;

	/**
	 * Return the Request instance.
	 *
	 * @static
	 * @return Illuminate\Http\Request
	 */
	 public static function instance(){
		return self::$root->instance();
	 }

	/**
	 * Get the root URL for the application.
	 *
	 * @static
	 * @return string
	 */
	 public static function root(){
		return self::$root->root();
	 }

	/**
	 * Get the URL (no query string) for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function url(){
		return self::$root->url();
	 }

	/**
	 * Get the full URL for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function fullUrl(){
		return self::$root->fullUrl();
	 }

	/**
	 * Get the current path info for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function path(){
		return self::$root->path();
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
		return self::$root->segment($index, $default);
	 }

	/**
	 * Get all of the segments for the request path.
	 *
	 * @static
	 * @return array
	 */
	 public static function segments(){
		return self::$root->segments();
	 }

	/**
	 * Determine if the current request URI matches a pattern.
	 *
	 * @static
	 * @param	string	$pattern
	 * @return bool
	 */
	 public static function is($pattern){
		return self::$root->is($pattern);
	 }

	/**
	 * Determine if the request is the result of an AJAX call.
	 *
	 * @static
	 * @return bool
	 */
	 public static function ajax(){
		return self::$root->ajax();
	 }

	/**
	 * Determine if the request is over HTTPS.
	 *
	 * @static
	 * @return bool
	 */
	 public static function secure(){
		return self::$root->secure();
	 }

	/**
	 * Determine if the request contains a given input item.
	 *
	 * @static
	 * @param	string|array	$key
	 * @return bool
	 */
	 public static function has($key){
		return self::$root->has($key);
	 }

	/**
	 * Get all of the input and files for the request.
	 *
	 * @static
	 * @return array
	 */
	 public static function all(){
		return self::$root->all();
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
		return self::$root->input($key, $default);
	 }

	/**
	 * Get a subset of the items from the input data.
	 *
	 * @static
	 * @param	array	$keys
	 * @return array
	 */
	 public static function only($keys){
		return self::$root->only($keys);
	 }

	/**
	 * Get all of the input except for a specified array of items.
	 *
	 * @static
	 * @param	array	$keys
	 * @return array
	 */
	 public static function except($keys){
		return self::$root->except($keys);
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
		return self::$root->query($key, $default);
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
		return self::$root->cookie($key, $default);
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
		return self::$root->file($key, $default);
	 }

	/**
	 * Determine if the uploaded data contains a file.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function hasFile($key){
		return self::$root->hasFile($key);
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
		return self::$root->header($key, $default);
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
		return self::$root->server($key, $default);
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
		return self::$root->old($key, $default);
	 }

	/**
	 * Flash the input for the current request to the session.
	 *
	 * @static
	 * @param	string $filter
	 * @param	array	$keys
	 */
	 public static function flash($filter = null, $keys = array()){
		self::$root->flash($filter, $keys);
	 }

	/**
	 * Flash only some of the input to the session.
	 *
	 * @static
	 * @param	dynamic	string
	 */
	 public static function flashOnly($keys){
		self::$root->flashOnly($keys);
	 }

	/**
	 * Flash only some of the input to the session.
	 *
	 * @static
	 * @param	dynamic	string
	 */
	 public static function flashExcept($keys){
		self::$root->flashExcept($keys);
	 }

	/**
	 * Flush all of the old input from the session.
	 *
	 * @static
	 */
	 public static function flush(){
		self::$root->flush();
	 }

	/**
	 * Merge new input into the current request's input array.
	 *
	 * @static
	 * @param	array	$input
	 */
	 public static function merge($input){
		self::$root->merge($input);
	 }

	/**
	 * Replace the input for the current request.
	 *
	 * @static
	 * @param	array	$input
	 */
	 public static function replace($input){
		self::$root->replace($input);
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
		return self::$root->json($key, $default);
	 }

	/**
	 * Get the Illuminate session store implementation.
	 *
	 * @static
	 * @return Illuminate\Session\Store
	 */
	 public static function getSessionStore(){
		return self::$root->getSessionStore();
	 }

	/**
	 * Set the Illuminate session store implementation.
	 *
	 * @static
	 * @param	Illuminate\Session\Store	$session
	 */
	 public static function setSessionStore($session){
		self::$root->setSessionStore($session);
	 }

	/**
	 * Determine if the session store has been set.
	 *
	 * @static
	 * @return bool
	 */
	 public static function hasSessionStore(){
		return self::$root->hasSessionStore();
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
		self::$root->__construct($query, $request, $attributes, $cookies, $files, $server, $content);
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
		self::$root->initialize($query, $request, $attributes, $cookies, $files, $server, $content);
	 }

	/**
	 * Creates a new request with values from PHP's super globals.
	 *
	 * @static
	 * @return Request A new request
	 */
	 public static function createFromGlobals(){
		return self::$root->createFromGlobals();
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
		return self::$root->create($uri, $method, $parameters, $cookies, $files, $server, $content);
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
		return self::$root->duplicate($query, $request, $attributes, $cookies, $files, $server);
	 }

	/**
	 * Clones the current request.
	 * Note that the session is not cloned as duplicated requests
	 * are most of the time sub-requests of the main one.
	 *
	 * @static
	 */
	 public static function __clone(){
		self::$root->__clone();
	 }

	/**
	 * Returns the request as a string.
	 *
	 * @static
	 * @return string The request
	 */
	 public static function __toString(){
		return self::$root->__toString();
	 }

	/**
	 * Overrides the PHP global variables according to this request instance.
	 * It overrides $_GET, $_POST, $_REQUEST, $_SERVER, $_COOKIE.
	 * $_FILES is never override, see rfc1867
	 *
	 * @static
	 */
	 public static function overrideGlobals(){
		self::$root->overrideGlobals();
	 }

	/**
	 * Trusts $_SERVER entries coming from proxies.
	 *
	 * @static
	 */
	 public static function trustProxyData(){
		self::$root->trustProxyData();
	 }

	/**
	 * Sets a list of trusted proxies.
	 * You should only list the reverse proxies that you manage directly.
	 *
	 * @static
	 * @param	array $proxies A list of trusted proxies
	 */
	 public static function setTrustedProxies($proxies){
		self::$root->setTrustedProxies($proxies);
	 }

	/**
	 * Gets the list of trusted proxies.
	 *
	 * @static
	 * @return array An array of trusted proxies.
	 */
	 public static function getTrustedProxies(){
		return self::$root->getTrustedProxies();
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
		self::$root->setTrustedHeaderName($key, $value);
	 }

	/**
	 * Returns true if $_SERVER entries coming from proxies are trusted,
	 * false otherwise.
	 *
	 * @static
	 * @return boolean
	 */
	 public static function isProxyTrusted(){
		return self::$root->isProxyTrusted();
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
		return self::$root->normalizeQueryString($qs);
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
		self::$root->enableHttpMethodParameterOverride();
	 }

	/**
	 * Checks whether support for the _method request parameter is enabled.
	 *
	 * @static
	 * @return Boolean True when the _method request parameter is enabled, false otherwise
	 */
	 public static function getHttpMethodParameterOverride(){
		return self::$root->getHttpMethodParameterOverride();
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
		return self::$root->get($key, $default, $deep);
	 }

	/**
	 * Gets the Session.
	 *
	 * @static
	 * @return SessionInterface|null The session
	 */
	 public static function getSession(){
		return self::$root->getSession();
	 }

	/**
	 * Whether the request contains a Session which was started in one of the
	 * previous requests.
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function hasPreviousSession(){
		return self::$root->hasPreviousSession();
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
		return self::$root->hasSession();
	 }

	/**
	 * Sets the Session.
	 *
	 * @static
	 * @param	SessionInterface $session The Session
	 */
	 public static function setSession($session){
		self::$root->setSession($session);
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
		return self::$root->getClientIp();
	 }

	/**
	 * Returns current script name.
	 *
	 * @static
	 * @return string
	 */
	 public static function getScriptName(){
		return self::$root->getScriptName();
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
		return self::$root->getPathInfo();
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
		return self::$root->getBasePath();
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
		return self::$root->getBaseUrl();
	 }

	/**
	 * Gets the request's scheme.
	 *
	 * @static
	 * @return string
	 */
	 public static function getScheme(){
		return self::$root->getScheme();
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
		return self::$root->getPort();
	 }

	/**
	 * Returns the user.
	 *
	 * @static
	 * @return string|null
	 */
	 public static function getUser(){
		return self::$root->getUser();
	 }

	/**
	 * Returns the password.
	 *
	 * @static
	 * @return string|null
	 */
	 public static function getPassword(){
		return self::$root->getPassword();
	 }

	/**
	 * Gets the user info.
	 *
	 * @static
	 * @return string A user name and, optionally, scheme-specific information about how to gain authorization to access the server
	 */
	 public static function getUserInfo(){
		return self::$root->getUserInfo();
	 }

	/**
	 * Returns the HTTP host being requested.
	 * The port name will be appended to the host if it's non-standard.
	 *
	 * @static
	 * @return string
	 */
	 public static function getHttpHost(){
		return self::$root->getHttpHost();
	 }

	/**
	 * Returns the requested URI.
	 *
	 * @static
	 * @return string The raw URI (i.e. not urldecoded)
	 */
	 public static function getRequestUri(){
		return self::$root->getRequestUri();
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
		return self::$root->getSchemeAndHttpHost();
	 }

	/**
	 * Generates a normalized URI for the Request.
	 *
	 * @static
	 * @return string A normalized URI for the Request
	 */
	 public static function getUri(){
		return self::$root->getUri();
	 }

	/**
	 * Generates a normalized URI for the given path.
	 *
	 * @static
	 * @param	string $path A path to use instead of the current one
	 * @return string The normalized URI for the path
	 */
	 public static function getUriForPath($path){
		return self::$root->getUriForPath($path);
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
		return self::$root->getQueryString();
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
		return self::$root->isSecure();
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
		return self::$root->getHost();
	 }

	/**
	 * Sets the request method.
	 *
	 * @static
	 * @param	string $method
	 */
	 public static function setMethod($method){
		self::$root->setMethod($method);
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
		return self::$root->getMethod();
	 }

	/**
	 * Gets the "real" request method.
	 *
	 * @static
	 * @return string The request method
	 */
	 public static function getRealMethod(){
		return self::$root->getRealMethod();
	 }

	/**
	 * Gets the mime type associated with the format.
	 *
	 * @static
	 * @param	string $format The format
	 * @return string The associated mime type (null if not found)
	 */
	 public static function getMimeType($format){
		return self::$root->getMimeType($format);
	 }

	/**
	 * Gets the format associated with the mime type.
	 *
	 * @static
	 * @param	string $mimeType The associated mime type
	 * @return string|null The format (null if not found)
	 */
	 public static function getFormat($mimeType){
		return self::$root->getFormat($mimeType);
	 }

	/**
	 * Associates a format with mime types.
	 *
	 * @static
	 * @param	string	$format	The format
	 * @param	string|array $mimeTypes The associated mime types (the preferred one must be the first as it will be used as the content type)
	 */
	 public static function setFormat($format, $mimeTypes){
		self::$root->setFormat($format, $mimeTypes);
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
		return self::$root->getRequestFormat($default);
	 }

	/**
	 * Sets the request format.
	 *
	 * @static
	 * @param	string $format The request format.
	 */
	 public static function setRequestFormat($format){
		self::$root->setRequestFormat($format);
	 }

	/**
	 * Gets the format associated with the request.
	 *
	 * @static
	 * @return string|null The format (null if no content type is present)
	 */
	 public static function getContentType(){
		return self::$root->getContentType();
	 }

	/**
	 * Sets the default locale.
	 *
	 * @static
	 * @param	string $locale
	 */
	 public static function setDefaultLocale($locale){
		self::$root->setDefaultLocale($locale);
	 }

	/**
	 * Sets the locale.
	 *
	 * @static
	 * @param	string $locale
	 */
	 public static function setLocale($locale){
		self::$root->setLocale($locale);
	 }

	/**
	 * Get the locale.
	 *
	 * @static
	 * @return string
	 */
	 public static function getLocale(){
		return self::$root->getLocale();
	 }

	/**
	 * Checks if the request method is of specified type.
	 *
	 * @static
	 * @param	string $method Uppercase request method (GET, POST etc).
	 * @return Boolean
	 */
	 public static function isMethod($method){
		return self::$root->isMethod($method);
	 }

	/**
	 * Checks whether the method is safe or not.
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isMethodSafe(){
		return self::$root->isMethodSafe();
	 }

	/**
	 * Returns the request body content.
	 *
	 * @static
	 * @param	Boolean $asResource If true, a resource will be returned
	 * @return string|resource The request body content or a resource to read the body stream.
	 */
	 public static function getContent($asResource = false){
		return self::$root->getContent($asResource);
	 }

	/**
	 * Gets the Etags.
	 *
	 * @static
	 * @return array The entity tags
	 */
	 public static function getETags(){
		return self::$root->getETags();
	 }

	/**
	 * 
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isNoCache(){
		return self::$root->isNoCache();
	 }

	/**
	 * Returns the preferred language.
	 *
	 * @static
	 * @param	array $locales An array of ordered available locales
	 * @return string|null The preferred locale
	 */
	 public static function getPreferredLanguage($locales = null){
		return self::$root->getPreferredLanguage($locales);
	 }

	/**
	 * Gets a list of languages acceptable by the client browser.
	 *
	 * @static
	 * @return array Languages ordered in the user browser preferences
	 */
	 public static function getLanguages(){
		return self::$root->getLanguages();
	 }

	/**
	 * Gets a list of charsets acceptable by the client browser.
	 *
	 * @static
	 * @return array List of charsets in preferable order
	 */
	 public static function getCharsets(){
		return self::$root->getCharsets();
	 }

	/**
	 * Gets a list of content types acceptable by the client browser
	 *
	 * @static
	 * @return array List of content types in preferable order
	 */
	 public static function getAcceptableContentTypes(){
		return self::$root->getAcceptableContentTypes();
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
		return self::$root->isXmlHttpRequest();
	 }

	/**
	 * Splits an Accept-* HTTP header.
	 *
	 * @static
	 * @param	string $header Header to split
	 * @return array Array indexed by the values of the Accept-* header in preferred order
	 */
	 public static function splitHttpAcceptHeader($header){
		return self::$root->splitHttpAcceptHeader($header);
	 }

 }
}

namespace  {
 class Lang{
	/**
	 * @var Illuminate\Translation\Translator $root
	 */
	 static private $root;

	/**
	 * Create a new translator instance.
	 *
	 * @static
	 * @param	Illuminate\Translation\LoaderInterface	$loader
	 * @param	string	$locale
	 */
	 public static function __construct($loader, $locale){
		self::$root->__construct($loader, $locale);
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
		return self::$root->has($key, $locale);
	 }

	/**
	 * Get the translation for the given key.
	 *
	 * @static
	 * @param	string	$key
	 * @param	array	$replace
	 * @param	string	$locale
	 * @return string
	 */
	 public static function get($key, $replace = array(), $locale = null){
		return self::$root->get($key, $replace, $locale);
	 }

	/**
	 * Get a translation according to an integer value.
	 *
	 * @static
	 * @param	string	$id
	 * @param	int	$number
	 * @param	array	$replace
	 * @param	string	$locale
	 * @return string
	 */
	 public static function choice($key, $number, $replace = array(), $locale = null){
		return self::$root->choice($key, $number, $replace, $locale);
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
		return self::$root->trans($id, $parameters, $domain, $locale);
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
		return self::$root->transChoice($id, $number, $parameters, $domain, $locale);
	 }

	/**
	 * Load the specified language group.
	 *
	 * @static
	 * @param	string	$namespace
	 * @param	string	$group
	 * @param	string	$locale
	 * @return string
	 */
	 public static function load($namespace, $group, $locale){
		return self::$root->load($namespace, $group, $locale);
	 }

	/**
	 * Add a new namespace to the loader.
	 *
	 * @static
	 * @param	string	$namespace
	 * @param	string	$hint
	 */
	 public static function addNamespace($namespace, $hint){
		self::$root->addNamespace($namespace, $hint);
	 }

	/**
	 * Parse a key into namespace, group, and item.
	 *
	 * @static
	 * @param	string	$key
	 * @return array
	 */
	 public static function parseKey($key){
		return self::$root->parseKey($key);
	 }

	/**
	 * Get the message selector instance.
	 *
	 * @static
	 * @return Symfony\Component\Translation\MessageSelector
	 */
	 public static function getSelector(){
		return self::$root->getSelector();
	 }

	/**
	 * Set the message selector instance.
	 *
	 * @static
	 * @param	Symfony\Component\Translation\MessageSelector	$selector
	 */
	 public static function setSelector($selector){
		self::$root->setSelector($selector);
	 }

	/**
	 * Get the language line loader implementation.
	 *
	 * @static
	 * @return Illuminate\Translation\LoaderInterface
	 */
	 public static function getLoader(){
		return self::$root->getLoader();
	 }

	/**
	 * Get the default locale being used.
	 *
	 * @static
	 * @return string
	 */
	 public static function getLocale(){
		return self::$root->getLocale();
	 }

	/**
	 * Set the default locale.
	 *
	 * @static
	 * @param	string	$locale
	 */
	 public static function setLocale($locale){
		self::$root->setLocale($locale);
	 }

	/**
	 * Set the parsed value of a key.
	 *
	 * @static
	 * @param	string	$key
	 * @param	array	$parsed
	 */
	 public static function setParsedKey($key, $parsed){
		self::$root->setParsedKey($key, $parsed);
	 }

 }
}

namespace  {
 class Log{
	/**
	 * @var Illuminate\Log\Writer $root
	 */
	 static private $root;

	/**
	 * Create a new log writer instance.
	 *
	 * @static
	 * @param	Monolog\Logger	$monolog
	 * @param	Illuminate\Events\Dispatcher	$dispatcher
	 */
	 public static function __construct($monolog, $dispatcher = null){
		self::$root->__construct($monolog, $dispatcher);
	 }

	/**
	 * Register a file log handler.
	 *
	 * @static
	 * @param	string	$path
	 * @param	string	$level
	 */
	 public static function useFiles($path, $level = 'debug'){
		self::$root->useFiles($path, $level);
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
		self::$root->useDailyFiles($path, $days, $level);
	 }

	/**
	 * Get the underlying Monolog instance.
	 *
	 * @static
	 * @return Monolog\Logger
	 */
	 public static function getMonolog(){
		return self::$root->getMonolog();
	 }

	/**
	 * Register a new callback handler for when
	 * a log event is triggered.
	 *
	 * @static
	 * @param	Closure	$callback
	 */
	 public static function listen($callback){
		self::$root->listen($callback);
	 }

	/**
	 * Get the event dispatcher instance.
	 *
	 * @static
	 * @return Illuminate\Events\Dispatcher
	 */
	 public static function getEventDispatcher(){
		return self::$root->getEventDispatcher();
	 }

	/**
	 * Set the event dispatcher instance.
	 *
	 * @static
	 * @param	Illuminate\Events\Dispatcher
	 */
	 public static function setEventDispatcher($dispatcher){
		self::$root->setEventDispatcher($dispatcher);
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
		return self::$root->__call($method, $parameters);
	 }

 }
}

namespace  {
 class Mail{
	/**
	 * @var Illuminate\Mail\Mailer $root
	 */
	 static private $root;

	/**
	 * Create a new Mailer instance.
	 *
	 * @static
	 * @param	Illuminate\View\Environment	$views
	 * @param	Swift_Mailer	$swift
	 */
	 public static function __construct($views, $swift){
		self::$root->__construct($views, $swift);
	 }

	/**
	 * Set the global from address and name.
	 *
	 * @static
	 * @param	string	$address
	 * @param	string	$name
	 */
	 public static function alwaysFrom($address, $name = null){
		self::$root->alwaysFrom($address, $name);
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
		self::$root->plain($view, $data, $callback);
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
		self::$root->send($view, $data, $callback);
	 }

	/**
	 * Tell the mailer to not really send messages.
	 *
	 * @static
	 * @param	bool	$value
	 */
	 public static function pretend($value = true){
		self::$root->pretend($value);
	 }

	/**
	 * Get the view environment instance.
	 *
	 * @static
	 * @return Illuminate\View\Environment
	 */
	 public static function getViewEnvironment(){
		return self::$root->getViewEnvironment();
	 }

	/**
	 * Get the Swift Mailer instance.
	 *
	 * @static
	 * @return Swift_Mailer
	 */
	 public static function getSwiftMailer(){
		return self::$root->getSwiftMailer();
	 }

	/**
	 * Set the Swift Mailer instance.
	 *
	 * @static
	 * @param	Swift_Mailer	$swift
	 */
	 public static function setSwiftMailer($swift){
		self::$root->setSwiftMailer($swift);
	 }

	/**
	 * Set the log writer instance.
	 *
	 * @static
	 * @param	Illuminate\Log\Writer	$logger
	 */
	 public static function setLogger($logger){
		self::$root->setLogger($logger);
	 }

	/**
	 * Set the IoC container instance.
	 *
	 * @static
	 * @param	Illuminate\Container	$container
	 */
	 public static function setContainer($container){
		self::$root->setContainer($container);
	 }

 }
}

namespace  {
 class Paginator{
	/**
	 * @var Illuminate\Pagination\Environment $root
	 */
	 static private $root;

	/**
	 * Create a new pagination environment.
	 *
	 * @static
	 * @param	Symfony\Component\HttpFoundation\Request	$request
	 * @param	Illuminate\View\Environment	$view
	 * @param	Illuminate\Translation\TranslatorInterface	$trans
	 */
	 public static function __construct($request, $view, $trans){
		self::$root->__construct($request, $view, $trans);
	 }

	/**
	 * Get a new paginator instance.
	 *
	 * @static
	 * @param	array	$items
	 * @param	int	$perPage
	 * @param	int	$total
	 * @return Illuminate\Pagination\Paginator
	 */
	 public static function make($items, $total, $perPage){
		return self::$root->make($items, $total, $perPage);
	 }

	/**
	 * Get the pagination view.
	 *
	 * @static
	 * @param	Illuminate\Pagination\Paginator	$paginator
	 * @return Illuminate\View\View
	 */
	 public static function getPaginationView($paginator){
		return self::$root->getPaginationView($paginator);
	 }

	/**
	 * Get the number of the current page.
	 *
	 * @static
	 * @return int
	 */
	 public static function getCurrentPage(){
		return self::$root->getCurrentPage();
	 }

	/**
	 * Set the number of the current page.
	 *
	 * @static
	 * @param	int	$number
	 */
	 public static function setCurrentPage($number){
		self::$root->setCurrentPage($number);
	 }

	/**
	 * Get the root URL for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function getCurrentUrl(){
		return self::$root->getCurrentUrl();
	 }

	/**
	 * Set the base URL in use by the paginator.
	 *
	 * @static
	 * @param	string	$baseUrl
	 */
	 public static function setBaseUrl($baseUrl){
		self::$root->setBaseUrl($baseUrl);
	 }

	/**
	 * Get the name of the pagination view.
	 *
	 * @static
	 * @return string
	 */
	 public static function getViewName(){
		return self::$root->getViewName();
	 }

	/**
	 * Set the name of the pagination view.
	 *
	 * @static
	 * @param	string	$viewName
	 */
	 public static function setViewName($viewName){
		self::$root->setViewName($viewName);
	 }

	/**
	 * Get the locale of the paginator.
	 *
	 * @static
	 * @return string
	 */
	 public static function getLocale(){
		return self::$root->getLocale();
	 }

	/**
	 * Set the locale of the paginator.
	 *
	 * @static
	 * @param	string	$locale
	 */
	 public static function setLocale($locale){
		self::$root->setLocale($locale);
	 }

	/**
	 * Get the active request instance.
	 *
	 * @static
	 * @return Symfony\Component\HttpFoundation\Request
	 */
	 public static function getRequest(){
		return self::$root->getRequest();
	 }

	/**
	 * Set the active request instance.
	 *
	 * @static
	 * @param	Symfony\Component\HttpFoundation\Request	$request
	 */
	 public static function setRequest($request){
		self::$root->setRequest($request);
	 }

	/**
	 * Get the current view driver.
	 *
	 * @static
	 * @return Illuminate\View\Environment
	 */
	 public static function getViewDriver(){
		return self::$root->getViewDriver();
	 }

	/**
	 * Set the current view driver.
	 *
	 * @static
	 * @param	Illuminate\View\Environment	$view
	 */
	 public static function setViewDriver($view){
		self::$root->setViewDriver($view);
	 }

	/**
	 * Get the translator instance.
	 *
	 * @static
	 * @return Symfony\Component\Translation\TranslatorInterface
	 */
	 public static function getTranslator(){
		return self::$root->getTranslator();
	 }

 }
}

namespace  {
 class Password{
	/**
	 * @var Illuminate\Auth\Reminders\PasswordBroker $root
	 */
	 static private $root;

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
		self::$root->__construct($reminders, $users, $redirect, $mailer, $reminderView);
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
		return self::$root->remind($credentials, $callback);
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
		self::$root->sendReminder($user, $token, $callback);
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
		return self::$root->reset($credentials, $callback);
	 }

	/**
	 * Get the user for the given credentials.
	 *
	 * @static
	 * @param	array	$credentials
	 * @return Illuminate\Auth\RemindableInterface
	 */
	 public static function getUser($credentials){
		return self::$root->getUser($credentials);
	 }

 }
}

namespace  {
 class Redirect{
	/**
	 * @var Illuminate\Routing\Redirector $root
	 */
	 static private $root;

	/**
	 * Create a new Redirector instance.
	 *
	 * @static
	 * @param	Illuminate\Routing\UrlGenerator	$generator
	 */
	 public static function __construct($generator){
		self::$root->__construct($generator);
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
		return self::$root->back($status, $headers);
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
		return self::$root->refresh($status, $headers);
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
		return self::$root->to($path, $status, $headers, $secure);
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
		return self::$root->secure($path, $status, $headers);
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
		return self::$root->route($route, $parameters, $status, $headers);
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
		return self::$root->action($action, $parameters, $status, $headers);
	 }

	/**
	 * Get the URL generator instance.
	 *
	 * @static
	 * @return Illuminate\Routing\UrlGenerator
	 */
	 public static function getUrlGenerator(){
		return self::$root->getUrlGenerator();
	 }

	/**
	 * Set the active session store.
	 *
	 * @static
	 * @param	Illuminate\Session\Store	$session
	 */
	 public static function setSession($session){
		self::$root->setSession($session);
	 }

 }
}

namespace  {
 class Request{
	/**
	 * @var Illuminate\Http\Request $root
	 */
	 static private $root;

	/**
	 * Return the Request instance.
	 *
	 * @static
	 * @return Illuminate\Http\Request
	 */
	 public static function instance(){
		return self::$root->instance();
	 }

	/**
	 * Get the root URL for the application.
	 *
	 * @static
	 * @return string
	 */
	 public static function root(){
		return self::$root->root();
	 }

	/**
	 * Get the URL (no query string) for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function url(){
		return self::$root->url();
	 }

	/**
	 * Get the full URL for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function fullUrl(){
		return self::$root->fullUrl();
	 }

	/**
	 * Get the current path info for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function path(){
		return self::$root->path();
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
		return self::$root->segment($index, $default);
	 }

	/**
	 * Get all of the segments for the request path.
	 *
	 * @static
	 * @return array
	 */
	 public static function segments(){
		return self::$root->segments();
	 }

	/**
	 * Determine if the current request URI matches a pattern.
	 *
	 * @static
	 * @param	string	$pattern
	 * @return bool
	 */
	 public static function is($pattern){
		return self::$root->is($pattern);
	 }

	/**
	 * Determine if the request is the result of an AJAX call.
	 *
	 * @static
	 * @return bool
	 */
	 public static function ajax(){
		return self::$root->ajax();
	 }

	/**
	 * Determine if the request is over HTTPS.
	 *
	 * @static
	 * @return bool
	 */
	 public static function secure(){
		return self::$root->secure();
	 }

	/**
	 * Determine if the request contains a given input item.
	 *
	 * @static
	 * @param	string|array	$key
	 * @return bool
	 */
	 public static function has($key){
		return self::$root->has($key);
	 }

	/**
	 * Get all of the input and files for the request.
	 *
	 * @static
	 * @return array
	 */
	 public static function all(){
		return self::$root->all();
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
		return self::$root->input($key, $default);
	 }

	/**
	 * Get a subset of the items from the input data.
	 *
	 * @static
	 * @param	array	$keys
	 * @return array
	 */
	 public static function only($keys){
		return self::$root->only($keys);
	 }

	/**
	 * Get all of the input except for a specified array of items.
	 *
	 * @static
	 * @param	array	$keys
	 * @return array
	 */
	 public static function except($keys){
		return self::$root->except($keys);
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
		return self::$root->query($key, $default);
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
		return self::$root->cookie($key, $default);
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
		return self::$root->file($key, $default);
	 }

	/**
	 * Determine if the uploaded data contains a file.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function hasFile($key){
		return self::$root->hasFile($key);
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
		return self::$root->header($key, $default);
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
		return self::$root->server($key, $default);
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
		return self::$root->old($key, $default);
	 }

	/**
	 * Flash the input for the current request to the session.
	 *
	 * @static
	 * @param	string $filter
	 * @param	array	$keys
	 */
	 public static function flash($filter = null, $keys = array()){
		self::$root->flash($filter, $keys);
	 }

	/**
	 * Flash only some of the input to the session.
	 *
	 * @static
	 * @param	dynamic	string
	 */
	 public static function flashOnly($keys){
		self::$root->flashOnly($keys);
	 }

	/**
	 * Flash only some of the input to the session.
	 *
	 * @static
	 * @param	dynamic	string
	 */
	 public static function flashExcept($keys){
		self::$root->flashExcept($keys);
	 }

	/**
	 * Flush all of the old input from the session.
	 *
	 * @static
	 */
	 public static function flush(){
		self::$root->flush();
	 }

	/**
	 * Merge new input into the current request's input array.
	 *
	 * @static
	 * @param	array	$input
	 */
	 public static function merge($input){
		self::$root->merge($input);
	 }

	/**
	 * Replace the input for the current request.
	 *
	 * @static
	 * @param	array	$input
	 */
	 public static function replace($input){
		self::$root->replace($input);
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
		return self::$root->json($key, $default);
	 }

	/**
	 * Get the Illuminate session store implementation.
	 *
	 * @static
	 * @return Illuminate\Session\Store
	 */
	 public static function getSessionStore(){
		return self::$root->getSessionStore();
	 }

	/**
	 * Set the Illuminate session store implementation.
	 *
	 * @static
	 * @param	Illuminate\Session\Store	$session
	 */
	 public static function setSessionStore($session){
		self::$root->setSessionStore($session);
	 }

	/**
	 * Determine if the session store has been set.
	 *
	 * @static
	 * @return bool
	 */
	 public static function hasSessionStore(){
		return self::$root->hasSessionStore();
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
		self::$root->__construct($query, $request, $attributes, $cookies, $files, $server, $content);
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
		self::$root->initialize($query, $request, $attributes, $cookies, $files, $server, $content);
	 }

	/**
	 * Creates a new request with values from PHP's super globals.
	 *
	 * @static
	 * @return Request A new request
	 */
	 public static function createFromGlobals(){
		return self::$root->createFromGlobals();
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
		return self::$root->create($uri, $method, $parameters, $cookies, $files, $server, $content);
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
		return self::$root->duplicate($query, $request, $attributes, $cookies, $files, $server);
	 }

	/**
	 * Clones the current request.
	 * Note that the session is not cloned as duplicated requests
	 * are most of the time sub-requests of the main one.
	 *
	 * @static
	 */
	 public static function __clone(){
		self::$root->__clone();
	 }

	/**
	 * Returns the request as a string.
	 *
	 * @static
	 * @return string The request
	 */
	 public static function __toString(){
		return self::$root->__toString();
	 }

	/**
	 * Overrides the PHP global variables according to this request instance.
	 * It overrides $_GET, $_POST, $_REQUEST, $_SERVER, $_COOKIE.
	 * $_FILES is never override, see rfc1867
	 *
	 * @static
	 */
	 public static function overrideGlobals(){
		self::$root->overrideGlobals();
	 }

	/**
	 * Trusts $_SERVER entries coming from proxies.
	 *
	 * @static
	 */
	 public static function trustProxyData(){
		self::$root->trustProxyData();
	 }

	/**
	 * Sets a list of trusted proxies.
	 * You should only list the reverse proxies that you manage directly.
	 *
	 * @static
	 * @param	array $proxies A list of trusted proxies
	 */
	 public static function setTrustedProxies($proxies){
		self::$root->setTrustedProxies($proxies);
	 }

	/**
	 * Gets the list of trusted proxies.
	 *
	 * @static
	 * @return array An array of trusted proxies.
	 */
	 public static function getTrustedProxies(){
		return self::$root->getTrustedProxies();
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
		self::$root->setTrustedHeaderName($key, $value);
	 }

	/**
	 * Returns true if $_SERVER entries coming from proxies are trusted,
	 * false otherwise.
	 *
	 * @static
	 * @return boolean
	 */
	 public static function isProxyTrusted(){
		return self::$root->isProxyTrusted();
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
		return self::$root->normalizeQueryString($qs);
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
		self::$root->enableHttpMethodParameterOverride();
	 }

	/**
	 * Checks whether support for the _method request parameter is enabled.
	 *
	 * @static
	 * @return Boolean True when the _method request parameter is enabled, false otherwise
	 */
	 public static function getHttpMethodParameterOverride(){
		return self::$root->getHttpMethodParameterOverride();
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
		return self::$root->get($key, $default, $deep);
	 }

	/**
	 * Gets the Session.
	 *
	 * @static
	 * @return SessionInterface|null The session
	 */
	 public static function getSession(){
		return self::$root->getSession();
	 }

	/**
	 * Whether the request contains a Session which was started in one of the
	 * previous requests.
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function hasPreviousSession(){
		return self::$root->hasPreviousSession();
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
		return self::$root->hasSession();
	 }

	/**
	 * Sets the Session.
	 *
	 * @static
	 * @param	SessionInterface $session The Session
	 */
	 public static function setSession($session){
		self::$root->setSession($session);
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
		return self::$root->getClientIp();
	 }

	/**
	 * Returns current script name.
	 *
	 * @static
	 * @return string
	 */
	 public static function getScriptName(){
		return self::$root->getScriptName();
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
		return self::$root->getPathInfo();
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
		return self::$root->getBasePath();
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
		return self::$root->getBaseUrl();
	 }

	/**
	 * Gets the request's scheme.
	 *
	 * @static
	 * @return string
	 */
	 public static function getScheme(){
		return self::$root->getScheme();
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
		return self::$root->getPort();
	 }

	/**
	 * Returns the user.
	 *
	 * @static
	 * @return string|null
	 */
	 public static function getUser(){
		return self::$root->getUser();
	 }

	/**
	 * Returns the password.
	 *
	 * @static
	 * @return string|null
	 */
	 public static function getPassword(){
		return self::$root->getPassword();
	 }

	/**
	 * Gets the user info.
	 *
	 * @static
	 * @return string A user name and, optionally, scheme-specific information about how to gain authorization to access the server
	 */
	 public static function getUserInfo(){
		return self::$root->getUserInfo();
	 }

	/**
	 * Returns the HTTP host being requested.
	 * The port name will be appended to the host if it's non-standard.
	 *
	 * @static
	 * @return string
	 */
	 public static function getHttpHost(){
		return self::$root->getHttpHost();
	 }

	/**
	 * Returns the requested URI.
	 *
	 * @static
	 * @return string The raw URI (i.e. not urldecoded)
	 */
	 public static function getRequestUri(){
		return self::$root->getRequestUri();
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
		return self::$root->getSchemeAndHttpHost();
	 }

	/**
	 * Generates a normalized URI for the Request.
	 *
	 * @static
	 * @return string A normalized URI for the Request
	 */
	 public static function getUri(){
		return self::$root->getUri();
	 }

	/**
	 * Generates a normalized URI for the given path.
	 *
	 * @static
	 * @param	string $path A path to use instead of the current one
	 * @return string The normalized URI for the path
	 */
	 public static function getUriForPath($path){
		return self::$root->getUriForPath($path);
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
		return self::$root->getQueryString();
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
		return self::$root->isSecure();
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
		return self::$root->getHost();
	 }

	/**
	 * Sets the request method.
	 *
	 * @static
	 * @param	string $method
	 */
	 public static function setMethod($method){
		self::$root->setMethod($method);
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
		return self::$root->getMethod();
	 }

	/**
	 * Gets the "real" request method.
	 *
	 * @static
	 * @return string The request method
	 */
	 public static function getRealMethod(){
		return self::$root->getRealMethod();
	 }

	/**
	 * Gets the mime type associated with the format.
	 *
	 * @static
	 * @param	string $format The format
	 * @return string The associated mime type (null if not found)
	 */
	 public static function getMimeType($format){
		return self::$root->getMimeType($format);
	 }

	/**
	 * Gets the format associated with the mime type.
	 *
	 * @static
	 * @param	string $mimeType The associated mime type
	 * @return string|null The format (null if not found)
	 */
	 public static function getFormat($mimeType){
		return self::$root->getFormat($mimeType);
	 }

	/**
	 * Associates a format with mime types.
	 *
	 * @static
	 * @param	string	$format	The format
	 * @param	string|array $mimeTypes The associated mime types (the preferred one must be the first as it will be used as the content type)
	 */
	 public static function setFormat($format, $mimeTypes){
		self::$root->setFormat($format, $mimeTypes);
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
		return self::$root->getRequestFormat($default);
	 }

	/**
	 * Sets the request format.
	 *
	 * @static
	 * @param	string $format The request format.
	 */
	 public static function setRequestFormat($format){
		self::$root->setRequestFormat($format);
	 }

	/**
	 * Gets the format associated with the request.
	 *
	 * @static
	 * @return string|null The format (null if no content type is present)
	 */
	 public static function getContentType(){
		return self::$root->getContentType();
	 }

	/**
	 * Sets the default locale.
	 *
	 * @static
	 * @param	string $locale
	 */
	 public static function setDefaultLocale($locale){
		self::$root->setDefaultLocale($locale);
	 }

	/**
	 * Sets the locale.
	 *
	 * @static
	 * @param	string $locale
	 */
	 public static function setLocale($locale){
		self::$root->setLocale($locale);
	 }

	/**
	 * Get the locale.
	 *
	 * @static
	 * @return string
	 */
	 public static function getLocale(){
		return self::$root->getLocale();
	 }

	/**
	 * Checks if the request method is of specified type.
	 *
	 * @static
	 * @param	string $method Uppercase request method (GET, POST etc).
	 * @return Boolean
	 */
	 public static function isMethod($method){
		return self::$root->isMethod($method);
	 }

	/**
	 * Checks whether the method is safe or not.
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isMethodSafe(){
		return self::$root->isMethodSafe();
	 }

	/**
	 * Returns the request body content.
	 *
	 * @static
	 * @param	Boolean $asResource If true, a resource will be returned
	 * @return string|resource The request body content or a resource to read the body stream.
	 */
	 public static function getContent($asResource = false){
		return self::$root->getContent($asResource);
	 }

	/**
	 * Gets the Etags.
	 *
	 * @static
	 * @return array The entity tags
	 */
	 public static function getETags(){
		return self::$root->getETags();
	 }

	/**
	 * 
	 *
	 * @static
	 * @return Boolean
	 */
	 public static function isNoCache(){
		return self::$root->isNoCache();
	 }

	/**
	 * Returns the preferred language.
	 *
	 * @static
	 * @param	array $locales An array of ordered available locales
	 * @return string|null The preferred locale
	 */
	 public static function getPreferredLanguage($locales = null){
		return self::$root->getPreferredLanguage($locales);
	 }

	/**
	 * Gets a list of languages acceptable by the client browser.
	 *
	 * @static
	 * @return array Languages ordered in the user browser preferences
	 */
	 public static function getLanguages(){
		return self::$root->getLanguages();
	 }

	/**
	 * Gets a list of charsets acceptable by the client browser.
	 *
	 * @static
	 * @return array List of charsets in preferable order
	 */
	 public static function getCharsets(){
		return self::$root->getCharsets();
	 }

	/**
	 * Gets a list of content types acceptable by the client browser
	 *
	 * @static
	 * @return array List of content types in preferable order
	 */
	 public static function getAcceptableContentTypes(){
		return self::$root->getAcceptableContentTypes();
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
		return self::$root->isXmlHttpRequest();
	 }

	/**
	 * Splits an Accept-* HTTP header.
	 *
	 * @static
	 * @param	string $header Header to split
	 * @return array Array indexed by the values of the Accept-* header in preferred order
	 */
	 public static function splitHttpAcceptHeader($header){
		return self::$root->splitHttpAcceptHeader($header);
	 }

 }
}

namespace  {
 class Response{
	/**
	 * @var Illuminate\Support\Facades\Response $root
	 */
	 static private $root;

	/**
	 * Return a new response from the application.
	 *
	 * @static
	 * @param	string	$content
	 * @param	int	$status
	 * @param	array	$headers
	 * @return Symfony\Component\HttpFoundation\Response
	 */
	 public static function make($content = '', $status = '200', $headers = array()){
		return self::$root->make($content, $status, $headers);
	 }

	/**
	 * Return a new JSON response from the application.
	 *
	 * @static
	 * @param	string	$content
	 * @param	int	$status
	 * @param	array	$headers
	 * @return Symfony\Component\HttpFoundation\JsonResponse
	 */
	 public static function json($data = array(), $status = '200', $headers = array()){
		return self::$root->json($data, $status, $headers);
	 }

	/**
	 * Return a new streamed response from the application.
	 *
	 * @static
	 * @param	Closure	$callback
	 * @param	int	$status
	 * @param	array	$headers
	 * @return Symfony\Component\HttpFoundation\StreamedResponse
	 */
	 public static function stream($callback, $status = '200', $headers = array()){
		return self::$root->stream($callback, $status, $headers);
	 }

	/**
	 * Create a new file download response.
	 *
	 * @static
	 * @param	SplFileInfo|string	$file
	 * @param	int	$status
	 * @param	array	$headers
	 * @return Symfony\Component\HttpFoundation\BinaryFileResponse
	 */
	 public static function download($file, $status = '200', $headers = array()){
		return self::$root->download($file, $status, $headers);
	 }

 }
}

namespace  {
 class Route{
	/**
	 * @var Illuminate\Routing\Router $root
	 */
	 static private $root;

	/**
	 * Create a new router instance.
	 *
	 * @static
	 * @param	Illuminate\Container	$container
	 */
	 public static function __construct($container = null){
		self::$root->__construct($container);
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
		return self::$root->get($pattern, $action);
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
		return self::$root->post($pattern, $action);
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
		return self::$root->put($pattern, $action);
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
		return self::$root->patch($pattern, $action);
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
		return self::$root->delete($pattern, $action);
	 }

	/**
	 * Add a new route to the collection.
	 *
	 * @static
	 * @param	string	$pattern
	 * @param	mixed	$action
	 * @return Illuminate\Routing\Route
	 */
	 public static function options($pattern, $action){
		return self::$root->options($pattern, $action);
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
		return self::$root->match($method, $pattern, $action);
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
		return self::$root->any($pattern, $action);
	 }

	/**
	 * Register an array of controllers with wildcard routing.
	 *
	 * @static
	 * @param	array	$controllers
	 */
	 public static function controllers($controllers){
		self::$root->controllers($controllers);
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
		return self::$root->controller($uri, $controller);
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
		self::$root->resource($resource, $controller, $options);
	 }

	/**
	 * Get the base resource URI for a given resource.
	 *
	 * @static
	 * @param	string	$resource
	 * @return string
	 */
	 public static function getResourceUri($resource){
		return self::$root->getResourceUri($resource);
	 }

	/**
	 * Create a route group with shared attributes.
	 *
	 * @static
	 * @param	array	$attributes
	 * @param	Closure	$callback
	 */
	 public static function group($attributes, $callback){
		self::$root->group($attributes, $callback);
	 }

	/**
	 * Get the response for a given request.
	 *
	 * @static
	 * @param	Symfony\Component\HttpFoundation\Request	$request
	 * @return Symfony\Component\HttpFoundation\Response
	 */
	 public static function dispatch($request){
		return self::$root->dispatch($request);
	 }

	/**
	 * Register a "before" routing filter.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function before($callback){
		self::$root->before($callback);
	 }

	/**
	 * Register an "after" routing filter.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function after($callback){
		self::$root->after($callback);
	 }

	/**
	 * Register a "close" routing filter.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function close($callback){
		self::$root->close($callback);
	 }

	/**
	 * Register a "finish" routing filters.
	 *
	 * @static
	 * @param	Closure|string	$callback
	 */
	 public static function finish($callback){
		self::$root->finish($callback);
	 }

	/**
	 * Register a new filter with the application.
	 *
	 * @static
	 * @param	string	$name
	 * @param	Closure|string	$callback
	 */
	 public static function addFilter($name, $callback){
		self::$root->addFilter($name, $callback);
	 }

	/**
	 * Get a registered filter callback.
	 *
	 * @static
	 * @param	string	$name
	 * @return Closure
	 */
	 public static function getFilter($name){
		return self::$root->getFilter($name);
	 }

	/**
	 * Tie a registered filter to a URI pattern.
	 *
	 * @static
	 * @param	string	$pattern
	 * @param	string|array	$names
	 */
	 public static function matchFilter($pattern, $names){
		self::$root->matchFilter($pattern, $names);
	 }

	/**
	 * Find the patterned filters matching a request.
	 *
	 * @static
	 * @param	Illuminate\Foundation\Request	$request
	 * @return array
	 */
	 public static function findPatternFilters($request){
		return self::$root->findPatternFilters($request);
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
		return self::$root->callFinishFilter($request, $response);
	 }

	/**
	 * Set a global where pattern on all routes
	 *
	 * @static
	 * @param	string	$key
	 * @param	string	$pattern
	 */
	 public static function pattern($key, $pattern){
		self::$root->pattern($key, $pattern);
	 }

	/**
	 * Register a model binder for a wildcard.
	 *
	 * @static
	 * @param	string	$key
	 * @param	string	$class
	 */
	 public static function model($key, $class){
		self::$root->model($key, $class);
	 }

	/**
	 * Register a custom parameter binder.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$binder
	 */
	 public static function bind($key, $binder){
		self::$root->bind($key, $binder);
	 }

	/**
	 * Determine if a given key has a registered binder.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function hasBinder($key){
		return self::$root->hasBinder($key);
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
		return self::$root->performBinding($key, $value, $route);
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
		return self::$root->prepare($value, $request);
	 }

	/**
	 * Determine if the current route has a given name.
	 *
	 * @static
	 * @param	string	$name
	 * @return bool
	 */
	 public static function currentRouteNamed($name){
		return self::$root->currentRouteNamed($name);
	 }

	/**
	 * Determine if the current route uses a given controller action.
	 *
	 * @static
	 * @param	string	$action
	 * @return bool
	 */
	 public static function currentRouteUses($action){
		return self::$root->currentRouteUses($action);
	 }

	/**
	 * Determine if route filters are enabled.
	 *
	 * @static
	 * @return bool
	 */
	 public static function filtersEnabled(){
		return self::$root->filtersEnabled();
	 }

	/**
	 * Enable the running of filters.
	 *
	 * @static
	 */
	 public static function enableFilters(){
		self::$root->enableFilters();
	 }

	/**
	 * Disable the running of all filters.
	 *
	 * @static
	 */
	 public static function disableFilters(){
		self::$root->disableFilters();
	 }

	/**
	 * Retrieve the entire route collection.
	 *
	 * @static
	 * @return Symfony\Component\Routing\RouteCollection
	 */
	 public static function getRoutes(){
		return self::$root->getRoutes();
	 }

	/**
	 * Get the current request being dispatched.
	 *
	 * @static
	 * @return Symfony\Component\HttpFoundation\Request
	 */
	 public static function getRequest(){
		return self::$root->getRequest();
	 }

	/**
	 * Get the current route being executed.
	 *
	 * @static
	 * @return Illuminate\Routing\Route
	 */
	 public static function getCurrentRoute(){
		return self::$root->getCurrentRoute();
	 }

	/**
	 * Set the current route on the router.
	 *
	 * @static
	 * @param	Illuminate\Routing\Route	$route
	 */
	 public static function setCurrentRoute($route){
		self::$root->setCurrentRoute($route);
	 }

	/**
	 * Get the filters defined on the router.
	 *
	 * @static
	 * @return array
	 */
	 public static function getFilters(){
		return self::$root->getFilters();
	 }

	/**
	 * Get the global filters defined on the router.
	 *
	 * @static
	 * @return array
	 */
	 public static function getGlobalFilters(){
		return self::$root->getGlobalFilters();
	 }

	/**
	 * Get the controller inspector instance.
	 *
	 * @static
	 * @return Illuminate\Routing\Controllers\Inspector
	 */
	 public static function getInspector(){
		return self::$root->getInspector();
	 }

	/**
	 * Set the controller inspector instance.
	 *
	 * @static
	 * @param	Illuminate\Routing\Controllers\Inspector	$inspector
	 */
	 public static function setInspector($inspector){
		self::$root->setInspector($inspector);
	 }

	/**
	 * Get the container used by the router.
	 *
	 * @static
	 * @return Illuminate\Container\Container
	 */
	 public static function getContainer(){
		return self::$root->getContainer();
	 }

	/**
	 * Set the container instance on the router.
	 *
	 * @static
	 * @param	Illuminate\Container\Container	$container
	 */
	 public static function setContainer($container){
		self::$root->setContainer($container);
	 }

 }
}

namespace  {
 class Schema{
	/**
	 * @var Illuminate\Database\Schema\Builder $root
	 */
	 static private $root;

	/**
	 * Create a new database Schema manager.
	 *
	 * @static
	 * @param	Illuminate\Database\Connection	$connection
	 */
	 public static function __construct($connection){
		self::$root->__construct($connection);
	 }

	/**
	 * Determine if the given table exists.
	 *
	 * @static
	 * @param	string	$table
	 * @return bool
	 */
	 public static function hasTable($table){
		return self::$root->hasTable($table);
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
		return self::$root->table($table, $callback);
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
		return self::$root->create($table, $callback);
	 }

	/**
	 * Drop a table from the schema.
	 *
	 * @static
	 * @param	string	$table
	 * @return Illuminate\Database\Schema\Blueprint
	 */
	 public static function drop($table){
		return self::$root->drop($table);
	 }

	/**
	 * Drop a table from the schema if it exists.
	 *
	 * @static
	 * @param	string	$table
	 * @return Illuminate\Database\Schema\Blueprint
	 */
	 public static function dropIfExists($table){
		return self::$root->dropIfExists($table);
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
		return self::$root->rename($from, $to);
	 }

	/**
	 * Get the database connection instance.
	 *
	 * @static
	 * @return Illuminate\Database\Connection
	 */
	 public static function getConnection(){
		return self::$root->getConnection();
	 }

	/**
	 * Set the database connection instance.
	 *
	 * @static
	 * @param	Illuminate\Database\Connection
	 * @return Illuminate\Database\Schema
	 */
	 public static function setConnection($connection){
		return self::$root->setConnection($connection);
	 }

 }
}

namespace  {
 class Seeder{
	/**
	 * @var Illuminate\Database\Seeder $root
	 */
	 static private $root;

	/**
	 * Run the database seeds.
	 *
	 * @static
	 */
	 public static function run(){
		self::$root->run();
	 }

	/**
	 * Seed the given connection from the given path.
	 *
	 * @static
	 * @param	string	$class
	 */
	 public static function call($class){
		self::$root->call($class);
	 }

	/**
	 * Set the IoC container instance.
	 *
	 * @static
	 * @param	Illuminate\Container\Container	$container
	 */
	 public static function setContainer($container){
		self::$root->setContainer($container);
	 }

 }
}

namespace  {
 class Session{
	/**
	 * @var Illuminate\Session\CookieStore $root
	 */
	 static private $root;

	/**
	 * Create a new Cookie based session store.
	 *
	 * @static
	 * @param	Illuminate\CookieJar	$cookies
	 * @param	string	$payload
	 */
	 public static function __construct($cookies, $payload = 'illuminate_payload'){
		self::$root->__construct($cookies, $payload);
	 }

	/**
	 * Retrieve a session payload from storage.
	 *
	 * @static
	 * @param	string	$id
	 * @return array|null
	 */
	 public static function retrieveSession($id){
		return self::$root->retrieveSession($id);
	 }

	/**
	 * Create a new session in storage.
	 *
	 * @static
	 * @param	string	$id
	 * @param	array	$session
	 * @param	Symfony\Component\HttpFoundation\Response	$response
	 */
	 public static function createSession($id, $session, $response){
		self::$root->createSession($id, $session, $response);
	 }

	/**
	 * Update an existing session in storage.
	 *
	 * @static
	 * @param	string	$id
	 * @param	array	$session
	 * @param	Symfony\Component\HttpFoundation\Response	$response
	 */
	 public static function updateSession($id, $session, $response){
		self::$root->updateSession($id, $session, $response);
	 }

	/**
	 * Set the name of the session payload cookie.
	 *
	 * @static
	 * @param	string	$name
	 */
	 public static function setPayloadName($name){
		self::$root->setPayloadName($name);
	 }

	/**
	 * Get the cookie jar instance.
	 *
	 * @static
	 * @return Illuminate\CookieJar
	 */
	 public static function getCookieJar(){
		return self::$root->getCookieJar();
	 }

	/**
	 * Load the session for the request.
	 *
	 * @static
	 * @param	Illuminate\CookieJar	$cookies
	 * @param	string	$name
	 */
	 public static function start($cookies, $name){
		self::$root->start($cookies, $name);
	 }

	/**
	 * Get the full array of session data, including flash data.
	 *
	 * @static
	 * @return array
	 */
	 public static function all(){
		return self::$root->all();
	 }

	/**
	 * Determine if the session contains a given item.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function has($key){
		return self::$root->has($key);
	 }

	/**
	 * Get the requested item from the session.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return mixed
	 */
	 public static function get($key, $default = null){
		return self::$root->get($key, $default);
	 }

	/**
	 * Get the request item from the flash data.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return mixed
	 */
	 public static function getFlash($key, $default = null){
		return self::$root->getFlash($key, $default);
	 }

	/**
	 * Determine if the old input contains an item.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function hasOldInput($key){
		return self::$root->hasOldInput($key);
	 }

	/**
	 * Get the requested item from the flashed input array.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return mixed
	 */
	 public static function getOldInput($key = null, $default = null){
		return self::$root->getOldInput($key, $default);
	 }

	/**
	 * Get the CSRF token value.
	 *
	 * @static
	 * @return string
	 */
	 public static function getToken(){
		return self::$root->getToken();
	 }

	/**
	 * Put a key / value pair in the session.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function put($key, $value){
		self::$root->put($key, $value);
	 }

	/**
	 * Flash a key / value pair to the session.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function flash($key, $value){
		self::$root->flash($key, $value);
	 }

	/**
	 * Flash an input array to the session.
	 *
	 * @static
	 * @param	array	$value
	 */
	 public static function flashInput($value){
		self::$root->flashInput($value);
	 }

	/**
	 * Keep all of the session flash data from expiring.
	 *
	 * @static
	 */
	 public static function reflash(){
		self::$root->reflash();
	 }

	/**
	 * Keep a session flash item from expiring.
	 *
	 * @static
	 * @param	string|array	$keys
	 */
	 public static function keep($keys){
		self::$root->keep($keys);
	 }

	/**
	 * Remove an item from the session.
	 *
	 * @static
	 * @param	string	$key
	 */
	 public static function forget($key){
		self::$root->forget($key);
	 }

	/**
	 * Remove all of the items from the session.
	 *
	 * @static
	 */
	 public static function flush(){
		self::$root->flush();
	 }

	/**
	 * Generate a new session identifier.
	 *
	 * @static
	 * @return string
	 */
	 public static function regenerate(){
		return self::$root->regenerate();
	 }

	/**
	 * Finish the session handling for the request.
	 *
	 * @static
	 * @param	Symfony\Component\HttpFoundation\Response	$response
	 * @param	int	$lifetime
	 */
	 public static function finish($response, $lifetime){
		self::$root->finish($response, $lifetime);
	 }

	/**
	 * Determine if the request hits the sweeper lottery.
	 *
	 * @static
	 * @return bool
	 */
	 public static function hitsLottery(){
		return self::$root->hitsLottery();
	 }

	/**
	 * Write the session cookie to the response.
	 *
	 * @static
	 * @param	Illuminate\Cookie\CookieJar	$cookie
	 * @param	string	$name
	 * @param	int	$lifetime
	 * @param	string	$path
	 * @param	string	$domain
	 */
	 public static function getCookie($cookie, $name, $lifetime, $path, $domain){
		self::$root->getCookie($cookie, $name, $lifetime, $path, $domain);
	 }

	/**
	 * Get the session payload.
	 *
	 * @static
	 */
	 public static function getSession(){
		self::$root->getSession();
	 }

	/**
	 * Set the entire session payload.
	 *
	 * @static
	 * @param	array	$session
	 */
	 public static function setSession($session){
		self::$root->setSession($session);
	 }

	/**
	 * Get the current session ID.
	 *
	 * @static
	 * @return string
	 */
	 public static function getSessionID(){
		return self::$root->getSessionID();
	 }

	/**
	 * Get the session's last activity UNIX timestamp.
	 *
	 * @static
	 * @return int
	 */
	 public static function getLastActivity(){
		return self::$root->getLastActivity();
	 }

	/**
	 * Determine if the session exists in storage.
	 *
	 * @static
	 * @return bool
	 */
	 public static function sessionExists(){
		return self::$root->sessionExists();
	 }

	/**
	 * Set the existence of the session.
	 *
	 * @static
	 * @param	bool	$value
	 */
	 public static function setExists($value){
		self::$root->setExists($value);
	 }

	/**
	 * Set the session cookie name.
	 *
	 * @static
	 * @param	string	$name
	 */
	 public static function setCookieName($name){
		self::$root->setCookieName($name);
	 }

	/**
	 * Get the given cookie option.
	 *
	 * @static
	 * @param	string	$option
	 * @return mixed
	 */
	 public static function getCookieOption($option){
		return self::$root->getCookieOption($option);
	 }

	/**
	 * Set the given cookie option.
	 *
	 * @static
	 * @param	string	$option
	 * @param	mixed	$value
	 */
	 public static function setCookieOption($option, $value){
		self::$root->setCookieOption($option, $value);
	 }

	/**
	 * Set the session lifetime.
	 *
	 * @static
	 * @param	int	$minutes
	 */
	 public static function setLifetime($minutes){
		self::$root->setLifetime($minutes);
	 }

	/**
	 * Set the chances of hitting the Sweeper lottery.
	 *
	 * @static
	 * @param	array	$values
	 */
	 public static function setSweepLottery($values){
		self::$root->setSweepLottery($values);
	 }

	/**
	 * Determine if the given offset exists.
	 *
	 * @static
	 * @param	string	$key
	 * @return bool
	 */
	 public static function offsetExists($key){
		return self::$root->offsetExists($key);
	 }

	/**
	 * Get the value at a given offset.
	 *
	 * @static
	 * @param	string	$key
	 * @return mixed
	 */
	 public static function offsetGet($key){
		return self::$root->offsetGet($key);
	 }

	/**
	 * Store a value at the given offset.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function offsetSet($key, $value){
		self::$root->offsetSet($key, $value);
	 }

	/**
	 * Remove the value at a given offset.
	 *
	 * @static
	 * @param	string	$key
	 */
	 public static function offsetUnset($key){
		self::$root->offsetUnset($key);
	 }

 }
}

namespace  {
 class Str{
	/**
	 * @var Illuminate\Support\Str $root
	 */
	 static private $root;

	/**
	 * Transliterate a UTF-8 value to ASCII.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function ascii($value){
		return self::$root->ascii($value);
	 }

	/**
	 * Convert a value to camel case.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function camel($value){
		return self::$root->camel($value);
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
		return self::$root->contains($haystack, $needle);
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
		return self::$root->endsWith($haystack, $needle);
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
		return self::$root->finish($value, $cap);
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
		return self::$root->is($pattern, $value);
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
		return self::$root->limit($value, $limit, $end);
	 }

	/**
	 * Limit the number of words in a string.
	 *
	 * @static
	 * @param	string	$value
	 * @param	int	$words
	 * @param	string	$end
	 * @return string
	 */
	 public static function words($value, $words = '100', $end = '...'){
		return self::$root->words($value, $words, $end);
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
		return self::$root->plural($value, $count);
	 }

	/**
	 * Generate a more truly "random" alpha-numeric string.
	 *
	 * @static
	 * @param	int	$length
	 * @return string
	 */
	 public static function random($length = '16'){
		return self::$root->random($length);
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
		return self::$root->quickRandom($length);
	 }

	/**
	 * Get the singular form of an English word.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function singular($value){
		return self::$root->singular($value);
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
		return self::$root->slug($title, $separator);
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
		return self::$root->snake($value, $delimiter);
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
		return self::$root->startsWith($haystack, $needles);
	 }

	/**
	 * Convert a value to studly caps case.
	 *
	 * @static
	 * @param	string	$value
	 * @return string
	 */
	 public static function studly($value){
		return self::$root->studly($value);
	 }

 }
}

namespace  {
 class URL{
	/**
	 * @var Illuminate\Routing\UrlGenerator $root
	 */
	 static private $root;

	/**
	 * Create a new URL Generator instance.
	 *
	 * @static
	 * @param	Symfony\Component\Routing\RouteCollection	$routes
	 * @param	Symfony\Component\HttpFoundation\Request	$request
	 */
	 public static function __construct($routes, $request){
		self::$root->__construct($routes, $request);
	 }

	/**
	 * Get the current URL for the request.
	 *
	 * @static
	 * @return string
	 */
	 public static function current(){
		return self::$root->current();
	 }

	/**
	 * Get the URL for the previous request.
	 *
	 * @static
	 * @return string
	 */
	 public static function previous(){
		return self::$root->previous();
	 }

	/**
	 * Generate a absolute URL to the given path.
	 *
	 * @static
	 * @param	string	$path
	 * @param	mixed	$parameters
	 * @param	bool	$secure
	 * @return string
	 */
	 public static function to($path, $parameters = array(), $secure = null){
		return self::$root->to($path, $parameters, $secure);
	 }

	/**
	 * Generate a secure, absolute URL to the given path.
	 *
	 * @static
	 * @param	string	$path
	 * @return string
	 */
	 public static function secure($path, $parameters = array()){
		return self::$root->secure($path, $parameters);
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
		return self::$root->asset($path, $secure);
	 }

	/**
	 * Generate a URL to a secure asset.
	 *
	 * @static
	 * @param	string	$path
	 * @return string
	 */
	 public static function secureAsset($path){
		return self::$root->secureAsset($path);
	 }

	/**
	 * Get the URL to a named route.
	 *
	 * @static
	 * @param	string	$name
	 * @param	mixed	$parameters
	 * @param	bool	$absolute
	 * @return string
	 */
	 public static function route($name, $parameters = array(), $absolute = true){
		return self::$root->route($name, $parameters, $absolute);
	 }

	/**
	 * Get the URL to a controller action.
	 *
	 * @static
	 * @param	string	$action
	 * @param	mixed	$parameters
	 * @param	bool	$absolute
	 * @return string
	 */
	 public static function action($action, $parameters = array(), $absolute = true){
		return self::$root->action($action, $parameters, $absolute);
	 }

	/**
	 * Determine if the given path is a valid URL.
	 *
	 * @static
	 * @param	string	$path
	 * @return bool
	 */
	 public static function isValidUrl($path){
		return self::$root->isValidUrl($path);
	 }

	/**
	 * Get the request instance.
	 *
	 * @static
	 * @return Symfony\Component\HttpFoundation\Request
	 */
	 public static function getRequest(){
		return self::$root->getRequest();
	 }

	/**
	 * Set the current request instance.
	 *
	 * @static
	 * @param	Symfony\Component\HttpFoundation\Request	$request
	 */
	 public static function setRequest($request){
		self::$root->setRequest($request);
	 }

	/**
	 * Get the Symfony URL generator instance.
	 *
	 * @static
	 * @return Symfony\Component\Routing\Generator\UrlGenerator
	 */
	 public static function getGenerator(){
		return self::$root->getGenerator();
	 }

	/**
	 * Get the Symfony URL generator instance.
	 *
	 * @static
	 * @param	Symfony\Component\Routing\Generator\UrlGenerator	$generator
	 */
	 public static function setGenerator($generator){
		self::$root->setGenerator($generator);
	 }

 }
}

namespace  {
 class Validator{
	/**
	 * @var Illuminate\Validation\Factory $root
	 */
	 static private $root;

	/**
	 * Create a new Validator factory instance.
	 *
	 * @static
	 * @param	Symfony\Component\Translation\TranslatorInterface	$translator
	 */
	 public static function __construct($translator){
		self::$root->__construct($translator);
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
		return self::$root->make($data, $rules, $messages);
	 }

	/**
	 * Register a custom validator extension.
	 *
	 * @static
	 * @param	string	$rule
	 * @param	Closure	$extension
	 */
	 public static function extend($rule, $extension){
		self::$root->extend($rule, $extension);
	 }

	/**
	 * Register a custom implicit validator extension.
	 *
	 * @static
	 * @param	string	$rule
	 * @param	Closure $extension
	 */
	 public static function extendImplicit($rule, $extension){
		self::$root->extendImplicit($rule, $extension);
	 }

	/**
	 * Set the Validator instance resolver.
	 *
	 * @static
	 * @param	Closure	$resolver
	 */
	 public static function resolver($resolver){
		self::$root->resolver($resolver);
	 }

	/**
	 * Get the Translator implementation.
	 *
	 * @static
	 * @return Symfony\Component\Translation\TranslatorInterface
	 */
	 public static function getTranslator(){
		return self::$root->getTranslator();
	 }

	/**
	 * Get the Presence Verifier implementation.
	 *
	 * @static
	 * @return Illuminate\Validation\PresenceVerifierInterface
	 */
	 public static function getPresenceVerifier(){
		return self::$root->getPresenceVerifier();
	 }

	/**
	 * Set the Presence Verifier implementation.
	 *
	 * @static
	 * @param	Illuminate\Validation\PresenceVerifierInterface	$presenceVerifier
	 */
	 public static function setPresenceVerifier($presenceVerifier){
		self::$root->setPresenceVerifier($presenceVerifier);
	 }

 }
}

namespace  {
 class View{
	/**
	 * @var Illuminate\View\Environment $root
	 */
	 static private $root;

	/**
	 * Create a new view environment instance.
	 *
	 * @static
	 * @param	Illuminate\View\Engines\EngineResolver	$engines
	 * @param	Illuminate\View\ViewFinderInterface	$finder
	 * @param	Illuminate\Events\Dispatcher	$events
	 */
	 public static function __construct($engines, $finder, $events){
		self::$root->__construct($engines, $finder, $events);
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
		return self::$root->make($view, $data);
	 }

	/**
	 * Determine if a given view exists.
	 *
	 * @static
	 * @param	string	$view
	 * @return bool
	 */
	 public static function exists($view){
		return self::$root->exists($view);
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
		return self::$root->renderEach($view, $data, $iterator, $empty);
	 }

	/**
	 * Add a piece of shared data to the environment.
	 *
	 * @static
	 * @param	string	$key
	 * @param	mixed	$value
	 */
	 public static function share($key, $value){
		self::$root->share($key, $value);
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
		return self::$root->composer($views, $callback);
	 }

	/**
	 * Call the composer for a given view.
	 *
	 * @static
	 * @param	Illuminate\View\View	$view
	 */
	 public static function callComposer($view){
		self::$root->callComposer($view);
	 }

	/**
	 * Start injecting content into a section.
	 *
	 * @static
	 * @param	string	$section
	 * @param	string	$content
	 */
	 public static function startSection($section, $content = ''){
		self::$root->startSection($section, $content);
	 }

	/**
	 * Inject inline content into a section.
	 *
	 * @static
	 * @param	string	$section
	 * @param	string	$content
	 */
	 public static function inject($section, $content){
		self::$root->inject($section, $content);
	 }

	/**
	 * Stop injecting content into a section and return its contents.
	 *
	 * @static
	 * @return string
	 */
	 public static function yieldSection(){
		return self::$root->yieldSection();
	 }

	/**
	 * Stop injecting content into a section.
	 *
	 * @static
	 * @return string
	 */
	 public static function stopSection(){
		return self::$root->stopSection();
	 }

	/**
	 * Get the string contents of a section.
	 *
	 * @static
	 * @param	string	$section
	 * @return string
	 */
	 public static function yieldContent($section){
		return self::$root->yieldContent($section);
	 }

	/**
	 * Flush all of the section contents.
	 *
	 * @static
	 */
	 public static function flushSections(){
		self::$root->flushSections();
	 }

	/**
	 * Increment the rendering counter.
	 *
	 * @static
	 */
	 public static function incrementRender(){
		self::$root->incrementRender();
	 }

	/**
	 * Decrement the rendering counter.
	 *
	 * @static
	 */
	 public static function decrementRender(){
		self::$root->decrementRender();
	 }

	/**
	 * Check if there are no active render operations.
	 *
	 * @static
	 * @return bool
	 */
	 public static function doneRendering(){
		return self::$root->doneRendering();
	 }

	/**
	 * Add a location to the array of view locations.
	 *
	 * @static
	 * @param	string	$location
	 */
	 public static function addLocation($location){
		self::$root->addLocation($location);
	 }

	/**
	 * Add a new namespace to the loader.
	 *
	 * @static
	 * @param	string	$namespace
	 * @param	string|array	$hints
	 */
	 public static function addNamespace($namespace, $hints){
		self::$root->addNamespace($namespace, $hints);
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
		self::$root->addExtension($extension, $engine, $resolver);
	 }

	/**
	 * Get the extension to engine bindings.
	 *
	 * @static
	 * @return array
	 */
	 public static function getExtensions(){
		return self::$root->getExtensions();
	 }

	/**
	 * Get the engine resolver instance.
	 *
	 * @static
	 * @return Illuminate\View\Engines\EngineResolver
	 */
	 public static function getEngineResolver(){
		return self::$root->getEngineResolver();
	 }

	/**
	 * Get the view finder instance.
	 *
	 * @static
	 * @return Illuminate\View\ViewFinder
	 */
	 public static function getFinder(){
		return self::$root->getFinder();
	 }

	/**
	 * Get the event dispatcher instance.
	 *
	 * @static
	 * @return Illuminate\Events\Dispatcher
	 */
	 public static function getDispatcher(){
		return self::$root->getDispatcher();
	 }

	/**
	 * Get the IoC container instance.
	 *
	 * @static
	 * @return Illuminate\Container
	 */
	 public static function getContainer(){
		return self::$root->getContainer();
	 }

	/**
	 * Set the IoC container instance.
	 *
	 * @static
	 * @param	Illuminate\Container	$container
	 */
	 public static function setContainer($container){
		self::$root->setContainer($container);
	 }

	/**
	 * Get all of the shared data for the environment.
	 *
	 * @static
	 * @return array
	 */
	 public static function getShared(){
		return self::$root->getShared();
	 }

	/**
	 * Get the entire array of sections.
	 *
	 * @static
	 * @return array
	 */
	 public static function getSections(){
		return self::$root->getSections();
	 }

 }
}

