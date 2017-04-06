
@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a>: compléter le plan d'intervention : impressions diagnostiques</h1>
@endsection
@section('body')
    <div id="app">
        <form role="form" method="POST" action="{{ url('plans',[$section,$plan->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div v-for="impression in impressions">
                <hr v-show="impressions.indexOf(impression) > 0">
                <button @click.prevent="pToDelete(impression)" id="delete-button" class="btn btn-danger btn-xs pull-right">X
                </button>
                <input type="hidden" v-model="impression.id"
                       v-bind:name="'impressions['+impressions.indexOf(impression)+'][id]'">
                <div class="form-group{{ $errors->has('impression') ? ' has-error' : '' }}">
                    <label for="impression" class=" control-label">Diagnostic</label>
                    <input id="impression" type="text" class="form-control"
                           v-bind:name="'impressions['+impressions.indexOf(impression)+'][diagnostic]'"
                           v-model="impression.diagnostic">
                    @if ($errors->has('impression'))
                        <span class="help-block"><strong>{{ $errors->first('impression') }}</strong></span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('confirme') ? ' has-error' : '' }}">
                    <label for="confirme" class="control-label">Confirmé ADIS-C</label>
                    <select
                            class="form-control"
                            v-model="impression.confirme"
                            v-bind:name="'impressions['+impressions.indexOf(impression)+'][confirme]'"
                    >
                        <option value="" selected>Veuillez choisir</option>
                        <option value="Oui">
                            Oui
                        </option>
                        <option value="Non">
                            Non
                        </option>
                    </select>
                    @if ($errors->has('confirme'))
                        <span class="help-block"><strong>{{ $errors->first('confirme') }}</strong></span>
                    @endif
                </div>
                <input type="hidden" v-model="impression.confirme"
                       v-bind:name="'impressions['+impressions.indexOf(impression)+'][confirme]'">
                <div class="form-group{{ $errors->has('score_severite') ? ' has-error' : '' }}">
                    <label for="score_severite" class=" control-label">Score de sévérité</label>
                    <input id="profession" type="number" min=0 max=100 class="form-control"
                           v-bind:name="'impressions['+impressions.indexOf(impression)+'][score_severite]'"
                           v-model="impression.score_severite">
                    @if ($errors->has('score_severite'))
                        <span class="help-block">
    		    <strong>{{ $errors->first('score_severite') }}</strong>
    		</span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('impressions_autres') ? ' has-error' : '' }}">
                <label for="impressions_autres" class=" control-label">Autre(s)</label>
                <textarea id="impressions_autres" class="form-control"
                          name="impressions_autres">{{ old('impressions_autres', $plan->impressions_autres) }}</textarea>
                @if ($errors->has('impressions_autres'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('impressions_autres') }}</strong>
            		</span>
                @endif
            </div>
            @include('plans/nav')
        </form>
        <button class="btn btn-primary" @click.prevent="ajoutimpression()">Ajouter une impression diagnostique</button>

        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
             aria-labelledby="Confirmation de supression" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Veuillez confirmer la supression.
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click.prevent="cancelDelete()" class="btn btn-default" data-dismiss="modal">Annuler</button>
                        <button type="button" @click.prevent="deleteimpression()" class="btn btn-danger btn-ok" id="confirmButton">Supprimer</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
@section('script')
    @include('partials.confirmationSupression')
    @include('partials.js.section8')
@endsection
