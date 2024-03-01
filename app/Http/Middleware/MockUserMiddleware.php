<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MockUserMiddleware
{
    // for set mock user on auth
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()) {
            $defaultUser = User::first();
            auth()->setUser($defaultUser);
        }

        return $next($request);
    }
}
