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
            <h2>Antécédents personnels</h2>
            <div class="form-group{{ $errors->has('ante_med') ? ' has-error' : '' }}">
                <label for="ante_med" class="control-label">Médicaux et chirurgicaux</label>
                <select class="form-control" name="ante_med" v-model="ante_med">
                    <option value="" selected>Veuillez choisir</option>
                    <option value="1"
                            @if(old('ante_med', $plan->ante_med)=="1")
                            selected
                            @endif>
                        Oui
                    </option>
                    <option value="0"
                            @if(old('ante_med', $plan->ante_med)=="0")
                            selected
                            @endif>
                        Non
                    </option>
                </select>
                @if ($errors->has('ante_med'))
                    <span class="help-block"><strong>{{ $errors->first('ante_med') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('ante_med_d') ? ' has-error' : '' }}" v-show="ante_med==1">
                <label for="ante_med_d" class=" control-label">Description</label>
                <input id="ante_med_d" type="text" class="form-control" name="ante_med_d"
                       value="{{ old('ante_med_d', $plan->ante_med_d) }}">
                @if ($errors->has('ante_med_d'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('ante_med_d') }}</strong>
            		</span>
                @endif
            </div>

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
            <div class="form-group{{ $errors->has('ante_psy') ? ' has-error' : '' }}">
                <label for="ante_psy" class="control-label">Psychiatriques</label>
                <select class="form-control" name="ante_psy" v-model="ante_psy">
                    <option value="" selected>Veuillez choisir</option>
                    <option value="Oui"
                            @if(old('ante_psy', $plan->ante_psy)=="Oui")
                            selected
                            @endif>
                        Oui
                    </option>
                    <option value="Non"
                            @if(old('ante_psy', $plan->ante_psy)=="Non")
                            selected
                            @endif>
                        Non
                    </option>
                    <option value="Module Calme"
                            @if(old('ante_psy', $plan->ante_psy)=="Module Calme")
                            selected
                            @endif>
                        Module Calme
                    </option>
                </select>
                @if ($errors->has('ante_psy'))
                    <span class="help-block"><strong>{{ $errors->first('ante_psy') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('ante_psy_d') ? ' has-error' : '' }}" v-show="ante_psy=='Oui' || ante_psy=='Module Calme'">
                <label for="ante_psy_d" class=" control-label">Description / motif</label>
                <input id="ante_psy_d" type="text" class="form-control" name="ante_psy_d"
                       value="{{ old('ante_psy_d', $plan->ante_psy_d) }}">
                @if ($errors->has('ante_psy_d'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('ante_psy_d') }}</strong>
            		</span>
                @endif
            </div>
            <h2>Antécédents familiaux</h2>
            <div class="form-group{{ $errors->has('antefam_med') ? ' has-error' : '' }}">
                <label for="antefam_med" class="control-label">Médicaux et chirurgicaux</label>
                <select class="form-control" name="antefam_med" v-model="antefam_med">
                    <option value="" selected>Veuillez choisir</option>
                    <option value="1"
                            @if(old('antefam_med', $plan->antefam_med)=="1")
                            selected
                            @endif>
                        Oui
                    </option>
                    <option value="0"
                            @if(old('antefam_med', $plan->antefam_med)=="0")
                            selected
                            @endif>
                        Non
                    </option>
                </select>
                @if ($errors->has('antefam_med'))
                    <span class="help-block"><strong>{{ $errors->first('antefam_med') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('antefam_med_d') ? ' has-error' : '' }}" v-show="antefam_med==1">
                <label for="antefam_med_d" class=" control-label">Description</label>
                <input id="antefam_med_d" type="text" class="form-control" name="antefam_med_d"
                       value="{{ old('antefam_med_d', $plan->antefam_med_d) }}">
                @if ($errors->has('antefam_med_d'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('antefam_med_d') }}</strong>
            		</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('antefam_psy') ? ' has-error' : '' }}">
                <label for="antefam_psy" class="control-label">Psychiatriques</label>
                <select class="form-control" name="antefam_psy" v-model="antefam_psy">
                    <option value="" selected>Veuillez choisir</option>
                    <option value="1"
                            @if(old('antefam_psy', $plan->antefam_psy)=="1")
                            selected
                            @endif>
                        Oui
                    </option>
                    <option value="0"
                            @if(old('antefam_psy', $plan->antefam_psy)=="0")
                            selected
                            @endif>
                        Non
                    </option>
                </select>
                @if ($errors->has('antefam_psy'))
                    <span class="help-block"><strong>{{ $errors->first('antefam_psy') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('antefam_psy_d') ? ' has-error' : '' }}" v-show="antefam_psy==1">
                <label for="antefam_psy_d" class=" control-label">Description</label>
                <input id="antefam_psy_d" type="text" class="form-control" name="antefam_psy_d"
                       value="{{ old('antefam_psy_d', $plan->antefam_psy_d) }}">
                @if ($errors->has('antefam_psy_d'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('antefam_psy_d') }}</strong>
            		</span>
                @endif
            </div>
            @include('plans/nav')
    </form>
    </div>
@endsection
@section('script')
    @include('partials.dateSupport')
    <script type="text/javascript">
        vm = new Vue({
            el: '#app',
            data: {
                ante_med: '{{$plan->ante_med}}',
                ante_bilan: '{{$plan->ante_bilan}}',
                ante_psy: '{{$plan->ante_psy}}',
                antefam_med: '{{$plan->antefam_med}}',
                antefam_psy: '{{$plan->antefam_psy}}'
            },
        })
    </script>
@endsection
