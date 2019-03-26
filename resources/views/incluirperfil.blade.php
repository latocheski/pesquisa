@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Diretrizes:</div>
				<div class="card-body">
				@include('alertas')
					<form method="POST" action="{{$diretriz == null ?  route('salvardiretriz') : route ('update.diretriz', $diretriz->id)}}">
						@csrf
						<div class="form-group">
							<label for="exampleFormControlInput1">Questão:</label>
							<input type="text" class="form-control" name="questao" value="{{is_null($diretriz) ? '' : $diretriz->questao}}" autofocus>
						</div>
							<div class="form-group">
							<div class="input-group mb-3">

						<div class="input-group-prepend">
							<label class="input-group-text" for="idArea">Selecione a área:</label>
						</div>

							<select class="custom-select" id="idArea" name="idArea">

								@foreach($areas as $area)
									@if($diretriz != null)
										@if($diretriz->idArea == $area->id)
											<option selected value="{{$area->id}}">{{$area->area}}</option>
										@else
											<option value="{{$area->id}}">{{$area->area}}</option>
										@endif
									@else
									<option value="{{$area->id}}">{{$area->area}}</option>
									@endif
								@endforeach
							</select>

							</div>
						</div>
							<div class="form-group row mt-4">
								<div class="col-sm-2">Exibir</div>
								<div class="col-sm-10">
									<div class="form-check pl-0">
										<span class="switch switch-sm">
										{{Form::hidden('ativo',0)}}
											<input type="checkbox" class="switch" id="switch-sm" name="ativo" {{$diretriz == null ? 'checked' : ($diretriz->ativo == 1 ? 'checked' : '')}}>
											<label for="switch-sm"></label>
											<small id="tip" class="form-text text-muted">
											<i class="far fa-clipboard"></i>
											Se inativo, a diretriz não é contabilizada nos relatórios/questionários.</small>	
										</span>
									</div>
								</div>
							</div>
						
						<button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
