<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithDocblockReturnFqn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithNullablePrimitiveReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithoutReturnType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithPrimitiveDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithPrimitiveReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithReturnType;
use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCast
 *
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $casted_property_with_return_type
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $casted_property_with_return_docblock
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $casted_property_with_return_docblock_fqn
 * @property array $casted_property_with_return_primitive
 * @property array|null $casted_property_with_return_primitive_docblock
 * @property array|null $casted_property_with_return_nullable_primitive
 * @property $casted_property_without_return
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnDocblock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnDocblockFqn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnNullablePrimitive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnPrimitive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnPrimitiveDocblock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithoutReturn($value)
 * @mixin \Eloquent
 */
class CustomCast extends Model
{
    protected $casts = [
        'casted_property_with_return_type' => CustomCasterWithReturnType::class,
        'casted_property_with_return_docblock' => CustomCasterWithDocblockReturn::class,
        'casted_property_with_return_docblock_fqn' => CustomCasterWithDocblockReturnFqn::class,
        'casted_property_with_return_primitive' => CustomCasterWithPrimitiveReturn::class,
        'casted_property_with_return_primitive_docblock' => CustomCasterWithPrimitiveDocblockReturn::class,
        'casted_property_with_return_nullable_primitive' => CustomCasterWithNullablePrimitiveReturn::class,
        'casted_property_without_return' => CustomCasterWithoutReturnType::class,
    ];
}
