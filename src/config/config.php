<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Filename
    |--------------------------------------------------------------------------
    |
    | The default path to the helper file
    |
    */

    'filename' => '_IDE_helper.php',

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

    'helper_files' => array(
        base_path().'/vendor/laravel/framework/src/Illuminate/Support/helpers.php',
        base_path().'/vendor/laravel/framework/preload/compiled.php',
    ),

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be parsed and added to the helper file.
    |
    */

    'aliases' => array(

        'App'       => 'Illuminate\Foundation\Application',
        'Artisan'   => 'Illuminate\Foundation\Artisan',
        'Auth'      => 'Illuminate\Auth\Guard',
        'Blade'     => 'Illuminate\View\Compilers\BladeCompiler',
        'Cache'     => 'Illuminate\Cache\Store',
        'ClassLoader'=> 'Illuminate\Support\ClassLoader',
        'Config'    => 'Illuminate\Config\Repository',
        'Controller'=> 'Illuminate\Routing\Controllers\Controller',
        'Cookie'    => 'Illuminate\Cookie\CookieJar',
        'Crypt'     => 'Illuminate\Encryption\Encrypter',
        'DB'        => 'Illuminate\Database\Connection',
        'Eloquent'  => 'Illuminate\Database\Eloquent\Model',
        'Event'     => 'Illuminate\Events\Event',
        'File'      => 'Illuminate\Filesystem\Filesystem',
        'Form'      => 'Illuminate\Support\Facades\Form',
        'Hash'      => 'Illuminate\Hashing\BcryptHasher',
        'Html'      => 'Illuminate\Html\HtmlBuilder',
        'Input'     => 'Illuminate\Http\Request',
        'Lang'      => 'Illuminate\Translation\Translator',
        'Log'       => 'Illuminate\Log\Writer',
        'Mail'      => 'Illuminate\Mail\Mailer',
        'Paginator' => 'Illuminate\Pagination\Paginator',
        'Password'  => 'Illuminate\Auth\Reminders\PasswordBroker',
        'Queue'     => 'Illuminate\Queue\QueueManager',
        'Redirect'  => 'Illuminate\Routing\Redirector',
        'Redis'     => 'Illuminate\Redis\Database',
        'Request'   => 'Illuminate\Http\Request',
        'Response'  => 'Illuminate\Http\Response',
        'Route'     => 'Illuminate\Routing\Router',
        'Schema'    => 'Illuminate\Database\Schema\Builder',
        'Seeder'    => 'Illuminate\Database\Seeder',
        'Session'   => 'Illuminate\Support\Facades\Session',
        'Str'       => 'Illuminate\Support\Str',
        'URL'       => 'Illuminate\Routing\UrlGenerator',
        'Validator' => 'Illuminate\Validation\Factory',
        'View'      => 'Illuminate\View\Environment',

    ),

);
