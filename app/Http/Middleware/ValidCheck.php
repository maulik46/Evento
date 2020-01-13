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
            'clgcode.required' => '* Please Select Your college Name',
            'senrl.required' => '* Please Enter your Enrollment Number',
            'senrl.max' => '* Enter Proper Enrollment Number',
            'senrl.min' => '* Enter Proper Enrollment Number'
        ]);
        return $next($request);
    }
}
