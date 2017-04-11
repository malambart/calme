<ul class="list-inline pull-right">
    @if($section>1)
        <li>
            <a class="btn btn-primary" href="{{url('plans',[$section-1,$dossier->id])}}">Précédant</a>
        </li>
    @endif
    @if ($section<9)
        <li>
            <button type="submit" class="btn btn-primary">
                Sauvegarder et continuer
            </button>
        </li>
    @else
        <li>
            <button type="submit" class="btn btn-primary">
                Sauvegarder et terminer
            </button>
        </li>
    @endif

</ul>