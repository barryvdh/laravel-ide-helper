<?= '<?php' ?>

/**
 * A helper file for Laravel 5, to provide autocomplete information to your IDE
 * Generated for Laravel <?= $version ?> on <?= date("Y-m-d") ?>.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 * @see https://github.com/barryvdh/laravel-ide-helper
 */

<?php foreach($namespaces as $namespace => $aliases): ?>
namespace <?= $namespace == '__root' ? '' : $namespace ?>{
<?php if($namespace == '__root'): ?>
    exit("This file should not be included, only analyzed by your IDE");
<?= $helpers ?>
<?php endif; ?>
<?php foreach($aliases as $alias): ?>

    <?= $alias->getClassType() ?> <?= $alias->getShortName() ?> <?= $alias->getExtends() ? 'extends ' . $alias->getExtends() : '' ?>{
        <?php foreach($alias->getMethods() as $method): ?>

        <?= trim($method->getDocComment('        ')) ?>

        public static function <?= $method->getName() ?>(<?= $method->getParamsWithDefault() ?>){<?php if($method->getDeclaringClass() !== $method->getRoot()): ?>

            //Method inherited from <?= $method->getDeclaringClass() ?>
            <?php endif; ?>

            <?= $method->shouldReturn() ? 'return ': '' ?><?= $method->getRoot() ?>::<?= $method->getName() ?>(<?= $method->getParams() ?>);
        }
        <?php endforeach; ?>

    }

<?php endforeach; ?>

}

<?php endforeach; ?>


<?php if($include_fluent): ?>
namespace Illuminate\Support {
    /**
     * Methods commonly used in migrations
     *
     * @method Fluent after(string $column) Add the after modifier
     * @method Fluent charset(string $charset) Add the character set modifier
     * @method Fluent collation(string $collation) Add the collation modifier
     * @method Fluent comment(string $comment) Add comment
     * @method Fluent default(mixed $value) Add the default modifier
     * @method Fluent first() Select first row
     * @method Fluent index(string $name = null) Add the in dex clause
     * @method Fluent on(string $column) `on` of a foreign key
     * @method Fluent onDelete(string $action) `on delete` of a foreign key
     * @method Fluent onUpdate(string $action) `on update` of a foreign key
     * @method Fluent primary() Add the primary key modifier
     * @method Fluent references(string $table) `references` of a foreign key
     * @method Fluent nullable() Add the nullable modifier
     * @method Fluent unique(string $name = null) Add unique index clause
     * @method Fluent unsigned() Add the unsigned modifier
     * @method Fluent useCurrent() Add the default timestamp value
     */
    class Fluent {}
}
<?php endif ?>
