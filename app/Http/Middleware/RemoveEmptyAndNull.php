<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemoveEmptyAndNull
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestData = $request->all();
        $data =  collect($requestData)
            ->filter(fn ($value) => !empty($value) && !is_null($value) && $value !== '')
            ->toArray();

        $request->replace($data);
        return $next($request);
    }
}
