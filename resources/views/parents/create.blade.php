@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a> : ajouter un parent</h1>
@endsection
@section('body')
    <div id="app">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/parents/create',$dossier->id)}}">
            {{ csrf_field() }}
            @if(!$dossier->hasRepondant())
                <input type="hidden" name="repondant" value="0">
                <div v-if="accepte == 1" class="form-group">
                    <label for="repondant" class="col-md-4 control-label"></label>
                    <div class="col-md-6 checkbox">
                        <label><input selected type="checkbox" name="repondant" v-model="repondant" value="1"><b>Parent
                                répondant</b></label>
                    </div>
                </div>
            @endif
            <div v-if="accepte == 1" class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
                <label for="prenom" class="col-md-4 control-label">Prénom</label>
                <div class="col-md-6">
                    <input id="prenom" type="text" class="form-control" name="prenom" value="{{ old('prenom') }}"
                    >
                    @if ($errors->has('prenom'))
                        <span class="help-block">
				<strong>{{ $errors->first('prenom') }}</strong>
			</span>
                    @endif
                </div>
            </div>
            <div v-if="accepte == 1" class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                <label for="nom" class="col-md-4 control-label">Nom</label>
                <div class="col-md-6">
                    <input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}">
                    @if ($errors->has('nom'))
                        <span class="help-block">
	   			<strong>{{ $errors->first('nom') }}</strong>
	  		</span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('lien') ? ' has-error' : '' }}">
                <label for="lien" class="col-md-4 control-label">Lien avec le jeune</label>
                <div class="col-md-6">
                    <select v-model="lien" id="lien" name="lien" class="form-control">
                        <option value="">Veuillez Choisir</option>
                        <option value="mère"
                                @if(old('lien')=="mère")
                                selected="selected"
                                @endif
                        >Mère
                        </option>
                        <option value="père"
                                @if(old('lien')=="père")
                                selected="selected"
                                @endif
                        >Père
                        </option>
                        <option value="autre"
                                @if(old('lien')=="autre")
                                selected="selected"
                                @endif
                        >Autre
                        </option>
                    </select>
                    @if ($errors->has('lien'))
                        <span class="help-block">
				<strong>{{ $errors->first('lien') }}</strong>
			</span>
                    @endif
                </div>
            </div>
            <div v-show="lien==='autre'" id="input_lien_autre"
                 class="form-group{{ $errors->has('lien_autre') ? ' has-error' : '' }}">
                <label for="lien_autre" class="col-md-4 control-label">Veuillez précisez</label>
                <div class="col-md-6">
                    <input id="lien_autre" type="text" class="form-control" name="lien_autre"
                           value="{{ old('lien_autre') }}">
                    @if ($errors->has('lien_autre'))
                        <span class="help-block">
				<strong>{{ $errors->first('lien_autre') }}</strong>
			</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="age" class="col-md-4 control-label">
                    Âge du parent
                </label>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="age" value="{{old('age')}}">
                </div>
            </div>
            <div v-if="accepte ==1" class="form-group{{ $errors->has('date_naiss') ? ' has-error' : '' }}">
                <label for="date_naiss" class="col-md-4 control-label">Date de naissance <span
                            class="tip">(aaaa-mm-jj)</span></label>
                <div class="col-md-6">
                    <input id="date_naiss" type="date" class="form-control datepicker" name="date_naiss"
                           value="{{ old('date_naiss') }}" autofocus>
                </div>

                @if ($errors->has('date_naiss'))
                    <span class="help-block">
		<strong>{{ $errors->first('date_naiss') }}</strong>
	</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('situation_familiale') ? ' has-error' : '' }}">
                <label for="situation_familiale" class="col-md-4 control-label">Situation familiale</label>
                <div class="col-md-6">
                    <select v-model="situation_familiale" class="form-control" name="situation_familiale">
                        <option value="" selected>Veuillez choisir</option>
                        <option value="Biparentale intacte"
                                @if(old('situation_familiale')=="Biparentale intacte")
                                selected
                                @endif>
                            Biparentale intacte
                        </option>
                        <option value="Biparentale recomposée"
                                @if(old('situation_familiale')=="Biparentale recomposée")
                                selected
                                @endif>
                            Biparentale recomposée
                        </option>
                        <option value="Monoparentale"
                                @if(old('situation_familiale')=="Monoparentale")
                                selected
                                @endif>
                            Monoparentale
                        </option>
                        <option value="Famille d'accueil"
                                @if(old('situation_familiale')=="Famille d'accueil")
                                selected
                                @endif>
                            Famille d'accueil
                        </option>
                        <option value="Autre"
                                @if(old('situation_familiale')=="Autre")
                                selected
                                @endif>
                            Autre
                        </option>
                    </select>
                </div>

                @if ($errors->has('situation_familiale'))
                    <span class="help-block"><strong>{{ $errors->first('situation_familiale') }}</strong></span>
                @endif
            </div>
            <div v-show="situation_familiale == 'Autre'" class="form-group{{ $errors->has('situation_familiale_autre') ? ' has-error' : '' }}">
                <label for="situation_familiale_autre" class="col-md-4 control-label">Précisez autre situation familiale</label>
                <div class="col-md-6">
                    <input id="situation_familiale_autre" type="text" class="form-control" name="situation_familiale_autre"
                           value="{{ old('situation_familiale_autre') }}">
                </div>
                @if ($errors->has('situation_familiale_autre'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('situation_familiale_autre') }}</strong>
            		</span>
                @endif
            </div>
            <div class="form-group">
                <label for="scolarite" class="col-md-4 control-label">
                    Dernier diplôme obtenu
                </label>
                <div class="radio col-md-6">
                    <label><input type="radio" name="scolarite" value="DES non terminé"
                                  @if(old('scolarite')=="DES non terminé")
                                  checked
                                @endif
                        >DES non terminé</label>
                </div>
                <div class="radio col-md-6 col-md-offset-4">
                    <label><input type="radio" name="scolarite" value="DES"
                                  @if(old('scolarite')=="DES")
                                  checked
                                @endif
                        >DES</label>
                </div>
                <div class="radio col-md-6 col-md-offset-4">
                    <label><input type="radio" name="scolarite" value="DEP"
                                  @if(old('scolarite')=="DEP")
                                  checked
                                @endif
                        >DEP</label>
                </div>
                <div class="radio col-md-6 col-md-offset-4">
                    <label><input type="radio" name="scolarite" value="DEC général ou technique"
                                  @if(old('scolarite')=="DEC général ou technique")
                                  checked
                                @endif
                        >DEC général ou technique</label>
                </div>
                <div class="radio col-md-6 col-md-offset-4">
                    <label><input type="radio" name="scolarite" value="1er cycle universitaire"
                                  @if(old('scolarite')=="1er cycle universitaire")
                                  checked
                                @endif
                        >1er cycle universitaire</label>
                </div>
                <div class="radio col-md-6 col-md-offset-4">
                    <label><input type="radio" name="scolarite" value="2e cycle universitaire"
                                  @if(old('scolarite')=="2e cycle universitaire")
                                  checked
                                @endif
                        >2e cycle universitaire</label>
                </div>
                <div class="radio col-md-6 col-md-offset-4">
                    <label><input type="radio" name="scolarite" value="3e cycle universitaire"
                                  @if(old('scolarite')=="3e cycle universitaire")
                                  checked
                                @endif
                        >3e cycle universitaire</label>
                </div>
            </div>
            <div v-if="accepte == 1" class="form-group">
                <label for="emploi" class="col-md-4 control-label">
                    Emploi
                </label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="emploi" value="{{old('emploi')}}">
                </div>
            </div>
            @if(!$dossier->hasRepondant())
                <div v-show="repondant && accepte == 1">
                    <div class="form-group{{ $errors->has('lieuT1') ? ' has-error' : '' }}">
                        <label for="lieuT1" class="col-md-4 control-label">Questionnaire T1 complété...</label>
                        <div class="col-md-6">
                            <select name="lieuT1" class="form-control">
                                <option selected="selected" value="">Veuillez choisir</option>
                                <option value="maison"
                                        @if(old('lieuT1')=="maison")
                                        selected="selected"
                                        @endif
                                >À la maison
                                </option>
                                <option value="chus"
                                        @if(old('lieuT1')=="chus")
                                        selected="selected"
                                        @endif >Au CHUS
                                </option>
                            </select>
                            @if ($errors->has('lieuT1'))
                                <span class="help-block">
				<strong>{{ $errors->first('lieuT1') }}</strong>
			</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('courriel') ? ' has-error' : '' }}">
                        <label for="courriel" class="col-md-4 control-label">Courriel</label>
                        <div class="col-md-6">
                            <input id="courriel" type="text" class="form-control" name="courriel"
                                   value="{{ old('courriel') }}"
                            >
                            @if ($errors->has('courriel'))
                                <span class="help-block">
				<strong>{{ $errors->first('courriel') }}</strong>
			</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                        <label for="tel" class="col-md-4 control-label">Téléphone principal</label>
                        <div class="col-md-6">
                            <input id="tel" type="text" class="form-control tel-mask tel-parent" name="tel"
                                   value="{{ old('tel') }}"
                            >
                            <input id="ext" type="text" class="form-control tel-ext" name="ext" value="{{ old('ext') }}"
                                   placeholder="ext. / commentaires">
                            @if ($errors->has('tel'))
                                <span class="help-block">
				<strong>{{ $errors->first('tel') }}</strong>
			</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('tel2') ? ' has-error' : '' }}">
                        <label for="tel2" class="col-md-4 control-label">Téléphone secondaire</label>
                        <div class="col-md-6">
                            <input id="tel2" type="text" class="form-control tel-mask tel-parent" name="tel2"
                                   value="{{ old('tel2') }}"
                            >
                            <input id="ext" type="text" class="form-control tel-ext" name="ext2"
                                   value="{{ old('ext2') }}"
                                   placeholder="ext. / commentaires">
                            @if ($errors->has('tel2'))
                                <span class="help-block"><strong>{{ $errors->first('tel2') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            <button type="submit" class="btn btn-primary pull-right">
                Ajouter
            </button>
        </form>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        new Vue({
            el: '#app',
            data: {
                accepte: '{{ $dossier->accepte }}',
                lien: '',
                repondant: true,
                situation_familiale:''
            },
        });

    </script>
@endsection
