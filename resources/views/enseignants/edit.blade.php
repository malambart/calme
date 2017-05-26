@extends('layouts.row')
@section('panel-heading')
    <h1>{{$enseignant->prenom." ".$enseignant->nom}} (enseignant)</h1>
@endsection
@section('body')
    @include('ecoles.create')
    <form class="form-horizontal" id="form" role="form" method="POST"
          action="{{ url('enseignants/edit', $enseignant->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group{{ $errors->has('ecole_id') ? ' has-error' : '' }}">
            <label for="ecole_id" class="col-md-4 control-label">École</label>

            <div class="col-md-6">
                <div class="input-group">
                    <select name="ecole_id" class="form-control" autofocus>
                        <option value="">Veuillez choisir</option>
                        @foreach($ecoles as $ecole)
                            <option value="{{$ecole->id}}"
                                    @if(old('ecole_id', $enseignant->ecole_id)==$ecole->id)
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
                <input id="prenom" type="text" class="form-control" name="prenom" value="{{ old('prenom', $enseignant->prenom) }}" autofocus>
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
                <input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom', $enseignant->nom) }}" autofocus>
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
                <input id="courriel" type="text" class="form-control" name="courriel" value="{{ old('courriel', $enseignant->courriel) }}">
            </div>

            @if ($errors->has('courriel'))
                <span class="help-block">
        		    <strong>{{ $errors->first('courriel') }}</strong>
        		</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary pull-right">
            Sauvegarder
        </button>
    </form>


@endsection

