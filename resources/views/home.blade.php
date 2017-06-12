@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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
                                <span class="input-group-btn">
                    <button class="btn btn-primary">Recherche</button>
                </span>
                            </div>

                            @if ($errors->has('recherche'))
                                <span class="help-block">
         <strong>{{ $errors->first('recherche') }}</strong>
     </span>
                            @endif

                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        Derniers dossiers créés
                    </h1>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @foreach($last as $d)
                            <a class="list-group-item" href="{{ url('dossiers/show', $d->id) }}">
                                {{$d->prenom}} {{$d->nom}}
                                <span class="pull-right">{{ $d->created_at }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
