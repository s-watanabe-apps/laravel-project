<?php

namespace App\Http\Controllers\Api;

Use \App\Http\Controllers\Controller;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Cookie;
use \Illuminate\Support\Facades\Crypt;
use \GuzzleHttp\Client;
use \GuzzleHttp\Exception\ClientException;

class ApiController extends Controller
{
    protected $user;

    public function callAction($method, $parameters)
    {
        try {
            $request = isset($parameters[0]) ? $parameters[0] : null;

            $client = new Client(['base_uri' => env('APP_URL')]);

            $apiToken = Crypt::decrypt(Cookie::get('api_token'), true);
            \Log::info("api_token:" . $apiToken);
            
            $response = $client->request('GET', '/api/user', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiToken,
                    'Accept' => 'application/json',
                ],
            ]);

            $this->user = json_decode($response->getBody()->getContents(), false);
        } catch (ClientException $exeption) {
            return response()->json([], 401);
        }

        return parent::callAction($method, $parameters);
    }

    private function authenticate(Request $request)
    {

    }
}
