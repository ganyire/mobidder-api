<?php

namespace App\Http\Controllers\Api\Auth\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangeEmailAddressRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group AUTH MANAGEMENT
 * 
 * APIs for managing authentication
 */

class ChangeEmailAddressController extends Controller
{
    /**
     * Change email address
     * 
     * @response status=200 scenario="Success" {
     *    "message": "Email address changed successfully",
     *   "payload": "lenny@app.com"
     * }
     * 
     */
    public function __invoke(ChangeEmailAddressRequest $request): JsonResponse
    {
        // return $this->success(message: 'Email address changed successfully', data: $request->user());

        $request->user()->update([
            'email' => $request->email
        ]);
        $request->user()->unverifyEmailAddress();

        return $this->success(message: 'Email address changed successfully', data: $request->user()->email);
    }
}
