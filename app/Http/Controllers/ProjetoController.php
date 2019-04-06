<?php

namespace App\Http\Controllers;

use App\Projeto;
use Validator;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projeto = null;
        return view('incluirpesquisa', compact('projeto'));
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
            "descricao" => "required",
            "instituicao" => "required",
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
        $dados['ativo'] = 1;
        Projeto::create($dados);
        return redirect()->route('atribuir')->with('success', 'Projeto criado com sucesso.');
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
        $projeto = Projeto::find($id);
        return view('incluirpesquisa', compact('projeto'));
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
        $dados = Projeto::find($id);
        $dados->instituicao = $request['instituicao'];
        $dados->descricao = $request['descricao'];
        $dados->ativo = $request['ativo'] == "on" ? 1 : 0;
        $dados->save();
        
        return redirect()->route('atribuir')->with('success', 'Projeto editado com sucesso.');
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
