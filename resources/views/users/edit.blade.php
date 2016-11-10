@extends('layouts.row')
@section('panel-heading')
<h1>Éditer : {{$user->name}}</h1>
@endsection
@section('body')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/utilisateurs/'.$user->id.'/edit') }}">
	{{ csrf_field() }}
	{{ method_field('PATCH')}}
	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		<label for="name" class="col-md-4 control-label">Nom</label>

		<div class="col-md-6">
			<input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" autofocus>

			@if ($errors->has('name'))
			<span class="help-block">
				<strong>{{ $errors->first('name') }}</strong>
			</span>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
		<label for="role" class="col-md-4 control-label">Role</label>

		<div class="col-md-6">
			<select class="form-control" name="role">
				<option value="" selected="selected">Choisir</option>
				<option @if(old('role', $user->role)=='superadmin')
					selected='selected' 
					@endif
					value="superadmin">Superadministrateur
				</option>
				<option @if(old('role', $user->role)=='admin')
					selected='selected' 
					@endif 
					value="admin">Administrateur
				</option>
				<option @if(old('role', $user->role)=='saisie')
					selected='selected' 
					@endif 
					value="saisie">Saisie
				</option>
			</select>
			@if ($errors->has('role'))
			<span class="help-block">
				<strong>{{ $errors->first('role') }}</strong>
			</span>
			@endif
		</div>
	</div>

	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		<label for="email" class="col-md-4 control-label">Courriel</label>

		<div class="col-md-6">
			<input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">

			@if ($errors->has('email'))
			<span class="help-block">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
			@endif
		</div>
	</div>

	<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		<label for="password" class="col-md-4 control-label">Mot de passe</label>

		<div class="col-md-6">
			<input id="password" type="password" class="form-control" name="password">

			@if ($errors->has('password'))
			<span class="help-block">
				<strong>{{ $errors->first('password') }}</strong>
			</span>
			@endif
		</div>
	</div>

	<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
		<label for="password-confirm" class="col-md-4 control-label">Confirmer le mot de passe</label>

		<div class="col-md-6">
			<input id="password-confirm" type="password" class="form-control" name="password_confirmation">

			@if ($errors->has('password_confirmation'))
			<span class="help-block">
				<strong>{{ $errors->first('password_confirmation') }}</strong>
			</span>
			@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6 col-md-offset-4">
			<button type="submit" class="btn btn-primary">
				Sauvegarder
			</button>
		</div>
	</div>
</form>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection		