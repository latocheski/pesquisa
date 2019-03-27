@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Perfil:</div>
				<div class="card-body">
				@include('alertas')
					<form method="post" action="{{is_null($questao) ? route('qperfil.store') : route ('qperfil.update', $questao->id)}}">
                    {{csrf_field()}}
                    {{is_null($questao) ?  method_field('POST') : method_field('PUT') }}
						<div class="form-group">
							<label for="exampleFormControlInput1">Questão:</label>
							<input type="text" class="form-control" name="questao" value="{{is_null($questao) ? '' : $questao->questao}}" autofocus>
						</div>		
                        <div class="form-group row mt-4">
								<div class="col-sm-2">Exibir</div>
								<div class="col-sm-10">
									<div class="form-check pl-0">
										<span class="switch switch-sm">
										{{Form::hidden('ativo',0)}}
											<input type="checkbox" class="switch" id="switch-sm" name="ativo" {{$questao == null ? 'checked' : ($questao->ativo == 1 ? 'checked' : '')}}>
											<label for="switch-sm"></label>
											<small id="tip" class="form-text text-muted">
											<i class="far fa-clipboard"></i>
											Se inativo, a questão não é contabilizada nos relatórios/questionários.</small>	
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
