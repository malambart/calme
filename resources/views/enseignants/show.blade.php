@extends('layouts.row')
@section('panel-heading')
    <h1>{{$enseignant->prenom.' '.$enseignant->nom.' (enseignant)'}}</h1>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{url('enseignants/edit', [$enseignant->id, $dossier->id])}}">Éditer</a>
        <a class="btn btn-primary" href="{{url('enseignants/create',$enseignant->id)}}">Changer d'enseignant</a>
    </div>
@endsection
@section('body')
    <div class="alert alert-warning">
        Pour modifier les infos de l'enseignant (ex. : corriger une erreur dans le nom, changer l'adresse courriel,
        etc), utiliser le bouton "Edit". Si l'enseignant répondant <b>change au cours du projet</b>, utilisez le bouton
        "changer d'enseignant".
    </div>
    <div class="rapport">
        <div class="ligne-rapport">
            <span>
                École :
            </span>
            <a href="{{url('ecoles/show', $ecole->id)}}">{{$ecole->nom}}</a>
        </div>
        <div class="ligne-rapport">
            <span>
                Courriel :
            </span>
            <a href="mailto:{{$enseignant->courriel}}">{{$enseignant->courriel}}</a>
        </div>
        <h1>Adresse</h1>
        <div class="ligne-rapport">
            <span>
                No civique:
            </span>
            {{ $enseignant->adresse->no_civique }}
        </div>
        <div class="ligne-rapport">
            <span>
                Rue:
            </span>
            {{ $enseignant->adresse->rue }}
        </div>
        <div class="ligne-rapport">
            <span>
                Code postal:
            </span>
            {{ $enseignant->adresse->cp }}
        </div>
        <div class="ligne-rapport">
            <span>
                Ville:
            </span>
            {{ $enseignant->adresse->ville }}
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
    </script>
@endsection