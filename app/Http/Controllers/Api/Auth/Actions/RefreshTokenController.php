<?php

namespace App\Http\Controllers\Api\Auth\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @group AUTH MANAGEMENT
 */

class RefreshTokenController extends Controller
{
    /**
     * Refresh Token
     * 
     * @response status=200 scenario='successful refresh' {
     *      "message": "Token refreshed successfully",
     *      "payload": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
     * }
     * 
     */
    public function __invoke(Request $request)
    {
        $request->user()->tokens()->delete();
        $token = $request->user()->generateToken();
        return $this->success(message: 'Token refreshed successfully', data: $token, httpCode: 200);
    }
}
