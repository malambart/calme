@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$note->dossier->baseUrl()}}">Dossier {{$note->dossier->id}}</a>: Note évolutive de la
        séance {{$note -> no_seance}}</h1>
@endsection
@section('body')
    <div>Date: {{$note->date}}</div>
    <div>Personne présentes: {{toCSL($note->presence)}}</div>
    <h1>Retour sur les exercises</h1>
    @foreach($note->exercises as $e)
        <div class="well">
            <button class="pull-right"></button>
            <div>{{ $e->nom }}</div>
            <div>Cote: {{ $e->cote }}</div>
            <div>Fréquence: {{ $e->frequence }}</div>
            <div>Commentaires: {{ $e->commentaires }}</div>
        </div>
    @endforeach
    <div>Évaluation du comportement du jeune pendant la séance :</div>
    <ul>
        @foreach($note->comportement as $c)
            <li>{{ $c }}</li>
        @endforeach
    </ul>
    <div>Contenu abordé dans la séance</div>
    <ul>
        @foreach($note->contenu as $c)
            <?php
                $contenu=\App\ContenuSeance::find($c);
            ?>
            <li>{{ $contenu->categories.": ".$contenu->label }}</li>
        @endforeach
    </ul>
    <div>Commentaires :</div>
    <div>{{$note->commentaires}}</div>
    <div>Date de la prochaine rencontre: {{$note->prochaine_rencontre}}</div>




@endsection