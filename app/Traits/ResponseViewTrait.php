<?php

namespace App\Traits;

trait ResponseViewTrait
{
    public static function success($data = null, $message = null, $code = 200)
    {
        return [
            'success' => true,
            'message' => $message,
            'response' => json_decode(json_encode($data)),
            'code' => $code,
        ];
    }

    public static function error($message = null, $code = 400)
    {
        return [
            'success' => false,
            'message' => $message,
            'response' => null,
            'code' => $code,
        ];
    }
}
