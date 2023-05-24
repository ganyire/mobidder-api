<?php

namespace App\Http\Controllers\Api\Auth\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendPasswordResetCodeRequest;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\JsonResponse;

/**
 * @group AUTH MANAGEMENT
 * @unauthenticated
 * 
 * APIs for managing authentication
 */

class SendPasswordResetCodeController extends Controller
{
    /**
     * Send password reset code
     * 
     * @response status=200 scenario="Success" {
     *   "message": "Password reset code sent successfully. Check your email.",
     *  "payload": null
     * }
     * @response status=422 scenario="Validation errors" storage/responses/validation_error.json
     * 
     */
    public function __invoke(SendPasswordResetCodeRequest $request, PasswordResetToken $passwordReset): JsonResponse
    {
        $user = User::query()->firstWhere('email', $request->email);
        $passwordReset->sendPasswordResetTokenNotification($user);

        return $this->success(message: 'Password reset code sent successfully. Check your email.');
    }
}
