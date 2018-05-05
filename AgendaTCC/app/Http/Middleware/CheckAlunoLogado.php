<?php

namespace App\Http\Middleware;

use Closure;

class CheckAlunoLogado
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
        if(!auth()->check()){
            dd("sucess");
            return $next($request);

        }
        return redirect('/login');
    }
}
