@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8 shadow p-3 mb-5 bg-white rounded">
			<div class="card border-0">
				<div class="card-header">Áreas:</div>
                <div class="card-body">
                @include('alertas')
                <div class="form-groupp">
                <div class="row mb-2">
                    <div class="col w-100">
                        <div class="col-md-4 col-lg-2 float-right">
                            <a href="{{ URL::route('area.create') }}">
                                <button type="button" name="teste" id="teste" class="btn btn-primary btn-md btn-block">Nova Área</button>
                            </a>
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <div class="col">
                            <div class="table-responsive-sm">
                                <table class="table">
                                    <tbody>
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col"style="width: 1%;">#</th>
                                            <th scope="col">Área</th>
                                            <th scope="col">Prefixo</th>
                                            <th scope="col"style="width: 8%;">Opções</th>
                                        </tr>
                                    </thead>
                                    @foreach($areas as $area)                                    
                                        <tr {{$area['ativo'] == 0 ? 'class=table-secondary' : ""}}>
                                            <th scope="row">{{$area->id}}</th>
                                            <td>{{$area->area}}</td>
                                            <td>{{$area->prefixo}}</td>
                                            <td>
                                            <form method="GET" action="{{ route('area.edit', $area->id)}}">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                                            </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
                    
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
