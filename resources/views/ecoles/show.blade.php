@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>École {{$ecole->nom}}</h1>
                    <a class="btn btn-primary pull-right" href="{{url('ecoles/edit', $ecole->id)}}">Éditer</a>
                </div>

                <div class="panel-body">
                    <p>Ville : {{$ecole->ville}}</p>
                    <p>Téléphone : {{$ecole->telephone}}</p>
                    <p>Fax : {{$ecole->telephone}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
