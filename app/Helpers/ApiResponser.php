<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Resources\Json\JsonResource;


class ApiResponser
{
    public static function success($data, string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function successWithPagination(
        JsonResource $data,
        string $message = null,
        int $code = 200
    ): JsonResponse
    {
        $response = [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ];

        $paginator = $data->resource;

        $response['links'] = [
            'next' => $paginator->nextPageUrl() ?? null,
            'previous' => $paginator->previousPageUrl() ?? null,
        ];

        $response['meta'] = [
            'per_page' => $paginator->perPage() ?? null,
            'count' => $paginator->count() ?? null
        ];

        return response()->json($response, $code);
    }

    public static function error($message, $code = 400, $errors = []): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }

    public static function notFound($message = 'Resource not found.', $code = 404): JsonResponse
    {
        return self::error($message, $code);
    }

    public static function unauthorized($message = 'Unauthorized.', $code = 401): JsonResponse
    {
        return self::error($message, $code);
    }

    // public static function file($path, $fileName = null, $headers = [], $code = 200)
    // {
    //     if (!File::exists($path)) {
    //         abort(404, 'File not found.');
    //     }

    //     $fileName = $fileName ?? basename($path);

    //     return response()->download($path, $fileName, $headers, $code);
    // }
}
