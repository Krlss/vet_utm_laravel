<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // config(['app.timezone' => setting('timezone')]);
        ini_set('max_execution_time', 1800);
    }

    public function sendResponse($result, $message)
    {
        return Response::json(['message' => $message, $result], 200);
    }

    public function sendError($error, $code = 404)
    {
        return Response::json($error, $code);
    }
}
