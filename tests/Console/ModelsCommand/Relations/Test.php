<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Types\SampleToAnyMorphedRelationType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Types\SampleToAnyRelationType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Types\SampleToBadlyNamedNotManyRelationType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Types\SampleToManyRelationType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Relations\Types\SampleToOneRelationType;
use Illuminate\Support\Facades\Config;

class Test extends AbstractModelsCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        Config::set('ide-helper.additional_relation_types', [
            'testToOneRelation' => SampleToOneRelationType::class,
            'testToManyRelation' => SampleToManyRelationType::class,
            'testToAnyRelation' => SampleToAnyRelationType::class,
            'testToAnyMorphedRelation' => SampleToAnyMorphedRelationType::class,
            'testToBadlyNamedNotManyRelation' => SampleToBadlyNamedNotManyRelationType::class,
        ]);

        Config::set('ide-helper.additional_relation_return_types', [
            'testToAnyRelation' => 'many',
            'testToAnyMorphedRelation' => 'morphTo',
            'testToBadlyNamedNotManyRelation' => 'one',
        ]);
    }

    public function test(): void
    {
        $command = $this->app->make(ModelsCommand::class);

        $tester = $this->runCommand($command, [
            '--write' => true,
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('Written new phpDocBlock to', $tester->getDisplay());
        $this->assertMatchesMockedSnapshot();
    }

    public function testRelationNotNullable(): void
    {
        // Disable enforcing nullable relationships
        Config::set('ide-helper.enforce_nullable_relationships', false);

        $command = $this->app->make(ModelsCommand::class);

        $tester = $this->runCommand($command, [
            '--write' => true,
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('Written new phpDocBlock to', $tester->getDisplay());
        $this->assertMatchesMockedSnapshot();

        // Re-enable default enforcing nullable relationships
        Config::set('ide-helper.enforce_nullable_relationships', true);
    }
}
