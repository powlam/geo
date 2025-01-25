<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class RegisterController extends Controller
{
    public function __invoke(RegisterUserRequest $request): JsonResponse
    {
        User::create($request->validated());

        return ApiResponses::ok('Registered!');
    }
}
