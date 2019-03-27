@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Área:</div>
				<div class="card-body">
				@include('alertas')
					<form method="post" action="{{is_null($area) ? route('area.store') : route ('area.update', $area->id)}}">
                    {{csrf_field()}}
                    {{is_null($area) ?  method_field('POST') : method_field('PUT') }}
						<div class="form-group">
							<label for="exampleFormControlInput1">Área:</label>
							<input type="text" class="form-control" name="area" value="{{is_null($area) ? '' : $area->area}}" autofocus>
						</div>
						<div class="form-group">
							<label for="exampleFormControlInput1">Prefixo:</label>
							<input type="text" class="form-control" style="text-transform: uppercase;"  maxlength="4" name="prefixo" value="{{is_null($area) ? '' : $area->prefixo}}">
						</div>				
                        <div class="form-group row mt-4">
								<div class="col-sm-2">Exibir</div>
								<div class="col-sm-10">
									<div class="form-check pl-0">
										<span class="switch switch-sm">
										{{Form::hidden('ativo',0)}}
											<input type="checkbox" class="switch" id="switch-sm" name="ativo" {{$area == null ? 'checked' : ($area->ativo == 1 ? 'checked' : '')}}>
											<label for="switch-sm"></label>
											<small id="tip" class="form-text text-muted">
											<i class="far fa-clipboard"></i>
											Se inativo, a area não é contabilizada nos relatórios/questionários.</small>	
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
