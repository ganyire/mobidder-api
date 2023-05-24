<?php

namespace App\Http\Controllers\Api\Auth\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group AUTH MANAGEMENT
 * 
 * APIs for managing authentication
 */

class SendEmailVerificationCodeController extends Controller
{

    /**
     * Sent email verification code
     * 
     * @subgroup Email verification
     * @subgroupDescription Endpoints for managing email verification
     * 
     * @response status=200 scenario="Success" {
     *   "message": "Verification code has been sent to your email address",
     *   "payload": null
     * }
     * @response status=400 scenario="Email address has already been verified" {
     *    "message": "Your email address has already been verified",
     *    "payload": null
     * }
     * 
     */
    public function __invoke(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmailAddress()) {
            return $this->error(message: 'Your email address has already been verified');
        }
        $request->user()->sendMailVerificationNotification();

        return $this->success(message: 'Verification code has been sent to your email address');
    }
}
