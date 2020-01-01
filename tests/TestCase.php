<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

use Illuminate\Console\Command;
use Orchestra\Testbench\TestCase as BaseTestCase;
use PHPUnit\Framework\Assert;
use Symfony\Component\Console\Tester\CommandTester;

abstract class TestCase extends BaseTestCase
{
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

    /**
     * @todo if support for Laravel 5.5 is dropped, this shim can be replaced with actual parent call
     *
     * @param string $needle
     * @param string $haystack
     * @param string $message
     */
    public static function assertStringNotContainsString(string $needle, string $haystack, string $message = ''): void
    {
        if (!method_exists(Assert::class, 'assertStringContainsString')) {
            parent::assertNotContains($needle, $haystack, $message);
            return;
        }

        parent::assertStringNotContainsString($needle, $haystack, $message);
    }
}
