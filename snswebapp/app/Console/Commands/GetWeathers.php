<?php

namespace App\Console\Commands;

use App\Services\WeathersService;
use Illuminate\Console\Command;

class GetWeathers extends Command
{
    private $weathersService;

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
    public function __construct(
        WeathersService $weathersService
    )
    {
        parent::__construct();
        $this->weathersService = $weathersService;
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
        foreach ($weathers['list'] as $weather) {
            $weather['city_id'] = $weathers['city']['id'];
            $row = $this->weathersService->getWeathersByCityIdAndTime($weather['city_id'], $weather['time']);
            if ($row == null) {
                $this->weathersService->insertWeathers($weather);
                $this->info("Insert weathers. ({$weather['city_id']}, {$weather['time']})");
            } else {
                $doUpdate = false;
                $values = [];
                foreach ($weather as $key => $value) {
                    if ($key != 'time' && $value != $row->getAttributes()[$key]) {
                        $values[$key] = $value;
                        $doUpdate = true;
                    }
                }

                if ($doUpdate) {
                    $this->weathersService->updateWeathers($weather['city_id'], $weather['time'], $values);
                    $this->info("Update weathers. ({$weather['city_id']}, {$weather['time']})");
                }
            }
        }
    }
}
