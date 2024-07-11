<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetWeathers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get-weathers {--args=} {--re-run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info(__CLASS__ . " - start.");
        $this->main();
        $this->info(__CLASS__ . " - end.");

        return 0;
    }

    private function main()
    {
        $class = "App\\Console\\Commands\\SubModules\\OpenWeathermap";
        $parts = explode('\\', get_parent_class($class));
        if (end($parts) != 'SubModule') {
            $this->warn("Execution class is invalid. [{$class}]");
            return;
        }

        $weathers = $class::get($this);
        dump($this->option('args'));
        dump(get_parent_class($class));
    }
}
