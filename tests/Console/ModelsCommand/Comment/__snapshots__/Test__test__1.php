<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Comment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Comment\Models\Simple
 *
 * @property integer $id
 * @property string $both_same_name I'm a getter
 * @property string $both_without_getter_comment
 * @property-read string $faker_comment
 * @property-read string $format_comment There is format comment, success.
 * @property-read string $format_comment_line_two There is format comment, success.
 * This is second line, success too.
 * @property-read string $many_format_comment There is format comment, success.
 * @property-read string $not_comment
 * @property-read \Illuminate\Database\Eloquent\Collection|Simple[] $relationHasMany HasMany relations.
 * @property-read int|null $relation_has_many_count
 * @property-read Simple|null $relationHasOne Others relations.
 * @property-read Model|\Eloquent $relationMorphTo MorphTo relations.
 * @property-write mixed $first_name Set the user's first name.
 * @method static \Illuminate\Database\Eloquent\Builder|Simple active() Scope a query to only include active users.
 * @method static \Illuminate\Database\Eloquent\Builder|Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple whereId($value)
 * @mixin \Eloquent
 */
class Simple extends Model
{
    /**
     * There is not comment.
     *
     * @return string
     */
    public function getNotCommentAttribute(): string
    {
    }

    /**
     * comment There is not format comment, invalid.
     *
     * @return string
     */
    public function getFakerCommentAttribute(): string
    {
    }

    /**
     * @comment There is format comment, success.
     *
     * @return string
     */
    public function getFormatCommentAttribute(): string
    {
    }

    /**
     * @comment There is format comment, success.
     * This is second line, success too.
     *
     * @return string
     */
    public function getFormatCommentLineTwoAttribute(): string
    {
    }

    /**
     * @comment There is format comment, success.
     * @comment This is others format comment, invalid.
     *
     * @return string
     */
    public function getManyFormatCommentAttribute(): string
    {
    }

    /**
     * @comment Set the user's first name.
     * @param $value
     */
    public function setFirstNameAttribute($value)
    {
    }

    /**
     * @comment Scope a query to only include active users.
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query;
    }

    /**
     * @comment HasMany relations.
     *
     * @return HasMany
     */
    public function relationHasMany(): HasMany
    {
        return $this->hasMany(Simple::class);
    }

    /**
     * @comment MorphTo relations.
     * @return MorphTo
     */
    public function relationMorphTo(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @comment Others relations.
     * @return HasOne
     */
    public function relationHasOne(): HasOne
    {
        return $this->hasOne(Simple::class);
    }

    /**
     * @comment I'm a setter
     */
    public function setBothSameNameAttribute(): void
    {
    }

    /**
     * @comment I'm a getter
     * @return string
     */
    public function getBothSameNameAttribute(): string
    {
    }

    /**
     * @comment I'm a setter
     */
    public function setBothWithoutGetterCommentAttribute(): void
    {
    }

    /**
     * @return string
     */
    public function getBothWithoutGetterCommentAttribute(): string
    {
    }
}
