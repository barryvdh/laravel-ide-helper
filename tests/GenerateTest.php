<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\Traits\Macroable;

/**
 * @internal
 * @coversDefaultClass \Barryvdh\LaravelIdeHelper\Alias
 */
class GenerateTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        TestParentClass::macro('foo', function () {
            return 'bar';
        });
        $this->app->register(IdeHelperServiceProvider::class, true);
    }

    /**
     * Remove the classes of do not has self-owned methods
     * @return void
     */
    public function testRemoveMacrosAbleSubClasses(): void
    {
        $this->assertStringNotContainsString('TestChildClass', $this->generateAndGetIdeHelperFileContent());
        unlink(__DIR__ . '/../_ide_helper.php');
    }

    /**
     * Check the _ide_helper if contains TestParentClass
     * @return void
     */
    public function testGeneratedFileContainParentClass()
    {
        $this->assertStringContainsString('TestParentClass', $this->generateAndGetIdeHelperFileContent());
        unlink(__DIR__ . '/../_ide_helper.php');
    }

    /**
     * @return false|string
     */
    private function generateAndGetIdeHelperFileContent()
    {
        $this->artisan('ide-helper:generate');
        return file_get_contents(__DIR__ . '/../_ide_helper.php');
    }
}


class TestParentClass
{
    use Macroable;
}

class TestChildClass extends TestParentClass
{
}
