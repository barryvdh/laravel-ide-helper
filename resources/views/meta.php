<?= '<?php' ?> namespace PHPSTORM_META {

    /**
    * PhpStorm Meta file, to provide autocomplete information for PhpStorm
    * Generated on <?= date("Y-m-d") ?>.
    *
    * @author Barry vd. Heuvel <barryvdh@gmail.com>
    * @author Kovács Vince <vincekovacs@hotmail.com>
    * @see https://github.com/barryvdh/laravel-ide-helper
    */

    /** @noinspection PhpIllegalArrayKeyTypeInspection */
    /** @noinspection PhpUnusedLocalVariableInspection */
    /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
    $STATIC_METHOD_TYPES = [
<?php foreach ($loc['methods'] as $method): ?>
    <?= $method ?>('') => [
    <?php foreach ($loc['bindings'] as $abstract => $class): ?>
        '<?= $abstract ?>' instanceof \<?= $class ?>,
    <?php endforeach ?>
    ],
<?php endforeach ?>
<?php foreach ($config['methods'] as $method): ?>
    <?= $method ?>('') => [
    <?php foreach ($config['keys'] as $key => $type): ?>
        '<?= $key ?>' instanceof <?= $type ?>,
    <?php endforeach ?>
    ],
<?php endforeach ?>
];
}
