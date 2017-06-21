
    <a href="{{ url('journals/create', $dossier->id) }}" class="btn btn-primary">Ajouter une entrée</a>
<br>
<br>
<div class="list-group">
    @foreach($dossier->journals as $journal)
        <a class="list-group-item" href="{{ url('journals/show', $journal->id) }}">Entrée du {{$journal->date}}</a>
    @endforeach
</div>