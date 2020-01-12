<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Illuminate\Filesystem\Filesystem;
use Mockery;

class Test extends AbstractModelsCommand
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('ide-helper', [
            'model_locations' => [
                // This is calculated from the base_path() which points to
                // vendor/orchestra/testbench-core/laravel
                '/../../../../tests/Console/ModelsCommand/Relations/Models',
            ],
        ]);
    }

    public function test(): void
    {
        $actualContent = null;
        $mockFilesystem = Mockery::mock(Filesystem::class);
        $mockFilesystem
            ->shouldReceive('get')
            ->andReturn(file_get_contents(__DIR__ . '/Models/Simple.php'))
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

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\ModelsOtherNamespace\AnotherModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models\Simple
 *
 * @property integer $id
 * @property-read \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models\Simple $relationBelongsTo
 * @property-read \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\ModelsOtherNamespace\AnotherModel $relationBelongsToInAnotherNamespace
 * @property-read \Illuminate\Database\Eloquent\Collection|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models\Simple[] $relationBelongsToMany
 * @property-read int|null $relation_belongs_to_many_count
 * @property-read \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\ModelsOtherNamespace\AnotherModel $relationBelongsToSameNameAsColumn
 * @property-read \Illuminate\Database\Eloquent\Collection|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models\Simple[] $relationHasMany
 * @property-read int|null $relation_has_many_count
 * @property-read \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models\Simple $relationHasOne
 * @property-read \Illuminate\Database\Eloquent\Collection|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models\Simple[] $relationMorphMany
 * @property-read int|null $relation_morph_many_count
 * @property-read \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models\Simple $relationMorphOne
 * @property-read \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models\Simple $relationMorphTo
 * @property-read \Illuminate\Database\Eloquent\Collection|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models\Simple[] $relationMorphedByMany
 * @property-read int|null $relation_morphed_by_many_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models\Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models\Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models\Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models\Simple whereId($value)
 * @mixin \Eloquent
 */
class Simple extends Model
{
    // Regular relations
    public function relationHasMany(): HasMany
    {
        return $this->hasMany(Simple::class);
    }

    public function relationHasOne(): HasOne
    {
        return $this->hasOne(Simple::class);
    }

    public function relationBelongsTo(): BelongsTo
    {
        return $this->belongsTo(Simple::class);
    }

    public function relationBelongsToMany(): BelongsToMany
    {
        return $this->belongsToMany(Simple::class);
    }

    public function relationMorphTo(): MorphTo
    {
        return $this->morphTo();
    }

    public function relationMorphOne(): MorphOne
    {
        return $this->morphOne(Simple::class, 'relationMorphTo');
    }

    public function relationMorphMany(): MorphMany
    {
        return $this->morphMany(Simple::class, 'relationMorphTo');
    }

    public function relationMorphedByMany(): MorphToMany
    {
        return $this->morphedByMany(Simple::class, 'foo');
    }

    // Custom relations

    public function relationBelongsToInAnotherNamespace(): BelongsTo
    {
        return $this->belongsTo(AnotherModel::class);
    }

    public function relationBelongsToSameNameAsColumn(): BelongsTo
    {
        return $this->belongsTo(AnotherModel::class, __FUNCTION__);
    }
}

PHP;

        $this->assertSame($expectedContent, $actualContent);
    }
}
