<?php namespace WebEd\Base\ModulesManagement\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;

class EnablePluginCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plugin:enable {--all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable plugins';

    /**
     * @var array
     */
    protected $container = [];

    /**
     * @var Composer
     */
    protected $composer;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Composer $composer)
    {
        parent::__construct();

        $this->composer = $composer;
        $this->composer->setWorkingPath(base_path());
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->getInformation();

        $count = 0;

        $plugins = get_plugin();

        if(!$this->container['alias']) {
            foreach ($plugins as $plugin) {
                $this->detectRequiredDependencies($plugin);
                webed_plugins()->enableModule(array_get($plugin, 'alias'));
                $count++;
            }
        } else {
            $plugins = $plugins->where('alias', '=', $this->container['alias']);
            foreach ($plugins as $plugin) {
                $this->detectRequiredDependencies($plugin);
                webed_plugins()->enableModule(array_get($plugin, 'alias'));
                $count++;
            }
        }

        echo PHP_EOL;

        modules_management()->refreshComposerAutoload();

        $this->info("\n$count module(s) enabled successfully.");
    }

    protected function getInformation()
    {
        if($this->option('all')) {
            $this->container['alias'] = null;
        } else {
            $this->container['alias'] = $this->ask('Plugin alias');
        }
    }

    protected function detectRequiredDependencies($module)
    {
        $checkRelatedModules = check_module_require($module);
        if ($checkRelatedModules['error']) {
            foreach ($checkRelatedModules['messages'] as $message) {
                $this->error($message);
            }
            die();
        }
    }
}
