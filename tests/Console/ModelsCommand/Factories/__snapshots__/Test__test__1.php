<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\CustomSpace\ModelWithCustomNamespaceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Models\ModelWithCustomNamespace
 *
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\CustomSpace\ModelWithCustomNamespaceFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithCustomNamespace newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithCustomNamespace newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithCustomNamespace on($connection = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithCustomNamespace onWriteConnection()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithCustomNamespace query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithCustomNamespace with($relations)
 * @mixin \Eloquent
 */
class ModelWithCustomNamespace extends Model
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ModelWithCustomNamespaceFactory::new();
    }
}
<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Models\ModelWithFactory
 *
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Factories\ModelWithFactoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithFactory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithFactory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithFactory on($connection = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithFactory onWriteConnection()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithFactory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithFactory with($relations)
 * @mixin \Eloquent
 */
class ModelWithFactory extends Model
{
    use HasFactory;
}
<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Models;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Models\ModelWithNestedFactory
 *
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Factories\ModelWithNestedFactoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithNestedFactory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithNestedFactory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithNestedFactory on($connection = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithNestedFactory onWriteConnection()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithNestedFactory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithNestedFactory with($relations)
 * @mixin \Eloquent
 */
class ModelWithNestedFactory extends ModelWithFactory
{
}
<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Models\ModelWithoutFactory
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithoutFactory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithoutFactory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithoutFactory on($connection = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithoutFactory onWriteConnection()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithoutFactory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithoutFactory with($relations)
 * @mixin \Eloquent
 */
class ModelWithoutFactory extends Model
{
    use HasFactory;
}
