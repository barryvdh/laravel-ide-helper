<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

use Illuminate\Console\Command;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Symfony\Component\Console\Tester\CommandTester;

abstract class TestCase extends BaseTestCase
{
    use MatchesSnapshots;

    /**
     * The `CommandTester` is directly returned, use methods like
     * `->getDisplay()` or `->getStatusCode()` on it.
     *
     * @param Command $command
     * @param array $arguments The command line arguments, array of key=>value
     *   Examples:
     *   - named  arguments: ['model' => 'Post']
     *   - boolean flags: ['--all' => true]
     *   - arguments with values: ['--arg' => 'value']
     * @param array $interactiveInput Interactive responses to the command
     *   I.e. anything the command `->ask()` or `->confirm()`, etc.
     * @return CommandTester
     */
    protected function runCommand(Command $command, array $arguments = [], array $interactiveInput = []): CommandTester
    {
        $command->setLaravel($this->app);

        $tester = new CommandTester($command);
        $tester->setInputs($interactiveInput);

        $tester->execute($arguments);

        return $tester;
    }

    protected function assertMatchesPhpSnapshot(?string $actualContent)
    {
        $this->assertMatchesSnapshot($actualContent, new SnapshotPhpDriver());
    }

    protected function assertMatchesTxtSnapshot(?string $actualContent)
    {
        $this->assertMatchesSnapshot($actualContent, new SnapshotTxtDriver());
    }
}
