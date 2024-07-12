<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models\Pivots\CustomPivot;
use Illuminate\Database\Eloquent\Model;

class ModelWithPivot extends Model
{
    public function relationWithCustomPivot()
    {
        return $this->belongsToMany(ModelwithPivot::class)
            ->using(CustomPivot::class)
            ->as('customAccessor');
    }
}
