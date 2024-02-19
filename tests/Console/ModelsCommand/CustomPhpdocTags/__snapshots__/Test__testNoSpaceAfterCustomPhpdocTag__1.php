<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomPhpdocTags\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The `@SuppressWarnings` tag below contains no space before the `(` but when
 * the class phpdoc is written back, one is inserted.
 *
 * @link https://github.com/barryvdh/laravel-ide-helper/issues/666
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder|Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple whereId($value)
 * @mixin \Eloquent
 */
class Simple extends Model
{
}
