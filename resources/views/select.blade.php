@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-6">

			<div class="card">
				<div class="card-header">Atribuir pesquisa:</div>
				<div class="card-body">
					<div class="table-responsive table-striped">
						@if($projeto->isEmpty())
						<div class="alert alert-danger" role="alert">
							Sem projeto cadastrado.
						</div>
						@else
						<table class="table">
							<thead class="thead-dark">
								<tr>
									<th scope="row">{{__('Descrição')}}</th>
									<th>{{__('Instituição')}}</th>
									<th style="width: 8%;">{{__('Gráfico')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($projeto as $proj)
								<tr>
									<td scope="row">{{$proj->descricao}}</td>
									<td>{{$proj->instituicao}}</td>
									<td>
										@csrf {{ method_field('SUBMIT') }}
										{!! Form::model($proj, ['method' => 'POST', 'route' => ['grafico', $proj->id]]) !!}
										{!! Form::hidden('id', $proj->id) !!}
										{!! Form::button('Visualizar', ['type' => 'submit', 'class' => 'btn btn-success'] ) !!}
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
</div>
@endsection