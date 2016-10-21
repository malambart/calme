@extends('layouts.row')
@section('panel-heading')
<h1>{{$dossier->nom_complet.' ('.$dossier->id.')'}}</h1>

@endsection
@section('body')
<p>Date de naissance : {{$dossier->date_naiss}}</p>
<p>Numéro de dossier au CHUS : {{$dossier->no_doss_chus}}</p>
@if(count($dossier->currentParent)>=1)
<p>Parent répondant : {{$dossier->currentParent->prenom.' ('.$dossier->currentParent->lien.')'}}</p>
<div class="clearfix list-header">Temps de mesure
	<a class="btn btn-primary pull-right" href="{{url('mesures/'.$dossier->id.'/create')}}">Ajouter</a>
</div>
<div class="list-group">
	@foreach($dossier->mesures as $mesure)
	<a class="list-group-item" href={{url('mesures/'.$mesure->id.'/show')}}>
		Temps {{$mesure->temps}}
	</a>
	@endforeach
</div>
@else
<a class="btn btn-primary" href="{{url('parents/'.$dossier->id.'/create')}}">Ajouter un parent répondant</a>
@endif




@endsection
@section('script')
<script type="text/javascript">
	$( "#gestion_dossiers" ).addClass( "active" );
	$( "#liste" ).addClass( "active" );
</script>
@endsection
