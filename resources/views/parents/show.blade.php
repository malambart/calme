@extends('layouts.row')
@section('panel-heading')
<h1>{{$parent->prenom.' '.$parent->nom.' '}}(parent répondant)</h1>
<div class="pull-right">
	<a class="btn btn-primary" href="{{url('parents/'.$parent->id.'/edit')}}">Éditer</a>
	<a class="btn btn-primary" href="{{url('parents/'.$parent->dossier->id.'/create')}}">Changer de parent</a>
</div>

@endsection
@section('body')
<div class="alert alert-warning">
  Pour modifier les infos du parent (ex. : corriger une erreur dans le nom,  changer l'adresse courriel,  etc),  utiliser le bouton "Edit". Si le parent répondant <b>change au cours du projet</b>,  utilisez le bouton "changer de parent".
</div>
<p>Lien avec le jeune : {{$parent->lien}}</p>
<p>Numéro de téléphone: {{$parent->tel}}</p>
<p>Courriel: {{$parent->courriel}}</p>
<p>Lieu du T1: {{$parent->lieuT1}}</p>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection		