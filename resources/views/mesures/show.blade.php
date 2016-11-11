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
@if($mesure->dossier->age<8)
<div class="alert alert-info">
	Le questionnaire jeune n'a pas été généré,  puisque le jeune est âgé de moins de huit ans.
</div>
@endif
@if($mesure->dossier->exclu)
<div class="alert alert-info">
	Les questionnaires parent et enseignant n'ont pas été générés,  puisque le jeune est exclu de l'étude.
</div>
@endif
@if($mesure->dossier->premiere_seance->month >= 7 && $mesure->dossier->premiere_seance->month < 10)
<div class="alert alert-info">
	Le questionnaire enseignant n'a pas été généré,  puisque la première séance a lieu entre le mois de juillet et d'octobre.
</div>
@endif

@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection		