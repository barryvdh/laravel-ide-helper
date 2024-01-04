<?php

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateMixinCollection\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @mixin IdeHelperWithCollection
 */
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
 * @property-read \Illuminate\Support\Collection<int, string> $collection
 * @property-read \Illuminate\Support\Collection $collection_without_doc_block
 * @property-read \Illuminate\Support\Collection $collection_without_template
 * @method static \Illuminate\Database\Eloquent\Builder|WithCollection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WithCollection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WithCollection query()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperWithCollection {}
}

