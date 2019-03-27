<?php

namespace App\Http\Controllers;

use App\AvaliacaoQuestionario;
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

        $questoes = DB::table("questoes")
            ->select('questoes.*', 'questoes.id as idq', 'areas.area as area', 'areas.prefixo')
            ->join('areas', 'questoes.idArea', '=', 'areas.id')
            ->where('questoes.ativo', '=', 1)
            ->where('areas.ativo', '=', 1)
            ->get()
            ->groupBy('area');

        return view('questionario', compact('questoes', "idP"));
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
            if($key != "_token" && $key != "idProjeto") {
                AvaliacaoQuestionario::create([
                    'idUsuario' => $idU,
                    'idQuestao' => $key,
                    'nota' => $value,
                    'idProjeto' => $dados['idProjeto'],
                ]);
            }
            
        }
        DB::table('grupo_projetos')->where('idUsuario', '=', $idU, 'and', 'idProjeto', '=', $dados['idProjeto'])
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
    public function destroy($id)
    {
        //
    }
}
