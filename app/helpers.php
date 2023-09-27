<?php

use Illuminate\Http\JsonResponse;

function sendSuccessResponse(string $message, int $statusCode = 200, $payload = []): JsonResponse
{
    return response()->json([
        'success' => true,
        'message' => $message,
        'data'    => $payload
    ], $statusCode);
}

function sendErrorResponse(string $message, int $statusCode = 200, $payload = []): JsonResponse
{
    return response()->json([
        'success' => false,
        'message' => $message,
        'data'    => $payload
    ], $statusCode);
}


if (!function_exists('unique_short_url')) {
    function unique_short_url($model, $column): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        while (true) {
            $result = '';
            for ($i = 0; $i < 3; $i++) {
                $result .= $characters[rand(0, strlen($characters) - 1)];
            }
            $existingModel = $model::query()->where($column, $result)->first();
            if (!$existingModel) {
                return $result;
            }
        }
    }

}


?>
