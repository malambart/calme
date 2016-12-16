@extends('layouts.row')
@section('panel-heading')
    <h1>Rechercher un dossier</h1>
@endsection
@section('body')
    <form role="form" method="POST" action="{{ url('recherche') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('recherche') ? ' has-error' : '' }}">
            <div class="input-group">
                <input placeholder="Recherche par nom,  id,  etc..." id="name" type="text" class="form-control"
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
    @if(isset($results))
        <p>Résultats pour <em>{{$chaine}}</em>:</p>
        @if(count($results)==0)
            Aucun résultat. Veuillez réessayer.
        @else
            <div class="list-group">
                @foreach($results as $result)
                    <a class="list-group-item"
                       href="{{url('dossiers/'.$result->id.'/show')}}">{{$result->prenom.' '.$result->nom}}</a>
                @endforeach
            </div>
        @endif
    @endif

@endsection
@section('script')

@endsection        