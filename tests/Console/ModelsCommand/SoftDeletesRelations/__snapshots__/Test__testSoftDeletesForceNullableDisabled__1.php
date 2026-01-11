<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SoftDeletesRelations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $soft_deletable_model_id
 * @property int $non_soft_deletable_model_id
 * @property-read \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SoftDeletesRelations\Models\NonSoftDeletableModel $nonSoftDeletable
 * @property-read \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SoftDeletesRelations\Models\NonSoftDeletableModel|null $nonSoftDeletableHasOne
 * @property-read \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SoftDeletesRelations\Models\SoftDeletableModel $softDeletable
 * @property-read \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SoftDeletesRelations\Models\SoftDeletableModel|null $softDeletableHasOne
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithRelations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithRelations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithRelations query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithRelations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithRelations whereNonSoftDeletableModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWithRelations whereSoftDeletableModelId($value)
 * @mixin \Eloquent
 */
class ModelWithRelations extends Model
{
    protected $table = 'models_with_relations';

    public function softDeletable(): BelongsTo
    {
        return $this->belongsTo(SoftDeletableModel::class, 'soft_deletable_model_id');
    }

    public function nonSoftDeletable(): BelongsTo
    {
        return $this->belongsTo(NonSoftDeletableModel::class, 'non_soft_deletable_model_id');
    }

    public function softDeletableHasOne(): HasOne
    {
        return $this->hasOne(SoftDeletableModel::class, 'model_with_relations_id');
    }

    public function nonSoftDeletableHasOne(): HasOne
    {
        return $this->hasOne(NonSoftDeletableModel::class, 'model_with_relations_id');
    }
}
<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SoftDeletesRelations\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int|null $model_with_relations_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NonSoftDeletableModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NonSoftDeletableModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NonSoftDeletableModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NonSoftDeletableModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NonSoftDeletableModel whereModelWithRelationsId($value)
 * @mixin \Eloquent
 */
class NonSoftDeletableModel extends Model
{
}
<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SoftDeletesRelations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $model_with_relations_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoftDeletableModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoftDeletableModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoftDeletableModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoftDeletableModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoftDeletableModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoftDeletableModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoftDeletableModel whereModelWithRelationsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoftDeletableModel withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoftDeletableModel withoutTrashed()
 * @mixin \Eloquent
 */
class SoftDeletableModel extends Model
{
    use SoftDeletes;
}
