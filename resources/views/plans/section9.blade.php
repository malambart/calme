<!--
 * Created by PhpStorm.
 * Project: calme
 * User: laff3601
 * Date: 30/03/17
 * Time: 16:03
-->

@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a>: compléter le plan d'intervention :
        recommendations concernant l'enfant</h1>
@endsection
@section('body')
    <div id="app">
        <form role="form" method="POST" action="{{ url('plans',[$section,$plan->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group{{ $errors->has('retenu') ? ' has-error' : '' }}">
                <label for="retenu" class="control-label">Retenu(e) ou non retenu(e)</label>
                <select class="form-control" name="retenu" v-model="retenu">
                    <option value="" selected>Veuillez choisir</option>
                    <option value="Retenu(e)"
                            @if(old('retenu', $plan->retenu)=="Retenu(e)")
                            selected
                            @endif>
                        Retenu(e)
                    </option>
                    <option value="Non retenu(e)"
                            @if(old('retenu', $plan->retenu)=="Non retenu(e)")
                            selected
                            @endif>
                        Non retenu(e)
                    </option>
                </select>
                @if ($errors->has('retenu'))
                    <span class="help-block"><strong>{{ $errors->first('retenu') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('non_retenu_motif') ? ' has-error' : '' }}"
                 v-show="retenu=='Non retenu(e)'">
                <label for="non_retenu_motif" class=" control-label">Motifs</label>
                <input id="non_retenu_motif" type="text" class="form-control" name="non_retenu_motif"
                       value="{{ old('non_retenu_motif') }}">
                @if ($errors->has('non_retenu_motif'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('non_retenu_motif', $plan->non_retenu_motif) }}</strong>
            		</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('non_retenu_redirige') ? ' has-error' : '' }}"
                 v-show="retenu=='Non retenu(e)'">
                <label for="non_retenu_redirige" class=" control-label">Redirigé(e)</label>
                <textarea id="non_retenu_redirige" class="form-control"
                          name="non_retenu_redirige">{{ old('non_retenu_redirige', $plan->non_retenu_redirige) }}</textarea>
                @if ($errors->has('non_retenu_redirige'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('non_retenu_redirige') }}</strong>
            		</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('date_premiere_seance') ? ' has-error' : '' }}"
                 v-show="retenu=='Retenu(e)'">
                <p style="color:red;">Cette information est déjà entrée à la création du dossier...</p>
                <label for="date_premiere_seance" class=" control-label">Date de la première séance<span class="tip">(aaaa-mm-jj)</span></label>
                <input id="date_premiere_seance" type="date" class="form-control datepicker" name="date_premiere_seance"
                       value="{{ old('date_premiere_seance', $premiere_seance->date->toDateString()) }}">
                @if ($errors->has('date_premiere_seance'))
                    <span class="help-block"><strong>{{ $errors->first('date_premiere_seance') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('suivi') ? ' has-error' : '' }}">
                <label for="suivi" class="control-label">Suivi</label>
                <select class="form-control" name="suivi">
                    <option value="" selected>Veuillez choisir</option>
                    <option value="Individuel"
                            @if(old('suivi')=="Individuel")
                            selected
                            @endif>
                        Individuel
                    </option>
                    <option value="De groupe"
                            @if(old('suivi')=="De groupe")
                            selected
                            @endif>
                        De groupe
                    </option>
                </select>
                @if ($errors->has('suivi'))
                    <span class="help-block"><strong>{{ $errors->first('suivi') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('type_suivi') ? ' has-error' : '' }}">
                <label for="type_suivi" class="control-label">Type de suivi</label>
                <select class="form-control" name="type_suivi">
                    <option value="" selected>Veuillez choisir</option>
                    <option value="Super Actif"
                            @if(old('type_suivi')=="Super Actif")
                            selected
                            @endif>
                        Super Actif
                    </option>
                    <option value="Pic qui Toc"
                            @if(old('type_suivi')=="Pic qui Toc")
                            selected
                            @endif>
                        Pic qui Toc
                    </option>
                    <option value="Perroquet Muet"
                            @if(old('type_suivi')=="Perroquet Muet")
                            selected
                            @endif>
                        Perroquet Muet
                    </option>
                    <option value="ZAK et ZOE"
                            @if(old('type_suivi')=="ZAK et ZOE")
                            selected
                            @endif>
                        ZAK et ZOE
                    </option>
                    <option value="ESPT"
                            @if(old('type_suivi')=="ESPT")
                            selected
                            @endif>
                        ESPT
                    </option>
                </select>
                @if ($errors->has('type_suivi'))
                    <span class="help-block"><strong>{{ $errors->first('type_suivi') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('duree') ? ' has-error' : '' }}">
                <label for="duree" class=" control-label">Durée</label>
                <input id="duree" type="text" class="form-control" name="duree" value="{{ old('duree') }}">
                @if ($errors->has('duree'))
                    <span class="help-block">
                		    <strong>{{ $errors->first('duree') }}</strong>
                		</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('frequence') ? ' has-error' : '' }}">
                <label for="frequence" class=" control-label">Fréquence</label>
                <input id="frequence" type="text" class="form-control" name="frequence"
                       value="{{ old('frequence') }}">
                @if ($errors->has('frequence'))
                    <span class="help-block">
                		    <strong>{{ $errors->first('frequence') }}</strong>
                		</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('objectifs') ? ' has-error' : '' }}">
                <label for="objectifs_input" class=" control-label">Objectifs</label>
                <input name=objectifs_input placeholder="Entrer un objectif et appuyez sur Enter" id="objectif"
                       type="text"
                       class="form-control"
                       v-model="new_objectif" @keydown.enter.prevent="addObjectif">
                @if ($errors->has('objectifs'))
                    <span class="help-block"><strong>{{ $errors->first('objectifs') }}</strong></span>
                @endif
            </div>
            <ul class="list-group">
                <li v-for="objectif in objectifs" class="list-group-item">
                    @{{ objectif }}
                    <button @click="deleteObjectif(objectif)" type="button" class="btn btn-danger btn-xs pull-right">
                    X</button>
                </li>
            </ul>
            <input v-for="objectif in objectifs"
                   type="hidden"
                   v-bind:value="objectif"
                   v-bind:name="'objectifs['+objectifs.indexOf(objectif)+']'">
            <div class="form-group{{ $errors->has('traitement_pharmaco') ? ' has-error' : '' }}">
                <label for="traitement_pharmaco" class="control-label">Un traitement pharmacologique a-t-il été
                    proposé?</label>
                <select class="form-control" name="traitement_pharmaco" v-model="traitement">
                    <option value="">Veuillez choisir</option>
                    <option value="1">
                        Oui
                    </option>
                    <option value="0">
                        Non
                    </option>
                </select>
                @if ($errors->has('traitement_pharmaco'))
                    <span class="help-block"><strong>{{ $errors->first('traitement_pharmaco') }}</strong></span>
                @endif
            </div>
            <div v-show="traitement==1">
                <div class="form-group{{ $errors->has('new_medicament') ? ' has-error' : '' }} clearfix">
                    <label class="control-label dual-input-label">Médication</label>
                    <div class="col-md-6 dual-input-input">
                        <input name="new_medicament" value="{{old('new_medicament')}}" placeholder="Nom du médicament"
                               id="medicament"
                               type="text"
                               class="form-control" v-model="new_medicament">
                    </div>
                    <div class="col-md-2 dual-input-input">
                        <input type="number" name="new_posologie" value="{{old('new_posologie')}}"
                               placeholder="Posologie"
                               id="posologie" class="form-control" v-model="new_posologie">
                    </div>
                    <div class="col-md-2 dual-input-input">
                        <select name="new_unit" id="input" class="form-control" v-model="new_unit">
                            <option value="mg/jour">
                                mg/jour
                            </option>
                        </select>
                    </div>
                    <button class="btn btn-primary" @click.prevent="addMedicament">Ajouter</button>

                    @if ($errors->has('new_medicament'))
                        <span class="help-block"><strong>Le médicament n'a pas été soumis.</strong></span>
                    @endif
                </div>
                <ul class="list-group">
                    <li v-for="medicament in medication" class="list-group-item">
                        @{{ medicament.med_string }}
                        <button @click="deleteMedicament(medicament)" type="button" class="
                        btn btn-danger btn-xs pull-right"
                        >X</button>
                    </li>
                </ul>
                <input v-for="medicament in medication"
                       type="hidden"
                       v-bind:value="medicament.nom"
                       v-bind:name="'medication['+medication.indexOf(medicament)+']'+'[nom]'">
                <input v-for="medicament in medication"
                       type="hidden"
                       v-bind:value="medicament.posologie"
                       v-bind:name="'medication['+medication.indexOf(medicament)+']'+'[posologie]'">
                <input v-for="medicament in medication"
                       type="hidden"
                       v-bind:value="medicament.unit"
                       v-bind:name="'medication['+medication.indexOf(medicament)+']'+'[unit]'">
                <input v-for="medicament in medication"
                       type="hidden"
                       v-bind:value="medicament.med_string"
                       v-bind:name="'medication['+medication.indexOf(medicament)+']'+'[med_string]'">
            </div>
            <div class="form-group{{ $errors->has('recommendations') ? ' has-error' : '' }}">
                <label for="recommendations" class=" control-label">Recommendations concernant les parents ou la
                    famille</label>
                <textarea name="recommendations" id="recommendations" rows="4" class="form-control">{{old('recommendations')}}</textarea>
                @if ($errors->has('recommendations'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('recommendations') }}</strong>
            		</span>
                @endif
            </div>
            @include('plans/nav')
        </form>
    </div>
@endsection
@section('script')
    @include('partials.dateSupport')
    @include('partials.js.section9')
@endsection
