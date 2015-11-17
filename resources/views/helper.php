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

namespace Illuminate\Support {
    /**
    * Methods commonly used in migrations
    *
    * @method Fluent nullable()
    * @method Fluent default($value)
    * @method Fluent unsigned()
    * @method Fluent unique()
    * @method Fluent charset($charset)
    * @method Fluent collation($collation)
    * @method Fluent onUpdate($action)
    * @method Fluent onDelete($action)
    * @method Fluent references($table)
    * @method Fluent on($column)
    * @method Fluent after($column)
    * @method Fluent first()
    * @method Fluent comment($comment)
    */
    class Fluent {
        //
    }
}
