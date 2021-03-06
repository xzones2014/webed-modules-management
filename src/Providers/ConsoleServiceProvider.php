<?php namespace WebEd\Base\ModulesManagement\Providers;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->generatorCommands();
        $this->otherCommands();
    }

    protected function generatorCommands()
    {
        $this->commands([
            /**
             * Core
             */
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeModule::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeProvider::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeController::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeMiddleware::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeRequest::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeModel::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeRepository::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeFacade::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeService::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeSupport::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeView::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeMigration::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeCommand::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeDataTable::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeCriteria::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeAction::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeMail::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Core\MakeViewComposer::class,
            /**
             * Plugin
             */
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeProvider::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeController::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeMiddleware::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeRequest::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeModel::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeRepository::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeFacade::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeService::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeSupport::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeView::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeMigration::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeCommand::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeDataTable::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeCriteria::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeAction::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeMail::class,
            \WebEd\Base\ModulesManagement\Console\Generators\Plugin\MakeViewComposer::class,
        ]);
    }

    protected function otherCommands()
    {
        $this->commands([
            \WebEd\Base\ModulesManagement\Console\Commands\InstallPluginCommand::class,
            \WebEd\Base\ModulesManagement\Console\Commands\UpdatePluginCommand::class,
            \WebEd\Base\ModulesManagement\Console\Commands\UninstallPluginCommand::class,
            \WebEd\Base\ModulesManagement\Console\Commands\DisablePluginCommand::class,
            \WebEd\Base\ModulesManagement\Console\Commands\EnablePluginCommand::class,

            \WebEd\Base\ModulesManagement\Console\Commands\UpdateCoreModuleCommand::class,

            \WebEd\Base\ModulesManagement\Console\Commands\ExportCoreModuleCommand::class,
            \WebEd\Base\ModulesManagement\Console\Commands\GetAllCoreModulesCommand::class,
        ]);
    }
}
