<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Types;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Concerns\SupportsDefaultModels;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Sample for custom relation
 *
 * the relation is a big fake and only for testing of the docblock generation
 *
 * @package Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations
 */
class SampleToOneRelationType extends Relation
{
    use SupportsDefaultModels;

    public function addConstraints()
    {
        // Fake
    }

    public function addEagerConstraints(array $models)
    {
        // Fake
    }

    public function initRelation(array $models, $relation)
    {
        // Fake
    }

    public function match(array $models, Collection $results, $relation)
    {
        // Fake
    }

    public function getResults()
    {
        // Fake
    }

    protected function newRelatedInstanceFor(Model $parent)
    {
        // Fake
    }
}
