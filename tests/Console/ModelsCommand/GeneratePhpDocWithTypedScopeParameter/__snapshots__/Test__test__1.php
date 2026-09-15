<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpDocWithTypedScopeParameter\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Builder<static>|Comment newModelQuery()
 * @method static Builder<static>|Comment newQuery()
 * @method static Builder<static>|Comment query()
 * @method static Builder<static>|Comment typed01(bool $value) Scope with required boolean parameter
 * @method static Builder<static>|Comment typed02(bool $value = true) Scope with optional boolean parameter and default true
 * @method static Builder<static>|Comment typed03(bool $value = false) Scope with optional boolean parameter and default false
 * @method static Builder<static>|Comment typed04(string $value) Scope with required string parameter
 * @method static Builder<static>|Comment typed05(string $value = 'dummy123') Scope with optional string parameter and default value
 * @method static Builder<static>|Comment typed06(int $value) Scope with required integer parameter
 * @method static Builder<static>|Comment typed07(int $value = 123) Scope with optional integer parameter and default positive value
 * @method static Builder<static>|Comment typed08(int $value = -123) Scope with optional integer parameter and default negative value
 * @method static Builder<static>|Comment typed09(float $value) Scope with required float parameter
 * @method static Builder<static>|Comment typed10(float $value = 123) Scope with optional float parameter and default positive integer value
 * @method static Builder<static>|Comment typed11(float $value = -123) Scope with optional float parameter and default negative integer value
 * @method static Builder<static>|Comment typed12(float $value = 1.23) Scope with optional float parameter and default positive float value
 * @method static Builder<static>|Comment typed13(float $value = -1.23) Scope with optional float parameter and default negative float value
 * @method static Builder<static>|Comment typed14(?bool $value) Scope with required nullable boolean parameter
 * @method static Builder<static>|Comment typed15(?bool $value = true) Scope with optional nullable boolean parameter and default true
 * @method static Builder<static>|Comment typed16(?bool $value = false) Scope with optional nullable boolean parameter and default false
 * @method static Builder<static>|Comment typed17(?bool $value = null) Scope with optional nullable boolean parameter and default null
 * @method static Builder<static>|Comment typed18(?string $value) Scope with required nullable string parameter
 * @method static Builder<static>|Comment typed19(?string $value = 'dummy123') Scope with optional nullable string parameter and default value
 * @method static Builder<static>|Comment typed20(?string $value = null) Scope with optional nullable string parameter and default null
 * @method static Builder<static>|Comment typed21(?int $value) Scope with required nullable integer parameter
 * @method static Builder<static>|Comment typed22(?int $value = 123) Scope with optional nullable integer parameter and default positive value
 * @method static Builder<static>|Comment typed23(?int $value = -123) Scope with optional nullable integer parameter and default negative value
 * @method static Builder<static>|Comment typed24(?int $value = null) Scope with optional nullable integer parameter and default null
 * @method static Builder<static>|Comment typed25(?float $value) Scope with required float nullable parameter
 * @method static Builder<static>|Comment typed26(?float $value = 123) Scope with optional nullable float parameter and default positive integer value
 * @method static Builder<static>|Comment typed27(?float $value = -123) Scope with optional nullable float parameter and default negative integer value
 * @method static Builder<static>|Comment typed28(?float $value = 1.23) Scope with optional float parameter and default positive float value
 * @method static Builder<static>|Comment typed29(?float $value = -1.23) Scope with optional float parameter and default negative float value
 * @method static Builder<static>|Comment typed30(?float $value = null) Scope with optional float parameter and default null
 * @mixin \Eloquent
 */
class Comment extends Model
{
    /**
     * @comment Scope with required boolean parameter
     */
    protected function scopeTyped01(Builder $query, bool $value)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional boolean parameter and default true
     */
    protected function scopeTyped02(Builder $query, bool $value = true)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional boolean parameter and default false
     */
    protected function scopeTyped03(Builder $query, bool $value = false)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with required string parameter
     */
    protected function scopeTyped04(Builder $query, string $value)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional string parameter and default value
     */
    protected function scopeTyped05(Builder $query, string $value = 'dummy123')
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with required integer parameter
     */
    protected function scopeTyped06(Builder $query, int $value)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional integer parameter and default positive value
     */
    protected function scopeTyped07(Builder $query, int $value = 123)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional integer parameter and default negative value
     */
    protected function scopeTyped08(Builder $query, int $value = -123)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with required float parameter
     */
    protected function scopeTyped09(Builder $query, float $value)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional float parameter and default positive integer value
     */
    protected function scopeTyped10(Builder $query, float $value = 123)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional float parameter and default negative integer value
     */
    protected function scopeTyped11(Builder $query, float $value = -123)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional float parameter and default positive float value
     */
    protected function scopeTyped12(Builder $query, float $value = 1.23)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional float parameter and default negative float value
     */
    protected function scopeTyped13(Builder $query, float $value = -1.23)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with required nullable boolean parameter
     */
    protected function scopeTyped14(Builder $query, ?bool $value)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional nullable boolean parameter and default true
     */
    protected function scopeTyped15(Builder $query, ?bool $value = true)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional nullable boolean parameter and default false
     */
    protected function scopeTyped16(Builder $query, ?bool $value = false)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional nullable boolean parameter and default null
     */
    protected function scopeTyped17(Builder $query, ?bool $value = null)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with required nullable string parameter
     */
    protected function scopeTyped18(Builder $query, ?string $value)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional nullable string parameter and default value
     */
    protected function scopeTyped19(Builder $query, ?string $value = 'dummy123')
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional nullable string parameter and default null
     */
    protected function scopeTyped20(Builder $query, ?string $value = null)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with required nullable integer parameter
     */
    protected function scopeTyped21(Builder $query, ?int $value)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional nullable integer parameter and default positive value
     */
    protected function scopeTyped22(Builder $query, ?int $value = 123)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional nullable integer parameter and default negative value
     */
    protected function scopeTyped23(Builder $query, ?int $value = -123)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional nullable integer parameter and default null
     */
    protected function scopeTyped24(Builder $query, ?int $value = null)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with required float nullable parameter
     */
    protected function scopeTyped25(Builder $query, ?float $value)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional nullable float parameter and default positive integer value
     */
    protected function scopeTyped26(Builder $query, ?float $value = 123)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional nullable float parameter and default negative integer value
     */
    protected function scopeTyped27(Builder $query, ?float $value = -123)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional float parameter and default positive float value
     */
    protected function scopeTyped28(Builder $query, ?float $value = 1.23)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional float parameter and default negative float value
     */
    protected function scopeTyped29(Builder $query, ?float $value = -1.23)
    {
        $query->where('type', $value);
    }

    /**
     * @comment Scope with optional float parameter and default null
     */
    protected function scopeTyped30(Builder $query, ?float $value = null)
    {
        $query->where('type', $value);
    }
}
