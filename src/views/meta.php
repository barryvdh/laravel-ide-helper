<?= '<?php' ?> namespace PHPSTORM_META {

	/**
	 * PhpStorm Meta file, to provide autocomplete information for PhpStorm
	 * Generated on <?= date('Y-m-d') ?>.
	 *
	 * @author Barry vd. Heuvel <barryvdh@gmail.com>
	 * @see https://github.com/barryvdh/laravel-ide-helper
	 */

	/** @noinspection PhpIllegalArrayKeyTypeInspection,PhpUnusedLocalVariableInspection,PhpUnnecessaryFullyQualifiedNameInspection */
	$STATIC_METHOD_TYPES = array(
<?php foreach ($methods as $method): ?>
		<?= strpos($method, 'new ') === 0 ? $method : $method . '(\'\')' ?> => array(
<?php foreach ($bindings as $abstract => $class): ?>
			<?= var_export($abstract, true) ?> instanceof \<?= $class ?>,
<?php endforeach ?>
		),
<?php endforeach ?>
	);

}
