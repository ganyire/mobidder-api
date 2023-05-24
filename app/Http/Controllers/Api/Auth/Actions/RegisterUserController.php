<?php

namespace App\Http\Controllers\Api\Auth\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Notifications\CredentialsNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Knuckles\Scribe\Attributes\Group;

/**
 * @group AUTH MANAGEMENT
 */

class RegisterUserController extends Controller
{

    /**
     * Register
     * 
     * Endpoint for registering a new user.
     * 
     * @responseFile status=201 scenario='successful registration' storage/responses/register_user.json 
     * @responseFile status=422 scenario='validation errors' storage/responses/validation_errors.json
     * @responseFile status=400 scenario='generic error (400-500)' storage/responses/generic_error.json
     *  
     * @unauthenticated
     */
    public function __invoke(RegisterUserRequest $request): JsonResponse
    {

        $user = DB::transaction(function () use ($request) {
            $user = User::create($request->validated());
            $user->addRole($request->role);
            if ($request->street) {
                $user->address()->create($request->validated());
                $user->load('address');
            }
            $user->notify(new CredentialsNotification($request->password));
            return $user;
        });

        $token = $user->generateToken();
        auth()->login($user);

        $data = new UserResource(resource: $user, _token: $token);

        return $this->success(message: 'Account created successfully', data: $data, httpCode: 201);
    }
}
