<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Traits;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Types\SampleToAnyMorphedRelationType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Types\SampleToAnyRelationType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Types\SampleToManyRelationType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Types\SampleToOneRelationType;

trait HasTestRelations
{
    public function testToOneRelation($related)
    {
        $instance = $this->newRelatedInstance($related);
        return new SampleToOneRelationType($instance->newQuery(), $this);
    }

    public function testToManyRelation($related)
    {
        $instance = $this->newRelatedInstance($related);
        return new SampleToManyRelationType($instance->newQuery(), $this);
    }

    public function testToAnyRelation($related)
    {
        $instance = $this->newRelatedInstance($related);
        return new SampleToAnyRelationType($instance->newQuery(), $this);
    }

    public function testToAnyMorphedRelation($related)
    {
        $instance = $this->newRelatedInstance($related);
        return new SampleToAnyMorphedRelationType($instance->newQuery(), $this);
    }
}
