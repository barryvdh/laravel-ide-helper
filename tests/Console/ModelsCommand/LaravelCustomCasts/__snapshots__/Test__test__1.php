<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithDocblockReturnFqn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithNullablePrimitiveReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithoutReturnType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithParam;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithPrimitiveDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithPrimitiveReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithReturnType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\ExtendedSelfCastingCasterWithStaticDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\ExtendedSelfCastingCasterWithThisDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\SelfCastingCasterWithStaticDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\SelfCastingCasterWithThisDocblockReturn;
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
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $casted_property_with_param
 * @property SelfCastingCasterWithStaticDocblockReturn $casted_property_with_static_return_docblock
 * @property SelfCastingCasterWithThisDocblockReturn $casted_property_with_this_return_docblock
 * @property ExtendedSelfCastingCasterWithStaticDocblockReturn $extended_casted_property_with_static_return_docblock
 * @property ExtendedSelfCastingCasterWithThisDocblockReturn $extended_casted_property_with_this_return_docblock
 * @property SelfCastingCasterWithStaticDocblockReturn $casted_property_with_static_return_docblock_and_param
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $cast_without_property
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithParam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnDocblock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnDocblockFqn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnNullablePrimitive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnPrimitive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnPrimitiveDocblock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithStaticReturnDocblock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithStaticReturnDocblockAndParam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithThisReturnDocblock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithoutReturn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereExtendedCastedPropertyWithStaticReturnDocblock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereExtendedCastedPropertyWithThisReturnDocblock($value)
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
        'casted_property_with_param' => CustomCasterWithParam::class . ':param',
        'casted_property_with_static_return_docblock' => SelfCastingCasterWithStaticDocblockReturn::class,
        'casted_property_with_this_return_docblock' => SelfCastingCasterWithThisDocblockReturn::class,
        'extended_casted_property_with_static_return_docblock' => ExtendedSelfCastingCasterWithStaticDocblockReturn::class,
        'extended_casted_property_with_this_return_docblock' => ExtendedSelfCastingCasterWithThisDocblockReturn::class,
        'casted_property_with_static_return_docblock_and_param' => SelfCastingCasterWithStaticDocblockReturn::class . ':param',
        'cast_without_property' => CustomCasterWithReturnType::class,
    ];
}
