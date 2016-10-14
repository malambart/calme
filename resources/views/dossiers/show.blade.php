@extends('layouts.row')
@section('panel-heading')
<h3>{{$dossier->nom_complet.' ('.$dossier->id.')'}}</h3>

@endsection
@section('body')
<p>Date de naissance : {{$dossier->date_naiss}}</p>
<p>Numéro de dossier au CHUS : {{$dossier->no_doss_chus}}</p>
@if(count($dossier->currentParent)>=1)
<p>Parent répondant : </p>
<div class="well">
hello
</div>
@else
<a class="btn btn-primary" href="{{url('parents/'.$dossier->id.'/create')}}">Ajouter un parent répondant</a>
@endif
<div class="clearfix list-header">Temps de mesure
	<a class="btn btn-primary pull-right" href="{{url('mesure/'.$dossier->id.'/create')}}">Ajouter</a>
</div>
<div class="list-group">
	<a class="list-group-item">
		item
	</a>
</div>



@endsection
@section('script')
<script type="text/javascript">
	$( "#gestion_dossiers" ).addClass( "active" );
	$( "#liste" ).addClass( "active" );
</script>
@endsection
