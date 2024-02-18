<?php

namespace Barryvdh\LaravelIdeHelper\DocBlock;

use phpDocumentor\Reflection\Fqsen;
use phpDocumentor\Reflection\FqsenResolver;
use phpDocumentor\Reflection\Types\Context;

class LocalFsqenResolver extends FqsenResolver
{
    public function resolve(string $fqsen, ?Context $context = null): Fqsen
    {
        return new Fqsen($fqsen);
    }
}
