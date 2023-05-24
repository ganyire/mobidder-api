<?php

namespace App\Http\Controllers\Api\Auth\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Knuckles\Scribe\Attributes\Group;


/**
 * @group AUTH MANAGEMENT
 */

class LoginController extends Controller
{
    /**
     * Login
     * 
     * Endpoint for signing in a user.
     * 
     * @responseFile status=200 scenario="Successful login" storage/responses/login.json
     * @response status=401 scenario="Invalid login credentials" {
     *      "message": "Invalid login credentials",
     *      "payload": null
     * }
     * @responseFile status=400 scenario="Generic error (400-500)" storage/responses/generic_error.json
     * 
     * @unauthenticated
     * 
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $payload = $request->validated();
        if (!Auth::attempt($payload)) {
            return $this->error(message: 'Invalid login credentials', httpCode: 401);
        }
        $user = User::query()->firstWhere('email', $payload['email']);
        $user->load('address');

        $token = $user->generateToken();

        $data = new UserResource(resource: $user, _token: $token);
        return $this->success(data: $data);
    }
}
