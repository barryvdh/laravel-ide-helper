<?php

namespace Barryvdh\LaravelIdeHelper\Enums;

enum ModelWarning
{
    case TableInspectionFailed;

    public function message(): string
    {
        return match ($this) {
            default => str($this->name)
                ->headline()
                ->lower()
                ->ucfirst()
        };
    }
}
