<?php

namespace App\Http\Middleware;

use Closure;

class admin_session_check
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('aname')) {
            // user value cannot be found in session
            return redirect('/slogin');
        }
        return $next($request);
    }
}
