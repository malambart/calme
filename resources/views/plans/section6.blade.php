<!--
 * Created by PhpStorm.
 * Project: calme
 * User: laff3601
 * Date: 02/03/17
 * Time: 11:48
-->

@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a>: compléter le plan d'intervention : Évaluation
        module CALME</h1>
@endsection
@section('body')
    <form role="form" method="POST" action="{{ url('plans',[$section,$plan->id]) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group{{ $errors->has('facteurs_predisposants') ? ' has-error' : '' }}">
            <label for="facteurs_predisposants" class=" control-label">Facteur(s) prédisposant(s)</label>
            <textarea id="facteurs_predisposants" class="form-control"
                      name="facteurs_predisposants">{{ old('facteurs_predisposants', $plan->facteurs_predisposants) }}</textarea>
            @if ($errors->has('facteurs_predisposants'))
                <span class="help-block">
        		    <strong>{{ $errors->first('facteurs_predisposants') }}</strong>
        		</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('facteurs_precipitants') ? ' has-error' : '' }}">
            <label for="facteurs_precipitants" class=" control-label">Facteur(s) précipitant(s)</label>
            <textarea id="facteurs_precipitants" class="form-control"
                      name="facteurs_precipitants">{{ old('facteurs_precipitants', $plan->facteurs_precipitants) }}</textarea>
            @if ($errors->has('facteurs_precipitants'))
                <span class="help-block">
        		    <strong>{{ $errors->first('facteurs_precipitants') }}</strong>
        		</span>
            @endif
        </div>
        <h2>Facteur(s) de maintien</h2>
        <div class="form-group{{ $errors->has('cognitions') ? ' has-error' : '' }}">
            <label for="cognitions" class=" control-label">Cognitions</label>
            <textarea id="cognitions" class="form-control"
                      name="cognitions">{{ old('cognitions', $plan->cognitions) }}</textarea>
            @if ($errors->has('cognitions'))
                <span class="help-block">
        		    <strong>{{ $errors->first('cognitions') }}</strong>
        		</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('sensations_physiques') ? ' has-error' : '' }}">
            <label for="sensations_physiques" class=" control-label">Sensations physiques</label>
            <textarea id="sensations_physiques" class="form-control"
                      name="sensations_physiques">{{ old('sensations_physiques', $plan->sensations_physiques) }}</textarea>
            @if ($errors->has('sensations_physiques'))
                <span class="help-block">
        		    <strong>{{ $errors->first('sensations_physiques') }}</strong>
        		</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('comportements') ? ' has-error' : '' }}">
            <label for="comportements" class=" control-label">Comportements</label>
            <textarea id="comportements" class="form-control"
                      name="comportements">{{ old('comportements', $plan->comportements) }}</textarea>
            @if ($errors->has('comportements'))
                <span class="help-block">
        		    <strong>{{ $errors->first('comportements') }}</strong>
        		</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('rassurance') ? ' has-error' : '' }}">
            <label for="rassurance" class=" control-label">Rassurance</label>
            <textarea id="rassurance" class="form-control"
                      name="rassurance">{{ old('rassurance', $plan->rassurance) }}</textarea>
            @if ($errors->has('rassurance'))
                <span class="help-block">
        		    <strong>{{ $errors->first('rassurance') }}</strong>
        		</span>
            @endif
        </div>
        <input type="hidden" name="imp_maison" value="0">
        <input type="hidden" name="imp_ecole" value="0">
        <input type="hidden" name="imp_loisirs" value="0">
        <input type="hidden" name="imp_reseau_social" value="0">
        <label for="imp_maison">Impacts fonctionnels</label>
        <div class="checkbox">
            <label><input type="checkbox" value="1" name="imp_maison"
                          @if(old('imp_maison', $plan->imp_maison)==1))
                          checked
                        @endif
                >Maison (ex.:relation)</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" value="1" name="imp_ecole"
                          @if(old('imp_ecole', $plan->imp_ecole)==1))
                          checked
                        @endif>École (ex.:absentéisme, rendement,
                motivation)</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" value="1" name="imp_loisirs"
                          @if(old('imp_loisirs', $plan->imp_loisirs)==1))
                          checked
                        @endif>Loisirs</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" value="1" name="imp_reseau_social"
                          @if(old('imp_reseau_social', $plan->imp_reseau_social)==1))
                          checked
                        @endif>Réseau social</label>
        </div>
        <div class="form-group{{ $errors->has('impacts_d') ? ' has-error' : '' }}">
            <label for="impacts_d" class=" control-label">Expliquer</label>
            <textarea id="impacts_d" class="form-control" name="impacts_d">{{ old('impacts_d', $plan->impacts_d) }}</textarea>
            @if ($errors->has('impacts_d'))
                <span class="help-block">
        		    <strong>{{ $errors->first('impacts_d') }}</strong>
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
