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

    public function selecao()
    {
        $projeto = Projeto::paginate(10);
        return view('select', compact('projeto'));
    }

    public function grafico($id)
    {
        $dados = DB::table('avaliacao_questionarios')->where('idProjeto', '=', $id)
        ->select('idQuestao', 'nota', 'idUsuario')
        ->get()
        ->groupby('idUsuario');
        return view('grafico', compact('dados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function participantes($idatual)
    {
        $usuarios = User::where('adm', '<>', '1')->get();
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
        } else { //sem participantes
            DB::table('grupo_projetos')->where('idProjeto', '=', $dados['idPesquisa'])->delete(); //remove o grupo pois nenhum participante foi selecionado
            DB::table('avaliacao_questionarios')->where('idProjeto', '=', $dados['idPesquisa'])->delete(); //remove a avaliação caso ja respondida
        }

        if (!empty($novos)) { //cria novos participantes
            foreach ($novos as $idUsuario) {
                GrupoProjeto::create([
                    'idUsuario' => $idUsuario,
                    'respondido' => 0,
                    'idProjeto' => $dados['idPesquisa'],
                ]);
            }
        }

        if (!empty($velhos)) { //remove participantes antigos
            foreach ($velhos as $idUsuario) {
                $this->destroy($dados['idPesquisa'], $idUsuario);
                DB::table('avaliacao_questionarios')->where('idProjeto', '=', $dados['idPesquisa'], 'and', 'idUsuario', '=', $idUsuario)->delete(); //remove a avaliação
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
