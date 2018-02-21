<?php namespace Barryvdh\LaravelIdeHelper\Console;

use Illuminate\Database\Eloquent\Model;

class ClassMapBuilder
{
    public static function createMap($dir)
    {
        if ($dir === '~/app/models')
            return array_flip(array(__NAMESPACE__ . '\Bar', __NAMESPACE__ . '\Foo', __NAMESPACE__ . '\Skip'));

        if ($dir === '~/tests/stubs')
            return array_flip(array(__CLASS__, __NAMESPACE__ . '\BarFoo'));

        return array();
    }
}

/**
 * @property string $name
 */
class Bar extends Model
{
    protected $table = 'bar';

    public function getCreatedAtAttribute($value = null)
    {
        return $value;
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = $value;
    }

    public function parent()
    {
        return $this->belongsTo(get_class($this), 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Barryvdh\LaravelIdeHelper\Console\Bar', 'parent_id');
    }
}

/**
 * @method static Foo byValid($not = false)
 */
class Foo extends Model
{
    protected $table = 'foo';

    public function scopeByValid($query, $not = false)
    {
        /* @var \Illuminate\Database\Eloquent\Builder $query */
        return $query->where('is_valid', !$not ? '<>' : '=', false);
    }

    public function getUpdatedAtAttribute($value = null)
    {
        return $value;
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = $value;
    }

    public function bars()
    {
        return $this->belongsToMany('BarFoo', 'bar_foo_', 'bar_id', 'foo_id');
    }
}

abstract class Skip extends Model
{
}

class BarFoo extends Model
{
    protected $table = 'bar_foo';
}
