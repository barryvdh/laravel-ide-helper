<?php

namespace Barryvdh\LaravelIdeHelper\Tests\Console;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;
use Mockery;

class RequestCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('config:clear');
        $this->artisan('cache:clear');
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup the application environment
    }

    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            \Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
        ];
    }

    /**
     * Test the ide-helper:request command with nested directories.
     *
     * @return void
     */
    public function testIdeHelperRequestCommandWithNestedDirectories()
    {
        // Define paths
        $basePath = app_path('Http/Requests');
        $nestedPath = app_path('Http/Requests/Nested');
        $filePath = $nestedPath . '/ExampleNestedRequest.php';
        $outputPath = base_path('_ide_helper_requests.php');

        // Ensure directories exist
        if (!is_dir($nestedPath)) {
            mkdir($nestedPath, 0777, true);
        }

        // Create a dummy nested request class
        file_put_contents($filePath, '<?php namespace App\Http\Requests\Nested; use Illuminate\Foundation\Http\FormRequest; class ExampleNestedRequest extends FormRequest { public function rules() { return []; } }');

        // Ensure the class is autoloaded
        require_once $filePath;

        // Mock Filesystem
        $filesystem = Mockery::mock(Filesystem::class);
        $filesystem->shouldReceive('exists')->andReturn(true);
        $filesystem->shouldReceive('allFiles')->andReturn([
            new \SplFileInfo($filePath)
        ]);
        $filesystem->shouldReceive('put')->once()->with($outputPath, Mockery::type('string'))->andReturn(true);

        $this->app->instance(Filesystem::class, $filesystem);

        // Run the command
        Artisan::call('ide-helper:request');

        // Assert the helper file was created
        $this->assertFileExists($outputPath);

        // Read the content to ensure correct namespace handling
        $generatedContent = file_get_contents($outputPath);
        $this->assertStringContainsString('namespace App\Http\Requests\Nested {', $generatedContent);
        $this->assertStringContainsString('class ExampleNestedRequest {}', $generatedContent);

        // Clean up
        unlink($filePath);
        rmdir($nestedPath);
        rmdir($basePath);
        unlink($outputPath);
    }
}
