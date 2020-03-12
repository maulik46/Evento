<?php

namespace App\Http\Middleware;

use Closure;

class system_session_check
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
        if (!$request->session()->exists('sysadmin')) {
            // user value cannot be found in session
            return redirect('/s_log_in');
        }
        return $next($request);
    }
}
