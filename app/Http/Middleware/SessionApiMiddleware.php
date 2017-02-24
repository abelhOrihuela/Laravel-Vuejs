<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class SessionApiMiddleware
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

      if(!Session::get('type_user')){
        return redirect('/');
      }
      return $next($request);

    }
}
