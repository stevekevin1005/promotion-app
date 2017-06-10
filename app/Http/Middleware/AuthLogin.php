<?php

namespace App\Http\Middleware;
use Session, Closure;

class AuthLogin
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('name')) {
          return redirect('/login');
        }

        return $next($request);
    }
}
