<?= '<?php' ?>
<?php
/**
 * @var Barryvdh\LaravelIdeHelper\Alias[][] $namespaces_by_alias_ns
 * @var Barryvdh\LaravelIdeHelper\Alias[][] $namespaces_by_extends_ns
 * @var bool $include_fluent
 * @var string $helpers
 */
?>

/* @noinspection ALL */
// @formatter:off
// phpcs:ignoreFile

/**
 * A helper file for Laravel, to provide autocomplete information to your IDE
 * Generated for Laravel <?= $version ?>.
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 * @see https://github.com/barryvdh/laravel-ide-helper
 */

<?php foreach ($namespaces_by_extends_ns as $namespace => $aliases) : ?>
namespace <?= $namespace == '__root' ? '' : trim($namespace, '\\') ?> {
    <?php foreach ($aliases as $alias) : ?>
        <?= trim($alias->getDocComment('    ')) ?>
        <?= $alias->getClassType() ?> <?= $alias->getExtendsClass() ?> {
        <?php foreach ($alias->getMethods() as $method) : ?>
            <?= trim($method->getDocComment('        ')) ?>
        public static function <?= $method->getName() ?>(<?= $method->getParamsWithDefault() ?>)
        {<?php if ($method->getDeclaringClass() !== $method->getRoot()) : ?>
            //Method inherited from <?= $method->getDeclaringClass() ?>
         <?php endif; ?>

            <?php if ($method->isInstanceCall()) : ?>
            /** @var <?=$method->getRoot()?> $instance */
            <?php endif?>
            <?= $method->shouldReturn() ? 'return ' : '' ?><?= $method->getRootMethodCall() ?>;
        }
        <?php endforeach; ?>
    }
    <?php endforeach; ?>
}

<?php endforeach; ?>

<?php foreach ($namespaces_by_alias_ns as $namespace => $aliases) : ?>
namespace <?= $namespace == '__root' ? '' : trim($namespace, '\\') ?> {
    <?php foreach ($aliases as $alias) : ?>
        <?= $alias->getClassType() ?> <?= $alias->getShortName() ?> extends <?= $alias->getExtends() ?> {<?php if ($alias->getExtendsNamespace() == '\Illuminate\Database\Eloquent') : ?>
            <?php foreach ($alias->getMethods() as $method) : ?>
                <?= trim($method->getDocComment('            ')) ?>
            public static function <?= $method->getName() ?>(<?= $method->getParamsWithDefault() ?>)
            {<?php if ($method->getDeclaringClass() !== $method->getRoot()) : ?>
                //Method inherited from <?= $method->getDeclaringClass() ?>
             <?php endif; ?>

                <?php if ($method->isInstanceCall()) : ?>
                /** @var <?=$method->getRoot()?> $instance */
                <?php endif?>
                <?= $method->shouldReturn() ? 'return ' : '' ?><?= $method->getRootMethodCall() ?>;
            }
            <?php endforeach; ?>
        <?php endif; ?>}
    <?php endforeach; ?>
}

<?php endforeach; ?>

<?php foreach($real_time_facades as $name): ?>
<?php $nested = explode('\\', str_replace('\\' . class_basename($name), '', $name)); ?>
namespace <?php echo implode('\\', $nested); ?> {
    /**
     * @mixin <?= str_replace('Facades', '', $name) ?>
     */
    class <?= class_basename($name) ?> extends <?= str_replace('Facades', '', $name) ?> {}
}
<?php endforeach; ?>

<?php if ($helpers) : ?>
namespace {
    <?= $helpers ?>
}
<?php endif; ?>

<?php if ($include_fluent) : ?>
namespace Illuminate\Support {
    /**
     * Methods commonly used in migrations
     *
     * @method Fluent after(string $column) Add the after modifier
     * @method Fluent charset(string $charset) Add the character set modifier
     * @method Fluent collation(string $collation) Add the collation modifier
     * @method Fluent comment(string $comment) Add comment
     * @method Fluent default($value) Add the default modifier
     * @method Fluent first() Select first row
     * @method Fluent index(string $name = null) Add the in dex clause
     * @method Fluent on(string $table) `on` of a foreign key
     * @method Fluent onDelete(string $action) `on delete` of a foreign key
     * @method Fluent onUpdate(string $action) `on update` of a foreign key
     * @method Fluent primary() Add the primary key modifier
     * @method Fluent references(string $column) `references` of a foreign key
     * @method Fluent nullable(bool $value = true) Add the nullable modifier
     * @method Fluent unique(string $name = null) Add unique index clause
     * @method Fluent unsigned() Add the unsigned modifier
     * @method Fluent useCurrent() Add the default timestamp value
     * @method Fluent change() Add the change modifier
     */
    class Fluent {}
}
<?php endif ?>

<?php foreach ($factories as $factory) : ?>
namespace <?=$factory->getNamespaceName()?> {
    /**
    * @method \Illuminate\Database\Eloquent\Collection|<?=$factory->getShortName()?>[]|<?=$factory->getShortName()?> create($attributes = [])
    * @method \Illuminate\Database\Eloquent\Collection|<?=$factory->getShortName()?>[]|<?=$factory->getShortName()?> make($attributes = [])
    */
    class <?=$factory->getShortName()?>FactoryBuilder extends \Illuminate\Database\Eloquent\FactoryBuilder {}
}
<?php endforeach; ?>
