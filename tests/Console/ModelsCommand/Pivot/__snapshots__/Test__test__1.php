<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models\Pivots\CustomPivot;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models\Pivots\DifferentCustomPivot;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read DifferentCustomPivot|CustomPivot|null $pivot
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ModelWithPivot> $relationCustomPivotUsingSameAccessor
 * @property-read int|null $relation_custom_pivot_using_same_accessor_count
 * @property-read bool|null $relation_custom_pivot_using_same_accessor_exists
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ModelWithPivot> $relationCustomPivotUsingSameAccessorAndClass
 * @property-read int|null $relation_custom_pivot_using_same_accessor_and_class_count
 * @property-read bool|null $relation_custom_pivot_using_same_accessor_and_class_exists
 * @property-read CustomPivot|null $customAccessor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ModelWithPivot> $relationWithCustomPivot
 * @property-read int|null $relation_with_custom_pivot_count
 * @property-read bool|null $relation_with_custom_pivot_exists
 * @property-read DifferentCustomPivot|null $differentCustomAccessor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ModelWithPivot> $relationWithDifferentCustomPivot
 * @property-read int|null $relation_with_different_custom_pivot_count
 * @property-read bool|null $relation_with_different_custom_pivot_exists
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ModelWithPivot> $relationWithDifferentCustomPivotUsingSameAccessor
 * @property-read int|null $relation_with_different_custom_pivot_using_same_accessor_count
 * @property-read bool|null $relation_with_different_custom_pivot_using_same_accessor_exists
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithPivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithPivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithPivot query()
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


    public function relationWithDifferentCustomPivot()
    {
        return $this->belongsToMany(ModelwithPivot::class)
            ->using(DifferentCustomPivot::class)
            ->as('differentCustomAccessor');
    }

    // without an accessor

    public function relationCustomPivotUsingSameAccessor()
    {
        return $this->belongsToMany(ModelwithPivot::class)
            ->using(CustomPivot::class);
    }

    public function relationCustomPivotUsingSameAccessorAndClass()
    {
        return $this->belongsToMany(ModelwithPivot::class)
            ->using(CustomPivot::class);
    }

    public function relationWithDifferentCustomPivotUsingSameAccessor()
    {
        return $this->belongsToMany(ModelwithPivot::class)
            ->using(DifferentCustomPivot::class);
    }
}
<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPivot query()
 * @mixin \Eloquent
 */
class CustomPivot extends Pivot
{
}
<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DifferentCustomPivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DifferentCustomPivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DifferentCustomPivot query()
 * @mixin \Eloquent
 */
class DifferentCustomPivot extends Pivot
{
}
