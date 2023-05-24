<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class RefreshTokenMiddleware
{
    /**
     * Handle an incoming request.
     *  
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (App::environment('local')) {
            $currentToken = $request->user()->token();
            $hasExpired = $currentToken && $currentToken->created_at->addMinutes(config('sanctum.expiration'))->lte(now());
            if ($hasExpired) :
                $request->user()->tokens()->delete();
                $token = $request->user()->generateToken();
                $request->headers->set('Authorization', 'Bearer ' . $token);
            endif;
        }
        return $next($request);
    }
}
