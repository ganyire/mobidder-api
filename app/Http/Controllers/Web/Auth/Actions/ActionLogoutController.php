<?php

namespace App\Http\Controllers\Web\Auth\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionLogoutController extends Controller
{
    /**
     * Logout and destroy an authenticated session 
     */
    public function __invoke(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('ui.login'));
    }
}
