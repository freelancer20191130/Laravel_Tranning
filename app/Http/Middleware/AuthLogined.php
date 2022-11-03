<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthLogined
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('login_session')){
            return $next($request);
        }
        else {
            return redirect('/');
        }
    }
}
