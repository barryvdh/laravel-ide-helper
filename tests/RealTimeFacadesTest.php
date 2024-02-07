<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

use Barryvdh\LaravelIdeHelper\Generator;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use PhpParser\Lexer\Emulative;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Parser\Php7;

class RealTimeFacadesTest extends TestCase
{
    public function testRealTimeFacades()
    {
        // Add the views path to the view finder so the generator actually generates the file
        View::addLocation(__DIR__ . '/../resources/views');

        // Clear cached real-time facades
        $cachedFacades = glob(storage_path('framework/cache/facade-*.php'));
        foreach ($cachedFacades as $cachedFacade) {
            unlink($cachedFacade);
        }

        // Copy stubs to storage path as if the real-time facades were cached by the framework
        copy(
            __DIR__ . '/stubs/facade-0e0385307adf5db34c7986ecbd11646061356ec8.php',
            storage_path('framework/cache/facade-0e0385307adf5db34c7986ecbd11646061356ec8.php')
        );
        copy(
            __DIR__ . '/stubs/facade-9431b04ec1494fc71a1bc848f020044aba2af7b1.php',
            storage_path('framework/cache/facade-9431b04ec1494fc71a1bc848f020044aba2af7b1.php')
        );

        // new instance of the generator which we test
        $generator = new Generator($this->app['config'], $this->app['view'], null, false);

        // Clear aliases and macros to have a small output file
        AliasLoader::getInstance()->setAliases([]);
        Request::flushMacros();

        // Generate the helper file and return the content
        $content = $generator->generate();

        $this->assertStringContainsString('namespace Facades\Illuminate\Foundation\Exceptions {', $content, 'Could not find Facades\Illuminate\Foundation\Exceptions namespace in the generated helper file.');
        $this->assertStringContainsString('namespace Facades\App\Exceptions {', $content, 'Could not find Facades\App\Exceptions namespace in the generated helper file.');

        $parsed = collect((new Php7(new Emulative()))->parse($content) ?: []);

        // test the Facades\Illuminate\Foundation\Exceptions namespace in the generated helper file
        $frameworkExceptionsNamespace = $parsed->first(function ($stmt) {
            return ($stmt instanceof Namespace_) && $stmt->name->toString() === 'Facades\Illuminate\Foundation\Exceptions';
        });
        $this->assertNotNull($frameworkExceptionsNamespace, 'Could not find Facades\Illuminate\Foundation\Exceptions namespace');
        $this->assertSame('Facades\Illuminate\Foundation\Exceptions', $frameworkExceptionsNamespace->name->toString());
        $this->verifyNamespace($frameworkExceptionsNamespace, 'Illuminate\Foundation\Exceptions\Handler');

        // test the Facades\App\Exceptions namespace in the generated helper file
        $appExceptionsNamespace = $parsed->first(function ($stmt) {
            return ($stmt instanceof Namespace_) && $stmt->name->toString() === 'Facades\App\Exceptions';
        });
        $this->assertNotNull($appExceptionsNamespace, 'Could not find Facades\App\Exceptions namespace');
        $this->assertSame('Facades\App\Exceptions', $appExceptionsNamespace->name->toString());
        $this->verifyNamespace($appExceptionsNamespace, 'App\Exceptions\Handler');
    }

    private function verifyNamespace(Namespace_ $namespace, $target)
    {
        $stmts = collect($namespace->stmts);

        $this->assertInstanceOf(Class_::class, $stmts[0], 'Expected instance of Class_');

        $statement = $stmts[0];
        $this->assertArrayHasKey('comments', $statement->getAttributes());

        $this->assertStringContainsString('@mixin \\' . $target, $statement->getAttributes()['comments'][0]->getText(), 'Mixin comment not found');
        $this->assertSame(class_basename($target), $statement->name->toString(), 'Class name not found');
        $this->assertSame($target, $statement->extends->toString(), 'Class extends not found');
    }

    protected function getPackageProviders($app)
    {
        return [IdeHelperServiceProvider::class];
    }
}
