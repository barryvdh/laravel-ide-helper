<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastableReturnsAnonymousCaster;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastableReturnsCustomCaster;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastableWithoutReturnType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithDocblockReturnFqn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithNullablePrimitiveReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithoutReturnType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithParam;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithPrimitiveDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithPrimitiveReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithReturnType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithStaticReturnType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\ExtendedSelfCastingCasterWithStaticDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\ExtendedSelfCastingCasterWithThisDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\InboundAttributeCaster;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\SelfCastingCasterWithStaticDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\SelfCastingCasterWithThisDocblockReturn;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $casted_property_with_return_type
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $casted_property_with_return_docblock
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $casted_property_with_return_docblock_fqn
 * @property array $casted_property_with_return_primitive
 * @property array $casted_property_with_return_primitive_docblock
 * @property array $casted_property_with_return_nullable_primitive
 * @property array|null $casted_property_with_return_nullable_primitive_and_nullable_column
 * @property $casted_property_without_return
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $casted_property_with_param
 * @property SelfCastingCasterWithStaticDocblockReturn $casted_property_with_static_return_docblock
 * @property SelfCastingCasterWithThisDocblockReturn $casted_property_with_this_return_docblock
 * @property ExtendedSelfCastingCasterWithStaticDocblockReturn $extended_casted_property_with_static_return_docblock
 * @property ExtendedSelfCastingCasterWithThisDocblockReturn $extended_casted_property_with_this_return_docblock
 * @property SelfCastingCasterWithStaticDocblockReturn $casted_property_with_static_return_docblock_and_param
 * @property CustomCasterWithStaticReturnType $casted_property_with_static_return_type
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $casted_property_with_castable
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $casted_property_with_anonymous_cast
 * @property CastableWithoutReturnType $casted_property_without_return_type
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $cast_without_property
 * @property mixed $cast_inbound_attribute
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast whereCastedPropertyWithParam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast whereCastedPropertyWithReturnDocblock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast whereCastedPropertyWithReturnDocblockFqn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast whereCastedPropertyWithReturnNullablePrimitive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast whereCastedPropertyWithReturnNullablePrimitiveAndNullableColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast whereCastedPropertyWithReturnPrimitive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast whereCastedPropertyWithReturnPrimitiveDocblock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast whereCastedPropertyWithReturnType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast whereCastedPropertyWithStaticReturnDocblock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast whereCastedPropertyWithStaticReturnDocblockAndParam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast whereCastedPropertyWithThisReturnDocblock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast whereCastedPropertyWithoutReturn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast whereExtendedCastedPropertyWithStaticReturnDocblock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomCast whereExtendedCastedPropertyWithThisReturnDocblock($value)
 * @mixin \Eloquent
 */
class CustomCast extends Model
{
    protected $casts = [
        'casted_property_with_return_type' => CustomCasterWithReturnType::class,
        'casted_property_with_static_return_type' => CustomCasterWithStaticReturnType::class,
        'casted_property_with_return_docblock' => CustomCasterWithDocblockReturn::class,
        'casted_property_with_return_docblock_fqn' => CustomCasterWithDocblockReturnFqn::class,
        'casted_property_with_return_primitive' => CustomCasterWithPrimitiveReturn::class,
        'casted_property_with_return_primitive_docblock' => CustomCasterWithPrimitiveDocblockReturn::class,
        'casted_property_with_return_nullable_primitive' => CustomCasterWithNullablePrimitiveReturn::class,
        'casted_property_with_return_nullable_primitive_and_nullable_column' => CustomCasterWithNullablePrimitiveReturn::class,
        'casted_property_without_return' => CustomCasterWithoutReturnType::class,
        'casted_property_with_param' => CustomCasterWithParam::class . ':param',
        'casted_property_with_static_return_docblock' => SelfCastingCasterWithStaticDocblockReturn::class,
        'casted_property_with_this_return_docblock' => SelfCastingCasterWithThisDocblockReturn::class,
        'casted_property_with_castable' => CastableReturnsCustomCaster::class,
        'casted_property_with_anonymous_cast' => CastableReturnsAnonymousCaster::class,
        'casted_property_without_return_type' => CastableWithoutReturnType::class,
        'extended_casted_property_with_static_return_docblock' => ExtendedSelfCastingCasterWithStaticDocblockReturn::class,
        'extended_casted_property_with_this_return_docblock' => ExtendedSelfCastingCasterWithThisDocblockReturn::class,
        'casted_property_with_static_return_docblock_and_param' => SelfCastingCasterWithStaticDocblockReturn::class . ':param',
        'cast_without_property' => CustomCasterWithReturnType::class,
        'cast_inbound_attribute' => InboundAttributeCaster::class,
    ];
}
