<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
class AdminMiddleware
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
        /*if($request->user() && $request->user()->role =='admin') 
        {
            return $next($request);
        }
        return redirect('login');*/

       // return $next($request);

        if(auth()->check() && auth()->user()->role == 'admin')
        {
          return $next($request);
        }
        return new Response(view('noAutorizadoadmin'));

    }
}
