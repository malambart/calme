@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{ $dossier->baseUrl() }}">Dossier {{$dossier->id}}</a>: Entrée du journal de bord </h1>
    <a href="{{url('journals/edit', $journal->id)}}" class="btn btn-primary pull-right">Éditer</a>
@endsection
@section('body')
    <div class="info">
        <span class="titre">
            Date de l'entrée:
        </span>
        {{$journal->date}}
    </div>
    <div class="info"><span class="titre">Durée de l'intervention en minutes :</span> {{$journal->duree}}</div>
    <div class="info"><span class="titre">Intervenants présents :</span>
        @if($journal->intervenants)
            {{toCSL($journal->intervenants)}}
        @endif
    </div>
    <div class="info">
        <span class="titre">
            Modalité :
        </span>
        {{ $journal->modalite }}
        @if($journal->modalite_autre)
             ({{$journal->modalite_autre}})
        @endif
    </div>
    <div class="info">
        <span class="titre">
            Destinataires :
        </span>
        {{ toCSL($journal->destinataires) }}
    </div>
    <div class="info">
        <span class="titre">
            Sujet de l'intervention :
        </span>
        {{ $journal->sujet }}
    </div>
    <div class="info">
        <div class="titre">
            Commentaires:
        </div>
        {{ $journal->commentaires }}
    </div>
@endsection