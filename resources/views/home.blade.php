@extends('layouts.app')

@section('content')
@if(Auth::user()->adm > 0)
@include('adm.dash')
@else
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8 shadow p-0 mb-3 mt-3 bg-white rounded">
			<div class="card border-0">
					<div class="card-header bg-success text-white">Questionário(s) disponívei(s):</div>
					<div class="card-body">
						@include('alertas')
						@php($n = 0)
						@foreach($projetos as $key)
						@if($key->respondido != 1)
						@php($n++)
						<div class="card mb-3">
							<h5 class="card-header">Questionário:</h5>
							<div class="card-body">
								<h5 class="card-title">{{$key->instituicao}}</h5>
								<p class="card-text">{{$key->descricao}}</p>
								@csrf {{ method_field('SUBMIT') }}
								{!! Form::model($key, ['method' => 'avaliar', 'route' => ['avaliar', $key->idProjeto], 'class' =>'form-delete']) !!}
								{!! Form::hidden('id', $key->idProjeto) !!}
								{!! Form::button('Responder', ['type' => 'submit', 'name' => 'delete_modal', 'class' => 'btn btn-primary'] ) !!}
								{!! Form::close() !!}
							</div>
						</div>
						@endif
						@endforeach
						@if($n == 0)
						<div class="alert alert-info" role="alert">
						<h4><i class="fas fa-trophy"></i>
							Muito bem!</h4>
						<hr>
							Todos os questionários já foram respondidos.
						</div>
						@endif
						{!! $projetos->links() !!}

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8 shadow p-0 mb-4 bg-white rounded"">
			<div class="card border-0">
					<div class="card-header text-white" style="background-color: #7f1a2e;">Questionário(s) já respondido(s):</div>
					<div class="card-body">
						@foreach($projetos as $key)
						@if($key->respondido == 1)
						<div class="card mb-3">
							<h5 class="card-header">Questionário:</h5>
							<div class="card-body">
								<h5 class="card-title">{{$key->instituicao}}</h5>
								<p class="card-text">{{$key->descricao}}</p>
								@csrf
								{!! Form::model($key, ['method' => 'GET', 'route' => ['avaliacao.edit', $key->idProjeto]]) !!}
								{!! Form::button($key->ativo ? 'Editar' : 'Indisponível', ['type' => 'submit', 'class' => $key->ativo ? 'btn btn-primary' : 'btn btn-secondary', $key->ativo ? '' : 'disabled'] ) !!}
								{!! Form::close() !!}
							</div>
						</div>
						@endif
						@endforeach
						{!! $projetos->links() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
@endsection
