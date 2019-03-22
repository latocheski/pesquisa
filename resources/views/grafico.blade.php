@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col text-center">
			<h1>{{$projeto->descricao}}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10">
			<canvas id="myChart" width="400" height="200"></canvas>
		</div>
		<div class="col">
			<div class="card border-light" style="max-width: 18rem;">
				<div class="card-header">Índice</div>
				<div class="card-body">
					<h5 class="card-title" id="indice"></h5>
					<p class="card-text"></p>
				</div>
			</div>

		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
<script src="{{ asset('js/jquery.multi-select.js') }}" defer></script>
<link href="{{ asset('css/multi-select.css') }}" rel="stylesheet">
<script>
	var dados = {!!json_encode($coeficienteDiretriz, JSON_HEX_TAG) !!};
</script>
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/grafico.projeto.js') }}"></script>

@endsection
