@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8 shadow p-3 mb-5 bg-white rounded">
			<div class="card border-0">
				<div class="card-header"><h4>Projetos:</h4></div>
				<div class="card-body">
				<div class="row mb-2">
                            <div class="col w-100">
							@include('alertas')
                                <div class="col-md-4 col-lg-2 float-right p-0">
                                    <a href="{{ URL::route('incluir') }}">
                                        <button type="button" name="teste" id="teste" class="btn btn-primary btn-md btn-block">Criar</button>
                                    </a>
                                </div>
                            </div>
                        </div>
					<div class="table-responsive">
						@if($projeto->isEmpty())
						<div class="alert alert-danger" role="alert">
							Sem projeto cadastrado.
						</div>
						@else
						<table class="table" data-toggle="deleteForm" data-form="deleteForm">
							<thead class="thead-dark">
								<tr>
									<th scope="row">{{__('Descrição')}}</th>
									<th>{{__('Instituição')}}</th>
									<th style="width: 8%;">{{__('Participantes')}}</th>
									<th style="width: 8%;">{{__('Editar')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($projeto as $proj)
								<tr {{$proj['ativo'] == 0 ? 'class=table-secondary' : ""}}>
									<td scope="row">{{$proj->descricao}}</td>
									<td>{{$proj->instituicao}}</td>
									<td>
										@csrf {{ method_field('SUBMIT') }}
										{!! Form::model($proj, ['method' => 'POST', 'route' => ['participantes', $proj->id]]) !!}
										{!! Form::hidden('id', $proj->id) !!}
										{!! Form::button('Selecionar', ['type' => 'submit', 'class' => 'btn btn-primary'] ) !!}
										{!! Form::close() !!}
									</td>
									<td>
										@csrf {{ method_field('GET') }}
										{!! Form::model($proj, ['method' => 'GET', 'route' => ['projeto.edit', $proj->id]]) !!}
										{!! Form::hidden('id', $proj->id) !!}
										{!! Form::button('Editar', ['type' => 'submit', 'class' => 'btn btn-danger'] ) !!}
										{!! Form::close() !!}
									</td>
								</tr>
								@endforeach

							</tbody>
						</table>
						{!! $projeto->links() !!}
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
