@extends('layouts.row')
@section('panel-heading')
    <h1>{{$parent->prenom.' '.$parent->nom.' '}}(parent répondant)</h1>
    <div class="pull-right">

    </div>

    <ul class="list-inline pull-right">
        <li>
            <a href="{{url('dossiers/show',$parent->dossier->id)}}" class="btn btn-primary">Retour</a>
        </li>
        <li>
            <a class="btn btn-primary" href="{{url('parents/edit',$parent->id)}}">Éditer</a>
        </li>
    </ul>

@endsection
@section('body')
    <p>Lien avec le jeune :
        @if($parent->lien=='autre')
            {{$parent->lien_autre}}
        @else
            {{$parent->lien}}
        @endif
    </p>
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
    <p>Courriel: <a href="mailto:{{$parent->courriel}}">{{$parent->courriel}}</a></p>
    <p>Lieu du T1: {{$parent->lieuT1}}</p>
@endsection
@section('script')
    <script type="text/javascript">
    </script>
@endsection		