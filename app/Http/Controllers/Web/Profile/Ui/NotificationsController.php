<?php

namespace App\Http\Controllers\Web\Profile\Ui;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;

class NotificationsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        return inertia('Profile/Notifications');
    }
}
