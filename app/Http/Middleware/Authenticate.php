<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;
use Auth;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (in_array('sanctum', $guards) && !Auth::guard('sanctum')->check()) {
            return response()->json(['status' => false, 'message' => 'User Not Authenticate'],401);
        }
        if (in_array('web', $guards) && !Auth::guard('sanctum')->check()) {
            return redirect()->route('login');
        }
        if (in_array('user', $guards) && !Auth::guard('user')->check()) {
            return redirect()->route('front.login.form');
        }
        return $next($request);
    }
}
