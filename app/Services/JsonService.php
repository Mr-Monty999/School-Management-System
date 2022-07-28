<?php

namespace App\Services;


class JsonService
{
    public static function responseSuccess($message, $data)
    {

        return response()->json(["success" => true, "message" => $message, "data" => $data]);
    }

    public static function responseError($message, $data)
    {

        return response()->json(["success" => false, "message" => $message, "data" => $data]);
    }
}
