<?= '<?php' ?>

/**
 * An helper file for Laravel 4, to provide autocomplete information to your IDE
 * Generated with https://github.com/barryvdh/laravel-ide-helper
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */

<?php foreach($namespaces as $namespace => $aliases): ?>

namespace <?= $namespace == '__root' ? '' : $namespace ?>{

    <?= $namespace == '__root' ? $helpers : '' ?>

<?php foreach($aliases as $alias): ?>

    <?= $alias->getClassType() ?> <?= $alias->getAlias() ?> <?= $alias->getExtends() ? 'extends ' . $alias->getExtends() : '' ?>{
        <?php foreach($alias->getMethods() as $method): ?>

        <?= trim($method->getDocComment()) ?>

        public static function <?= $method->getName() ?>(<?= $method->getParamsWithDefault() ?>){
            //Method inherited from <?= $method->getDeclaringClass() ?>

            <?= $method->shouldReturn() ? 'return ': '' ?><?= $method->getRoot() ?>::<?= $method->getName() ?>(<?= $method->getParams() ?>);
        }
        <?php endforeach; ?>

    }

<?php endforeach; ?>

}

<?php endforeach; ?>
