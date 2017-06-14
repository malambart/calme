<!--
 * Created by PhpStorm.
 * Project: calme
 * User: laff3601
 * Date: 02/03/17
 * Time: 11:47
-->

@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a>: compléter le plan d'intervention : Plan
            d'intervention scolaire</h1>
@endsection
@section('body')
    <div id="app">
        <form role="form" method="POST" action="{{ url('plans',[$section,$plan->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group{{ $errors->has('plan_intervention_scolaire') ? ' has-error' : '' }}">
                <label for="plan_intervention_scolaire" class="control-label">Plan d'intervention scolaire</label>
                <select v-model="planIntervention" class="form-control" name="plan_intervention_scolaire">
                    <option value="" selected>Veuillez choisir</option>
                    <option value="1"
                            @if(old('plan_intervention_scolaire', $plan->plan_intervention_scolaire)=="1")
                            selected
                            @endif>
                        Oui
                    </option>
                    <option value="0"
                            @if(old('plan_intervention_scolaire', $plan->plan_intervention_scolaire)=="0")
                            selected
                            @endif>
                        Non
                    </option>
                </select>
                @if ($errors->has('plan_intervention_scolaire'))
                    <span class="help-block"><strong>{{ $errors->first('plan_intervention_scolaire') }}</strong></span>
                @endif
            </div>
            <div v-show="planIntervention==1" class="form-group{{ $errors->has('lie_anxiete') ? ' has-error' : '' }}">
                <label for="lie_anxiete" class="control-label">Est-ce que le plan d'intervention est lié à
                    l'anxiété?</label>
                <select v-model="lieAnxiete" class="form-control" name="lie_anxiete">
                    <option value="" selected>Veuillez choisir</option>
                    <option value="1"
                            @if(old('lie_anxiete', $plan->lie_anxiete)=="1")
                            selected
                            @endif>
                        Oui
                    </option>
                    <option value="0"
                            @if(old('lie_anxiete', $plan->lie_anxiete)=="0")
                            selected
                            @endif>
                        Non
                    </option>
                </select>
                @if ($errors->has('lie_anxiete'))
                    <span class="help-block"><strong>{{ $errors->first('lie_anxiete') }}</strong></span>
                @endif
            </div>
            <div v-show="lieAnxiete==1 && planIntervention==1" class="form-group{{ $errors->has('lie_anxiete_d') ? ' has-error' : '' }}">
                <label for="lie_anxiete_d" class=" control-label">Expliquer</label>
                <input id="lie_anxiete_d" type="text" class="form-control" name="lie_anxiete_d"
                       value="{{ old('lie_anxiete_d', $plan->lie_anxiete_d) }}">
                @if ($errors->has('lie_anxiete_d'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('lie_anxiete_d') }}</strong>
            		</span>
                @endif
            </div>
            @include('plans/nav')
        </form>
    </div>
@endsection
@section('script')

    <script type="text/javascript">
        vm = new Vue({
            el: '#app',
            data: {
                planIntervention:'{{$plan->plan_intervention_scolaire}}',
                lieAnxiete:'{{$plan->lie_anxiete}}'
            },
        })
    </script>
@endsection
