<?php

namespace App\Http\Controllers\Web\Auth\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActionChangeEmailAddressController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:users,email'
        ]);
        $request->user()->update([
            'email' => $request->email
        ]);
        $request->user()->unverifyEmailAddress();

        return back()->with('success', 'Email address changed successfully');
    }
}
