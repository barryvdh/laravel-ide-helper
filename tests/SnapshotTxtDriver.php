<?php

namespace Barryvdh\LaravelIdeHelper\Tests;

use PHPUnit\Framework\Assert;
use Spatie\Snapshots\Driver;

class SnapshotTxtDriver implements Driver
{
    public function serialize($data): string
    {
        return (string) $data;
    }

    public function extension(): string
    {
        return 'txt';
    }

    public function match($expected, $actual)
    {
        Assert::assertSame($expected, $this->serialize($actual));
    }
}
