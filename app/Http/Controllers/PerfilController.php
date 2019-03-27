<?php

namespace App\Http\Controllers;

use App\PerfilUsuario;
use App\QuestoesPerfil;
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
        $questoes = QuestoesPerfil::where('ativo', '=', 1)->get();
        $row = DB::table('perfil_usuarios')
            ->select('idQuestaoPerfil', 'nota')
            ->where('idUsuario', '=', $id)
            ->get()
            ->groupby('idQuestaoPerfil')
            ->toarray();

        return view('perfil', compact('row', 'questoes'));
    }

    public function atualizar()
    {
        $id = auth()->user()->id;
        $perfil = DB::table('perfil_usuarios')
            ->where('idUsuario', '=', $id)
            ->select('idQuestaoPerfil as id')
            ->get()->toarray();
        $respostas = [];
        $ids = [];
        $responder = [];
        $todasQuestoesPerfil = DB::table('questoes_perfil')->select('id')->where('ativo', '=', 1)->get()->toarray();

        foreach ($perfil as $value) {
            foreach ($value as $key => $valor) {
                array_push($respostas, $valor);
            }            
        }
        foreach ($todasQuestoesPerfil as $value) {
            foreach ($value as $key => $valor) {
                array_push($ids, $valor);
            }            
        }
        $ids = array_diff($ids, $respostas);
        
        $questoes = QuestoesPerfil::find($ids);
        $row = null;
        
        return view('perfil', compact('row', 'questoes'));
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
        $dados = $request->except('_token', '_method');
        $user = auth()->user()->id;

        foreach ($dados as $key => $value) {
            PerfilUsuario::create([
                'idUsuario' => intval($user),
                'idQuestaoPerfil' => intval($key),
                'nota' => intval($value),
            ]);
        }

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
        $dados = $request->except('_token', '_method');

        foreach ($dados as $key => $value) {
            DB::table('perfil_usuarios')
                ->where('idUsuario', '=', $id)
                ->where('idQuestaoPerfil', '=', $key)
                ->update(['nota' => $value]);
        }

        return redirect()->route('home')
            ->with('success', 'Perfil atualizado com sucesso.');
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
