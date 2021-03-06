@extends('layouts.row')
@section('panel-heading')
    <h1>Télécharger les données</h1>
@endsection
@section('body')
    <form role="form" method="POST" action="{{ url('downloads/getfile') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Tables à télécharger</label>
            @foreach( $models as $model)
                <div class="checkbox">
                    <label><input type="checkbox" name="choix[]" value="{{ $model[1] }}" checked>{{ $model[0] }}</label>
                </div>
            @endforeach
        </div>
        <div class="form-group">
            <label>Questionnaires à télécharger</label>
            @foreach( $questionnaires as $questionnaire)
                <div class="checkbox">
                    <label><input type="checkbox" name="questionnaires[]" value="{{ $questionnaire[1] }}" checked>{{ $questionnaire[0] }}</label>
                </div>
            @endforeach
@foreach( $archives as $archive)
<div class="checkbox">
                    <label><input type="checkbox" name="archives[]" value="{{ $archive[1] }}" checked>{{ $archive[0] }}</label>
                </div>
@endforeach
        </div>


        <button type="submit" class="btn btn-primary pull-right">
            Télécharger
        </button>
    </form>
@endsection    
