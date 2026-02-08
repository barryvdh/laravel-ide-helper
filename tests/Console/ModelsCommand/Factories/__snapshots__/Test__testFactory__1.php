<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\CustomSpace\ModelWithCustomNamespaceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\CustomSpace\ModelWithCustomNamespaceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithCustomNamespace newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithCustomNamespace newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithCustomNamespace query()
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
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Factories\ModelWithFactoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithFactory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithFactory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithFactory query()
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
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Factories\ModelWithNestedFactoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithNestedFactory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithNestedFactory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithNestedFactory query()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithoutFactory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithoutFactory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithoutFactory query()
 * @mixin \Eloquent
 */
class ModelWithoutFactory extends Model
{
    use HasFactory;
}
