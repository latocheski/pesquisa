<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use Validator;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();
        return view('areas', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $area = null;
        return view('criararea', compact('area'));
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
        Area::create($dados);
        return redirect()->route('area.index')->with('success', 'Área criada com sucesso.');
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

    private function validar($request)
    {
        $validator = Validator::make($request->all(), [
            "area" => "required",
            "prefixo" => "required",
        ]);
        return $validator;
    }
  
    public function edit($id)
    {
        $area = Area::find($id);
        return view('criararea', compact('area'));
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
        $area = Area::find($id);
        $area->area = $request['area'];
        $area->prefixo = $request['prefixo'];
        $area->ativo = $request['ativo'] == "on" ? 1 : 0;
        $area->save();
        return redirect()->route('area.index')->with('success', 'Área atualizada com sucesso.');
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
