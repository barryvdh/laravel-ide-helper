<?= '<?php' ?> namespace PHPSTORM_META {

   /**
    * PhpStorm Meta file, to provide autocomplete information for PhpStorm
    * Generated on <?= date("Y-m-d") ?>.
    *
    * @author Barry vd. Heuvel <barryvdh@gmail.com>
    * @see https://github.com/barryvdh/laravel-ide-helper
    * @noinspection PhpUnusedLocalVariableInspection
    * @noinspection PhpIllegalArrayKeyTypeInspection
    */
    $STATIC_METHOD_TYPES = [
<?php foreach($methods as $method): ?>
        <?= $method ?>('') => [
<?php foreach($bindings as $abstract => $class): ?>
            '<?= $abstract ?>' instanceof \<?= $class ?>,
<?php endforeach ?>        ],
<?php endforeach ?>
    ];
}
