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
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\ExtendedSelfCastingCasterWithStaticDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\ExtendedSelfCastingCasterWithThisDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\SelfCastingCasterWithStaticDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\SelfCastingCasterWithThisDocblockReturn;
use Illuminate\Database\Eloquent\Model;

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
        'casted_property_with_castable' => CastableReturnsCustomCaster::class,
        'casted_property_with_anonymous_cast' => CastableReturnsAnonymousCaster::class,
        'casted_property_without_return_type' => CastableWithoutReturnType::class,
        'extended_casted_property_with_static_return_docblock' => ExtendedSelfCastingCasterWithStaticDocblockReturn::class,
        'extended_casted_property_with_this_return_docblock' => ExtendedSelfCastingCasterWithThisDocblockReturn::class,
        'casted_property_with_static_return_docblock_and_param' => SelfCastingCasterWithStaticDocblockReturn::class . ':param',
        'cast_without_property' => CustomCasterWithReturnType::class,
    ];
}
