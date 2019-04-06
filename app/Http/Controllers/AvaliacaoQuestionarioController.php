<?php

namespace App\Http\Controllers;

use App\AvaliacaoQuestionario;
use App\Projeto;
use Auth;
use DB;
use Illuminate\Http\Request;

class AvaliacaoQuestionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idP)
    {
        $novo = null;
        $projeto = Projeto::find($idP);
        
        $questoes = DB::table("questoes")
            ->select('questoes.*', 'questoes.id as idq', 'areas.area as area', 'areas.prefixo')
            ->join('areas', 'questoes.idArea', '=', 'areas.id')
            ->where('questoes.ativo', '=', 1)
            ->where('areas.ativo', '=', 1)
            ->get()
            ->groupBy('area');

        return view('questionario', compact('questoes', "idP", "novo", "projeto"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dados = $request->all();
        $idU = auth()->user()->id;

        foreach ($dados as $key => $value) {
            if ($key != "_token" && $key != "idProjeto" && $key != "_method") {
                AvaliacaoQuestionario::create([
                    'idUsuario' => $idU,
                    'idQuestao' => $key,
                    'nota' => $value,
                    'idProjeto' => $dados['idProjeto'],
                ]);
            }

        }

        DB::table('grupo_projetos')
            ->where('idProjeto', '=', $dados['idProjeto'])
            ->where('idUsuario', '=', $idU)
            ->update(['respondido' => 1]);

        return redirect()->route('home')->with('success', 'Questionário avaliado com sucesso.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $novo = 1;
        $idU = auth()->user()->id;
        $idP = $id;
        $projeto = Projeto::find($id);

        $questoes = DB::table("questoes")
            ->select('questoes.*', 'questoes.id as idq', 'areas.area as area', 'areas.prefixo', 'avaliacao_questionarios.nota as nota')
            ->join('areas', 'questoes.idArea', '=', 'areas.id')
            ->join('avaliacao_questionarios', 'questoes.id', '=', 'avaliacao_questionarios.idQuestao')
            ->where('questoes.ativo', '=', 1)
            ->where('areas.ativo', '=', 1)
            ->where('avaliacao_questionarios.idProjeto', '=', $id)
            ->where('avaliacao_questionarios.idUsuario', '=', $idU)
            ->get()
            ->groupBy('area');
        
        return view('questionario', compact('questoes', "idP", "novo", "projeto"));
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
        $dados = $request->all();
        $idProjeto = $dados['idProjeto'];
        $idU = auth()->user()->id;
        $questionario = [];
        
        foreach ($dados as $key => $value) {
            if ($key != "_token" && $key != "idProjeto" && $key != "_method") {
                $questionario[$key] = DB::table("avaliacao_questionarios")
                    ->select("nota", "id")
                    ->where("idQuestao", "=", $key)
                    ->where("idUsuario", "=", $idU)
                    ->where("idProjeto", "=", $idProjeto)
                    ->first()
                ;
                $banco = AvaliacaoQuestionario::find($questionario[$key]->id);
                $banco->nota = $value;
                
                $banco->save();
            }

        }
        //return dump($questionario);
        
        return redirect()->route('home')->with('success', 'Questionário atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
