@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Atribuir pesquisa:</div>
                <div class="card-body">
                    <div style="overflow-x:auto;">
                    @if($projeto->isEmpty())
                                <div class="alert alert-danger" role="alert">
                                    Sem projeto cadastrado.
                                </div>
                    @else
                        <table class="table" data-toggle="deleteForm" data-form="deleteForm">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="row">{{__('Descrição')}}</th>
                                    <th>{{__('Instituição')}}</th>
                                    <th>{{__('Participantes')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projeto as $proj)
                                <tr>
                                    <td scope="row">{{$proj->descricao}}</td>
                                    <td>{{$proj->instituicao}}</td>
                                    <td>
                                    @csrf {{ method_field('SUBMIT') }}
                                    {!! Form::model($proj, ['method' => 'POST', 'route' => ['participantes', $proj->id]]) !!}
                                    {!! Form::hidden('id', $proj->id) !!}
                                    {!! Form::button('Selecionar', ['type' => 'submit', 'class' => 'btn btn-primary'] ) !!}
                                    {!! Form::close() !!}                                    
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        {!! $projeto->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection