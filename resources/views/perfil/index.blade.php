@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">Perfil dos participantes:</div>
                    <canvas id="myChart" width="400" height="200"></canvas>
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
	var perfil = {!!json_encode($perfil->toArray(), JSON_HEX_TAG) !!};

</script>
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/grafico.perfil.js') }}"></script>

@endsection
