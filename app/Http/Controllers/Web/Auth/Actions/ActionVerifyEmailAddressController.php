<?php

namespace App\Http\Controllers\Web\Auth\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActionVerifyEmailAddressController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email_verification_token' => ['required', 'string', 'size:6', 'exists:users,email_verification_token'],
        ]);

        if ($request->user()->hasVerifiedEmailAddress()) {
            return back()->with('error', 'Your email address has already been verified');
        }
        $request->user()->markEmailAddressAsVerified();

        return back()->with('success', 'Your email address has been verified');
    }
}
