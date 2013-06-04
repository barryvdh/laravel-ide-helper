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
    | Extra classes
    |--------------------------------------------------------------------------
    |
    | These implementations are not really extended, but called with magic functions
    |
    */

    'extra' => array(
        'Auth'      => array('Illuminate\Auth\Guard'),
        'Cache'     => array('Illuminate\Cache\StoreInterface', 'Illuminate\Cache\Repository'),
        'DB'        => array('Illuminate\Database\Connection'),
        'Eloquent'  => array('Illuminate\Database\Query\Builder'),
        'Queue'     => array('Illuminate\Queue\QueueInterface'),
    ),


    /*
    |--------------------------------------------------------------------------
    | Non-static methods
    |--------------------------------------------------------------------------
    |
    | These functions aren't actually facade calls, so don't make them static
    |
    */

    'nonstatic' => array(
        'Eloquent'  => array('freshTimestamp', 'newCollection', 'toArray', 'toJson', 'toSql', 'delete'),
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
