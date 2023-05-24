<?php

namespace App\Http\Controllers\Web\Auth\Ui;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;

class RegisterUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): Response
    {
        return inertia('Auth/Register');
    }
}
