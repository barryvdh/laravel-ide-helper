<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomPhpdocTags;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;

class Test extends AbstractModelsCommand
{
    /**
     * This test shows that, when adding custom phpdoc tags with a parameter
     * but without a space, they're changed when writing break, possibly breaking
     * tools.
     *
     * It is changed from
     * - `@SuppressWarnings(PHPMD.ExcessiveClassComplexity)`
     *   to
     * - `@SuppressWarnings (PHPMD.ExcessiveClassComplexity)`
     *
     * If this test fails because the issue has been fixed, please keep the
     * test but adjust it and it's comments, to prevent this from every breaking
     * again.
     *
     * @link https://github.com/barryvdh/laravel-ide-helper/issues/666
     */
    public function testNoSpaceAfterCustomPhpdocTag(): void
    {
        $command = $this->app->make(ModelsCommand::class);

        $tester = $this->runCommand($command, [
            '--write' => true,
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('Written new phpDocBlock to', $tester->getDisplay());
        $this->assertMatchesMockedSnapshot();
    }
}
