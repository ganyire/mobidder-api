<?php

namespace App\Http\Controllers\Web\Auth\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActionSendEmailVerificationCodeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmailAddress()) {
            return back()->with('error', 'Your email address has already been verified');
        }
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verification code has been sent to your email address');
    }
}
