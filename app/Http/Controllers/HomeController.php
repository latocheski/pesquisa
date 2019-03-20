<?php

namespace App\Http\Controllers;

use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentuserid = Auth::user()->id;

        $projetos = DB::table("grupo_projetos")
            ->select('projetos.descricao as descricao', 'projetos.instituicao as instituicao', 'grupo_projetos.*')
            ->join('projetos', 'grupo_projetos.idProjeto', '=', 'projetos.id')
            ->where('grupo_projetos.idUsuario', '=', $currentuserid)
            ->where('grupo_projetos.respondido', '=', '0')
            ->paginate(5);

        return view('home', compact('projetos'));

    }
}
