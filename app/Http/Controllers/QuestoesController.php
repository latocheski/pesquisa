<?php

namespace App\Http\Controllers;

use App\Area;
use App\Questoes;
use Illuminate\Http\Request;
use Validator;

class QuestoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();
        $diretriz = null;
        return view('incluirperfil', compact('areas', 'diretriz'));
    }

    public function listar()
    {
        $questoes = Questoes::join('areas', 'questoes.idArea', 'areas.id')
            ->select('areas.id', 'questao', 'area', 'questoes.id as qid', 'ativo')
            ->get()
            ->groupby('area')
            ->toarray();

        return view('listarQuestoesPerfil', compact('questoes'));
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
    private function validar($request)
    {
        $validator = Validator::make($request->all(), [
            "questao" => "required",
        ]);
        return $validator;
    }

    public function store(Request $request)
    {
        $validator = $this->validar($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $dados = $request->all();
        $dados['ativo'] = $dados['ativo'] == "on" ? 1 : 0;
        Questoes::create($dados);
        return redirect()->route('listar.diretriz')->with('success', 'Diretriz criada com sucesso.');
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
        $diretriz = Questoes::find($id);
        $areas = Area::all();
        return view('incluirperfil', compact('areas', 'diretriz'));
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
        $validator = $this->validar($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        
        $dados = $request->all();
        $diretriz = Questoes::find($id);
        $diretriz['idArea'] = $dados['idArea'];
        $diretriz['questao'] = $dados['questao'];
        $diretriz['ativo'] = $dados['ativo'] == "on" ? 1 : 0;
        $diretriz->save();
        return redirect()->route('listar.diretriz')->with('success', 'Diretriz atualizada com sucesso.');
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
