<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use App\PerfilUsuario;
use App\QuestoesPerfil;

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
            $perfil = PerfilUsuario::where('idUsuario', '=', $id)
            ->get();
            $questoesPerfil = QuestoesPerfil::where('ativo', '=', 1)->get();
            
            if($questoesPerfil->count() > $perfil->count() && $request->user()->adm != 1) {
                return redirect('atualizar');
            }            
        }
        return $next($request);
    }
}
