@extends('layouts.row')
@section('panel-heading')
    <h1>Ajouter un dossier</h1>
@endsection
@section('body')
    <form role="form" method="POST" action="{{ url('/dossiers/create') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
            <label for="prenom" class=" control-label">Prénom</label>
            <input id="prenom" type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" autofocus>
            @if ($errors->has('prenom'))
                <span class="help-block">
			<strong>{{ $errors->first('prenom') }}</strong>
		</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
            <label for="nom" class=" control-label">Nom</label>
            <input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}" autofocus>

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
                <option value=2 @if(old('sexe')==2)
                selected
                        @endif>
                    Féminin
                </option>
                <option value=1 @if(old('sexe')==1)
                selected
                        @endif>
                    Masculin
                </option>
            </select>
            @if ($errors->has('sexe'))
                <span class="help-block"><strong>{{ $errors->first('sexe') }}</strong></span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('no_doss_chus') ? ' has-error' : '' }}">
            <label for="no_doss_chus" class=" control-label"># dossier CHUS</label>
            <input id="no_doss_chus" type="text" class="form-control" name="no_doss_chus"
                   value="{{ old('no_doss_chus') }}" autofocus>
            @if ($errors->has('no_doss_chus'))
                <span class="help-block">
		<strong>{{ $errors->first('no_doss_chus') }}</strong>
	</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('date_naiss') ? ' has-error' : '' }}">
            <label for="date_naiss" class=" control-label">Date de naissance <span
                        class="tip">(aaaa-mm-jj)</span></label>
            <input id="date_naiss" type="date" class="form-control datepicker" name="date_naiss"
                   value="{{ old('date_naiss') }}" autofocus>
            @if ($errors->has('date_naiss'))
                <span class="help-block">
		<strong>{{ $errors->first('date_naiss') }}</strong>
	</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('premiere_seance') ? ' has-error' : '' }}">
            <label for="premiere_seance" class=" control-label">Date prévue de la première séance de traitement <span
                        class="tip">(aaaa-mm-jj)</span></label>
            <input id="premiere_seance" type="date" class="form-control datepicker" name="premiere_seance"
                   value="{{ old('premiere_seance') }}" autofocus>
            @if ($errors->has('premiere_seance'))
                <span class="help-block">
		<strong>{{ $errors->first('premiere_seance') }}</strong>
	</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('bilan_final') ? ' has-error' : '' }}">
            <label for="bilan_final" class=" control-label">Date prévue du bilan final <span
                        class="tip">(aaaa-mm-jj)</span></label>
            <input id="bilan_final" type="date" class="form-control datepicker" name="bilan_final"
                   value="{{ old('bilan_final') }}" autofocus>
            @if ($errors->has('bilan_final'))
                <span class="help-block">
		<strong>{{ $errors->first('bilan_final') }}</strong>
	</span>
            @endif
        </div>
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
        <button type="submit" class="btn btn-primary pull-right">
            Ajouter
        </button>
    </form>
@endsection
