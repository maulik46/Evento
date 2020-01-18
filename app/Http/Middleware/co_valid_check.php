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
            'cuser.required' => '* Please Enter your ID',
            'password.required' => '* Please Enter your Password'
        ]);
        return $next($request);
    }
}
