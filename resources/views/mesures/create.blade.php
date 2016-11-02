@extends('layouts.row')
@section('panel-heading')
<h1>Dossier {{$dossier->id}} : ajouter un temps de mesure</h1>
@endsection
@section('body')
<!-- Modal -->
<div class="modal fade" id="ecoleForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Ajouter une école</h4>
			</div>
			<div class="modal-body">
				<form class="bootstrap-modal-form clearfix" role="form" method="POST" action="{{ url('ecoles/create') }}">
					{{ csrf_field() }}
					<div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
						<label for="nom" class="control-label">Nom de l'école</label>
						<input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}" autofocus>
						@if ($errors->has('nom'))
						<p class="help-block">
							<strong>{{ $errors->first('nom') }}</strong>
						</p>
						@endif
					</div>
					<div class="form-group{{ $errors->has('ville') ? ' has-error' : '' }}">
						<label for="ville" class="control-label">Ville</label>
						<input id="ville" type="text" class="form-control" name="ville" value="{{ old('ville') }}" autofocus>
						@if ($errors->has('ville'))
						<span class="help-block">
							<strong>{{ $errors->first('ville') }}</strong>
						</span>
						@endif
					</div>
					<button type="submit" class="btn btn-primary pull-right">
						Ajouter
					</button>
				</form>
			</div>

		</div>
	</div>
</div>
<form class="form-horizontal" role="form" method="POST" action="{{ url('mesures/'.$dossier->id.'/create') }}">
	{{ csrf_field() }}
	<div class="form-group{{ $errors->has('ecole_id') ? ' has-error' : '' }}">
		<label for="ecole_id" class="col-md-4 control-label">École</label>
		
		<div class="col-md-6">
			<div class="input-group">
				<select name="ecole_id" class="form-control" autofocus>
					<option value="">Veuillez choisir</option>
					@foreach($ecoles as $ecole)
					<option value="{{$ecole->id}}">{{$ecole->nom}}</option>
					@endforeach
				</select>
				<span class="input-group-btn">
					<button tabindex="-1" type="button" class="btn btn-primary bootstrap-modal-form-open" data-toggle="modal" data-target="#ecoleForm">+</button>
				</span>	
				
			</div>
			
			@if ($errors->has('ecole_id'))
			<span class="help-block">
				<strong>{{ $errors->first('ecole_id') }}</strong>
			</span>
			@endif
			
		</div>
	</div>	
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
