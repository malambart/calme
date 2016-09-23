@extends('layouts.row')
@section('body')
    <ul class="list-group">
        @foreach($users as $user)
        <li class="list-group-item">
            <a href="{{url('/utilisateurs/'.$user->id)}}">
                {{$user->name}} ({{$user->role}})
            </a>
        </li>
        
        @endforeach
    </ul>
<a class="btn btn-primary" href="{{url('/utilisateurs/ajout')}}">Ajouter un utilisateur</a>
@endsection
@section('script')
<script type="text/javascript">
$( "#gestion_utilisateurs" ).addClass( "active" );
</script>
@endsection
