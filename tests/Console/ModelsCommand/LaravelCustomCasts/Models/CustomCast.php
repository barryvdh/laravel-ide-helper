<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithNullablePrimitiveReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithoutReturnType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithPrimitiveDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithPrimitiveReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithReturnType;
use Illuminate\Database\Eloquent\Model;

class CustomCast extends Model
{
    protected $casts = [
        'casted_property_with_return_type' => CustomCasterWithReturnType::class,
        'casted_property_with_return_docblock' => CustomCasterWithDocblockReturn::class,
        'casted_property_with_return_primitive' => CustomCasterWithPrimitiveReturn::class,
        'casted_property_with_return_primitive_docblock' => CustomCasterWithPrimitiveDocblockReturn::class,
        'casted_property_with_return_nullable_primitive' => CustomCasterWithNullablePrimitiveReturn::class,
        'casted_property_without_return' => CustomCasterWithoutReturnType::class,
    ];
}
