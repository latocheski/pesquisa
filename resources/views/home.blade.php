@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
					<div class="card-header">Questionário(s) disponívei(s):</div>
					<div class="card-body">
						@include('alertas')
						@if($projetos->isEmpty())
						<div class="alert alert-danger" role="alert">
							Sem questionário.
						</div>
						@endif

						@foreach($projetos as $key)
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
						@endforeach
						{!! $projetos->links() !!}
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
