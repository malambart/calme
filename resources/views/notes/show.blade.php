@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$note->dossier->baseUrl()}}">Dossier {{$note->dossier->id}}</a>: Note évolutive de la
        séance {{$note -> no_seance}}</h1>
    <a class="btn btn-primary pull-right" href="{{ url('/notes/edit', $note->id) }}">Éditer</a>
@endsection
@section('body')
    <div class="info">Date: {{$note->date}}</div>
    <div class="info">Personne présentes:
        @if($note->presence)
            {{toCSL($note->presence)}}
        @endif
    </div>
    <h1>Retour sur les exercises</h1>
    @if(count($note->exercises)>=1)
        @foreach($note->exercises as $e)
            <div class="well">
                <div>{{ $e->nom }}</div>
                <div>Cote: {{ $e->cote }}</div>
                <div>Fréquence: {{ $e->frequence }}</div>
                <div>Commentaires: {{ $e->commentaires }}</div>
            </div>
        @endforeach
    @endif
    <div class="info">Évaluation du comportement du jeune pendant la séance :</div>
    <ul>
        @if($note->comportement)
            @foreach($note->comportement as $c)
                <li>{{ $c }}</li>
            @endforeach
        @endif
    </ul>
    <div class="info">Contenu abordé dans la séance</div>
    <ul>
        @if($note->contenu)
            @foreach($note->contenu as $c)
                <?php
                $contenu = \App\ContenuSeance::find($c);
                ?>
                <li>{{ $contenu->categories.": ".$contenu->label }}</li>
            @endforeach
        @endif
    </ul>
    <div class="info">Commentaires :</div>
    <div class="info">{{$note->commentaires}}</div>
    <div class="info">Date de la prochaine rencontre: {{$note->prochaine_rencontre}}</div>




@endsection