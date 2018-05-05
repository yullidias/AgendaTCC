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
        // Permite que continue (Caso não entre em nenhum dos if acima)...
        return redirect('/login');

    }
}
