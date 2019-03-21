<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class PerfilCheck
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
        if ($request->user()) {
            $id = $request->user()->id;
            $row = DB::table('perfil_usuarios')->where('idUsuario', '=', $id)->get();
            if ($row->isEmpty() && $request->user()->adm != 1) {
                return redirect('perfil');
            }
        }
        return $next($request);
    }
}
