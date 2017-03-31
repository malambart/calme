
<!--
 * Created by PhpStorm.
 * Project: calme
 * User: laff3601
 * Date: 02/03/17
 * Time: 11:48
-->

@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a>: compléter le plan d'intervention : Attentes</h1>
@endsection
@section('body')
    <form role="form" method="POST" action="{{ url('plans',[$section,$plan->id])}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group{{ $errors->has('attentes_jeune') ? ' has-error' : '' }}">
            <label for="attentes_jeune" class=" control-label">Attendes du jeune</label>
            <textarea id="attentes_jeune" class="form-control"
                      name="attentes_jeune">{{ old('attentes_jeune', $plan->attentes_jeune) }}</textarea>
            @if ($errors->has('attentes_jeune'))
                <span class="help-block">
        		    <strong>{{ $errors->first('attentes_jeune') }}</strong>
        		</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('attentes_parents') ? ' has-error' : '' }}">
            <label for="attentes_parents" class=" control-label">Attentes des parents</label>
            <textarea id="attentes_parents" class="form-control"
                      name="attentes_parents">{{ old('attentes_parents', $plan->attentes_parents) }}</textarea>
            @if ($errors->has('attentes_parents'))
                <span class="help-block">
        		    <strong>{{ $errors->first('attentes_parents') }}</strong>
        		</span>
            @endif
        </div>
        @include('plans/nav')
    </form>
@endsection
@section('script')
    @include('partials.dateSupport')
    <script type="text/javascript">
    </script>
@endsection
