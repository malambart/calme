@extends('layouts.row')
@section('body')
<dl class="dl-horizontal">
	<dt>Nom:</dt>
	<dd>{{$user->name}}</dd>
	<dt>Role:</dt>
	<dd>{{$user->role}}</dd>
	<dt>Courriel:</dt>
	<dd>{{$user->email}}</dd>
</dl>

<a data-href="{{url('/utilisateurs/'.$user->id.'/delete')}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger pull-right" id="deleteButton">
 Supprimer
 </a>
@endsection
@section('script')
@include('partials.confirmationSupression')
<script type="text/javascript">
$( "#gestion_utilisateurs" ).addClass( "active" );
</script>
@endsection