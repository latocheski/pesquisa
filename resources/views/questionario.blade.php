@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">Atribua um valor para os seguintes itens:</div>
				<form method="post" action="{{ route('enviar') }}">
					@csrf
					<div class="card-body">
						<?php $index = 0;?>
						<div class="row">
							<div class="col-3" style="overflow-x:auto;">
								<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
									@foreach($questoes as $q)
									<a class="nav-link mr-3 {{$index == 0 ? 'active' : ''}}" id="v-pills-{{$q[0]->area}}-tab" data-toggle="pill" href="#v-pills-{{$q[0]->area}}" role="tab" aria-controls="v-pills-{{$q[0]->area}}" aria-selected="true">{{$q[0]->area}}</a>
									<?php $index++;?>
									@endforeach
									<div class="mb-2 mr-2 mt-3">
										<div class="form-group row mb-0">
											<div class="col-md-6 d-flex flex-row">
												<a href="{{ url()->previous() }}" role="button" class="btn btn-dark">Voltar</a>
												<button type="submit" class="ml-2 btn btn-primary">
													<i class="fas fa-save mr-2"></i>
													{{ __('Salvar') }}
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<?php $index = 0;?>
							<div class="col-9">
								<div class="tab-content" id="v-pills-tabContent">
									@php ($quest = [])
									@php ( $id = 0)
									@foreach($questoes as $q)
									<div class="tab-pane fade {{$index == 0 ? 'show active' : ''}}" id="v-pills-{{$q[0]->area}}" role="tabpanel" aria-labelledby="v-pills-{{$q[0]->area}}-tab">
									@php ($id = 0)	
									@foreach($q as $pergunta)
										@php ($id++)
										<b>Q{{$pergunta->prefixo}}{{$id}} - </b>
										{{$pergunta->questao}}
										@php (array_push($quest, $pergunta))
										<br>
										<p><span id="{{$pergunta->idq}}s" class="badge badge-primary badge-pill ml-2"></span></p>
										<input type="range" min="1" max="100" value="1" class="slider" id="{{$pergunta->idq}}" name="{{$pergunta->idq}}">
										<hr>
										@endforeach
									</div>
									<?php $index++;?>
									@endforeach
									{!! Form::hidden('idProjeto', $idP) !!}
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script>
	var questoes = {!!json_encode($quest, JSON_HEX_TAG) !!};
</script>
<script src="{{ asset('js/questoes.js') }}" defer></script>
@endsection
