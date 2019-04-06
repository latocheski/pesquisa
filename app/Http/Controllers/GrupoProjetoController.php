<?php

namespace App\Http\Controllers;

use App\Area;
use App\GrupoProjeto;
use App\Projeto;
use App\Questoes;
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
        if ($request->ajax()) {
            $request = $request->all();
            $respostas = DB::table('avaliacao_questionarios')
                ->select('nota', 'name', 'questao', 'prefixo')
                ->join('questoes', 'avaliacao_questionarios.idQuestao', 'questoes.id')
                ->join('users', 'avaliacao_questionarios.idUsuario', 'users.id')
                ->join('areas', 'questoes.idArea', 'areas.id')
                ->where('questoes.id', '=', $request['idQuestao'])
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
        $coeficienteDiretriz = [];
        $projeto = Projeto::find($id);
        $areas = Area::where('ativo', '=', 1)->get();
        $idAreaPesquisa = $request['idArea'] == null ? 0 : $request['idArea'];
        $indicePerfilIndividual = [];
        $irea = 0;
        $questoesPorArea = Questoes::join('areas', 'questoes.idArea', 'areas.id')
            ->where('questoes.idArea', ($idAreaPesquisa == 0 ? '<>' : '='), $idAreaPesquisa)
            ->where('questoes.ativo', '=', '1')
            ->select('areas.id as area', 'questoes.id as questao')
            ->get()
            ->groupby('area')
            ->toarray();
        $mediaPorArea = Area::where('ativo', '=', 1)
            ->where('id', ($idAreaPesquisa == 0 ? '<>' : '='), $idAreaPesquisa)
            ->select('id')
            ->get()
            ->keyBy('id')
            ->toarray();
        foreach ($mediaPorArea as $key => $value) {
            $mediaPorArea[$key] = 0;
        }

        $somatoriaGeral = DB::table('grupo_projetos') //dividir nota do participante pelo somatorio e atribuir ao array
            ->select('perfil_usuarios.nota', 'perfil_usuarios.idUsuario')
            ->join('perfil_usuarios', 'grupo_projetos.idUsuario', '=', 'perfil_usuarios.idUsuario')
            ->join('questoes_perfil', 'perfil_usuarios.idQuestaoPerfil', '=', 'questoes_perfil.id')
            ->where('idProjeto', '=', $id)
            ->where('respondido', '=', 1)
            ->where('questoes_perfil.ativo', '=', 1)
            ->sum('nota');

        $respostas = DB::table('avaliacao_questionarios')
            ->select('idQuestao', 'nota', 'idUsuario', 'questoes.idArea')
            ->join('questoes', 'avaliacao_questionarios.idQuestao', 'questoes.id')
            ->where('questoes.idArea', ($idAreaPesquisa == 0 ? '<>' : '='), $idAreaPesquisa)
            ->where('idProjeto', '=', $id)
            ->where('questoes.ativo', '=', 1)
            ->get()
            ->groupby('idUsuario')
            ->toarray();

        $perfilProjeto = DB::table('grupo_projetos') //dividir nota do participante pelo somatorio e atribuir ao array
            ->select('perfil_usuarios.nota', 'perfil_usuarios.idUsuario')
            ->join('perfil_usuarios', 'grupo_projetos.idUsuario', '=', 'perfil_usuarios.idUsuario')
            ->join('questoes_perfil', 'perfil_usuarios.idQuestaoPerfil', '=', 'questoes_perfil.id')
            ->where('idProjeto', '=', $id)
            ->where('respondido', '=', 1)
            ->where('questoes_perfil.ativo', '=', 1)
            ->get()
            ->groupby('idUsuario')
            ->toarray();

        foreach ($perfilProjeto as $idUsuario => $usuario) {
            foreach ($usuario as $atributo => $valor) {
                $indicePerfilIndividual[$valor->idUsuario] = 0;
                break;
            }
        }
        foreach ($perfilProjeto as $idUsuario => $usuario) {
            foreach ($usuario as $atributo => $valor) {
                $indicePerfilIndividual[$valor->idUsuario] += $valor->nota;
            }
        }
        foreach ($perfilProjeto as $idUsuario => $usuario) {
            foreach ($usuario as $atributo => $valor) {
                $indicePerfilIndividual[$valor->idUsuario] = round($indicePerfilIndividual[$valor->idUsuario] / $somatoriaGeral, 3);
                break;
            }
        }

        foreach ($respostas as $key => $value) {
            foreach ($value as $chave => $valor) {
                foreach ($valor as $chaveUsuario => $valorChave) {
                    $coeficienteDiretriz[$valor->idQuestao] = 0;
                    break;
                }
            }
        }

        foreach ($respostas as $key => $value) {
            foreach ($value as $chave => $valor) {
                foreach ($valor as $chaveUsuario => $valorChave) {
                    if ($chaveUsuario === "nota") {
                        $coeficienteDiretriz[$valor->idQuestao] += round($this->pesquisaUsuario($valor, $indicePerfilIndividual), 3);
                    }

                }
            }
        }
        if ($coeficienteDiretriz != null) {
            foreach ($questoesPorArea as $array) {
                foreach ($array as $key => $v) {
                    $mediaPorArea[$v['area']] += $coeficienteDiretriz[$v['questao']];
                }
                $mediaPorArea[$array[0]['area']] /= count($array);
            }

            foreach ($mediaPorArea as $key => $value) {
                $irea += $value;
            }
            $irea /= count($mediaPorArea);
        }

        return view('grafico', compact('coeficienteDiretriz', 'projeto', 'areas', 'idAreaPesquisa', 'irea'));
    }

    public function pesquisaUsuario($nota, $perfil)
    {
        foreach ($perfil as $key => $indiciIndividual) {
            if ($key == $nota->idUsuario) {
                $calculo = $indiciIndividual * $nota->nota;
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
        $projeto = Projeto::find($idatual);

        return view('participantes', compact('usuarios', 'grupo', 'idatual', 'projeto'));
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
