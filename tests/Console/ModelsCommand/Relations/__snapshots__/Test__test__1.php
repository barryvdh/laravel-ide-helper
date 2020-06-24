<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\ModelsOtherNamespace\AnotherModel;
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
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Models\Simple
 *
 * @property integer $id
 * @property-read Simple $relationBelongsTo
 * @property-read AnotherModel $relationBelongsToInAnotherNamespace
 * @property-read \Illuminate\Database\Eloquent\Collection|Simple[] $relationBelongsToMany
 * @property-read int|null $relation_belongs_to_many_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Simple[] $relationBelongsToManyWithSub
 * @property-read int|null $relation_belongs_to_many_with_sub_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Simple[] $relationBelongsToManyWithSubAnother
 * @property-read int|null $relation_belongs_to_many_with_sub_another_count
 * @property-read AnotherModel $relationBelongsToSameNameAsColumn
 * @property-read \Illuminate\Database\Eloquent\Collection|Simple[] $relationHasMany
 * @property-read int|null $relation_has_many_count
 * @property-read Simple|null $relationHasOne
 * @property-read Simple $relationHasOneWithDefault
 * @property-read \Illuminate\Database\Eloquent\Collection|Simple[] $relationMorphMany
 * @property-read int|null $relation_morph_many_count
 * @property-read Simple|null $relationMorphOne
 * @property-read Model|\Eloquent $relationMorphTo
 * @property-read \Illuminate\Database\Eloquent\Collection|Simple[] $relationMorphedByMany
 * @property-read int|null $relation_morphed_by_many_count
 * @method static \Illuminate\Database\Eloquent\Builder|Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple whereId($value)
 * @mixin \Eloquent
 */
class Simple extends Model
{
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
}
