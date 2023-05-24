<?php

namespace App\Http\Controllers\Web\Profile\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Traits\Responder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class UpdateProfileController extends Controller
{

    public function __invoke(UpdateProfileRequest $request): RedirectResponse
    {
        $payload = $this->filterNull($request->validated());
        DB::transaction(function () use ($payload, $request) {
            $user = $request->user();
            $user->update($payload);
            if (!empty($payload['role'])) {
                $user->syncRoles([$payload['role']]);
            }
        });
        return back()->with('success', 'Profile updated successfully');
    }
}
