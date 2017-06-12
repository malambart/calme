<!--
 * Created by PhpStorm.
 * Project: calme
 * User: laff3601
 * Date: 03/03/17
 * Time: 15:47
-->

@extends('layouts.row')
@section('panel-heading')
    <h1>Éditer le temps de mesure</h1>
@endsection
@section('body')
    <form role="form" method="POST" action="{{ url('mesures/edit', $mesure->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
            <label for="date" class=" control-label">
                @if($mesure->temps==1)
                    Date du début du traitement <span class="tip">(aaaa-mm-jj)</span>
                @elseif($mesure->temps==2)
                    Date du bilan final <span class="tip">(aaaa-mm-jj)</span>
                 @endif
            </label>
            <input id="date" type="date" class="form-control datepicker" name="date" value="{{ old('date', $mesure->date->toDateString()) }}">
            @if ($errors->has('date'))
                <span class="help-block"><strong>{{ $errors->first('date') }}</strong></span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary pull-right">
            Sauvegarder
        </button>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
    </script>
@endsection
