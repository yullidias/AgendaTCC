<?php

namespace App\Http\Middleware;

use Closure;

class CheckOrientadorLogado
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
        if(auth()->check()){
            if(auth()->user()["professor"] == 1 and auth()->user()["orientador"]==1)
                return $next($request);
            else
                return redirect('/');
            return $next($request);
        }
        return redirect('/');
    }
}
