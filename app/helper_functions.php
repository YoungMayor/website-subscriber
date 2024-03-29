<?php

use App\Enums\StatusCode;

if (!function_exists('apiResponse')) {
    function apiResponse(
        StatusCode $statusCode,
        string $message,
        array $context = [],
        array $messageContext = []
    ) {
        return response()->json([
            'status_code' => $statusCode->value,
            'status' => $statusCode->label(),
            'message' => __($message, $messageContext),
            'data' => $context
        ], $statusCode->value);
    }
}
