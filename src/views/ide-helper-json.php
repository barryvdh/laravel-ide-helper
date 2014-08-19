{
/**
 * An helper file for Laravel 4, to provide autocomplete information to your IDE
 * Generated with https://github.com/barryvdh/laravel-ide-helper
 * This produces json format
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 * @author Michael Hoppes <hoppes@gmail.com>
 */
    "php": {
        "classes": {
        <?php foreach($aliases as $alias): ?>
            "<?= $alias->getAlias() ?>": {
            <?php foreach($alias->getMethods() as $method): ?>
                "<?= $method->getName() ?>": "(<?= $method->getParamsWithDefault() ?>)",
            <?php endforeach; ?>
            }
        <?php endforeach; ?>
        }
    }
}
