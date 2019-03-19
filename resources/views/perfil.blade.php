@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Atribua um valor para os seguintes itens:</div>

                <div class="card-body">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="slidecontainer">
                            <div class="row ml-1">
                                {{_('Experiencia sobre o tema:')}}
                            <p><span id="tema" class="badge badge-primary badge-pill ml-2"></span></p>
                            </div>
                            <input type="range" min="1" max="100" value="1" class="slider" id="stema">
                        </div>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="slidecontainer">
                            <div class="row ml-1">
                            {{_('Experiencia sobre o REA:')}}
                                <p><span id="rea" class="badge badge-primary badge-pill ml-2"></span></p>
                            </div>
                            <input type="range" min="1" max="100" value="1" class="slider" id="srea">
                        </div>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="slidecontainer">
                            <div class="row ml-1">
                            {{_('Experiencia em ensino:')}}
                                <p><span id="ensino" class="badge badge-primary badge-pill ml-2"></span></p>
                            </div>
                            <input type="range" min="1" max="100" value="1" class="slider" id="sensino">
                        </div>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="slidecontainer">
                            <div class="row ml-1">
                            {{_('Conhecimento sobre o tema:')}}
                                <p><span id="conhecimento" class="badge badge-primary badge-pill ml-2"></span></p>
                            </div>
                            <input type="range" min="1" max="100" value="1" class="slider" id="sconhecimento">
                        </div>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="slidecontainer">
                            <div class="row ml-1">
                            {{_('Prática sobre o tema:')}}
                                <p><span id="pratica" class="badge badge-primary badge-pill ml-2"></span></p>
                            </div>
                            <input type="range" min="1" max="100" value="1" class="slider" id="spratica">
                        </div>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="slidecontainer">
                            <div class="row ml-1">
                            {{_('Nível de formação:')}}
                                <p><span id="formacao" class="badge badge-primary badge-pill ml-2"></span></p>
                            </div>
                            <input type="range" min="1" max="100" value="1" class="slider" id="sformacao">
                        </div>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="slidecontainer">
                            <div class="row ml-1">
                            {{_('Experiencia em projetos de REA:')}}
                                <p><span id="projeto" class="badge badge-primary badge-pill ml-2"></span></p>
                            </div>
                            <input type="range" min="1" max="100" value="1" class="slider" id="sprojeto">
                        </div>
                    </li>

                </div>
                <div class="mb-2 mr-2">
                    <div class="float-right">
                        <div class="form-group row mb-0">
                            <div class="col-md-6 d-flex flex-row">
                            <a href="{{ url()->previous() }}" role="button" class="btn btn-dark">Voltar</a>
                                <button type="submit" class="ml-2 btn btn-primary">
                                    <i class="fas fa-save mr-2"></i>
                                    {{ __('Enviar') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
