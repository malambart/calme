@extends('layouts.row')
@section('panel-heading')
<h1>{{$user->name}}</h1>
@endsection
@section('body')
<dl class="dl-horizontal">
	<dt>Nom:</dt>
	<dd>{{$user->name}}</dd>
	<dt>Role:</dt>
	<dd>{{$user->role}}</dd>
	<dt>Courriel:</dt>
	<dd>{{$user->email}}</dd>
</dl>

<div class="pull-right">
	<a data-href="{{url('/utilisateurs/'.$user->id.'/delete')}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" id="deleteButton">
		Supprimer
	</a>
	<a href="{{url('/utilisateurs/'.$user->id.'/edit')}}" class="btn btn-primary" id="editbutton">
		Éditer
	</a>

</div>

@endsection
@section('script')
<script type="text/javascript">
	@include('partials.confirmationSupression')
	<script type="text/javascript">
		$( "#gestion_utilisateurs" ).addClass( "active" );
	</script>
	@endsection		