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

    'filename' => '_ide_helper.php',

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
    | Replaced classes (Managers)
    |--------------------------------------------------------------------------
    |
    | These implementations cannot be found directly, because of a Manager class.
    |
    */

    'replace' => array(
        'Illuminate\Auth\AuthManager'           => 'Illuminate\Auth\Guard',
        'Illuminate\Cache\CacheManager'         => 'Illuminate\Cache\StoreInterface',
        'Illuminate\Database\DatabaseManager'   => 'Illuminate\Database\Connection',
        'Illuminate\Queue\QueueManager'         => 'Illuminate\Queue\QueueInterface',
        'Illuminate\Redis\RedisManager'         => 'Illuminate\Redis\Database',
    ),

    /*
    |--------------------------------------------------------------------------
    | Only extend
    |--------------------------------------------------------------------------
    |
    | These implementations aren't called static, so only extend them.
    |
    */

    'only_extend' => array(
        'Seeder',
    ),

);
