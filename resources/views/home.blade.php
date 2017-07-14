@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('partials.recherche-form')
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        Prochains suivis
                    </h1>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @foreach($mesures as $mesure)
                            <a class="list-group-item" href="{{ url('mesures/show', $mesure->id) }}">
                            {{$mesure->dossier->nom_complet}} -
                            @if($mesure->temps===1)
                                Début du traitement: <b>{{$mesure->date->toDateString()}}</b>
                            @elseif($mesure->temps===2)
                                Bilan final: <b>{{$mesure->date->toDateString()}}</b>
                            @endif
                            <span class="badge">{{$mesure->qCompleted()['complet'].' / '.$mesure->qCompleted()['deno']}}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        Derniers dossiers créés
                    </h1>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @foreach($last as $d)
                            <a class="list-group-item" href="{{ url('dossiers/show', $d->id) }}">
                                {{$d->prenom}} {{$d->nom}}
                                <span class="pull-right">{{ $d->created_at }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
