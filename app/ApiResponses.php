<?php

namespace App;

use \Illuminate\Http\JsonResponse;

trait ApiResponses
{
    /**
     * Return a ok response
     *
     * @param  string $message
     * @param  array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function ok(string $message, array $data = []): JsonResponse
    {
        return $this->success($message, $data, 200);
    }

    /**
     * Return a created response
     *
     * @param  string $message
     * @param  array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function created(string $message, array $data = []): JsonResponse
    {
        return $this->success($message, $data, 201);
    }

    /**
     * Return a success response with ok code as default
     *
     * @param  string $message
     * @param  array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($message, array $data = [], int $code = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'code' => $code
        ], $code);
    }
}
