@extends('layouts.row')
@section('panel-heading')
    <h1>{{$mesure->dossier->prenom.' '.$mesure->dossier->nom.': temps '.$mesure->temps}}</h1>
@endsection
@section('body')
    <div class="list-group">
        @foreach($mesure->getTokens() as $q)
            @if($q->rep=="PA" && !$mesure->dossier->hasRepondant())
            @elseif($q->rep=="EN" && !$mesure->dossier->currentEnseignant())
            @elseif($q->rep=="JE" && $mesure->age<8)
            @elseif($q->isCompleted()=="N")
                <a class="list-group-item"
                   href="{{url(env('LS_BASE_PATH').'/index.php?r=survey/index/sid/'.$q->ls_id.'/token/'.$q->token.'/lang//newtest/Y')}}">{{$q->questionnaire->titre}}
                </a>
            @else
                <div class="list-group-item list-group-item-success">
                    {{$q->questionnaire->titre}}
                    <div class="pull-right"><b>{{$q->isCompleted()}}</b></div>
                </div>
            @endif
        @endforeach
    </div>
    @if(!$mesure->dossier->exclu && !$mesure->dossier->hasRepondant())
        <div class="alert alert-warning">
            Le parent n'a pas été ajouté.
            <a class="alert-link" href="{{url('parents/create',$mesure->dossier->id)}}">Ajouter un parent
                répondant</a>
        </div>
    @endif
    @if(!$mesure->dossier->exclu && !$mesure->dossier->currentEnseignant())
        <div class="alert alert-warning">
            L'enseignant n'a pas été ajouté
            <a class="alert-link" href="{{url('enseignants/create',$mesure->dossier->id)}}">Ajouter un enseignant
                répondant</a>
        </div>
    @endif
    @if($mesure->age<8)
        <div class="alert alert-info">
            Le questionnaire jeune n'a pas été généré, puisque le jeune est âgé de moins de huit ans.
        </div>
    @endif
    @if($mesure->dossier->exclu)
        <div class="alert alert-info">
            Les questionnaires parent et enseignant n'ont pas été générés, puisque le jeune est exclu de l'étude.
        </div>
    @endif
    @if($mesure->date->month >= 7 && $mesure->date->month < 10)
        <div class="alert alert-info">
            Le questionnaire enseignant n'a pas été généré, puisque la première séance a lieu entre le mois de juillet
            et d'octobre.
        </div>
    @endif
@endsection
@section('script')
    <script type="text/javascript">
    </script>
@endsection		