@extends('layouts.row')
@section('panel-heading')
<ul class="nav nav-pills">
<li id="liste_utilisateurs">
		<a href="{{url('/utilisateurs')}}">Liste</a>
	</li>
	<li id="gestion_dossiers">
		<a href="{{url('/utilisateurs/ajout')}}">Ajouter</a>
	</li>
</ul>
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
