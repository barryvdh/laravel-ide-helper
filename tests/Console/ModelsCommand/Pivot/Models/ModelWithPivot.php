<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models\Pivots\CustomPivot;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Pivot\Models\Pivots\DifferentCustomPivot;
use Illuminate\Database\Eloquent\Model;

class ModelWithPivot extends Model
{
    public function relationWithCustomPivot()
    {
        return $this->belongsToMany(ModelwithPivot::class)
            ->using(CustomPivot::class)
            ->as('customAccessor');
    }


    public function relationWithDifferentCustomPivot()
    {
        return $this->belongsToMany(ModelwithPivot::class)
            ->using(DifferentCustomPivot::class)
            ->as('differentCustomAccessor');
    }

    // without an accessor

    public function relationCustomPivotUsingSameAccessor()
    {
        return $this->belongsToMany(ModelwithPivot::class)
            ->using(CustomPivot::class);
    }

    public function relationCustomPivotUsingSameAccessorAndClass()
    {
        return $this->belongsToMany(ModelwithPivot::class)
            ->using(CustomPivot::class);
    }

    public function relationWithDifferentCustomPivotUsingSameAccessor()
    {
        return $this->belongsToMany(ModelwithPivot::class)
            ->using(DifferentCustomPivot::class);
    }
}
