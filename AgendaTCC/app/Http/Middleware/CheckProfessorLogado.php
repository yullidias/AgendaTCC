<?php

namespace App\Http\Middleware;

use Closure;

class CheckProfessorLogado
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
            if(auth()->user()["professor"] == 1)
                return $next($request);
            else
                return redirect('/');
        }
        return redirect('/');

    }
}
