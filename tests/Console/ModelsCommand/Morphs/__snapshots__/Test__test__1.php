<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Morphs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $relation_morph_to_type
 * @property int $relation_morph_to_id
 * @property string|null $nullable_relation_morph_to_type
 * @property int|null $nullable_relation_morph_to_id
 * @property-read Model|\Eloquent|null $nullableRelationMorphTo
 * @property-read Model|\Eloquent $relationMorphTo
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Morphs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Morphs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Morphs query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Morphs whereNullableRelationMorphToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Morphs whereNullableRelationMorphToType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Morphs whereRelationMorphToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Morphs whereRelationMorphToType($value)
 * @mixin \Eloquent
 */
class Morphs extends Model
{
    public function relationMorphTo(): MorphTo
    {
        return $this->morphTo();
    }

    public function nullableRelationMorphTo(): MorphTo
    {
        return $this->morphTo();
    }
}
