<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompositeBelongsToVariation extends Model
{
    public $table = 'belongs_to_variations';

    public function bothNonNullableWithForeignKeyConstraint(): BelongsTo
    {
        // Note, duplicating the keys here for simplicity.
        return $this->belongsTo(
            self::class,
            ['not_null_column_with_foreign_key_constraint', 'not_null_column_with_foreign_key_constraint'],
            ['not_null_column_with_foreign_key_constraint', 'not_null_column_with_foreign_key_constraint'],
        );
    }

    public function nonNullableMixedWithoutForeignKeyConstraint(): BelongsTo
    {
        return $this->belongsTo(
            self::class,
            ['not_null_column_with_foreign_key_constraint', 'not_null_column_with_no_foreign_key_constraint'],
            ['not_null_column_with_foreign_key_constraint', 'not_null_column_with_no_foreign_key_constraint'],
        );
    }

    public function nullableMixedWithForeignKeyConstraint(): BelongsTo
    {
        return $this->belongsTo(
            self::class,
            ['nullable_column_with_no_foreign_key_constraint', 'not_null_column_with_foreign_key_constraint'],
            ['nullable_column_with_no_foreign_key_constraint', 'not_null_column_with_foreign_key_constraint'],
        );
    }
}
