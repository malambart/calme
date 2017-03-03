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
    <a class="btn btn-primary pull-right" href="{{url('dossiers/edit', $dossier->id)}}">Éditer</a>

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
        <hr>
        @if($dossier->parents->count()>0)
            @foreach($dossier->parents->sortByDesc('repondant') as $parent)
                <p>
                    @if($parent->repondant)
                        <b>Parent répondant : </b>
                    @else
                        <b>Parent participant : </b>
                    @endif

                    <a href="{{url('parents/'.$parent->id.'/show')}}">{{$parent->prenom.' ('.$parent->getLien().')'}}</a>
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
        @if(!$dossier->exclu && !$dossier->hasRepondant())
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


    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="myTab">
        <li class="active"><a href="#plan-intervention" role="tab" data-toggle="tab">Plan d'intervention</a></li>
        <li><a href="#notes-evolutives" role="tab" data-toggle="tab">Notes évolutives</a></li>
        <li><a href="#journeaux-bord" role="tab" data-toggle="tab">Journaux de bord</a></li>
        <li><a href="#bilan-final" role="tab" data-toggle="tab">Bilan final</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="plan-intervention">
            <a href="{{url('plans/1',$dossier->id)}}" class="btn btn-primary">Compléter le plan d'intervention</a></div>
        <div class="tab-pane" id="notes-evolutives">
            Notes évolutives
        </div>
        <div class="tab-pane" id="journeaux-bord">
            Journeaux de bord
        </div>
        <div class="tab-pane" id="bilan-final">
            Bilan final
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
