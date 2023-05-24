<?php

namespace App\Http\Controllers\Web\Auth\Ui;

use App\Http\Controllers\Controller;
use Inertia\Response;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): Response
    {
        return inertia('Auth/Login');
    }
}
