<?php

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\EnumerateTypes\Enums;

enum PostMode: int
{
    case OPEN = 0;
    case VOTE = 1;
    case REWARD = 3;
    case BROADCAST = 4;
}