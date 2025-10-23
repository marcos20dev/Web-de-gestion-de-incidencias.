<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckActiveAccount
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && !auth()->user()->isActive()) {
            auth()->logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Tu cuenta no está activa.']);
        }

        return $next($request);
    }
}
