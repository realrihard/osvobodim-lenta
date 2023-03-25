<?php

namespace App\Exceptions;

use Exception;

class EmailException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'message' => 'Заявка не была отправлена. Попробуйте еще раз'
        ], 500);
    }
}
