<?php

namespace App\Http\Middleware;

use Closure;

class co_valid_check
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
        
        $request->validate([
            'cuser' => 'required',
            'password' => 'required'
        ],[
            'cuser.required' => 'Please Enter Your Email',
            'password.required' => 'Please Enter Your Password'
        ]);
        return $next($request);
    }
}
