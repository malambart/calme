
@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a>: compléter le plan d'intervention : évaluation
        pédopsychiatrique</h1>
@endsection
@section('body')
    <div id="app">
        <form role="form" method="POST" action="{{ url('plans',[$section,$plan->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group{{ $errors->has('date_eval') ? ' has-error' : '' }}">
                <label for="date_eval" class=" control-label">Date de l'évaluation<span
                            class="tip">(aaaa-mm-jj)</span></label>
                <input id="date_eval" type="date" class="form-control datepicker" name="date_eval"
                       value="{{ old('date_eval', $plan->date_eval) }}" autofocus>
                @if ($errors->has('date_eval'))
                    <span class="help-block"><strong>{{ $errors->first('date_eval') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('pedopsy') ? ' has-error' : '' }}">
                <label for="pedopsy" class=" control-label">Pédopsychiatre</label>
                <input id="pedopsy" type="text" class="form-control" name="pedopsy"
                       value="{{ old('pedopsy', $plan->pedopsy) }}">
                @if ($errors->has('pedopsy'))
                    <span class="help-block">
        		    <strong>{{ $errors->first('pedopsy') }}</strong>
        		</span>
                @endif
            </div>

            <div class="{{ $errors->has('new_diagnostic') ? ' has-error' : '' }}">
                <list-input name="diagnostics"
                            titre="Troubles anxieux retenus"
                            tip="Entrez un trouble anxieux et appuyer sur Enter"
                            inputname="new_diagnostic"
                            items="{{ json_encode($plan->diagnostics) }}"
                            value="{{old('new_diagnostic')}}"
                ></list-input>
                @if ($errors->has('new_diagnostic'))
                    <span class="help-block">
        		    <strong>Ce diagnostic n'a pas été soumis.</strong>
        		</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('autres') ? ' has-error' : '' }}">
                <label for="autres" class=" control-label">Autres</label>
                <input id="autres" type="text" class="form-control" name="autres"
                       value="{{ old('autres', $plan->autres) }}">
                @if ($errors->has('autres'))
                    <span class="help-block">
        		    <strong>{{ $errors->first('autres') }}</strong>
        		</span>
                @endif
            </div>

            <div class="{{ $errors->has('new_medicament') ? ' has-error' : '' }} clearfix">
                <list-med
                        name="medication"
                        items="{{old('medication', json_encode($plan->medication))}}"
                        old_med="{{ old('new_medicament') }}"
                        old_posologie="{{ old('new_posologie') }}"
                        old_unit="{{ old('new_unit') }}"
                ></list-med>
                @if ($errors->has('new_medicament'))
                    <span class="help-block"><strong>Le médicament n'a pas été soumis.</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('reference') ? ' has-error' : '' }}">
                <label for="reference" class=" control-label">Date de la référence au module Calme<span
                            class="tip">(aaaa-mm-jj)</span></label>
                <input id="reference" type="date" class="form-control datepicker" name="reference"
                       value="{{ old('reference', $plan->reference) }}">
                @if ($errors->has('reference'))
                    <span class="help-block"><strong>{{ $errors->first('reference') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('motif') ? ' has-error' : '' }}">
                <label for="motif" class=" control-label">Motif de la référence</label>
                <input id="motif" type="text" class="form-control" name="motif"
                       value="{{ old('motif', $plan->motif) }}">
                @if ($errors->has('motif'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('motif') }}</strong>
            		</span>
                @endif
            </div>
            @include('plans/nav')
        </form>
    </div>
@endsection
@section('script')
    <script>
        vm = new Vue({
            el: '#app',
        })
    </script>
@endsection
