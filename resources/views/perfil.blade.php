@extends('layouts.app')

@section('content')

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Atribua um valor para os seguintes itens:</div>
				<form method="post" action="{{$row == [] ? route ('perfil.salvar') : route ('perfil.update', Auth::user()->id)}}">
				@csrf @method('POST')
					<div class="card-body">

						@foreach($questoes as $linha)
							<li class="list-group-item d-flex justify-content-between align-items-center">
								<div class="slidecontainer">
									<div class="row ml-1">
										{{$linha['questao']}}
										<p><span id="{{$linha['id']}}s" class="badge badge-primary badge-pill ml-2"></span></p>
									</div>
									<input name="{{$linha['id']}}" type="range" min="1" max="100" value="{{$row == [] ? 1 : $row[$linha['id']][0]->nota}}" class="slider" id="{{$linha['id']}}">
								</div>
							</li>
						@endforeach

					</div>
					<div class="mb-2 mr-3">
						<div class="float-right">
							<div class="form-group row mb-0">
								<div class="col-md-6 d-flex flex-row">
									<button type="submit" class="ml-2 btn btn-primary mb-3">
										<i class="fas fa-save mr-2"></i>
										{{ __('Salvar') }}
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('js/fn.js') }}" defer></script>
<script>
	var questoes = {!!json_encode($questoes, JSON_HEX_TAG) !!};
</script>

@endsection
