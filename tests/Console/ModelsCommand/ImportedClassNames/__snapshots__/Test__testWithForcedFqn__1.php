<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ImportedClassNames\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ImportedClassNames\Factories\SimpleFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * @property int $id
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ImportedClassNames\Factories\SimpleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ImportedClassNames\Models\Simple imported(\Illuminate\Http\Request $request)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ImportedClassNames\Models\Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ImportedClassNames\Models\Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ImportedClassNames\Models\Simple notImported(\Illuminate\Support\Stringable $value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ImportedClassNames\Models\Simple nullableImported(?\Illuminate\Http\Request $request)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ImportedClassNames\Models\Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ImportedClassNames\Models\Simple unionOfImportedAndNotImported(\Illuminate\Http\Request|\Illuminate\Support\Stringable $value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ImportedClassNames\Models\Simple whereId($value)
 * @mixin \Eloquent
 */
class Simple extends Model
{
    use HasFactory;

    protected static function newFactory(): SimpleFactory
    {
        return SimpleFactory::new();
    }

    public function scopeImported(Builder $query, Request $request): void
    {
    }

    public function scopeNullableImported(Builder $query, ?Request $request): void
    {
    }

    public function scopeNotImported(Builder $query, \Illuminate\Support\Stringable $value): void
    {
    }

    public function scopeUnionOfImportedAndNotImported(Builder $query, Request|\Illuminate\Support\Stringable $value): void
    {
    }
}
