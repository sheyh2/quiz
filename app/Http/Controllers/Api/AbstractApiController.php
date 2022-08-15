<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

class AbstractApiController
{
    /**
     * @param $data
     * @param string|null $message
     * @param int $code
     * @param bool $status
     * @return JsonResponse
     */
    public static function renderJson($data, string $message = null, int $code = 200, bool $status = true): JsonResponse
    {
        return response()->json(
            [
                'status'  => $status,
                'code'    => $code,
                'message' => is_null($message) ? trans('main.successfully', [], app()->getLocale()) : $message,
                'data'    => $data,
            ],
            $code
        );
    }
}