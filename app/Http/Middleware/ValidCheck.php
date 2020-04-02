<?php

namespace App\Http\Middleware;

use Closure;

class ValidCheck
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
            'clgcode' => 'required',
            'senrl' => 'required | max:15 | min:6 '
        ],[
            'clgcode.required' => 'Please select your college Name',
            'senrl.required' => 'Please enter your Enrollment Number',
            'senrl.max' => 'Please enter valid Enrollment Number',
            'senrl.min' => 'Please enter valid Enrollment Number'
        ]);
        return $next($request);
    }
}
