@extends('layouts.row')
@section('panel-heading')
<h1>Dossier {{$id}} : ajouter un parent répondant</h1>
@endsection
@section('body')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/parents/'.$id.'/create') }}">
	{{ csrf_field() }}
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
	<div class="form-group{{ $errors->has('lien') ? ' has-error' : '' }}">
		<label for="lien" class="col-md-4 control-label">Lien avec le jeune</label>
		<div class="col-md-6">
			<select id="lien" name="lien" class="form-control">
				<option value="">Veillez Choisir</option>
				<option value="mère"
				@if(old('lien')=="mère")
				selected="selected"
				@endif 
				>Mère</option>
				<option value="père"
				@if(old('lien')=="père")
				selected="selected"
				@endif
				>Père</option>
				<option value="autre"
				@if(old('lien')=="autre")
				selected="selected"
				@endif
				>Autre</option>
			</select>
			@if ($errors->has('lien'))
			<span class="help-block">
				<strong>{{ $errors->first('lien') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div hidden id="input_lien_autre" class="form-group{{ $errors->has('lien_autre') ? ' has-error' : '' }}">
		<label for="lien_autre" class="col-md-4 control-label">Veuillez précisez</label>
		<div class="col-md-6">
			<input id="lien_autre" type="text" class="form-control" name="lien_autre" value="{{ old('lien_autre') }}" autofocus>
			@if ($errors->has('lien_autre'))
			<span class="help-block">
				<strong>{{ $errors->first('lien_autre') }}</strong>
			</span>
			@endif
		</div>
	</div>		
	<div class="form-group{{ $errors->has('lieuT1') ? ' has-error' : '' }}">
		<label for="lieuT1" class="col-md-4 control-label">Questionnaire T1 complété...</label>
		<div class="col-md-6">
			<select name="lieuT1" class="form-control">
				<option selected="selected" value="">Veuillez choisir</option>
				<option value="maison"
				@if(old('lieuT1')=="maison")
				selected="selected"
				@endif 
				>À la maison</option>
				<option value="chus"
				@if(old('lieuT1')=="chus")
				selected="selected"
				@endif >Au CHUS</option>
			</select>	
			@if ($errors->has('lieuT1'))
			<span class="help-block">
				<strong>{{ $errors->first('lieuT1') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('courriel') ? ' has-error' : '' }}">
		<label for="courriel" class="col-md-4 control-label">Courriel</label>
		<div class="col-md-6">
			<input id="courriel" type="text" class="form-control" name="courriel" value="{{ old('courriel') }}" autofocus>
			@if ($errors->has('courriel'))
			<span class="help-block">
				<strong>{{ $errors->first('courriel') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
		<label for="tel" class="col-md-4 control-label">Téléphone principal</label>
		<div class="col-md-6">
			<input id="tel" type="text" class="form-control" name="tel" value="{{ old('tel') }}" autofocus>
			@if ($errors->has('tel'))
			<span class="help-block">
				<strong>{{ $errors->first('tel') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('tel2') ? ' has-error' : '' }}">
		<label for="tel2" class="col-md-4 control-label">Téléphone secondaire</label>
		<div class="col-md-6">
			<input id="tel2" type="text" class="form-control" name="tel2" value="{{ old('tel2') }}" autofocus>
			@if ($errors->has('tel2'))
			<span class="help-block">
				<strong>{{ $errors->first('tel2') }}</strong>
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
	if ($('#lien').val()=='autre') {
		$('#input_lien_autre').show();
	}
	$('#lien').change(function(){
		if($(this).val()=='autre'){
			$('#input_lien_autre').show();
		}
		else {
			$('#input_lien_autre').hide();
		}
	});
</script>
@endsection
