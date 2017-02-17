@extends('layouts.row')
@section('panel-heading')
<h1>{{$enseignant->prenom.' '.$enseignant->nom.' (enseignant)'}}</h1>
<div class="pull-right">
	<a class="btn btn-primary" href="{{url('enseignants/edit',$enseignant->id)}}">Éditer</a>
	<a class="btn btn-primary" href="{{url('enseignants/create',$enseignant->id)}}">Changer d'enseignant</a>
</div>
@endsection
@section('body')
<div class="alert alert-warning">
  Pour modifier les infos de l'enseignant (ex. : corriger une erreur dans le nom,  changer l'adresse courriel,  etc),  utiliser le bouton "Edit". Si l'enseignant répondant <b>change au cours du projet</b>,  utilisez le bouton "changer d'enseignant".
</div>
<p>École : {{$ecole->nom}}</p>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection