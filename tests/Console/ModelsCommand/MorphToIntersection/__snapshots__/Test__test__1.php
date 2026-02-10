<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\MorphToIntersection\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $relation_morph_to_type
 * @property int $relation_morph_to_id
 * @property string|null $nullable_relation_morph_to_type
 * @property int|null $nullable_relation_morph_to_id
 * @property-read (BaseModel&CanBeAssigned)|null $assigneeWithParens
 * @property-read (BaseModel&CanBeAssigned)|null $assigneeWithoutParens
 * @property-read (BaseModel&CanBeAssigned) $nonNullableAssignee
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MorphToIntersection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MorphToIntersection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MorphToIntersection query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MorphToIntersection whereNullableRelationMorphToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MorphToIntersection whereNullableRelationMorphToType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MorphToIntersection whereRelationMorphToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MorphToIntersection whereRelationMorphToType($value)
 * @mixin \Eloquent
 */
class MorphToIntersection extends Model
{
    protected $table = 'morphs';

    /** @return MorphTo<(BaseModel&CanBeAssigned), $this> */
    public function assigneeWithParens(): MorphTo
    {
        return $this->morphTo(type: 'nullable_relation_morph_to_type', id: 'nullable_relation_morph_to_id');
    }

    /** @return MorphTo<BaseModel&CanBeAssigned, $this> */
    public function assigneeWithoutParens(): MorphTo
    {
        return $this->morphTo(type: 'nullable_relation_morph_to_type', id: 'nullable_relation_morph_to_id');
    }

    /** @return MorphTo<(BaseModel&CanBeAssigned), $this> */
    public function nonNullableAssignee(): MorphTo
    {
        return $this->morphTo(type: 'relation_morph_to_type', id: 'relation_morph_to_id');
    }
}
