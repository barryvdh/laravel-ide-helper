<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCastWithDocblockReturnType;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithDocblockReturn;
use Illuminate\Database\Eloquent\Model;

class CustomCastWithDocblockReturnType extends Model
{
    protected $table = 'custom_casts';
    protected $casts = [
        'casted_property' => CustomCasterWithDocblockReturn::class
    ];
}
