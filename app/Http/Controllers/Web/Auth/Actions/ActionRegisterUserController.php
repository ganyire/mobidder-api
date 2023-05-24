<?php

namespace App\Http\Controllers\Web\Auth\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use App\Notifications\CredentialsNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ActionRegisterUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterUserRequest $request): RedirectResponse
    {
        $payload = $request->validated();
        $role = $request->input('role', 'super-admin');
        $user = DB::transaction(function () use ($payload, $role) {
            $user = User::create($payload);
            $user->addRole($role);
            $user->notify(new CredentialsNotification($payload['password']));
            return $user;
        });

        auth()->login($user);

        return to_route('dashboard.admin');
    }
}
