@extends('layouts.row')
@section('panel-heading')
<h1>{{$mesure->dossier->prenom.' '.$mesure->dossier->nom.': temps '.$mesure->temps}}</h1>
@endsection
@section('body')
<div class="list-group">
	@foreach($mesure->tokens as $token)
		<a class="list-group-item" href="{{url(env('LS_BASE_PATH').'/index.php?r=survey/index/sid/'.$token->ls_id.'/token/'.$token->token.'/lang//newtest/Y')}}">{{$token->questionnaire->titre}}</a>
	@endforeach
</div>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection		