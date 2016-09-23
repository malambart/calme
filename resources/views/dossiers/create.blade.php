@extends('layouts.row')
@section('navLevel2')
@include('dossiers.navLevel2')
@endsection
@section('body')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/dossiers/create') }}">
	{{ csrf_field() }}

	<div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
		<label for="nom" class="col-md-4 control-label">Nom</label>

		<div class="col-md-6">
			<input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}" autofocus>

			@if ($errors->has('nom'))
			<span class="help-block">
				<strong>{{ $errors->first('nom') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
		<label for="prenom" class="col-md-4 control-label">Prénom</label>

		<div class="col-md-6">
			<input id="prenom" type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" autofocus>

			@if ($errors->has('prenom'))
			<span class="help-block">
				<strong>{{ $errors->first('prenom') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('no_doss_chus') ? ' has-error' : '' }}">
		<label for="no_doss_chus" class="col-md-4 control-label"># dossier CHUS</label>

		<div class="col-md-6">
			<input id="no_doss_chus" type="text" class="form-control" name="no_doss_chus" value="{{ old('no_doss_chus') }}" autofocus>

			@if ($errors->has('no_doss_chus'))
			<span class="help-block">
				<strong>{{ $errors->first('no_doss_chus') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('date_naiss') ? ' has-error' : '' }}">
		<label for="date_naiss" class="col-md-4 control-label">Date de naissance</label>
		<div class="col-md-6">
			<input id="date_naiss" type="date" class="form-control" name="date_naiss" value="{{ old('date_naiss') }}" autofocus>
			@if ($errors->has('date_naiss'))
			<span class="help-block">
				<strong>{{ $errors->first('date_naiss') }}</strong>
			</span>
			@endif
		</div>
	</div>				
	<div class="form-group">
		<div class="col-md-6 col-md-offset-4">
			<button type="submit" class="btn btn-primary">
				Ajouter
			</button>
		</div>
	</div>
</form>
@endsection
@section('script')
<script type="text/javascript">
	$( "#gestion_dossiers" ).addClass( "active" );
	$( "#create" ).addClass( "active" );
</script>
@endsection
