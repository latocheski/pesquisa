@if($errors->any())
<div class="alert h5 alert-danger" role="alert" id="hidden-alert">
	@foreach ($errors->all() as $error) {{ $error }}
	<br> @endforeach
</div>

@endif @if ($message = Session::get('success'))
<div class="alert h5 alert-success" role="alert" id="hidden-alert">
	<p>{{$message}}</p>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert h5 alert-info" role="alert" id="hidden-alert">
	<p>{{$message}}</p>
</div>
@endif


