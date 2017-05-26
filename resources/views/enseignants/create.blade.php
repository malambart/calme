@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a> : ajouter un enseignant</h1>
@endsection
@section('body')
@include('ecoles.create')
    <form class="form-horizontal" id="form" role="form" method="POST"
          action="{{ url('enseignants/create',$dossier->id) }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('ecole_id') ? ' has-error' : '' }}">
            <label for="ecole_id" class="col-md-4 control-label">École</label>

            <div class="col-md-6">
                <div class="input-group">
                    <select name="ecole_id" class="form-control" autofocus>
                        <option value="">Veuillez choisir</option>
                        @foreach($ecoles as $ecole)
                            <option value="{{$ecole->id}}"
                                    @if(old('ecole_id')==$ecole->id)
                                    selected
                                    @endif
                            >
                                {{$ecole->nom}}
                            </option>
                        @endforeach
                    </select>
                    <span class="input-group-btn">
					<button tabindex="-1" type="button" class="btn btn-primary bootstrap-modal-form-open"
                            data-toggle="modal" data-target="#ecoleForm">+</button>
				</span>

                </div>

                @if ($errors->has('ecole_id'))
                    <span class="help-block">
				<strong>{{ $errors->first('ecole_id') }}</strong>
			</span>
                @endif

            </div>
        </div>
        <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
            <label for="prenom" class="col-md-4 control-label">Prénom de l'enseignant</label>
            <div class="col-md-6">
                <input id="prenom" type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" autofocus>
                @if ($errors->has('prenom'))
                    <span class="help-block">
				<strong>{{ $errors->first('prenom') }}</strong>
			</span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
            <label for="nom" class="col-md-4 control-label">Nom de l'enseignant</label>
            <div class="col-md-6">
                <input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}" autofocus>
                @if ($errors->has('nom'))
                    <span class="help-block">
				<strong>{{ $errors->first('nom') }}</strong>
			</span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('courriel') ? ' has-error' : '' }}">
            <label for="courriel" class="col-md-4 control-label">Courriel</label>
            <div class="col-md-6">
                <input id="courriel" type="text" class="form-control" name="courriel" value="{{ old('courriel') }}">
            </div>

            @if ($errors->has('courriel'))
                <span class="help-block">
        		    <strong>{{ $errors->first('courriel') }}</strong>
        		</span>
            @endif
        </div>
        <input type="hidden" name="confirmAssociate" id="confirmAssociate" value="0">
        <input type="hidden" name="confirmCreate" id="confirmCreate" value="0">
        <input type="hidden" name="prof_id" id="prof_id" value="0">
        <button type="submit" class="btn btn-primary pull-right">
            Ajouter
        </button>
    </form>
    @if(Session::has('enseignant_existe'))
        <div class="modal fade" id="confirm-enseignant" tabindex="-1" role="dialog"
             aria-labelledby="jkhkjhkj"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <p>
                            L'enseignant(e) {{Session::get('enseignant_existe')->prenom}} {{Session::get('enseignant_existe')->nom}}
                            de l'école {{Session::get('enseignant_existe')->ecole->nom}} est déjà associé(e) au(x)
                            dossier(s) suivant(s):</p>
                        <ul>
                            @foreach(Session::get('enseignant_existe')->dossiers as $d)
                                <li>{{$d->prenom.' '.$d->nom.' ('.$d->id.')'}}</li>
                            @endforeach
                        </ul>
                        <p>Voulez-vous...</p>
                        <p>
                            <a href="#" id="associate" class="confirm">Associer ce même enseignant au dossier
                                actuel?</a>
                        </p>
                        <p>
                            <a href="#" id="createNew" class="confirm">Créer un nouvel enseignant?</a>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    </div>

                </div>
            </div>
        </div>
    @endif

@endsection
@section('script')
    <script type="text/javascript">
        @if(Session::has('enseignant_existe'))
            $('#confirm-enseignant').modal('show');
        $('#associate').click(function () {
            $('#confirmAssociate').val(1);
            $('#prof_id').val({{Session::get('enseignant_existe')->id}});
            $('#confirm-enseignant').modal('hide');
            $('#form').submit();
        });
        $('#createNew').click(function () {
            $('#confirmCreate').val(1);
            $('#prof_id').val({{Session::get('enseignant_existe')->id}});
            $('#confirm-enseignant').modal('hide');
            $('#form').submit();
        });
        @endif
    </script>
@endsection		
