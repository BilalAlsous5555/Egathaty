<?php

namespace App\Http\Controllers;

abstract class Controller
{
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
