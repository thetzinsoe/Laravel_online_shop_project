<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check())
        {
            if(url()->current() == route('auth#loginPage') || url()->current() == route('auth#registerPage'))
            {
                return back();
            }
            if(Auth::user()->role == 'admin'){
                return back();
            }
            return $next($request);
        }
    }
}
