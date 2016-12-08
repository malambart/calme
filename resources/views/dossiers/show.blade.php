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
    <a class="btn btn-primary pull-right" href="{{url('dossiers/'.$dossier->id.'/edit')}}">Éditer</a>

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
        <p>Date de la première séance de traitement : {{$dossier->premiere_seance->toDateString()}}</p>
        <p>Date du bilan final : {{$dossier->bilan_final}}</p>
        <hr>
        @if($parent)
            <p>Parent répondant : <a
                        href="{{url('parents/'.$parent->id.'/show')}}">{{$parent->prenom.' ('.$parent->getLien().')'}}</a>
            </p>
            @if($parent->courriel)
                <p>Courriel du parent : <a href="mailto:{{$parent->courriel}}">{{$parent->courriel}}</a></p>
            @endif
            <p>
                Numéro de téléphone: {{$parent->tel}}
                @if($parent->ext)
                    ({{$parent->ext}})
                @endif
            </p>
            @if($parent->tel2)
                <p>
                    Numéro de téléphone secondaire : {{$parent->tel2}}
                    @if($parent->ext2)
                        ($parent->ext2)
                    @endif
                </p>
            @endif
        @elseif(!$dossier->exclu)
            <div class="alert alert-warning">
                Le parent n'a pas été ajouté.
                <a class="alert-link" href="{{url('parents/'.$dossier->id.'/create')}}">Ajouter un parent répondant</a>
            </div>
        @endif
        <hr>
        @if($enseignant)
            <?php ?>
            <p>Enseignant répondant : <a
                        href="{{url('enseignants/'.$enseignant->id.'/'.$dossier->id.'/show')}}">{{$enseignant->prenom.' '.$enseignant->nom. ' (école '.$enseignant->ecole()->first()->nom.')'}}</a>
            </p>
        @elseif(!$dossier->exclu)
            <div class="alert alert-warning">
                L'enseignant n'a pas été ajouté.
                <a class="alert-link" href="{{url('enseignants/'.$dossier->id.'/create')}}">Ajouter un enseignant</a>
            </div>
        @endif

    </section>
    <hr>
    <div class="clearfix list-header">Questionnaires</div>
    <div class="list-group">
        @foreach($dossier->mesures as $mesure)
            <a class="list-group-item" href={{url('mesures/'.$mesure->id.'/show')}}>
                Temps {{$mesure->temps}}:
                @if($mesure->temps===1)
                    (avant le début du traitement)
                @elseif($mesure->temps===2)
                    (lors du bilan final)
                @endif
                <span class="badge">{{$mesure->qCompleted()['complet'].' / '.$mesure->qCompleted()['deno']}}</span>
            </a>
        @endforeach
    </div>
    <hr>


    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="myTab">
        <li class="active"><a href="#home" role="tab" data-toggle="tab">Plan d'intervention</a></li>
        <li><a href="#profile" role="tab" data-toggle="tab">Notes évolutives</a></li>
        <li><a href="#messages" role="tab" data-toggle="tab">Journaux de bord</a></li>
        <li><a href="#settings" role="tab" data-toggle="tab">Bilan final</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
            <div class="tab-pane active" id="home">
                <a href="" class="btn btn-primary">Compléter le plan d'intervention</a></div>
            <div class="tab-pane" id="profile">
                Profile
            </div>
            <div class="tab-pane" id="messages">
                Messages
            </div>
            <div class="tab-pane" id="settings">
                Settings
            </div>
    </div>



@endsection
@section('script')
    <script type="text/javascript">

        $('.doc-section').hide();

        $('#section_plan_intervention').show();

        $('#plan_intervention').click(function(){
            event.preventDefault();
           $('.nav-tabs li').removeClass('active');
           $(this).parent().addClass('active');
           $('.doc_section').hide();
           $('#section_plan_intervention').show();
        });

        $('#notesEvolutives').click(function(){
            event.preventDefault();
            $('.nav-tabs li').removeClass('active');
            $(this).parent().addClass('active');
            $('.doc_section').hide();
            $('#section_notes_evolutives').show();
        });
    </script>
@endsection
