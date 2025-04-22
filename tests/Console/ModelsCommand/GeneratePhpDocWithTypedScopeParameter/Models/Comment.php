<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpDocWithTypedScopeParameter\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
