<?php

namespace App\Http\Controllers\Web\Dashboard\Ui;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;

class AdminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        return inertia('Dashboard/AdminDashboard');
    }
}
