<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BelongsToVariation extends Model
{
    public function notNullColumnWithForeignKeyConstraint(): BelongsTo
    {
        return $this->belongsTo(self::class, 'not_null_column_with_foreign_key_constraint');
    }

    public function notNullColumnWithNoForeignKeyConstraint(): BelongsTo
    {
        return $this->belongsTo(self::class, 'not_null_column_with_no_foreign_key_constraint');
    }

    public function nullableColumnWithForeignKeyConstraint(): BelongsTo
    {
        return $this->belongsTo(self::class, 'nullable_column_with_foreign_key_constraint');
    }

    public function nullableColumnWithNoForeignKeyConstraint(): BelongsTo
    {
        return $this->belongsTo(self::class, 'nullable_column_with_no_foreign_key_constraint');
    }
}
