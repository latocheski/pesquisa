@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">Atribuir participantes ao projeto:</div>
				<form method="post" action="{{route ('salvargrupo')}}">
					@csrf
					<div class="card-body mx-auto" style="max-width: 430px;">
						<div style="overflow-x:auto;">
							<select name="id[]" id='options' multiple='multiple'>
								@foreach($usuarios as $usuario)
								<option value='{{$usuario->id}}'>{{$usuario->name}}</option>
								@endforeach
							</select>
							{!! Form::hidden('idPesquisa', $idatual) !!}

						</div>
						<button type="submit" class="btn btn-primary mt-3">
							<i class="fas fa-save mr-2"></i>Salvar</button>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
<script src="{{ asset('js/jquery.multi-select.js') }}" defer></script>
<link href="{{ asset('css/multi-select.css') }}" rel="stylesheet">
<script>
	var grupo = {!!json_encode($grupo->toArray(), JSON_HEX_TAG) !!};

</script>
<script src="{{ asset('js/selector.js') }}"></script>

@endsection
