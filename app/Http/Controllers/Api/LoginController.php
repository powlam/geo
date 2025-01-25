<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Models\User;
use App\Permissions\V1\Abilities;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class LoginController extends Controller
{
    /**
     * Login
     *
     * Authenticates the user and returns the user's API token.
     *
     * @unauthenticated
     *
     * @group Authentication
     *
     * @response 200 {"message":"Authenticated","statusCode":200,"data":{"token":"{YOUR_AUTH_KEY}"}}
     */
    public function __invoke(LoginUserRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->validated())) {
            return ApiResponses::error('Unauthorized', 401);
        }

        $user = User::firstWhere('email', $request->email);

        $token = $user?->createToken(
            'Authentication token',
            Abilities::getAbilities($user),
            now()->addDay()
        );

        return ApiResponses::ok(
            'Authenticated',
            [
                'token' => $token->plainTextToken ?? '',
            ]
        );
    }
}
