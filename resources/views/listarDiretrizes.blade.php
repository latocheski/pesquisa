@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8 shadow p-3 mb-5 bg-white rounded">
			<div class="card border-0">
				<div class="card-header"><h4>Diretrizes:</h4></div>
				    <div class="card-body">
                    @include('alertas')
                        <div class="row mb-2">
                            <div class="col w-100">
                                <div class="col-md-4 col-lg-2 float-right p-0">
                                    <a href="{{ URL::route('criardiretriz') }}">
                                        <button type="button" name="teste" id="teste" class="btn btn-primary btn-md btn-block">Criar</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        
                        <div class="table-responsive-sm">
                            <table class="table">
                                <tbody>
                                @foreach($questoes as $area => $quest)
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col"style="width: 1%;">#</th>
                                        <th scope="col">Diretriz</th>
                                        <th scope="col">Área</th>
                                        <th scope="col"style="width: 8%;">Opções</th>
                                    </tr>
                                </thead>
                                    @foreach($quest as $questao)
                                    <tr {{$questao['ativo'] == 0 ? 'class=table-secondary' : ""}}>
                                        <th scope="row">{{$questao['qid']}}</th>
                                        <td>{{$questao['questao']}}</td>
                                        <td>{{$questao['area']}}</td>
                                        <td>
                                        <form method="POST" action="{{ route('editar.diretriz', $questao['qid']) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                                        </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
