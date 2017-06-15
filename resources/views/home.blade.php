@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('partials.recherche-form')
        <div class="col-md-10 col-md-offset-1">
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
