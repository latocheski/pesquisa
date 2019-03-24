<?php

namespace App\Http\Controllers;

use App\PerfilUsuario;
use Auth;
use DB;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $row = DB::table('perfil_usuarios')->where('idUsuario', '=', $id)->first();

        return view('perfil', compact('row'));
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
        $soma = $this->somatorio($request);        

        PerfilUsuario::create([
            'idUsuario' => auth()->user()->id,
            'tema' => $dados['tema'],
            'rea' => $dados['rea'],
            'ensino' => $dados['ensino'],
            'conhecimento' => $dados['conhecimento'],
            'pratica' => $dados['pratica'],
            'formacao' => $dados['formacao'],
            'projetos' => $dados['projeto'],
            'somatorio' => $soma,
        ]);

        return redirect()->route('home');
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
        $dados = $request->all();

        $usuario = PerfilUsuario::find($id);
        $usuario->tema = $request->get('tema');
        $usuario->rea = $request->get('rea');
        $usuario->ensino = $request->get('ensino');
        $usuario->conhecimento = $request->get('conhecimento');
        $usuario->pratica = $request->get('pratica');
        $usuario->formacao = $request->get('formacao');
        $usuario->projetos = $request->get('projeto');
        $usuario->somatorio = $this->somatorio($request);
        $usuario->save();
        
        return redirect()->route('home')
            ->with('success', 'Perfil atualizado com sucesso.');
    }

    public function somatorio(Request $request)
    {
        $itens = ['tema', 'rea', 'ensino', 'conhecimento', 'pratica', 'formacao', 'projeto'];
        $soma = 0;        
        
        foreach ($itens as  $item) {  
            $soma += $request->get($item);
        }
        return $soma;
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
