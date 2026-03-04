<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\PhpAttributesBeforeClass\Models;

use Illuminate\Database\Eloquent\Model;

// Tests: final class + attribute with nested array argument (e.g. ObservedBy([...]))
#[ObservedByStub([StubObserver::class])]
final class FinalWithNested extends Model
{
    protected $table = 'simples';
}
