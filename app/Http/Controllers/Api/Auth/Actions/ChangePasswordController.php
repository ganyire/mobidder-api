<?php

namespace App\Http\Controllers\Api\Auth\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use Illuminate\Http\JsonResponse;

/**
 * @group AUTH MANAGEMENT
 * 
 * APIs for managing authentication
 */

class ChangePasswordController extends Controller
{
    /**
     * Change password
     * 
     * @response status=200 scenario="Password changed successfully" {
     *     "message": "Password changed successfully",
     *    "payload": null
     * }
     * @response status=422 scenario="Validation errors" storage/responses/validation_error.json
     * @responseFile status=400 scenario="Generic error (400-500)" storage/responses/generic_error.json
     * 
     */
    public function __invoke(ChangePasswordRequest $request): JsonResponse
    {
        $request->user()->update([
            'password' => $request->password
        ]);

        return $this->success(message: 'Password changed successfully');
    }
}
