<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function sentSuccessfully($data = [], $message = "success", $status)
    {
        return response()->json([
            'data'        => $data,
            'message'     => $message,
            'status code' => $status,
            'time'        => now()
        ], $status);
    }
}
