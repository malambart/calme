@extends('layouts.row')
@section('panel-heading')
<h1>Ajouter une école</h1>
@endsection
@section('body')
<form class="form-horizontal" role="form" method="POST" action="{{ url('ecoles/create') }}">
	{{ csrf_field() }}
	<div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
		<label for="nom" class="col-md-4 control-label">Nom de l'école</label>
		<div class="col-md-6">
			<input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}" autofocus>
			@if ($errors->has('nom'))
			<span class="help-block">
				<strong>{{ $errors->first('nom') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('ville') ? ' has-error' : '' }}">
		<label for="ville" class="col-md-4 control-label">Ville</label>
		<div class="col-md-6">
			<input id="ville" type="text" class="form-control" name="ville" value="{{ old('ville') }}" autofocus>
			@if ($errors->has('ville'))
			<span class="help-block">
				<strong>{{ $errors->first('ville') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<p class="clearfix">
		<button type="submit" class="btn btn-primary pull-right">
				Ajouter
			</button>
	</p>				
	
</form>
@include('flash::message')
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection		