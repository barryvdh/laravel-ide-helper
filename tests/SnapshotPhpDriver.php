<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

use PHPUnit\Framework\Assert;
use Spatie\Snapshots\Driver;

class SnapshotPhpDriver implements Driver
{
    public function serialize($data): string
    {
        return str_replace(["\r\n", "\r"], "\n", (string) $data);
    }

    public function extension(): string
    {
        return 'php';
    }

    public function match($expected, $actual)
    {
        Assert::assertSame(str_replace(["\r\n", "\r"], "\n", $expected), $this->serialize($actual));
    }
}
