<?= '<?php' ?>

/**
 * A helper file for Laravel 5, to provide autocomplete information to your IDE
 * Generated for Laravel <?= $version ?> on <?= date("Y-m-d") ?>.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 * @see https://github.com/barryvdh/laravel-ide-helper
 */
namespace  {
    exit("This file should not be included, only analyzed by your IDE");
}

<?php foreach($facade_aliases_by_extends_ns as $extends_ns => $facade_aliases): ?>
<?php if($extends_ns == '\Illuminate\Database\Eloquent'): continue; endif; ?>
namespace <?= ltrim($extends_ns, '\\') ?> {
<?php foreach($facade_aliases as $alias): ?>

    <?= $alias->getClassType() ?> <?= $alias->getExtendsClass() ?> {
        <?php foreach($alias->getMethods() as $method): ?>

        <?= trim($method->getDocComment('        ')) ?> 
        public static function <?= $method->getName() ?>(<?= $method->getParamsWithDefault() ?>)
        {<?php if($method->getDeclaringClass() !== $method->getRootClass()): ?>

            //Method inherited from <?= $method->getDeclaringClass() ?>
            <?php endif; ?>

            <?= $method->shouldReturn() ? 'return ': '' ?><?= $method->getRootClass() ?>::<?= $method->getRootMethod() ?>(<?= $method->getParams() ?>);
        }
        <?php endforeach; ?> 
    }
<?php endforeach; ?> 
}

<?php endforeach; ?>

<?php foreach($all_aliases_by_alias_ns as $alias_ns => $all_aliases): ?>
namespace <?= ltrim($alias_ns, '\\') ?> {
<?php foreach($all_aliases as $alias): ?>

    <?= $alias->getClassType() ?> <?= $alias->getShortName() ?> extends <?= $alias->getExtends() ?> {<?php if ($alias->getExtendsNamespace() == '\Illuminate\Database\Eloquent'): ?>
        <?php foreach($alias->getMethods() as $method): ?> 
            <?= trim($method->getDocComment('            ')) ?> 
            public static function <?= $method->getName() ?>(<?= $method->getParamsWithDefault() ?>)
            {<?php if($method->getDeclaringClass() !== $method->getRootClass()): ?>
    
                //Method inherited from <?= $method->getDeclaringClass() ?>
                <?php endif; ?>
    
                <?= $method->shouldReturn() ? 'return ': '' ?><?= $method->getRootClass() ?>::<?= $method->getRootMethod() ?>(<?= $method->getParams() ?>);
            }
        <?php endforeach; ?>
<?php endif; ?>}
<?php endforeach; ?> 
}

<?php endforeach; ?>

<?php if($helpers): ?>
namespace {
<?= $helpers ?> 
}
<?php endif; ?>

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
     * @method Fluent on(string $table) `on` of a foreign key
     * @method Fluent onDelete(string $action) `on delete` of a foreign key
     * @method Fluent onUpdate(string $action) `on update` of a foreign key
     * @method Fluent primary() Add the primary key modifier
     * @method Fluent references(string $column) `references` of a foreign key
     * @method Fluent nullable() Add the nullable modifier
     * @method Fluent unique(string $name = null) Add unique index clause
     * @method Fluent unsigned() Add the unsigned modifier
     * @method Fluent useCurrent() Add the default timestamp value
     */
    class Fluent {}
}
<?php endif ?>
