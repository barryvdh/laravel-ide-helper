<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\PhpAttributesBeforeClass\Models;

use Illuminate\Database\Eloquent\Model;

// Tests: final class + attribute with nested array argument (e.g. ObservedBy([...]))
/**
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinalWithNested newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinalWithNested newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinalWithNested query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinalWithNested whereId($value)
 * @mixin \Eloquent
 */
#[ObservedByStub([StubObserver::class])]
final class FinalWithNested extends Model
{
    protected $table = 'simples';
}
<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\PhpAttributesBeforeClass\Models;

use Illuminate\Database\Eloquent\Model;

// Tests: multiple consecutive PHP 8 attributes before the class declaration
/**
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultipleAttributes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultipleAttributes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultipleAttributes query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultipleAttributes whereId($value)
 * @mixin \Eloquent
 */
#[\AllowDynamicProperties]
#[SecondAttribute]
class MultipleAttributes extends Model
{
    protected $table = 'simples';
}
<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\PhpAttributesBeforeClass\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple whereId($value)
 * @mixin \Eloquent
 */
#[\AllowDynamicProperties]
class Simple extends Model
{
}
