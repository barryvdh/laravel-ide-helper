<?php


namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Types;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;

class SampleToManyRelationType extends Relation
{

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
}
