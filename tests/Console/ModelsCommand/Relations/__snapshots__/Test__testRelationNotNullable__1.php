<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $not_null_column_with_foreign_key_constraint
 * @property int $not_null_column_with_no_foreign_key_constraint
 * @property int|null $nullable_column_with_foreign_key_constraint
 * @property int|null $nullable_column_with_no_foreign_key_constraint
 * @property-read BelongsToVariation $notNullColumnWithForeignKeyConstraint
 * @property-read BelongsToVariation $notNullColumnWithNoForeignKeyConstraint
 * @property-read BelongsToVariation|null $nullableColumnWithForeignKeyConstraint
 * @property-read BelongsToVariation|null $nullableColumnWithNoForeignKeyConstraint
 * @method static \Illuminate\Database\Eloquent\Builder|BelongsToVariation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BelongsToVariation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BelongsToVariation query()
 * @method static \Illuminate\Database\Eloquent\Builder|BelongsToVariation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BelongsToVariation whereNotNullColumnWithForeignKeyConstraint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BelongsToVariation whereNotNullColumnWithNoForeignKeyConstraint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BelongsToVariation whereNullableColumnWithForeignKeyConstraint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BelongsToVariation whereNullableColumnWithNoForeignKeyConstraint($value)
 * @mixin \Eloquent
 */
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
<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $not_null_column_with_foreign_key_constraint
 * @property int $not_null_column_with_no_foreign_key_constraint
 * @property int|null $nullable_column_with_foreign_key_constraint
 * @property int|null $nullable_column_with_no_foreign_key_constraint
 * @property-read CompositeBelongsToVariation $bothNonNullableWithForeignKeyConstraint
 * @property-read CompositeBelongsToVariation $nonNullableMixedWithoutForeignKeyConstraint
 * @property-read CompositeBelongsToVariation|null $nullableMixedWithForeignKeyConstraint
 * @method static \Illuminate\Database\Eloquent\Builder|CompositeBelongsToVariation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompositeBelongsToVariation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompositeBelongsToVariation query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompositeBelongsToVariation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompositeBelongsToVariation whereNotNullColumnWithForeignKeyConstraint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompositeBelongsToVariation whereNotNullColumnWithNoForeignKeyConstraint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompositeBelongsToVariation whereNullableColumnWithForeignKeyConstraint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompositeBelongsToVariation whereNullableColumnWithNoForeignKeyConstraint($value)
 * @mixin \Eloquent
 */
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
<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\ModelsOtherNamespace\AnotherModel;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Traits\HasTestRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * 
 *
 * @property int $id
 * @property-read Simple $relationBelongsTo
 * @property-read AnotherModel $relationBelongsToInAnotherNamespace
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Simple> $relationBelongsToMany
 * @property-read int|null $relation_belongs_to_many_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Simple> $relationBelongsToManyWithSub
 * @property-read int|null $relation_belongs_to_many_with_sub_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Simple> $relationBelongsToManyWithSubAnother
 * @property-read int|null $relation_belongs_to_many_with_sub_another_count
 * @property-read AnotherModel $relationBelongsToSameNameAsColumn
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Simple> $relationHasMany
 * @property-read int|null $relation_has_many_count
 * @property-read Simple|null $relationHasOne
 * @property-read Simple $relationHasOneWithDefault
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Simple> $relationMorphMany
 * @property-read int|null $relation_morph_many_count
 * @property-read Simple|null $relationMorphOne
 * @property-read Model|\Eloquent $relationMorphTo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Simple> $relationMorphedByMany
 * @property-read int|null $relation_morphed_by_many_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Simple> $relationSampleRelationType
 * @property-read int|null $relation_sample_relation_type_count
 * @property-read Model|\Eloquent $relationSampleToAnyMorphedRelationType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Simple> $relationSampleToAnyRelationType
 * @property-read int|null $relation_sample_to_any_relation_type_count
 * @property-read Simple $relationSampleToBadlyNamedNotManyRelation
 * @property-read Simple $relationSampleToManyRelationType
 * @method static \Illuminate\Database\Eloquent\Builder|Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple whereId($value)
 * @mixin \Eloquent
 */
class Simple extends Model
{
    use HasTestRelations;

    // Regular relations
    public function relationHasMany(): HasMany
    {
        return $this->hasMany(Simple::class);
    }

    public function relationHasOne(): HasOne
    {
        return $this->hasOne(Simple::class);
    }

    public function relationHasOneWithDefault(): HasOne
    {
        return $this->hasOne(Simple::class)->withDefault();
    }

    public function relationBelongsTo(): BelongsTo
    {
        return $this->belongsTo(Simple::class);
    }

    public function relationBelongsToMany(): BelongsToMany
    {
        return $this->belongsToMany(Simple::class);
    }

    public function relationBelongsToManyWithSub(): BelongsToMany
    {
        return $this->belongsToMany(Simple::class)->where('foo', 'bar');
    }

    public function relationBelongsToManyWithSubAnother(): BelongsToMany
    {
        return $this->relationBelongsToManyWithSub()->where('foo', 'bar');
    }

    public function relationMorphTo(): MorphTo
    {
        return $this->morphTo();
    }

    public function relationMorphOne(): MorphOne
    {
        return $this->morphOne(Simple::class, 'relationMorphTo');
    }

    public function relationMorphMany(): MorphMany
    {
        return $this->morphMany(Simple::class, 'relationMorphTo');
    }

    public function relationMorphedByMany(): MorphToMany
    {
        return $this->morphedByMany(Simple::class, 'foo');
    }

    // Custom relations

    public function relationBelongsToInAnotherNamespace(): BelongsTo
    {
        return $this->belongsTo(AnotherModel::class);
    }

    public function relationBelongsToSameNameAsColumn(): BelongsTo
    {
        return $this->belongsTo(AnotherModel::class, __FUNCTION__);
    }

    public function relationSampleToManyRelationType()
    {
        return $this->testToOneRelation(Simple::class);
    }

    public function relationSampleRelationType()
    {
        return $this->testToManyRelation(Simple::class);
    }

    public function relationSampleToAnyRelationType()
    {
        return $this->testToAnyRelation(Simple::class);
    }

    public function relationSampleToAnyMorphedRelationType()
    {
        return $this->testToAnyMorphedRelation(Simple::class);
    }

    public function relationSampleToBadlyNamedNotManyRelation()
    {
        return $this->testToBadlyNamedNotManyRelation(Simple::class);
    }
}
