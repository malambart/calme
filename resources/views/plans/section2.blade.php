
<!--
 * Created by PhpStorm.
 * Project: calme
 * User: laff3601
 * Date: 24/02/17
 * Time: 15:25
-->

@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a>: compléter le plan d'intervention : évaluation pédopsychiatrique</h1>
@endsection
@section('body')
    <form role="form" method="POST" action="{{ url('plan/edit/section2', $dossier->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group{{ $errors->has('date_eval') ? ' has-error' : '' }}">
            <label for="date_eval" class=" control-label">Date de l'évaluation<span
                        class="tip">(aaaa-mm-jj)</span></label>
            <input id="date_eval" type="date" class="form-control datepicker" name="date_eval"
                   value="{{ old('date_eval') }}">
            @if ($errors->has('date_eval'))
                <span class="help-block"><strong>{{ $errors->first('date_eval') }}</strong></span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('pedopsy') ? ' has-error' : '' }}">
            <label for="pedopsy" class=" control-label">Pédopsychiatre</label>
            <input id="pedopsy" type="text" class="form-control" name="pedopsy" value="{{ old('pedopsy') }}">
            @if ($errors->has('pedopsy'))
                <span class="help-block">
        		    <strong>{{ $errors->first('pedopsy') }}</strong>
        		</span>
            @endif
        </div>
        <a href="{{url('plans/edit/section1', $dossier->id)}}"></a>
        <button type="submit" class="btn btn-primary pull-right">
            Suivant
        </button>
    </form>
@endsection
@section('script')
    @include('partials.dateSupport')
    <script type="text/javascript">
    </script>
@endsection
