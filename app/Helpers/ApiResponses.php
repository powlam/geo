<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

final class ApiResponses
{
    /**
     * @param  array<string, string>  $data
     */
    public static function ok(string $message, array $data = []): JsonResponse
    {
        return self::successResponse($message, $data, 200);
    }

    /**
     * @param  array<string, string>  $data
     */
    public static function successResponse(string $message, array $data = [], int $code = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'statusCode' => $code,
            'data' => $data,
        ], $code);
    }

    /**
     * @param  string|array<int, array<string, string>>  $errors
     */
    public static function error(string|array $errors = [], ?int $statusCode = null): JsonResponse
    {
        if (is_string($errors)) {
            $errors = [
                [
                    'message' => $errors,
                    'status' => $statusCode ?? 400,
                ],
            ];
        }

        return response()->json([
            'errors' => $errors,
        ]);
    }

    /**
     * @param  ModelNotFoundException<Model>  $e
     */
    public static function sourceOfModelNotFoundException(ModelNotFoundException $e): string
    {
        return basename($e->getModel()).' : '.implode(', ', $e->getIds());
    }
}
