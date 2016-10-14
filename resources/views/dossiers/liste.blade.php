@extends('layouts.row')
@section('navLevel2')
@include('dossiers.navLevel2')
@endsection
@section('body')
<div class='list-group'>
	@foreach($dossiers as $dossier)
	<a class="list-group-item" href={{url('dossiers/'.$dossier->id.'/show')}}>
			{{$dossier->nom_complet}}
			<span class="pull-right">{{$dossier->id}}</span>
	</a>
	@endforeach
</div>
@endsection
@section('script')
<script type="text/javascript">
	$( "#gestion_dossiers" ).addClass( "active" );
	$( "#liste" ).addClass( "active" );
</script>
@endsection
