<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCastWithReturnType;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithReturnType;
use Illuminate\Database\Eloquent\Model;

class CustomCastWithReturnType extends Model
{
    protected $table = 'custom_casts';
    protected $casts = [
        'casted_property' => CustomCasterWithReturnType::class
    ];
}
