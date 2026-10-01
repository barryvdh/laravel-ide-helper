<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqnMixin\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $someProp
 * @method someMethod(string $method)
 */
class Post extends Model
{
}
