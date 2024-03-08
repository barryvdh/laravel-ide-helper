<?php

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateMixinCollection\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateMixinCollection\NonModels\CollectionModel;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateMixinCollection\NonModels\NonModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Collection as IntCollection;

/**
 * @mixin IdeHelperWithCollection
 */
class WithCollection extends Model
{
//    /**
//     * @return Collection<int, string>
//     */
//    public function getCollectionAttribute(): Collection
//    {
//        return new Collection();
//    }
//
//    /**
//     * @return Collection
//     */
//    public function getCollectionWithoutTemplateAttribute(): Collection
//    {
//        return new Collection();
//    }
//
//    public function getCollectionWithoutDocBlockAttribute(): Collection
//    {
//        return new Collection();
//    }
//
//    /**
//     * @return Collection<int, NonModel>
//     */
//    public function getCollectionWithNonModelTemplateAttribute(): Collection
//    {
//        return new Collection();
//    }
//
    /**
     * @return Collection<Collection, CollectionModel<IntCollection, CollectionModel<int, NonModel>>>
     */
    public function getCollectionWithNestedTemplateAttribute(): Collection
    {
        return new Collection();

    }
}
<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateMixinCollection\Models{
/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateMixinCollection\Models\WithCollection
 *
 * @property-read \Illuminate\Support\Collection\Illuminate\Support\Collection\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateMixinCollection\NonModels\CollectionModelIntCollection,\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateMixinCollection\NonModels\CollectionModelint,\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateMixinCollection\NonModels\NonModel>> $collection_with_nested_template
 * @method static \Illuminate\Database\Eloquent\Builder|WithCollection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WithCollection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WithCollection query()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperWithCollection {}
}

