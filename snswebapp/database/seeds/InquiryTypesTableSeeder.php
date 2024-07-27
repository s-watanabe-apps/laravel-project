<?php
use App\Models\InquiryTypes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InquiryTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inquiry_types')->truncate();

        $inquiryTypes = [
            [
                'id' => 1,
                'name' => __('strings.inquiry_types')[0],
            ],
            [
                'id' => 2,
                'name' => __('strings.inquiry_types')[1],
            ],
            [
                'id' => 3,
                'name' => __('strings.inquiry_types')[2],
            ],
            [
                'id' => 4,
                'name' => __('strings.inquiry_types')[3],
            ],
        ];

        foreach($inquiryTypes as $type) {
            InquiryTypes::query()->create($type);
        }
    }
}