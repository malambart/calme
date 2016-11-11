@extends('layouts.row')
@section('panel-heading')
<h1>
	{{$dossier->nom_complet.' ('.$dossier->id.')'}}
	@if($dossier->exclu)
	<i>
	 - dossier exclu de l'étude
	</i>
	@endif
</h1>

@endsection
@section('body')
<section>
<p>Date de naissance : {{$dossier->date_naiss->toDateString()}}</p>
<p>Âge : {{$dossier->age}}</p>
<p>Sexe : 
@if($dossier->sexe==1)
Masculin
@elseif($dossier->sexe==2)
Féminin
@endif</p>
<p>Numéro de dossier au CHUS : {{$dossier->no_doss_chus}}</p>
<p>Date de la première séance de traitement : {{$dossier->premiere_seance->toDateString()}}</p>
<p>Date du bilan final : {{$dossier->bilan_final}}</p>
@if(count($dossier->currentParent)>=1)
<p>Parent répondant : {{$dossier->currentParent->prenom.' ('.$dossier->currentParent->lien.')'}}</p>

@elseif(!$dossier->exclu)
<a class="btn btn-primary" href="{{url('parents/'.$dossier->id.'/create')}}">Ajouter un parent répondant</a>
@endif

</section>
<hr>
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



@endsection
@section('script')
<script type="text/javascript">
	$( "#gestion_dossiers" ).addClass( "active" );
	$( "#liste" ).addClass( "active" );
</script>
@endsection
