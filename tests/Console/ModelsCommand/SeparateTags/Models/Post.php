<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SeparateTags\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    /**
     * @comment Set the user's first name.
     * @param $value
     */
    public function setFirstNameAttribute($value)
    {
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
