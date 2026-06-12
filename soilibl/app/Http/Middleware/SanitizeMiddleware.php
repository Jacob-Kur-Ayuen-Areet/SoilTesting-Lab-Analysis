<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class SanitizeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
    
     */
    public function handle(Request $request, Closure $next)
    {
      

        foreach ($request->input() as $key => $value) {
            if (empty($value) || $value =="") {
              if($value !== '0')
              $request->request->remove($key);
            }
        }

        return $next($request);
    }
}
