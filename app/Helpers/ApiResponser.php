<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Resources\Json\JsonResource as HttpJsonResource;

class ApiResponser {

    public static function success($data, $message = null, $code = 200): JsonResponse
    {
        if ($data instanceof HttpJsonResource) $data = $data->resolve();

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
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
