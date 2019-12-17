@extends('layouts.row')
@section('panel-heading')
    <h1>
        {{$dossier->accepte == 1 ? $dossier->nom_complet : "Anonyme" .' ('.$dossier->id.')'}}
        @if($dossier->exclu)
            <i>
                - dossier exclu de l'étude
            </i>
        @endif
    </h1>
    <a class="btn btn-primary pull-right" href="{{url('dossiers/edit', $dossier->id)}}">Éditer</a>
@endsection
@section('body')
    <section>
        @if($dossier->accepte == 1)
        <p>Date de naissance : {{$dossier->date_naiss->toDateString()}}</p>
        @endif
        <p>Âge : {{$dossier->getAge()}}</p>
        <p>Sexe :
            @if($dossier->sexe==1)
                Masculin
            @elseif($dossier->sexe==2)
                Féminin
            @endif</p>
        <p>Numéro de dossier au CHUS : {{$dossier->no_doss_chus}}</p>
        <hr>
        <p>Confirmation reçue des parents :
            @if($dossier->confirmation_received)
                Oui
            @else
                Non
            @endif
        </p>
        @if($dossier->parents->count()>0)
            @foreach($dossier->parents->sortByDesc('repondant') as $parent)
                <p>
                    @if($parent->repondant)
                        <b>Parent répondant : </b>
                    @else
                        <b>Parent participant : </b>
                    @endif

                    <a href="{{url('parents/show', $parent->id)}}">{{$parent->prenom.' ('.$parent->getLien().')'}}</a>
                </p>
                @if($parent->courriel)
                    <p>Courriel du parent : <a href="mailto:{{$parent->courriel}}">{{$parent->courriel}}</a></p>
                @endif
                <p>
                    @if($parent->tel)
                        Numéro de téléphone: {{$parent->tel}}
                    @endif
                    @if($parent->ext)
                        ({{$parent->ext}})
                    @endif
                </p>
                @if($parent->tel2)
                    <p>
                        Numéro de téléphone secondaire : {{$parent->tel2}}
                        @if($parent->ext2)
                            ({{$parent->ext2}})
                        @endif
                    </p>
                @endif
            @endforeach

        @endif
        @if(!$dossier->exclu && !$dossier->hasRepondant() && $dossier->accepte == 1)
            <div class="alert alert-warning">
                Le parent n'a pas été ajouté.
                <a class="alert-link" href="{{url('parents/create',$dossier->id)}}">Ajouter un parent
                    répondant</a>
            </div>
        @else
            <a class="btn btn-primary" href="{{url('parents/create',$dossier->id)}}">Ajouter un parent</a>
        @endif


        <hr>
        @if($enseignant)
            <?php ?>
            <p>Enseignant répondant : <a
                        href="{{url('enseignants/show/'.$enseignant->id.'/'.$dossier->id)}}">{{$enseignant->prenom.' '.$enseignant->nom. ' (école '.$enseignant->ecole()->first()->nom.')'}}</a>
            </p>
        @elseif(!$dossier->exclu)
            <div class="alert alert-warning">
                L'enseignant n'a pas été ajouté.
                <a class="alert-link" href="{{url('enseignants/create',$dossier->id)}}">Ajouter un
                    enseignant</a>
            </div>
        @endif

    </section>
    <hr>
    <div class="clearfix list-header">Questionnaires</div>
    <div class="list-group">
        @foreach($dossier->mesures as $mesure)
            @if(!$mesure->date)
                <a class="list-group-item" href={{url('mesures/ajoutdate',$mesure->id)}}>
                    @if($mesure->temps===1)
                        Entrer la date du début du traitement
                    @elseif($mesure->temps===2)
                        Entrer la date du bilan final
                    @endif
                </a>
            @else
                <a class="list-group-item" href={{url('mesures/show',$mesure->id)}}>
                    @if($mesure->temps===1)
                        Début du traitement: <b>{{$mesure->date->toDateString()}}</b>
                    @elseif($mesure->temps===2)
                        Bilan final: <b>{{$mesure->date->toDateString()}}</b>
                    @endif
                    <span class="badge">{{$mesure->qCompleted()['complet'].' / '.$mesure->qCompleted()['deno']}}</span>
                </a>
            @endif
        @endforeach
    </div>
    <hr>
        <div class="panel-group menu-accordeon" id="accordion">
            <div class="panel panel-default">
                <a class="menu-link" data-toggle="collapse" data-parent="#accordion" href="#plan-intervention">
                    <div class="panel-heading">
                    <div class="panel-title">
                        Plan d'intervention
                    </div>
                    </div>
                </a>
                <div class="panel-collapse collapse" id="plan-intervention">
                    <div class="panel-body">
                        @include('dossiers.plan_intervention')
                    </div>

                </div>
            </div>
            <div class="panel panel-default">
                <a class="menu-link" data-toggle="collapse" data-parent="#accordion" href="#notes-evolutives">
                    <div class="panel-heading">
                        <div class="panel-title">
                            Notes évolutives
                        </div>
                    </div>
                </a>
                <div class="panel-collapse collapse" id="notes-evolutives">
                    <div class="panel-body">
                        @include('dossiers.notes-evolutives')
                    </div>

                </div>
            </div>
            <div class="panel panel-default">
                <a class="menu-link" data-toggle="collapse" data-parent="#accordion" href="#journaux-bord">
                    <div class="panel-heading">
                        <div class="panel-title">
                            Journal de bord
                        </div>
                    </div>
                </a>
                <div class="panel-collapse collapse" id="journaux-bord">
                    <div class="panel-body">
                       @include('dossiers.journal-de-bord')
                    </div>

                </div>
            </div>
            <div class="panel panel-default">
                <a class="menu-link" data-toggle="collapse" data-parent="#accordion" href="#bilan-final">
                    <div class="panel-heading">
                        <div class="panel-title">
                            Bilan final
                        </div>
                    </div>
                </a>
                <div class="panel-collapse collapse" id="bilan-final">
                    <div class="panel-body">
                        Bilan final
                    </div>

                </div>
            </div>

@endsection
@section('script')
    <script type="text/javascript">

        $('.doc-section').hide();

        $('#section_plan_intervention').show();

        $('#plan_intervention').click(function () {
            event.preventDefault();
            $('.nav-tabs li').removeClass('active');
            $(this).parent().addClass('active');
            $('.doc_section').hide();
            $('#section_plan_intervention').show();
        });

        $('#notesEvolutives').click(function () {
            event.preventDefault();
            $('.nav-tabs li').removeClass('active');
            $(this).parent().addClass('active');
            $('.doc_section').hide();
            $('#section_notes_evolutives').show();
        });
    </script>
@endsection
