<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController; 

abstract class Controller extends BaseController
{
     use AuthorizesRequests, ValidatesRequests;
protected function success(array $data = [], string $message = 'Operation successful', int $code = 200)
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'   => $data,
        ], $code);
    }

protected function error(array $data = [] ,string $message="Something went wrong" , int $code=400 )
    {
            return response()->json([
            'status'  => 'Faild',
            'message' => $message,
            'data'   => $data,
        ], $code);
    }
}