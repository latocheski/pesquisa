@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row mb-5">
		<div class="col text-center">
			<h1>{{$projeto->descricao}}</h1>
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<canvas id="myChart" width="400" height="200"></canvas>
		</div>
		<div class="mx-auto" style="max-width: 280px;">
			<h1 class="text-center font-weight-bold" id="numero"></h1>
			<canvas id="indice" width="280" height="200"></canvas>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
<script src="{{ asset('js/gauge.min.js') }}"></script>
<script>
	var dados = {!!json_encode($coeficienteDiretriz, JSON_HEX_TAG) !!};
</script>
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/grafico.projeto.js') }}"></script>

@endsection
