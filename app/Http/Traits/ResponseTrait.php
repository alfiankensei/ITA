<?php

namespace App\Http\Traits;

use Illuminate\Http\Response;

trait ResponseTrait
{

    /**
     * Build success response
     * @param  string|array $data
     * @param  int $code
     * @return Illuminate\Http\JsonResponse
     */
    public function successResponse($message = 'Success', $data = '', $code = Response::HTTP_OK)
    {
        return response()->json(['message' => $message, 'data' => $data, 'code' => $code], $code);
    }

    /**
     * Build error responses
     * @param  string|array $message
     * @param  int $code
     * @return Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code = Response::HTTP_BAD_REQUEST, $data = null)
    {
        $data = is_null($data) ? json_decode("{}") : $data;
        return response()->json(['message' => $message, 'data' => $data, 'code' => $code], $code);
    }
}
