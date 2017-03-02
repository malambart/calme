<!--
 * Created by PhpStorm.
 * Project: calme
 * User: laff3601
 * Date: 02/03/17
 * Time: 11:47
-->

@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a>: compléter le plan d'intervention : partenaires
        impliqués</h1>
@endsection
@section('body')
    <div id="app">
        <form role="form" method="POST" action="{{ url('plans',[$section,$plan->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div v-for="partenaire in partenaires">
                <hr v-show="partenaires.indexOf(partenaire) > 0">
                <h2>Partenaire @{{ partenaires.indexOf(partenaire)+1 }}</h2>
                <button @click="deletePartenaire(partenaire)" class="btn btn-danger btn-xs pull-right">X</button>
                <div class="form-group{{ $errors->has('passe_actuel') ? ' has-error' : '' }}">
                    <label for="passe_actuel" class="control-label">Partenaire passé ou actuel</label>
                    <select
                            class="form-control"
                            v-bind:name="'partenaires['+partenaires.indexOf(partenaire)+'][passe_actuel]'"
                    >
                        <option value="" selected>Veuillez choisir</option>
                        <option value="Passe"
                                @if(old('passe_actuel')=="Passe")
                                selected
                                @endif>
                            Passé
                        </option>
                        <option value="Actuel"
                                @if(old('passe_actuel')=="Actuel")
                                selected
                                @endif>
                            Actuel
                        </option>
                    </select>
                    @if ($errors->has('passe_actuel'))
                        <span class="help-block"><strong>{{ $errors->first('passe_actuel') }}</strong></span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('partenaire') ? ' has-error' : '' }}">
                    <label for="partenaire" class=" control-label">Partenaire</label>
                    <input id="partenaire" type="text" class="form-control"
                           v-bind:name="'partenaires['+partenaires.indexOf(partenaire)+'][partenaire]'"
                           value="{{ old('partenaire') }}">
                    @if ($errors->has('partenaire'))
                        <span class="help-block">
    		    <strong>{{ $errors->first('partenaire') }}</strong>
    		</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('profession') ? ' has-error' : '' }}">
                    <label for="profession" class=" control-label">Profession</label>
                    <input id="profession" type="text" class="form-control"
                           v-bind:name="'partenaires['+partenaires.indexOf(partenaire)+'][profession]'"
                           value="{{ old('profession') }}">
                    @if ($errors->has('profession'))
                        <span class="help-block">
    		    <strong>{{ $errors->first('profession') }}</strong>
    		</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('frequence') ? ' has-error' : '' }}">
                    <label for="frequence" class=" control-label">Fréquence</label>
                    <input id="frequence" type="text" class="form-control"
                           v-bind:name="'partenaires['+partenaires.indexOf(partenaire)+'][frequence]'"
                           value="{{ old('frequence') }}">
                    @if ($errors->has('frequence'))
                        <span class="help-block">
    		    <strong>{{ $errors->first('frequence') }}</strong>
    		</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('But') ? ' has-error' : '' }}">
                    <label for="But" class=" control-label">But</label>
                    <input id="But" type="text" class="form-control"
                           v-bind:name="'partenaires['+partenaires.indexOf(partenaire)+'][but]'"
                           value="{{ old('But') }}">
                    @if ($errors->has('But'))
                        <span class="help-block">
    		    <strong>{{ $errors->first('But') }}</strong>
    		</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('quand') ? ' has-error' : '' }}">
                    <label for="quand" class=" control-label">Quand</label>
                    <input id="quand" type="text" class="form-control"
                           v-bind:name="'partenaires['+partenaires.indexOf(partenaire)+'][quand]'"
                           value="{{ old('quand') }}">
                    @if ($errors->has('quand'))
                        <span class="help-block">
            		    <strong>{{ $errors->first('quand') }}</strong>
            		</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('duree') ? ' has-error' : '' }}">
                    <label for="duree" class=" control-label">Durée</label>
                    <input id="duree" type="text" class="form-control"
                           v-bind:name="'partenaires['+partenaires.indexOf(partenaire)+'][duree]'"
                           value="{{ old('duree') }}">
                    @if ($errors->has('duree'))
                        <span class="help-block">
            		    <strong>{{ $errors->first('duree') }}</strong>
            		</span>
                    @endif
                </div>
            </div>
            @include('plans/nav')
        </form>
        <button class="btn btn-primary" @click.prevent="ajoutPartenaire()">Ajouter un partenaire</button>

    </div>


@endsection
@section('script')
    <script type="text/javascript">
        vm = new Vue({
            el: '#app',
            methods: {
                ajoutPartenaire: function () {
                    ++this.id
                    this.partenaires.push(this.id);
                },
                deletePartenaire: function (partenaire) {
                    this.partenaires.splice(this.partenaires.indexOf(partenaire), 1);
                }

            },
            data: {
                partenaires: [1],
                id: 1
            },
            computed: {
                nombre: function () {
                    return this.partenaires.length;
                }
            }
        })
    </script>
@endsection
