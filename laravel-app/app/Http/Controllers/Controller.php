<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const REQUEST_METHOD_POST = 'post';
    const REQUEST_METHOD_PUT = 'put';

    public function callAction($method, $parameters)
    {
        header_register_callback(function(){
            header_remove('X-Powered-By');
        });

        \Log::info('callAction');

/*
        $request = isset($parameters[0]) ? $parameters[0] : '';
        if (preg_match('/Request$/', get_class($request))) {
            if (isset($request->user->id)) {
                \Log::info($request->user->id . ',' . $request->url());
            }
        }
*/
        return parent::callAction($method, $parameters);
    }

    public function postView($view, $variables = [])
    {
        return view($view, $variables + ['formMethod' => self::REQUEST_METHOD_POST]);
    }

    public function putView($view, $variables = [])
    {
        return view($view, $variables + ['formMethod' => self::REQUEST_METHOD_PUT]);
    }

    public function customView($view, $variables, $method)
    {
        return view($view, $variables + ['formMethod' => $method]);
    }
}
