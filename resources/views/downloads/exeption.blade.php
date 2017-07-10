@extends('layouts.row')
@section('panel-heading')
    <h1>Une erreur s'est produite.</h1>
@endsection
@section('body')
    <p>Le fichier n'a pu être généré.</p>
        <a class='btn btn-primary' href="{{ url('/downloads/selection') }}">Réessayer</a>
    <hr>
    {{ var_dump($e) }}
@endsection    