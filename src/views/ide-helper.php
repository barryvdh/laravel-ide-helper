<?= '<?php' ?>

/**
 * An helper file for Laravel 4, to provide autocomplete information to your IDE
 * Generated for Laravel <?= $version ?> on <?= date('Y-m-d') ?>.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 * @see https://github.com/barryvdh/laravel-ide-helper
 */

<?php foreach ($namespaces as $namespace => $aliases/* @var \Barryvdh\LaravelIdeHelper\Alias[] $aliases */): ?>
namespace <?= $namespace == '__root' ? '' : $namespace ?>{
<?php if ($namespace == '__root'): ?>
	exit('This file should not be included, only analyzed by your IDE');
<?= $helpers ?>
<?php endif; ?>
<?php foreach ($aliases as $alias): ?>

<?php if (($cBase = class_basename($alias->getExtends())) != $alias->getExtends() && $cBase != $alias->getShortName()): ?>
	/** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
<?php endif; ?>
	<?= $alias->getClassType() ?> <?= $alias->getShortName() ?> <?= $alias->getExtends() ? 'extends ' . $alias->getExtends() : '' ?>{
<?php foreach ($alias->getMethods() as $method): ?>

<?php if (($nParams = count($method->getDocParams())) > count($mParams = $method->getParamsWithDefault(false))): ?>
		/** @noinspection PhpDocSignatureInspection */
<?php endif; ?>
<?php if ($docComment = str_replace("/**\n\t\t */", '', trim($method->getDocComment("\t\t", true)))): ?>
		<?= $docComment ?>

<?php endif; ?>
		public static function <?= $method->getName() ?>(<?= ($docComment && $nParams < count($mParams)) ? '/** @noinspection PhpDocSignatureInspection */' . implode(', /** @noinspection PhpDocSignatureInspection */', $mParams) : $method->getParamsWithDefault() ?>){
<?php if ($method->getDeclaringClass() !== $method->getRoot()): ?>
			//Method inherited from <?= $method->getDeclaringClass() ?>

<?php endif; ?>
			/** @noinspection PhpUnnecessaryFullyQualifiedNameInspection,PhpDynamicAsStaticMethodCallInspection<?= ($method->shouldReturn() === 1 ? ',PhpVoidFunctionResultUsedInspection' : '') . ($method->isDeprecated() ? ',PhpDeprecationInspection' : '') ?> */
			<?= $method->shouldReturn() ? 'return ' : '' ?><?= $method->getRoot() ?>::<?= $method->getName() ?>(<?= $method->getParams() ?>);
		}
<?php endforeach; ?>

	}
<?php endforeach; ?>

}
<?php endforeach; ?>
