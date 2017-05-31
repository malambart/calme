<div class="list-group">
    @for($i = 1; $i <= 10; $i++)
            @if ($i == 9)
            @else
                    <a href="{{ url('notes/create', [$dossier->id,$i]) }}" class="list-group-item">Créér la note évolutive pour la séance {{$i}}</a>
            @endif

    @endfor
</div>

