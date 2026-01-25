<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DnfTypes\Models;

use ArrayAccess;
use Countable;
use Illuminate\Database\Eloquent\Model;
use Iterator;
use Stringable;
use Traversable;

/**
 * Test model covering all DNF type scenarios from PHP RFC.
 *
 * @see https://wiki.php.net/rfc/dnf_types
 * @property-read (\Countable&\Iterator)|null $basic_dnf
 * @property-read (\Countable&\Iterator)|\stdClass $intersection_or_class
 * @property-read (\Countable&\Iterator)|(\ArrayAccess&\Stringable)|null $multiple_intersections
 * @property-read (\Countable&\Iterator)|(\ArrayAccess&\Stringable)|(\Traversable&\Countable) $multiple_intersections_no_null
 * @property-read (\Countable&\Iterator) $pure_intersection
 * @property-read \stdClass|(\Countable&\Iterator)|null $single_or_intersection_or_null
 * @property-read (\Countable&\Iterator&\Traversable)|int|null $triple_intersection
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DnfTypeModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DnfTypeModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DnfTypeModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DnfTypeModel withBasicDnfParam((\Countable&\Iterator)|null $param)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DnfTypeModel withComplexDnfParam(\stdClass|(\Countable&\Iterator)|null $param)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DnfTypeModel withDnfParamAndReturn((\Countable&\Iterator)|null $param)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DnfTypeModel withIntersectionOrPrimitive((\Countable&\Iterator)|int $param)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DnfTypeModel withMultipleIntersectionParam((\Countable&\Iterator)|(\ArrayAccess&\Stringable) $param)
 * @mixin \Eloquent
 */
class DnfTypeModel extends Model
{
    // =========================================================================
    // RFC Example 1: (A&B)|null - Intersection with null
    // =========================================================================

    /**
     * Basic DNF: intersection OR null.
     */
    public function getBasicDnfAttribute(): (Countable&Iterator)|null
    {
        return null;
    }

    // =========================================================================
    // RFC Example 2: (A&B)|D - Intersection OR single type (no null)
    // =========================================================================

    /**
     * Intersection OR single class type.
     */
    public function getIntersectionOrClassAttribute(): (Countable&Iterator)|\stdClass
    {
        return new \stdClass();
    }

    // =========================================================================
    // RFC Example 3: C|(X&D)|null - Single type OR intersection OR null
    // =========================================================================

    /**
     * Single type OR intersection OR null.
     */
    public function getSingleOrIntersectionOrNullAttribute(): \stdClass|(Countable&Iterator)|null
    {
        return null;
    }

    // =========================================================================
    // RFC Example 4: (A&B&D)|int|null - Triple intersection OR primitive OR null
    // =========================================================================

    /**
     * Triple intersection OR primitive OR null.
     */
    public function getTripleIntersectionAttribute(): (Countable&Iterator&Traversable)|int|null
    {
        return null;
    }

    // =========================================================================
    // RFC Example 5: (A&B)|(C&D)|null - Multiple intersection segments
    // =========================================================================

    /**
     * Multiple intersection segments OR null.
     */
    public function getMultipleIntersectionsAttribute(): (Countable&Iterator)|(ArrayAccess&Stringable)|null
    {
        return null;
    }

    // =========================================================================
    // RFC Example 6: (A&B)|(C&D)|(E&F) - Multiple intersections without null
    // =========================================================================

    /**
     * Multiple intersection segments without null.
     */
    public function getMultipleIntersectionsNoNullAttribute(): (Countable&Iterator)|(ArrayAccess&Stringable)|(Traversable&Countable)
    {
        return new class implements Countable, Iterator {
            public function count(): int
            {
                return 0;
            }

            public function current(): mixed
            {
                return null;
            }

            public function key(): mixed
            {
                return null;
            }

            public function next(): void
            {
            }

            public function rewind(): void
            {
            }

            public function valid(): bool
            {
                return false;
            }
        };
    }

    // =========================================================================
    // Pure intersection type (A&B) - No union, just intersection
    // =========================================================================

    /**
     * Pure intersection type without union.
     */
    public function getPureIntersectionAttribute(): Countable&Iterator
    {
        return new class implements Countable, Iterator {
            public function count(): int
            {
                return 0;
            }

            public function current(): mixed
            {
                return null;
            }

            public function key(): mixed
            {
                return null;
            }

            public function next(): void
            {
            }

            public function rewind(): void
            {
            }

            public function valid(): bool
            {
                return false;
            }
        };
    }

    // =========================================================================
    // Parameter context: DNF types in method parameters
    // =========================================================================

    /**
     * Scope with DNF parameter: (A&B)|null.
     */
    public function scopeWithBasicDnfParam(
        \Illuminate\Database\Query\Builder $query,
        (Countable&Iterator)|null $param
    ): \Illuminate\Database\Query\Builder {
        return $query;
    }

    /**
     * Scope with complex DNF parameter: C|(A&B)|null.
     */
    public function scopeWithComplexDnfParam(
        \Illuminate\Database\Query\Builder $query,
        \stdClass|(Countable&Iterator)|null $param
    ): \Illuminate\Database\Query\Builder {
        return $query;
    }

    /**
     * Scope with multiple intersection parameters.
     */
    public function scopeWithMultipleIntersectionParam(
        \Illuminate\Database\Query\Builder $query,
        (Countable&Iterator)|(ArrayAccess&Stringable) $param
    ): \Illuminate\Database\Query\Builder {
        return $query;
    }

    /**
     * Scope with intersection OR primitive parameter.
     */
    public function scopeWithIntersectionOrPrimitive(
        \Illuminate\Database\Query\Builder $query,
        (Countable&Iterator)|int $param
    ): \Illuminate\Database\Query\Builder {
        return $query;
    }

    // =========================================================================
    // Mixed: DNF in both parameter and return type
    // =========================================================================

    /**
     * DNF in both parameter and return type.
     */
    public function scopeWithDnfParamAndReturn(
        \Illuminate\Database\Query\Builder $query,
        (Countable&Iterator)|null $param
    ): (Countable&Iterator)|\Illuminate\Database\Query\Builder {
        return $query;
    }
}
