<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SoftDeletesRelations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
