<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericCustomBuilder\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericCustomBuilder\Builders\GenericBuilder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @method static GenericBuilder<static>|GenericModel isActive()
 * @method static GenericBuilder<static>|GenericModel named(string $name)
 * @method static GenericBuilder<static>|GenericModel newModelQuery()
 * @method static GenericBuilder<static>|GenericModel newQuery()
 * @method static GenericBuilder<static>|GenericModel query()
 * @method static GenericBuilder<static>|GenericModel whereId($value)
 * @mixin \Eloquent
 */
class GenericModel extends Model
{
    protected $table = 'simples';

    public function newEloquentBuilder($query): GenericBuilder
    {
        return new GenericBuilder($query);
    }

    public function scopeNamed($query, string $name)
    {
        return $query;
    }
}
<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericCustomBuilder\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericCustomBuilder\Builders\NonGenericBuilder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @method static NonGenericBuilder|NonGenericModel isActive()
 * @method static NonGenericBuilder|NonGenericModel named(string $name)
 * @method static NonGenericBuilder|NonGenericModel newModelQuery()
 * @method static NonGenericBuilder|NonGenericModel newQuery()
 * @method static NonGenericBuilder|NonGenericModel query()
 * @method static NonGenericBuilder|NonGenericModel whereId($value)
 * @mixin \Eloquent
 */
class NonGenericModel extends Model
{
    protected $table = 'simples';

    public function newEloquentBuilder($query): NonGenericBuilder
    {
        return new NonGenericBuilder($query);
    }

    public function scopeNamed($query, string $name)
    {
        return $query;
    }
}
