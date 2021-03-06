@extends('layouts.row')
@section('panel-heading')
    <h1>Éditer dossier {{$dossier->id.' ('.$dossier->nom_complet.')'}}</h1>
@endsection
@section('body')
    <div id="app">
        <form role="form" method="POST" action="{{ url('/dossiers/edit',$dossier->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH')}}
            <div class="form-group">
                <select v-model="orientation" class="form-control" name="orientation">
                    <option value="0" selected>Quelle est l’orientation du cas suite à l’évaluation ?</option>
                    <option value="1">Module Calme</option>
                    <option value="2">Suivi intensif</option>
                    <option value="3">Autre</option>
                </select>
            </div>
            <div v-if="orientation == 3" class=form-group>
                <label for="orientation_autre" class="control-label">Veuillez préciser</label>
                <input type="text" name="orientation_autre" class="form-control" value="{{ old('orientation_autre', $dossier->orientation_autre) }}">
            </div>
            <div class="form-group">
                <select v-model="accepte" class="form-control" name="accepte">
                    <option value="0" selected>Sélectionnez la situation qui s'applique.</option>
                    <option value="1">
                        La famille accepte d'être contactée par l'équipe de recherche
                    </option>

                    </option>
                    <option value="2">
                        La famille refuse d'être contactée par l'équipe de recherche
                    </option>
                     <option value="3">
                        La recherche n'est pas proposée
                    </option>
                </select>
            </div>
              <div v-if="accepte == 3" class="form-group">
                <label for="pourquoi_la_recherche_n_est_pas_proposee">
                    Pourquoi la recherche n'a pas été proposée?
                </label>
                <textarea class="form-control" name="pourquoi_la_recherche_n_est_pas_proposee">{{ old('pourquoi_la_recherche_n_est_pas_proposee', $dossier->pourquoi_la_recherche_n_est_pas_proposee) }}
                </textarea>
            </div>
            <div v-if="accepte == 1 || accepte == 2">
                <div v-if="accepte == 1" class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
                    <label for="prenom" class=" control-label">Prénom</label>
                    <input id="prenom" type="text" class="form-control" name="prenom" value="{{ old('prenom', $dossier->prenom) }}"
                           autofocus>
                    @if ($errors->has('prenom'))
                        <span class="help-block">
			<strong>{{ $errors->first('prenom') }}</strong>
		</span>
                    @endif
                </div>
                <div v-if="accepte == 1" class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                    <label for="nom" class=" control-label">Nom</label>
                    <input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom', $dossier->nom) }}" autofocus>

                    @if ($errors->has('nom'))
                        <span class="help-block">
			<strong>{{ $errors->first('nom') }}</strong>
		</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('sexe') ? ' has-error' : '' }}">
                    <label for="sexe" class="control-label">Sexe du jeune</label>
                    <select class="form-control" name="sexe">
                        <option value="" selected>Veuillez choisir</option>
                        <option value=2 @if(old('sexe', $dossier->sexe)==2)
                        selected
                                @endif>
                            Féminin
                        </option>
                        <option value=1 @if(old('sexe', $dossier->sexe)==1)
                        selected
                                @endif>
                            Masculin
                        </option>
                    </select>
                    @if ($errors->has('sexe'))
                        <span class="help-block"><strong>{{ $errors->first('sexe') }}</strong></span>
                    @endif
                </div>
                <div v-if="accepte == 1" class="form-group{{ $errors->has('no_doss_chus') ? ' has-error' : '' }}">
                    <label for="no_doss_chus" class=" control-label"># dossier CHUS</label>
                    <input id="no_doss_chus" type="text" class="form-control" name="no_doss_chus"
                           value="{{ old('no_doss_chus', $dossier->no_doss_chus) }}" autofocus>
                    @if ($errors->has('no_doss_chus'))
                        <span class="help-block">
		<strong>{{ $errors->first('no_doss_chus') }}</strong>
	</span>
                    @endif
                </div>
                <div v-if="accepte == 1" class="form-group{{ $errors->has('date_naiss') ? ' has-error' : '' }}">
                    <label for="date_naiss" class=" control-label">Date de naissance <span
                                class="tip">(aaaa-mm-jj)</span></label>
                    <input id="date_naiss" type="date" class="form-control datepicker" name="date_naiss"
                           value="{{ old('date_naiss', $dossier->date_naiss ? $dossier->date_naiss->toDateString(): "") }}" autofocus>
                    @if ($errors->has('date_naiss'))
                        <span class="help-block">
		<strong>{{ $errors->first('date_naiss') }}</strong>
	</span>
                    @endif
                </div>
                <div v-if="accepte == 2" class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                    <label for="age">Âge de l'enfant</label>
                    <input class="form-control" type="number" name="age" value="{{ old('age', $dossier->age) }}">
                    @if ($errors->has('age'))
                        <span class="help-block">
			<strong>{{ $errors->first('age') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('langue') ? ' has-error' : '' }}">
                    <label for="langue" class=" control-label">Langue principale</label>
                    <input id="langue" type="text" class="form-control" name="langue" value="{{ old('langue', $dossier->langue) }}">
                    @if ($errors->has('langue'))
                        <span class="help-block">
            		    <strong>{{ $errors->first('langue') }}</strong>
            		</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('diagnostic') ? ' has-error' : '' }}">
                    <label for="diagnostic" class=" control-label">Diagnostics pédopsychiatriques</label>
                    <input id="diagnostic" type="text" class="form-control" name="diagnostic"
                           value="{{ old('diagnostic', $dossier->diagnostic) }}">
                    @if ($errors->has('diagnostic'))
                        <span class="help-block">
                		    <strong>{{ $errors->first('diagnostic') }}</strong>
                		</span>
                    @endif
                </div>
                <!--
                <div class="form-group">
                    <label><input type="checkbox" name="exclu" value="1"
                                  @if(old('exclu')==1)
                                  checked
                                @endif
                        > Exclure de l'étude</label>
                </div>
                <div class="form-group">
                    <label><input type="checkbox" name="confirmation_received" value="1"
                                  @if(old('confirmation_received')==1)
                                  checked
                                @endif
                        > Consentement du parent reçue</label>
                </div>
                !-->
                
            </div>
            <button type="submit" class="btn btn-primary pull-right">
                    Sauvegarder
                </button>

        </form>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        let accepte = "{{ $dossier->accepte }}";
        let orientation = "{{ $dossier->orientation }}"
        let old_orientation = "{{ old('orientation') }}"
        let old_accepte = "{{ old('accepte') }}";
        /*if(old_accepte != 0) {
            accepte = old_accepte;
        }*/
        vm = new Vue({
            el: '#app',
            data: {
                'accepte': accepte,
                'orientation' : orientation
            },
        })
    </script>
@endsection
