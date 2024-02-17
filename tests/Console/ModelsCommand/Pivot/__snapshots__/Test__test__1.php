<?php

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models\Pivots\CustomPivot;
use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models\ModelWithPivot
 *
 * @property-read CustomPivot $customAccessor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ModelWithPivot> $relationWithCustomPivot
 * @property-read int|null $relation_with_custom_pivot_count
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithPivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithPivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelWithPivot query()
 * @mixin \Eloquent
 */
class ModelWithPivot extends Model
{
    public function relationWithCustomPivot()
    {
        return $this->belongsToMany(ModelwithPivot::class)
            ->using(CustomPivot::class)
            ->as('customAccessor');
    }
}
<?php

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models\Pivots\CustomPivot
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPivot query()
 * @mixin \Eloquent
 */
class CustomPivot extends Pivot
{

}
