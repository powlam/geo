<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponses;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class LogoutController extends Controller
{
    /**
     * Logout
     *
     * Signs out the user and destroys the API token.
     *
     * @group Authentication
     *
     * @response 200 {}
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->user()?->tokens()->delete();

        return ApiResponses::ok('Logged out!');
    }
}
