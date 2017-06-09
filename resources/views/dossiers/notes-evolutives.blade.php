<?php
if ($dossier->notes()->orderBy('no_seance', 'desc')->first()) {
    $next = 1 + $dossier->notes()->orderBy('no_seance', 'desc')->first()->no_seance;
    if( $next==9 ) {
        $next = 1+$next;
    }
} else {
    $next = 1;
}
?>
<a class="btn btn-primary" href="{{ url('notes/create', [$dossier->id,$next]) }}">Créer la note évolutive pour la rencontre {{ $next }}</a>
<br>
<br>
<div class="list-group">
    @foreach($dossier->notes()->orderBy('no_seance')->get() as $note)
        <a class="list-group-item" href="{{ url('notes/show', $note->id) }}">Note de la séance {{ $note->no_seance." (".$note->date.")"}}</a>
    @endforeach
</div>

