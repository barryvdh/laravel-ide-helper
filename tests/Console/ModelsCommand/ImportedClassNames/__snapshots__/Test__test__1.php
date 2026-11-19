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
 * @method static SimpleFactory factory($count = null, $state = [])
 * @method static Builder<static>|Simple imported(Request $request)
 * @method static Builder<static>|Simple newModelQuery()
 * @method static Builder<static>|Simple newQuery()
 * @method static Builder<static>|Simple notImported(\Illuminate\Support\Stringable $value)
 * @method static Builder<static>|Simple nullableImported(?Request $request)
 * @method static Builder<static>|Simple query()
 * @method static Builder<static>|Simple unionOfImportedAndNotImported(Request|\Illuminate\Support\Stringable $value)
 * @method static Builder<static>|Simple whereId($value)
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
