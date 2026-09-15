<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\MorphToIntersection\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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
