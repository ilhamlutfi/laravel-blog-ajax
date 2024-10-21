<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WriterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check yang login penulis dan harus verified
        if ($request->user()->hasRole('writer') && !auth()->user()->is_verified) {
            return response()->view('backend.writers.unverified', ['owner_email' => 'ilhamlutfi@gmail.com'], 403);
        }
        return $next($request);
    }
}
