<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomDate;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Carbon\CarbonImmutable;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Mockery;

class Test extends AbstractModelsCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        Date::use(CarbonImmutable::class);
    }

    protected function tearDown(): void
    {
        Date::use(Carbon::class);

        parent::tearDown();
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('ide-helper', [
            'model_locations' => [
                // This is calculated from the base_path() which points to
                // vendor/orchestra/testbench-core/laravel
                '/../../../../tests/Console/ModelsCommand/CustomDate/Models',
            ],
        ]);
    }

    public function test(): void
    {
        $actualContent = null;
        $mockFilesystem = Mockery::mock(Filesystem::class);
        $mockFilesystem
            ->shouldReceive('get')
            ->andReturn(file_get_contents(__DIR__ . '/Models/CustomDate.php'))
            ->once();
        $mockFilesystem
            ->shouldReceive('put')
            ->with(
                Mockery::any(),
                Mockery::capture($actualContent)
            )
            ->andReturn(1) // Simulate we wrote _something_ to the file
            ->once();

        $this->instance(Filesystem::class, $mockFilesystem);

        $command = $this->app->make(ModelsCommand::class);

        $tester = $this->runCommand($command, [
            '--write' => true,
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertEmpty($tester->getDisplay());

        $expectedContent = <<<'PHP'
<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomDate\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomDate\Models\CustomDate
 *
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomDate\Models\CustomDate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomDate\Models\CustomDate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomDate\Models\CustomDate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomDate\Models\CustomDate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomDate\Models\CustomDate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CustomDate extends Model
{
}

PHP;

        $this->assertSame($expectedContent, $actualContent);
    }
}
