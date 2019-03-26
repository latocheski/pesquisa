@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Diretrizes:</div>
				    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table">
				            @include('alertas')
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


@endsection
