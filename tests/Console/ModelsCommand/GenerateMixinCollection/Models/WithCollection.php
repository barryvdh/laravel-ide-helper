<?php

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateMixinCollection\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class WithCollection extends Model
{
    /**
     * @return Collection<int, string>
     */
    public function getCollectionAttribute(): Collection
    {
        return new Collection();
    }

    /**
     * @return Collection
     */
    public function getCollectionWithoutTemplateAttribute(): Collection
    {
        return new Collection();
    }

    public function getCollectionWithoutDocBlockAttribute(): Collection
    {
        return new Collection();
    }
}
