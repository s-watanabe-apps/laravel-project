<?php

namespace Tests\Feature;

use App\Http\Requests\ArticlesRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppHttpRequestsArticlesRequestTest extends TestCase
{
    /**
     * @test
     * @dataProvider validationProvider
     */
    public function validation($expected, $data)
    {
        $rules = (new ArticlesRequest())->rules();
        $validator = validator($data, $rules);
 
        $this->assertEquals($expected, $validator->passes());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function validationProvider()
    {
        return [
            [
                true,
                [
                    'title' => 'Test Title',
                    'body' => 'Test Body',
                ],
            ], [
                false,
                [
                    'title' => '',
                    'body' => 'Test Body',
                ],
            ], [
                false,
                [
                    'title' => str_repeat('A', 256),
                    'body' => 'Test Body',
                ],
            ], [
                false,
                [
                    'id' => 'A',
                    'title' => 'Test Title',
                    'body' => 'Test Body',
                ],
            ]
        ];
    }
}
