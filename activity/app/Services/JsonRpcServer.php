<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Http\Response\JsonRpcResponse;
use Illuminate\Http\Request;

class JsonRpcServer
{
    public function handle(Request $request, Controller $controller)
    {        
        try {
            $content = json_decode($request->getContent(), true);


            if (empty($content)) {
                throw new JsonRpcException('Parse error', JsonRpcException::PARSE_ERROR);
            }

            $result = $controller->{$content['method']}(...[$content['params']]);


            $jsondata = JsonRpcResponse::success($result, $content['id']);

\Log::error('result ' . print_r($jsondata, true));

            return $jsondata;
        } catch (\Exception $e) {
            return JsonRpcResponse::error($e->getMessage());
        }
    }
}