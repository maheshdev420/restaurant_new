<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('web')->check()) {
            return redirect(route(RouteServiceProvider::HOME));
        }

        if (Auth::guard('user')->check()) {
            return redirect(route('front.home'));
        }

        return $next($request);
    }
}
