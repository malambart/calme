<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading"><h1>Rechercher un dossier</h1></div>
        <div class="panel-body">
            <form role="form" method="POST" action="{{ url('recherche') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('recherche') ? ' has-error' : '' }}">
                    <div class="input-group">
                        <input required placeholder="Recherche par nom,  id,  etc..." id="name" type="text" class="form-control"
                               name="recherche" value="{{ old('name') }}" autofocus>
                        <span class="input-group-btn"><button class="btn btn-primary">Recherche</button></span>
                    </div>
                    @if ($errors->has('recherche'))
                        <span class="help-block"><strong>{{ $errors->first('recherche') }}</strong></span>
                    @endif
                </div>
            </form>
            @if(isset($results))
                @if($results->count() == 0)
                    Aucun résultat pour <i><b>{{ $chaine }}</b></i>. Veuiller réessayer.
                @else
                    <h1>Résultats pour <i><b>{{$chaine}}</b></i> :</h1>
                    <div class="list-group">
                        @foreach($results as $r)
                            <a href="{{ url('dossiers/show', $r->id) }}" class="list-group-item">
                                {{ $r->nom_complet }}
                                <span class="pull-right">{{$r->id}}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>