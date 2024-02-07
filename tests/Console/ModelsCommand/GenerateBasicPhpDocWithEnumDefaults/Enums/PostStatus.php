<?php

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpDocWithEnumDefaults\Enums;

enum PostStatus
{
    case Published;

    case Unpublished;

    case Archived;
}