@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Novo projeto:</div>
				<div class="card-body">
				@include('alertas')
					<form method="POST" action="{{is_null($projeto) ? route('criar') : route('projeto.update', $projeto->id)}}">
					{{csrf_field()}}
                    {{is_null($projeto) ?  method_field('POST') : method_field('PUT') }}
						<div class="form-group">
							<label for="exampleFormControlInput1">Descrição</label>
							<input type="text" class="form-control" name="descricao" value="{{$projeto == null ? '' : $projeto->descricao}}">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Instituições participantes:</label>
							<textarea class="form-control" name="instituicao" rows="5">{{$projeto == null ? '' : $projeto->instituicao}}</textarea>
							</div>
							<div class="form-group row mt-4">
								<div class="col-sm-2">Possibilitar edição</div>
								<div class="col-sm-10">
									<div class="form-check pl-0">
										<span class="switch switch-sm">
										{{Form::hidden('ativo',0)}}
										<input type="checkbox" class="switch" id="switch-sm" name="ativo" {{$projeto == null ? 'checked' : ($projeto->ativo == 1 ? 'checked' : '')}}>
											<label for="switch-sm"></label>
											<small id="tip" class="form-text text-muted mb-4">
									<i class="far fa-clipboard"></i>
									Se inativo, o usuário não conseguirá alterar suas respostas.</small>
								</span>
									</div>
								</div>
							</div>
						<button type="submit" class="btn btn-primary">{{$projeto == null ? 'Cadastrar' : 'Atualizar'}}</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
