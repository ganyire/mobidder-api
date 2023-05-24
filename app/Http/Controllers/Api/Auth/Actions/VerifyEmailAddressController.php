<?php

namespace App\Http\Controllers\Api\Auth\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyEmailRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group AUTH MANAGEMENT
 * 
 * APIs for managing authentication
 */

class VerifyEmailAddressController extends Controller
{
    /**
     * Verify email address
     * 
     * @subgroup Email verification
     * 
     * @response status=200 scenario="Success" {
     *    "message": "Your email address has been verified successfully",
     *    "payload": null
     * }
     * 
     */
    public function __invoke(VerifyEmailRequest $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmailAddress()) {
            return $this->error(message: 'Your email address has been verified already');
        }
        $request->user()->markEmailAddressAsVerified();

        return $this->success(message: 'Your email address has been verified successfully');
    }
}
