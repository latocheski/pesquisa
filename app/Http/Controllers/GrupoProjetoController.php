<?php

namespace App\Http\Controllers;

use App\Area;
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

    public function modal(request $request)
    {
        if ( $request->ajax() ) {
            $request = $request->all();
            $respostas = DB::table('avaliacao_questionarios')
            ->select('nota', 'name', 'questao')
            ->join('questoes', 'avaliacao_questionarios.idQuestao', 'questoes.id')
            ->join('users', 'avaliacao_questionarios.idUsuario', 'users.id')
            ->where('questoes.id',  '=', $request['idQuestao'])
            ->where('idProjeto', '=', $request['idProjeto'])
            ->get()
            ->groupby('questao')
            ->toarray();
            
            return response($respostas);
        }
        return response(['msg' => 'Falha.', 'status' => 'failed']); 
    }

    public function grafico(request $request)
    {
        $id = $request['id'];
        $somatoriaGeral = 0;
        $coeficienteDiretriz = [];
        $projeto = Projeto::find($id);
        $areas = Area::all();
        $idAreaPesquisa = $request['idArea'] == null ? 0 : $request['idArea'];

        $perfilProjeto = DB::table('grupo_projetos')
            ->select('perfil_usuarios.somatorio', 'perfil_usuarios.idUsuario')
            ->join('perfil_usuarios', 'grupo_projetos.idUsuario', '=', 'perfil_usuarios.idUsuario')
            ->where('idProjeto', '=', $id)
            ->where('respondido', '=', 1)
            ->get()
            ->toarray();

        $respostas = DB::table('avaliacao_questionarios')
            ->select('idQuestao', 'nota', 'idUsuario', 'questoes.idArea')
            ->join('questoes', 'avaliacao_questionarios.idQuestao', 'questoes.id')
            ->where('questoes.idArea', ($idAreaPesquisa == 0 ? '<>' : '='), $idAreaPesquisa)
            ->where('idProjeto', '=', $id)
            ->get()
            ->groupby('idUsuario')
            ->toarray();

        foreach ($perfilProjeto as $key => $value) {
            foreach ($value as $chave => $valor) {
                if ($chave === "somatorio") {
                    $somatoriaGeral += intval($valor);
                }
            }
        }

        foreach ($perfilProjeto as $key => $value) {
            foreach ($value as $chave => $valor) {
                if ($chave === "somatorio") {
                    $perfilProjeto[$key]->somatorio = intval($valor) / $somatoriaGeral;
                }
            }
        }

        foreach ($respostas as $key => $value) {
            foreach ($value as $chave => $valor) {
                foreach ($valor as $chaveUsuario => $valorChave) {
                    $coeficienteDiretriz[$valor->idQuestao] = 0;
                }
            }
        }
        foreach ($respostas as $key => $value) {
            foreach ($value as $chave => $valor) {
                foreach ($valor as $chaveUsuario => $valorChave) {
                    if ($chaveUsuario === "nota") {
                        $coeficienteDiretriz[$valor->idQuestao] += round($this->pesquisaUsuario($valor, $perfilProjeto), 3);
                    }
                    
                }
            }
        }
        return view('grafico', compact('coeficienteDiretriz', 'projeto', 'areas', 'idAreaPesquisa'));
    }

    public function pesquisaUsuario($nota, $perfil)
    {
        foreach ($perfil as $key) {
            if ($key->idUsuario == $nota->idUsuario) {
                $calculo = $key->somatorio * $nota->nota;
            
                return $calculo;
            }
        }
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
            DB::table('avaliacao_questionarios')
            ->where('idProjeto', '=', $dados['idPesquisa'])
            ->delete(); //remove a avaliação
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
                DB::table('grupo_projetos')
                    ->where('idProjeto', '=', $dados['idPesquisa'])
                    ->where('idUsuario', '=', $idUsuario)
                    ->delete();

                DB::table('avaliacao_questionarios')
                    ->where('idUsuario', '=', $idUsuario, 'and', 'idProjeto', '=', $dados['idPesquisa'])
                    ->delete(); //remove a avaliação
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
        //
    }
}
