@extends('layouts.row')
@section('panel-heading')
<h1>Dossier {{$dossier->id}} : ajouter un temps de mesure</h1>
@endsection
@section('body')
<form class="form-horizontal" role="form" method="POST" action="{{ url('mesures/'.$dossier->id.'/create') }}">
	{{ csrf_field() }}
	<div class="form-group{{ $errors->has('prenom_ens') ? ' has-error' : '' }}">
		<label for="prenom_ens" class="col-md-4 control-label">Prénom de l'enseignant</label>
		<div class="col-md-6">
			<input id="prenom_ens" type="text" class="form-control" name="prenom_ens" value="{{ old('prenom_ens') }}" autofocus>
			@if ($errors->has('prenom_ens'))
			<span class="help-block">
				<strong>{{ $errors->first('prenom_ens') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('nom_ens') ? ' has-error' : '' }}">
		<label for="nom_ens" class="col-md-4 control-label">Nom de l'enseignant</label>
		<div class="col-md-6">
			<input id="nom_ens" type="text" class="form-control" name="nom_ens" value="{{ old('nom_ens') }}" autofocus>
			@if ($errors->has('nom_ens'))
			<span class="help-block">
				<strong>{{ $errors->first('nom_ens') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('ecole_id') ? ' has-error' : '' }}">
		<label for="ecole_id" class="col-md-4 control-label">École</label>
		<a class="btn btn-primary float-right" tabindex="-1" target="_blank" href="{{url('/ecoles/create')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
		<div class="col-md-6">
			<select name="ecole_id" class="form-control">
				<option value="">Veuillez choisir</option>
				@foreach($ecoles as $ecole)
				<option value="{{$ecole->id}}">{{$ecole->nom}}</option>
				@endforeach
			</select>
			@if ($errors->has('ecole_id'))
			<span class="help-block">
				<strong>{{ $errors->first('ecole_id') }}</strong>
			</span>
			@endif
		</div>
	</div>	
	<div class="form-group{{ $errors->has('tel_ens') ? ' has-error' : '' }}">
		<label for="tel_ens" class="col-md-4 control-label">Numéro de téléphone</label>
		<div class="col-md-6">
			<input id="tel_ens" type="text" class="form-control" name="tel_ens" value="{{ old('tel_ens') }}" autofocus>
			@if ($errors->has('tel_ens'))
			<span class="help-block">
				<strong>{{ $errors->first('tel_ens') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('courriel_ens') ? ' has-error' : '' }}">
		<label for="courriel_ens" class="col-md-4 control-label">Courriel</label>
		<div class="col-md-6">
			<input id="courriel_ens" type="text" class="form-control" name="courriel_ens" value="{{ old('courriel_ens') }}" autofocus>
			@if ($errors->has('courriel_ens'))
			<span class="help-block">
				<strong>{{ $errors->first('courriel_ens') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('fax_ens') ? ' has-error' : '' }}">
		<label for="fax_ens" class="col-md-4 control-label">Numéro de fax (facultatif)</label>
		<div class="col-md-6">
			<input id="fax_ens" type="text" class="form-control" name="fax_ens" value="{{ old('fax_ens') }}" autofocus>
			@if ($errors->has('fax_ens'))
			<span class="help-block">
				<strong>{{ $errors->first('fax_ens') }}</strong>
			</span>
			@endif
		</div>
	</div>			
	<button type="submit" class="btn btn-primary pull-right">
		Ajouter
	</button>
</form>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection		
