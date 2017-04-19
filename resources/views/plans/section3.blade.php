<!--
 * Created by PhpStorm.
 * Project: calme
 * User: laff3601
 * Date: 01/03/17
 * Time: 14:02
-->

@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a>: compléter le plan d'intervention : antécédents
        personnels et familiaux</h1>
@endsection
@section('body')
    <div id="app">
        <form role="form" method="POST" action="{{ url('plans',[$section,$plan->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div v-for="antecedent in antecedents">
                <hr v-show="antecedents.indexOf(antecedent) > 0">
                <button @click.prevent="pToDelete(antecedent)" id="delete-button"
                        class="btn btn-danger btn-xs pull-right">X
                </button>
                <input type="hidden" v-model="antecedent.id"
                       v-bind:name="'antecedents['+antecedents.indexOf(antecedent)+'][id]'">
                <div class="form-group">
                    <label for="antecedent" class=" control-label">Description de l'antécédent</label>
                    <input id="antecedent" type="text" class="form-control"
                           v-bind:name="'antecedents['+antecedents.indexOf(antecedent)+'][antecedent]'"
                           v-model="antecedent.antecedent">
                    @if ($errors->has('antecedent'))
                        <span class="help-block"><strong>{{ $errors->first('antecedent') }}</strong></span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="control-label">Antécédent personnel ou familial</label>
                    <select
                            class="form-control"
                            v-model="antecedent.fam_perso"
                            v-bind:name="'antecedents['+antecedents.indexOf(antecedent)+'][fam_perso]'"
                    >
                        <option value="" selected>Veuillez choisir</option>
                        <option value="Personnel">
                            Personnel
                        </option>
                        <option value="Familial">
                            Familial
                        </option>
                    </select>
                </div>
                <input type="hidden" v-model="antecedent.fam_perso"
                       v-bind:name="'antecedents['+antecedents.indexOf(antecedent)+'][fam_perso]'">
                <div class="form-group">
                    <label class="control-label">Type d'antécédent</label>
                    <select class="form-control" v-model="antecedent.type"
                            v-bind:name="'antecedents['+antecedents.indexOf(antecedent)+'][type]'">
                        <option value="" selected>Veuillez choisir</option>
                        <option value="Medical">
                            Médical
                        </option>
                        <option value="Chirurgical">
                            Chirurgical
                        </option>
                        <option value="Psychiatrique">
                            Psychiatrique
                        </option>
                        <option value="Module Calme">
                            Module Calme
                        </option>
                    </select>
                </div>
                <div class="form-group" v-show="antecedent.type=='Module Calme'">
                    <label class="control-label">Motifs</label>
                    <textarea v-model="antecedent.motifs" class="form-control" v-bind:name="'antecedents['+antecedents.indexOf(antecedent)+'][motifs]'" rows="5">@{{ antecedent.motifs }}</textarea>

                </div>
            </div>

            <button class="btn btn-primary" @click.prevent="ajoutantecedent()">Ajouter un antécédent</button>
            <hr>

            <div class="form-group{{ $errors->has('ante_bilan') ? ' has-error' : '' }}">
                <label for="ante_bilan" class="control-label">Dernier bilan sanguin</label>
                <select class="form-control" name="ante_bilan" v-model="ante_bilan">
                    <option value="" selected>Veuillez choisir</option>
                    <option value="1"
                            @if(old('ante_bilan', $plan->ante_bilan)=="1")
                            selected
                            @endif>
                        Oui
                    </option>
                    <option value="0"
                            @if(old('ante_bilan', $plan->ante_bilan)=="0")
                            selected
                            @endif>
                        Non
                    </option>
                </select>
                @if ($errors->has('ante_bilan'))
                    <span class="help-block"><strong>{{ $errors->first('ante_bilan') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('ante_bilan_date') ? ' has-error' : '' }}" v-show="ante_bilan">
                <label for="ante_bilan_date" class=" control-label">Date du dernier bilan sanguin<span class="tip">(aaaa-mm-jj)</span></label>
                <input id="ante_bilan_date" type="date" class="form-control datepicker" name="ante_bilan_date"
                       value="{{ old('ante_bilan_date', $plan->ante_bilan_date) }}">
                @if ($errors->has('ante_bilan_date'))
                    <span class="help-block"><strong>{{ $errors->first('ante_bilan_date') }}</strong></span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('ante_bilan_resultat') ? ' has-error' : '' }}" v-show="ante_bilan==1">
                <label for="ante_bilan_resultat" class=" control-label">Résultats</label>
                <input id="ante_bilan_resultat" type="text" class="form-control" name="ante_bilan_resultat"
                       value="{{ old('ante_bilan_resultat', $plan->ante_bilan_resultat) }}">
                @if ($errors->has('ante_bilan_resultat'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('ante_bilan_resultat') }}</strong>
            		</span>
                @endif
            </div>

            @include('plans/nav')
        </form>


        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
             aria-labelledby="Confirmation de supression" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Veuillez confirmer la supression.
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click.prevent="cancelDelete()" class="btn btn-default"
                                data-dismiss="modal">Annuler
                        </button>
                        <button type="button" @click.prevent="deleteantecedent()" class="btn btn-danger btn-ok"
                                id="confirmButton">Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('partials.dateSupport')
    @include('partials.js.section3')
@endsection
