@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a> Éditer une entrée au journal</h1>
@endsection
@section('body')
    <form role="form" method="POST" action="{{ url('journals/edit', $journal->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
            <label for="date" class=" control-label">Date<span class="tip">(aaaa-mm-jj)</span></label>
            <input required id="date" type="date" class="form-control datepicker" name="date" value="{{ old('date', dateString($journal->date)) }}">
            @if ($errors->has('date'))
                <span class="help-block"><strong>{{ $errors->first('date') }}</strong></span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('duree') ? ' has-error' : '' }}">
            <label for="duree" class=" control-label">Durée de l'intervention en minutes</label>
            <input id="duree" type="number" class="form-control" name="duree" value="{{ old('duree', $journal->duree) }}">
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
                        <label><input type="checkbox" name="intervenants[]" value="pédopsychiatre"
                            @if(arrContains('pédopsychiatre', old('intervenants', $journal->intervenants)))
                                checked
                            @endif
                            >Pédopsychiatre</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="intervenants[]" value="médecin résident"
                                      @if(arrContains('médecin résident', old('intervenants', $journal->intervenants)))
                                      checked
                                    @endif
                            >Médecin résident</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="intervenants[]" value="psychologue"
                                      @if(arrContains('psychologue', old('intervenants', $journal->intervenants)))
                                      checked
                                    @endif>Psychologue</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="intervenants[]" value="psychoéducatrice"
                                      @if(arrContains('psychoéducatrice', old('intervenants', $journal->intervenants)))
                                      checked
                                    @endif>Psychoéducatrice</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="intervenants[]" value="travailleuse sociale"
                                      @if(arrContains('travailleuse sociale', old('intervenants', $journal->intervenants)))
                                      checked
                                    @endif>Travailleuse sociale</label>
                    </div>
                    <input type="text" class="form-control" placeholder="Autre" name="intervenants[autre]" value="{{ old('intervenants[autre]', $journal->intervenants['autre']) }}">
                </div>
            </div>
            <div class="form-group{{ $errors->has('modalite') ? ' has-error' : '' }}">
                <label for="modalite" class="control-label">Modalité</label>
                <select class="form-control" name="modalite" v-model="modalite">
                    <option value="" selected>Veuillez choisir</option>
                    <option value="Rencontre au CHUS" selected
                            @if(old('modalite', $journal->modalite)=="Rencontre au CHUS")
                            selected
                            @endif>
                        Rencontre au CHUS
                    </option>
                    <option value="Contact téléphonique"
                            @if(old('modalite', $journal->modalite)=="Contact téléphonique")
                            selected
                            @endif>
                        Contact téléphonique
                    </option>
                    <option value="Autre"
                            @if(old('modalite', $journal->modalite)=="Autre")
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
                       value="{{ old('modalite_autre', $journal->modalite_autre) }}">
                @if ($errors->has('modalite_autre'))
                    <span class="help-block">
               		    <strong>{{ $errors->first('modalite_autre') }}</strong>
               		</span>
                @endif
            </div>
            <div class="form-group checkbox-list">
                <label>Destinataires</label>
                <div class="checkbox">
                    <label><input type="checkbox" value="père" name="destinataires[]"
                                  @if(arrContains('père', old('destinataires', $journal->destinataires)))
                                  checked
                                @endif>Père</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" value="mère" name="destinataires[]"
                                  @if(arrContains('mère', old('destinataires', $journal->destinataires)))
                                  checked
                                @endif>Mère</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" value="conjoint(e)" name="destinataires[]"
                                  @if(arrContains('conjoint(e)', old('destinataires', $journal->destinataires)))
                                  checked
                                @endif>Conjoint(e)</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" value="enfant ayant un diagnostic de troubles anxieux" name="destinataires[]"
                                  @if(arrContains('enfant ayant un diagnostic de troubles anxieux', old('destinataires', $journal->destinataires)))
                                  checked
                                @endif>Enfant ayant un diagnostic de troubles anxieux</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" value="fratrie" name="destinataires[]"
                                  @if(arrContains('fratrie', old('destinataires', $journal->destinataires)))
                                  checked
                                @endif>Fratrie</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" value="prof" name="destinataires[]"
                                  @if(arrContains('prof', old('destinataires', $journal->destinataires)))
                                  checked
                                @endif>Prof</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" value="psychoed" name="destinataires[]"
                                  @if(arrContains('psychoed', old('destinataires', $journal->destinataires)))
                                  checked
                                @endif>Psychoéd</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" value="intervenant" name="destinataires[]"
                                  @if(arrContains('intervenant', old('destinataires', $journal->destinataires)))
                        checked
                                @endif>Intervenant</label>
                </div>
                <input type="text" class="form-control" placeholder="Autre" name="destinataires[autre]" value="{{ old('destinataires[autre]', $journal->destinataires['autre']) }}">
            </div>
        </div>
        <div class="form-group{{ $errors->has('sujet') ? ' has-error' : '' }}">
            <label for="sujet" class=" control-label">À quel sujet, dans quel but?</label>
            <textarea id="sujet" class="form-control" name="sujet">{{ old('sujet', $journal->sujet) }}</textarea>
            @if ($errors->has('sujet'))
                <span class="help-block">
        		    <strong>{{ $errors->first('sujet') }}</strong>
        		</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('commentaires') ? ' has-error' : '' }}">
            <label for="commentaires" class=" control-label">Commentaires</label>
            <textarea id="commentaires" class="form-control" name="commentaires">{{ old('commentaires', $journal->commentaires) }}</textarea>
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


    <script>

        new Vue({
            el: '#app',
            data: {
                modalite:'{{ old('modalite', $journal->modalite) }}'
            }
        });

    </script>

@endsection