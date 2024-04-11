<?php
namespace App\Http\Controllers;

use App\Http\Exceptions\NotFoundException;
use App\Http\Exceptions\ForbiddenException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Pagination\LengthAwarePaginator;
use \DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function callAction($method, $parameters)
    {
        try {
            header_register_callback(function(){
                header_remove('X-Powered-By');
            });
    
            $request = isset($parameters[0]) ? $parameters[0] : '';
            if (preg_match('/Request$/', get_class($request))) {
                \Log::info(sprintf("user_id=%s, %s", user()->id ?? '', $request->url()));
            }

            header('X-FRAME-OPTIONS: SAMEORIGIN');
    
            return parent::callAction($method, $parameters);

        } catch(NotFoundException $e) {
            abort(404);
        } catch(ForbiddenException $e) {
            abort(403);
        } catch(Exception $e) {
            abort(500);
        }
    }

    protected function pager($array, $limit, $page, $path)
    {
        $page = $page ?? 1;

        $data = new LengthAwarePaginator(
            array_slice($array, ($page - 1) * $limit, $limit),
            count($array),
            $limit,
            $page,
            ['path' => $path]
        );

        return $data;
    }
}
