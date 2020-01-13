<?php

namespace App\Http\Middleware;

use Closure;

class CookieCheck
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
        $response= $next($request);
        $check=$request->remainder;
        if($check==1)
        {
            $minutes=3600;
            cookie()->queue('clgcode', $request->clgcode, $minutes);
            cookie()->queue('senrl', $request->senrl, $minutes);
        }
        return $response;
    }
}
