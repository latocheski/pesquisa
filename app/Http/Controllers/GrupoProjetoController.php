<?php

namespace App\Http\Controllers;

use App\GrupoProjeto;
use App\Projeto;
use App\User;
use DB;
use Illuminate\Http\Request;

class GrupoProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projeto = Projeto::paginate(10);
        return view('atribuir', compact('projeto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function participantes($idatual)
    {
        $usuarios = User::all();
        $grupo = DB::table('grupo_projetos')->where('idProjeto', '=', $idatual)->get();
        return view('participantes', compact('usuarios', 'grupo', 'idatual'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ids;
        $dados = $request->all();
        $participantes = DB::table('grupo_projetos')
            ->select('idUsuario as id')
            ->where('idProjeto', '=', $dados['idPesquisa'])
            ->get()
            ->toArray();

        $participantes = array_column($participantes, 'id');
        if (count($dados) == 3) {
            $ids = array_map(
                function ($value) {return (int) $value;},
                $dados['id']
            );
            $novos = array_diff($ids, $participantes);
            $velhos = array_diff($participantes, $ids);
        } else {
            DB::table('grupo_projetos')->where('idProjeto', '=', $dados['idPesquisa'])->delete();
        }

        if (!empty($novos)) { //cria novos participantes
            foreach ($novos as $key) {
                GrupoProjeto::create([
                    'idUsuario' => $key,
                    'respondido' => 0,
                    'idProjeto' => $dados['idPesquisa'],
                ]);
            }
        }

        if (!empty($velhos)) { //remove participantes antigos
            foreach ($velhos as $key) {
                $this->destroy($dados['idPesquisa'], $key);
            }
        }

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $user)
    {
        DB::table('grupo_projetos')
            ->where('idProjeto', '=', $id)
            ->where('idUsuario', '=', $user)
            ->delete();
    }
}
