<?php

namespace App\Http\Controllers\Api\User\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group USER MANAGEMENT
 * 
 * APIs for managing users
 */

class UpdateProfileController extends Controller
{
    /**
     * Update profile
     */
    public function __invoke(UpdateProfileRequest $request): JsonResponse
    {
        //
    }
}
