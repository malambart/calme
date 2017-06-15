@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{ $dossier->baseUrl() }}">Dossier {{$dossier->id}}</a>: Ajouter une entrée au journal de bord</h1>
@endsection
@section('body')
    <form role="form" method="POST" action="{{ url('journals/create', $dossier->id) }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
            <label for="date" class=" control-label">Date<span class="tip">(aaaa-mm-jj)</span></label>
            <input required id="date" type="date" class="form-control datepicker" name="date" value="{{ old('date') }}">
            @if ($errors->has('date'))
                <span class="help-block"><strong>{{ $errors->first('date') }}</strong></span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('duree') ? ' has-error' : '' }}">
            <label for="duree" class=" control-label">Durée de l'intervention en minutes</label>
            <input id="duree" type="number" class="form-control" name="duree" value="{{ old('duree') }}">
            @if ($errors->has('duree'))
                <span class="help-block">
    		    <strong>{{ $errors->first('duree') }}</strong>
    		</span>
            @endif
        </div>
        <div id="app">
            <div class="form-group">
                <div class="checkbox-list">
                    <label>Intervenants présents</label>
                    <div class="checkbox">
                        <label><input type="checkbox" name="intervanants[]" value="Pédopsychiatre">Pédopsychiatre</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="intervanants[]" value="Médecin résident">Médecin résident</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="intervanants[]" value="Psychologue">Psychologue</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="intervanants[]" value="Psychoéducatrice">Psychoéducatrice</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="intervanants[]" value="Travailleuse sociale">Travailleuse sociale</label>
                    </div>
                    <checklist-autre name="intervenants" value="Autre"></checklist-autre>
                </div>
            </div>
            <div class="form-group{{ $errors->has('modalite') ? ' has-error' : '' }}">
                <label for="modalite" class="control-label">Modalité</label>
                <select class="form-control" name="modalite" v-model="modalite">
                    <option value="" selected>Veuillez choisir</option>
                    <option value="Rencontre au CHUS"
                            @if(old('modalite')=="Rencontre au CHUS")
                            selected
                            @endif>
                        Rencontre au CHUS
                    </option>
                    <option value="Contact téléphonique"
                            @if(old('modalite')=="Contact téléphonique")
                            selected
                            @endif>
                        Contact téléphonique
                    </option>
                    <option value="Autre"
                            @if(old('modalite')=="Autre")
                            selected
                            @endif>
                        Autre
                    </option>
                </select>
                @if ($errors->has('modalite'))
                    <span class="help-block"><strong>{{ $errors->first('modalite') }}</strong></span>
                @endif

            </div>
            <div class="form-group{{ $errors->has('modalite_autre') ? ' has-error' : '' }}" v-show="modalite == 'Autre'">
                <input id="modalite_autre" type="text" class="form-control" name="modalite_autre" placeholder="Précisez"
                       value="{{ old('modalite_autre') }}">
                @if ($errors->has('modalite_autre'))
                    <span class="help-block">
               		    <strong>{{ $errors->first('modalite_autre') }}</strong>
               		</span>
                @endif
            </div>
            <div class="form-group checkbox-list">
                <label>Destinataires</label>
                <div class="checkbox">
                    <label><input type="checkbox" name="destinataires[]">Père</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="destinataires[]">Mère</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="destinataires[]">Conjoint(e)</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="destinataires[]">Enfant ayant un diagnostic de troubles anxieux</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="destinataires[]">Fratrie</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="destinataires[]">Prof</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="destinataires[]">Psychoéd</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="destinataires[]">Intervenant</label>
                </div>
                <checklist-autre name="destinataires"></checklist-autre>
            </div>
        </div>
        <div class="form-group{{ $errors->has('sujet') ? ' has-error' : '' }}">
            <label for="sujet" class=" control-label">À quel sujet, dans quel but?</label>
            <textarea id="sujet" class="form-control" name="sujet">{{ old('sujet') }}</textarea>
            @if ($errors->has('sujet'))
                <span class="help-block">
        		    <strong>{{ $errors->first('sujet') }}</strong>
        		</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('commentaires') ? ' has-error' : '' }}">
            <label for="commentaires" class=" control-label">Commentaires</label>
            <textarea id="commentaires" class="form-control" name="commentaires">{{ old('commentaires') }}</textarea>
            @if ($errors->has('commentaires'))
                <span class="help-block">
        		    <strong>{{ $errors->first('commentaires') }}</strong>
        		</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary pull-right">
            Sauvegarder
        </button>
    </form>


@endsection

@section('script')

    <script type="text/x-template" id="checklist-autre">
        <div>
            <div class="checkbox">
                <label><input type="checkbox" value="Autre" v-model="autre" @click="uncheck()">Autre</label>
            </div>
            <input type="text" class="form-control" :name="inputName" v-show="autre" placeholder="Précisez" v-model="preciser">
        </div>
    </script>

    <script>

        Vue.component('checklist-autre', {
            props: ['name', 'items'],
            template: '#checklist-autre',
            data: function() {
                return {
                    autre:false,
                    preciser:''
                }
            },
            computed: {
                inputName: function() {
                    return this.name+"[autre]";
                }
            },
            methods: {
                uncheck: function() {
                    this.preciser = '';
                }
            }
        });

        new Vue({
            el: '#app',
            data: {
                modalite:'{{ old('modalite') }}'
            }
        });

    </script>

@endsection