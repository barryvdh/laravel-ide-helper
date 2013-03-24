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
    | Sublime version
    |--------------------------------------------------------------------------
    |
    | Use a different code format, better for SublimeText (instead of Netbeans/phpStorm)
    | Can also be used with the --sublime (-S) option.
    |
    */

    'sublime' => false,

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
    ),

    /*
    |--------------------------------------------------------------------------
    | Custom Facades
    |--------------------------------------------------------------------------
    |
    | These facades cannot be found directly, because of a Manager class.
    |
    */

    'aliases' => array(
        'Auth'      => 'Illuminate\Auth\Guard',
        'Cache'     => 'Illuminate\Cache\StoreInterface',
        'DB'        => 'Illuminate\Database\Connection',
        'Queue'     => 'Illuminate\Queue\QueueInterface',
        'Redis'     => 'Illuminate\Redis\Database',
    ),

);
