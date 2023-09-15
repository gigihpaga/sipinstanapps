<?php

namespace App\Macros;

use Symfony\Component\HttpFoundation\Response;

class ResponseJsonMacro
{
    function successJson()
    {
        return function ($data = null, $messages = null) {
            $response['success'] = true;
            $response['message'] = 'Success';
            $response['data'] = $data;
            $response['statusText'] = "OK";
            $messages ?  $response['message'] = $response['message'] . ", $messages" : '';

            return response()->json($response, 200);
        };
    }

    function failedJson()
    {
        return function ($code = 500, $messages = null) {
            $statusTexts = Response::$statusTexts;
            $statusText = array_key_exists($code, $statusTexts) ? $statusTexts[$code] : 'Internal Server Error';;

            $response['success'] = false;
            $response['message'] = 'Failed';
            $response['data'] = null;
            $response['statusText'] = $statusText;
            $messages ?  $response['message'] = $response['message'] . ", $messages" : '';

            return response()->json($response, $code);
        };
    }
}
