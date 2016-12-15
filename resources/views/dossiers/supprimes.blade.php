@extends('layouts.row')
@section('panel-heading')
    <h1>Dossiers supprimés</h1>
    <a class="pull-right" href="{{url('dossiers/index')}}">Dossiers non supprimés</a>
@endsection
@section('body')
    <div ul='list-group'>
        @foreach($dossiers as $dossier)
            <li class="list-group-item" href={{url('dossiers/'.$dossier->id.'/show')}}>
                {{$dossier->nom_complet}} ({{$dossier->id}})
                <a href="{{url('dossiers/'.$dossier->id.'/restore')}}" class="pull-right">Restaurer</a>
            </li>
        @endforeach
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $("#gestion_dossiers").addClass("active");
        $("#liste").addClass("active");
    </script>
@endsection
