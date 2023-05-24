<?php

namespace App\Http\Controllers\Web\Auth\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ActionChangePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ChangePasswordRequest $request): RedirectResponse
    {
        $request->user()->update([
            'password' => $request->password,
        ]);
        // $request->user()->unverifyEmailAddress();

        return back()->with('success', 'Password changed successfully!');
    }
}
