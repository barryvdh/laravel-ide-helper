<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\PromptsToWriteMetaIfConfigSetToFalse;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;

class Test extends AbstractModelsCommand
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('ide-helper.always_overwrite_model_files', false);
    }

    public function test(): void
    {
        $command = $this->app->make(ModelsCommand::class);

        $tester = $this->runCommand($command, []);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('Do you want to overwrite the existing model files? Choose no to write to _ide_helper_models.php instead', $tester->getDisplay());
    }
}
