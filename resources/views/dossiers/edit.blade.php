@extends('layouts.row')
@section('panel-heading')
    <h1>Éditer dossier {{$dossier->id.' ('.$dossier->nom_complet.')'}}</h1>
@endsection
@section('body')
    <form role="form" method="POST" action="{{ url('/dossiers/edit',$dossier->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH')}}
        <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
            <label for="prenom" class=" control-label">Prénom</label>
            <input id="prenom" type="text" class="form-control" name="prenom"
                   value="{{ old('prenom', $dossier->prenom) }}" autofocus>
            @if ($errors->has('prenom'))
                <span class="help-block">
			<strong>{{ $errors->first('prenom') }}</strong>
		</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
            <label for="nom" class=" control-label">Nom</label>
            <input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom', $dossier->nom) }}"
                  >

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
                <span class="help-block">
	<strong>{{ $errors->first('sexe') }}</strong>
</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('no_doss_chus') ? ' has-error' : '' }}">
            <label for="no_doss_chus" class=" control-label"># dossier CHUS</label>
            <input id="no_doss_chus" type="text" class="form-control" name="no_doss_chus"
                   value="{{ old('no_doss_chus', $dossier->no_doss_chus) }}">
            @if ($errors->has('no_doss_chus'))
                <span class="help-block">
		<strong>{{ $errors->first('no_doss_chus') }}</strong>
	</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('date_naiss') ? ' has-error' : '' }}">
            <label for="date_naiss" class=" control-label">Date de naissance</label>
            <input id="date_naiss" type="date" class="form-control datepicker" name="date_naiss"
                   value="{{ old('date_naiss', $dossier->date_naiss->toDateString()) }}">
            @if ($errors->has('date_naiss'))
                <span class="help-block">
		<strong>{{ $errors->first('date_naiss') }}</strong>
	</span>
            @endif
        </div>
        <input type="hidden" name="exclu" value="0">
        <div class="form-group">
            <label><input type="checkbox" name="exclu" value="1"
                          @if($dossier->exclu)
                          checked
                        @endif>
                Exclure de l'étude</label>
        </div>

        <ul class="list-inline pull-right">
            <li>
                <button type="submit" class="btn btn-primary">
                    Sauvegarder
                </button>
            </li>
            <li>
                <a data-href="{{url('dossiers/delete', $dossier->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" id="deleteButton">
                    Supprimer le dossier
                </a>
            </li>
        </ul>

    </form>
@endsection
@section('script')
    @include('partials.confirmationSupression')
    <script type="text/javascript">
    </script>
@endsection
