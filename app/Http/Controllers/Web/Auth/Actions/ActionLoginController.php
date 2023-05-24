<?php

namespace App\Http\Controllers\Web\Auth\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ActionLoginController extends Controller
{

    public function __invoke(LoginRequest $request): RedirectResponse
    {
        $payload = $request->validated();
        if (!Auth::attempt($payload)) {
            return back()->with('error', 'Invalid login credentials');
        }
        return redirect()->intended(route('dashboard.admin'));
    }
}
