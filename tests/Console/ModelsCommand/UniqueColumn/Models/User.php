<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\UniqueColumn\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users_unique';
}
