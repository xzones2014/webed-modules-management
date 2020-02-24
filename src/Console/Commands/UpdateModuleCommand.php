<?php namespace WebEd\Base\ModulesManagement\Console\Commands;

use Illuminate\Console\Command;
use WebEd\Base\ModulesManagement\Facades\ModulesFacade;

class UpdateModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:update {alias}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update WebEd module';

    /**
     * @var array
     */
    protected $container = [];

    /**
     * @var array
     */
    protected $dbInfo = [];

    /**
     * @var \Illuminate\Foundation\Application|mixed
     */
    protected $app;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->app = app();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $module = get_module_information($this->argument('alias'));

        if (!$module) {
            $this->error('Module not exists');
            die();
        }

        if (array_get($module, 'version') === array_get($module, 'installed_version')) {
            $this->info("\nModule " . $this->argument('alias') . " already up to date.");
            return;
        }

        $this->registerUpdateModuleService($module);

        $moduleProvider = str_replace('\\\\', '\\', array_get($module, 'namespace', '') . '\Providers\ModuleProvider');
        \Artisan::call('vendor:publish', [
            '--provider' => $moduleProvider,
            '--tag' => 'webed-public-assets',
            '--force' => true
        ]);

        $this->info("\nModule " . $this->argument('alias') . " has been updated.");
    }

    protected function registerUpdateModuleService($module)
    {
        $this->line('Update module dependencies...');

        $namespace = str_replace('\\\\', '\\', array_get($module, 'namespace', '') . '\Providers\UpdateModuleServiceProvider');
        if (class_exists($namespace)) {
            $this->app->register($namespace);
        }

        ModulesFacade::saveModule($module, [
            'installed_version' => array_get($module, 'version'),
        ]);

        $this->line('Your module has been updated');
    }
}
