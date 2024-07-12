<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Morphs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Morphs extends Model
{
    public function relationMorphTo(): MorphTo
    {
        return $this->morphTo();
    }

    public function nullableRelationMorphTo(): MorphTo
    {
        return $this->morphTo();
    }
}
