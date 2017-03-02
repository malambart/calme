<ul class="list-inline pull-right">
    @if($section>1)
    <li>
        <a class="btn btn-primary" href="{{url('plans',[$section-1,$plan->id])}}">Précédant</a>
    </li>
    @endif
    <li>
        <button type="submit" class="btn btn-primary">
            Suivant
        </button>
    </li>
</ul>