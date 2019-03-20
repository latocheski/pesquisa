<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if ($request->user() && $request->user()->adm != 1) {
            return redirect('/')->withErrors(['Você não tem privilégio suficiente para acessar esta página.']);
        } 
        return $next($request);
    }
}
