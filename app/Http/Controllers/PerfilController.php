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
        $row = DB::table('perfil_usuarios')->where('idUsuario', '=', $id)->get();
        if (!$row->isEmpty()) {
            return redirect('home');
        }
        return view('perfil');
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
        $soma =0;
        foreach ($dados as $key => $value) {
            if ($key != "idUsuario") {
                $soma += intval($value);
            }
        }

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

    public function grafico()
    {

        $perfil = DB::table("perfil_usuarios")
            ->select('perfil_usuarios.tema', 'perfil_usuarios.rea', 'perfil_usuarios.ensino', 'perfil_usuarios.conhecimento',
            'perfil_usuarios.pratica', 'perfil_usuarios.formacao','perfil_usuarios.projetos')
            ->get();
            
        return view('perfil.index', compact('perfil'));
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
