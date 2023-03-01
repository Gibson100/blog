<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomCKFinderAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $config['authentication'] = '\App\Http\Middleware\CustomCKFinderAuth';

        config(['ckfinder.authentication' => function() {
            return true;
        }]);
        return $next($request);
    }
}
