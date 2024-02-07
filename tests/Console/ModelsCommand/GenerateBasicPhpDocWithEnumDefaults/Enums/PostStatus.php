<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpDocWithEnumDefaults\Enums;

enum PostStatus
{
    case Published;

    case Unpublished;

    case Archived;
}
