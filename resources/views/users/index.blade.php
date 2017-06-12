@extends('layouts.row')
@section('panel-heading')
    <h1>
        Liste des utilisateurs
    </h1>
@endsection
@section('body')
    <ul class="list-group">
        @foreach($users as $user)
        <li class="list-group-item">
            <a href="{{url('/utilisateurs/show', $user->id)}}">
                {{$user->name}} ({{$user->role}})
            </a>
        </li>
        
        @endforeach
    </ul>
<a class="btn btn-primary" href="{{url('/utilisateurs/ajout')}}">Ajouter un utilisateur</a>
@endsection
@section('script')
<script type="text/javascript">
$( "#liste_utilisateurs" ).addClass( "active" );
</script>
@endsection
