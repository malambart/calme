
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
                <h2>@{{ partenaire.partenaire }}</h2>
                <button @click.prevent="pToDelete(partenaire)" id="delete-button" class="btn btn-danger btn-xs pull-right">X
                </button>
                <input type="hidden" v-model="partenaire.id"
                       v-bind:name="'partenaires['+partenaires.indexOf(partenaire)+'][id]'">
                <div class="form-group{{ $errors->has('partenaire') ? ' has-error' : '' }}">
                    <label for="partenaire" class=" control-label">Nom du partenaire</label>
                    <input id="partenaire" type="text" class="form-control"
                           v-bind:name="'partenaires['+partenaires.indexOf(partenaire)+'][partenaire]'"
                           v-model="partenaire.partenaire">
                    @if ($errors->has('partenaire'))
                        <span class="help-block"><strong>{{ $errors->first('partenaire') }}</strong></span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('passe_actuel') ? ' has-error' : '' }}">
                    <label for="passe_actuel" class="control-label">Partenaire passé ou actuel</label>
                    <select
                            class="form-control"
                            v-model="partenaire.passe_actuel"
                            v-bind:name="'partenaires['+partenaires.indexOf(partenaire)+'][passe_actuel]'"
                    >
                        <option value="" selected>Veuillez choisir</option>
                        <option value="Passe">
                            Passé
                        </option>
                        <option value="Actuel">
                            Actuel
                        </option>
                    </select>
                    @if ($errors->has('passe_actuel'))
                        <span class="help-block"><strong>{{ $errors->first('passe_actuel') }}</strong></span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('profession') ? ' has-error' : '' }}">
                    <label for="profession" class=" control-label">Profession</label>
                    <input id="profession" type="text" class="form-control"
                           v-bind:name="'partenaires['+partenaires.indexOf(partenaire)+'][profession]'"
                           v-model="partenaire.profession">
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
                           v-model="partenaire.frequence">
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
                           v-model="partenaire.but">
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
                           v-model="partenaire.quand">
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
                           v-model="partenaire.duree">
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

        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
             aria-labelledby="Confirmation de supression" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Veuillez confirmer la supression.
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click.prevent="cancelDelete()" class="btn btn-default" data-dismiss="modal">Annuler</button>
                        <button type="button" @click.prevent="deletePartenaire()" class="btn btn-danger btn-ok" id="confirmButton">Supprimer</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
@section('script')
    @include('partials.confirmationSupression')
    <script type="text/javascript">
        var stored = [];
        @foreach($plan->partenaires as $partenaire)
            stored.push({
            num: null,
            id: '{{$partenaire->id}}',
            passe_actuel: '{{$partenaire->passe_actuel}}',
            partenaire: '{{$partenaire->partenaire}}',
            profession: '{{$partenaire->profession}}',
            frequence: '{{$partenaire->frequence}}',
            but: '{{$partenaire->but}}',
            quand: '{{$partenaire->quand}}',
            duree: '{{$partenaire->duree}}',
        });
        @endforeach
        if (stored.length == 0) {
            stored = [{
                num: 1,
                id: null,
                passe_actuel: '',
                partenaire: '',
                profession: '',
                frequence: '',
                but: '',
                quand: '',
                duree: '',
            }];
        }
        vm = new Vue({
            el: '#app',
            data: {
                partenaires: stored,
                toDelete:'',
                num:1,
            },
            computed: {
                nombre: function () {
                    return this.partenaires.length;
                }
            },
            methods: {
                ajoutPartenaire: function () {
                    ++this.num
                    this.partenaires.push({
                        num: this.num,
                        id: null,
                        passe_actuel: '',
                        partenaire: '',
                        profession: '',
                        frequence: '',
                        but: '',
                        quand: '',
                        duree: '',
                    });
                },
                deletePartenaire: function () {
                    if (this.toDelete.id) {
                        $.get('{{url('partenaires/delete')}}/' + this.toDelete.id);
                    }
                    this.partenaires.splice(this.partenaires.indexOf(this.toDelete.partenaire), 1);
                    $('#confirm-delete').modal('hide');
                    this.toDelete = null;
                },
                pToDelete: function(num) {
                    this.toDelete = num;
                    $('#confirm-delete').modal('show');
                },
                cancelDelete: function(){
                    this.toDelete = null;
                }
            },
        })
    </script>
@endsection
