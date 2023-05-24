<?php

namespace App\Http\Controllers\Api\Auth\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * @group AUTH MANAGEMENT
 *  @unauthenticated
 * 
 * APIs for managing authentication
 */

class ResetPasswordController extends Controller
{
    /**
     * Reset password
     * 
     * @response status=200 scenario="Success" {
     *  "message": "Password reset successfully.",
     * "payload": null
     * }
     * @response status=422 scenario="Validation errors" storage/responses/validation_error.json
     */

    public function __invoke(ResetPasswordRequest $request, PasswordResetToken $passwordReset): JsonResponse
    {


        $user = User::query()->firstWhere('email', $request->email);

        DB::transaction(function () use ($user, $request, $passwordReset) {
            $user->update([
                'password' => $request->password,
            ]);
            $passwordReset->query()->firstWhere('email', $request->email)->delete();
        });

        return $this->success(message: 'Password reset successfully.');
    }
}
