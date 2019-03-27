<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\QuestoesPerfil;

class QuestaoPerfil extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questoes = QuestoesPerfil::all();
        return view('questoesperfil', compact('questoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questao = null;
        return view('criarQuestaoPerfil', compact('questao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validar($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $dados = $request->all();
        $dados['ativo'] = $dados['ativo'] == "on" ? 1 : 0;
        QuestoesPerfil::create($dados);
        return redirect()->route('qperfil.index')->with('success', 'Questão criada com sucesso.');
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
        $questao = QuestoesPerfil::find($id);
        return view('criarQuestaoPerfil', compact('questao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    private function validar($request)
    {
        $validator = Validator::make($request->all(), [
            "questao" => "required",
        ]);
        return $validator;
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validar($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $questao = QuestoesPerfil::find($id);
        $questao->questao = $request['questao'];
        $questao->ativo = $request['ativo'] == "on" ? 1 : 0;
        $questao->save();
        return redirect()->route('qperfil.index')->with('success', 'Questão atualizada com sucesso.');
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
