<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
class userMiddleware
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
        if(auth()->check() && auth()->user()->role == 'user')
        {
          return $next($request);
        }
        return new Response(view('noAutorizadouser'));
    }
}
