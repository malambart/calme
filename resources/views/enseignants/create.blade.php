@extends('layouts.row')
@section('panel-heading')
<h1>Dossier {{$dossier->id}} : ajouter un enseignant</h1>
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
<form class="form-horizontal" role="form" method="POST" action="{{ url('enseignants/'.$dossier->id.'/create') }}">
	{{ csrf_field() }}
	<div class="form-group{{ $errors->has('ecole_id') ? ' has-error' : '' }}">
		<label for="ecole_id" class="col-md-4 control-label">École</label>
		
		<div class="col-md-6">
			<div class="input-group">
				<select name="ecole_id" class="form-control" autofocus>
					<option value="">Veuillez choisir</option>
					@foreach($ecoles as $ecole)
					<option value="{{$ecole->id}}"
						@if(old('ecole_id')==$ecole->id)
						selected
						@endif
					>
						{{$ecole->nom}}
					</option>
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
	<div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
		<label for="prenom" class="col-md-4 control-label">Prénom de l'enseignant</label>
		<div class="col-md-6">
			<input id="prenom" type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" autofocus>
			@if ($errors->has('prenom'))
			<span class="help-block">
				<strong>{{ $errors->first('prenom') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
		<label for="nom" class="col-md-4 control-label">Nom de l'enseignant</label>
		<div class="col-md-6">
			<input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}" autofocus>
			@if ($errors->has('nom'))
			<span class="help-block">
				<strong>{{ $errors->first('nom') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<input type="hidden" name="confirmation" value="0">
	<button type="submit" class="btn btn-primary pull-right">
		Ajouter
	</button>
</form>
@if(Session::has('enseignant_existe'))
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="Cet enseignant est déjà associé" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p>Cet enseignant est déjà associé au(x) dossier(s) suivant(s):</p>
                <ul>

                </ul>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <a href="" class="btn btn-danger btn-ok" id="confirmButton">Supprimer</a>
            </div>
        
    	</div>
	</div>
</div>
@endif
<script>
$( document ).ready(function() {
	var url=$('#deleteButton').data("href");
	$('#confirmButton').attr('href',url);
});
</script>
@if(Session::has('enseignant_existe'))
	<script type="text/javascript">
	</script>
@endif
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection		
