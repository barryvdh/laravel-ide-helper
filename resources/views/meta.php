<?= '<?php' ?>

/* @noinspection ALL */
// @formatter:off
// phpcs:ignoreFile

namespace PHPSTORM_META {

   /**
    * PhpStorm Meta file, to provide autocomplete information for PhpStorm
    *
    * @author Barry vd. Heuvel <barryvdh@gmail.com>
    * @see https://github.com/barryvdh/laravel-ide-helper
    */
<?php foreach ($methods as $method) : ?>
    override(<?= $method ?>, map([
        '' => '@',
    <?php foreach ($bindings as $abstract => $class) : ?>
        '<?= $abstract ?>' => \<?= $class ?>::class,
    <?php endforeach; ?>
    ]));
<?php endforeach; ?>

<?php foreach ($userMethods as $method) : ?>
    override(<?= $method ?>, map([
        '' => \<?= $userModel ?>::class,
    ]));
<?php endforeach; ?>

<?php foreach ($configMethods as $method) : ?>
    override(<?= $method ?>, map([
    <?php foreach ($configValues as $name => $value) : ?>
        '<?= $name ?>' => '<?= $value ?>',
    <?php endforeach; ?>
    ]));
<?php endforeach; ?>

<?php if (count($factories)) : ?>
    override(\factory(0), map([
        '' => '@FactoryBuilder',
    <?php foreach ($factories as $factory) : ?>
        '<?= $factory->getName() ?>' => \<?= $factory->getName() ?>FactoryBuilder::class,
    <?php endforeach; ?>
    ]));
<?php endif; ?>

    override(\Illuminate\Foundation\Testing\Concerns\InteractsWithContainer::mock(0), map(["" => "@&\Mockery\MockInterface"]));
    override(\Illuminate\Foundation\Testing\Concerns\InteractsWithContainer::partialMock(0), map(["" => "@&\Mockery\MockInterface"]));
    override(\Illuminate\Foundation\Testing\Concerns\InteractsWithContainer::instance(0), type(1));
    override(\Illuminate\Foundation\Testing\Concerns\InteractsWithContainer::spy(0), map(["" => "@&\Mockery\MockInterface"]));
    override(\Illuminate\Support\Arr::add(0), type(0));
    override(\Illuminate\Support\Arr::except(0), type(0));
    override(\Illuminate\Support\Arr::first(0), elementType(0));
    override(\Illuminate\Support\Arr::last(0), elementType(0));
    override(\Illuminate\Support\Arr::get(0), elementType(0));
    override(\Illuminate\Support\Arr::only(0), type(0));
    override(\Illuminate\Support\Arr::prepend(0), type(0));
    override(\Illuminate\Support\Arr::pull(0), elementType(0));
    override(\Illuminate\Support\Arr::set(0), type(0));
    override(\Illuminate\Support\Arr::shuffle(0), type(0));
    override(\Illuminate\Support\Arr::sort(0), type(0));
    override(\Illuminate\Support\Arr::sortRecursive(0), type(0));
    override(\Illuminate\Support\Arr::where(0), type(0));
    override(\array_add(0), type(0));
    override(\array_except(0), type(0));
    override(\array_first(0), elementType(0));
    override(\array_last(0), elementType(0));
    override(\array_get(0), elementType(0));
    override(\array_only(0), type(0));
    override(\array_prepend(0), type(0));
    override(\array_pull(0), elementType(0));
    override(\array_set(0), type(0));
    override(\array_sort(0), type(0));
    override(\array_sort_recursive(0), type(0));
    override(\array_where(0), type(0));
    override(\head(0), elementType(0));
    override(\last(0), elementType(0));
    override(\with(0), type(0));
    override(\tap(0), type(0));
    override(\optional(0), type(0));

    <?php if (isset($expectedArgumentSets)): ?>
    <?php foreach ($expectedArgumentSets as $name => $argumentsList) : ?>
    registerArgumentsSet('<?= $name ?>', <?php foreach ($argumentsList as $i => $arg) : ?><?php if($i % 5 == 0) {
        echo "\n";
    } ?><?= var_export($arg, true); ?>,<?php endforeach; ?>);
    <?php endforeach; ?>
    <?php endif ?>

    <?php if (isset($expectedArguments)) : ?>
    <?php foreach ($expectedArguments as $arguments) : ?>
    <?php
        $classes = isset($arguments['class']) ? (array) $arguments['class'] : [null];
        $index = $arguments['index'] ?? 0;
        $argumentSet = $arguments['argumentSet'];
        $functions = [];
        foreach ($classes as $class) {
            foreach ((array) $arguments['method'] as $method) {
                $functions[] = '\\' . ($class ? ltrim($class, '\\') . '::' : '') . $method . '()';
            }
        }
        ?>
    <?php foreach ($functions as $function) : ?>
expectedArguments(<?= $function ?>, <?= $index ?>, argumentsSet('<?= $argumentSet ?>'));
    <?php endforeach; ?>
    <?php endforeach; ?>
    <?php endif; ?>

}
