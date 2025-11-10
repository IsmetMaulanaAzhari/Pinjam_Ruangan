<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next)
    {
<<<<<<< HEAD
        if (Auth::check() && Auth::user()->role_id != 1) {
=======
        if (Auth::check() && Auth::user()->role_id !== 1) {
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
            abort(403);
        }
        return $next($request);
    }
}
