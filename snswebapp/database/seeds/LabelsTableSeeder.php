<?php
use App\Models\Labels;
use App\Services\LabelsService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('labels')->truncate();

        $labelsService = new LabelsService();

        $var = file_get_contents(__DIR__ . '/data/labels.csv');
        if ($var !== false) {
            $labels = explode("\n", $var);
        } else {
            $labels = [];
        }

        foreach ($labels as $label) {
            $array = explode(",", $label);

            $key = $array[0];
            if (substr($key, 0, 1) == '#') {
                continue;
            }
            list($key, $value) = $labelsService->getKeyValue($array[0]);

            $params = [
                'value' => $value,
                'key' => $key,
                'weight' => $array[1],
            ];
            Labels::query()->create($params);
        }
    }
}