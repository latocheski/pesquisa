@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Novo projeto:</div>
				<div class="card-body">
					<form method="POST" action="{{ route('criar') }}">
						@csrf
						<div class="form-group">
							<label for="exampleFormControlInput1">Descrição</label>
							<input type="text" class="form-control" name="descricao">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Instituições participantes:</label>
							<textarea class="form-control" name="instituicao" rows="5"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">{{ __('Cadastrar') }}</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
