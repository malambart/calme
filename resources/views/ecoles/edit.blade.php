@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Éditer école {{$ecole->nom}}</h1></div>
                <div class="panel-body">
                    <form class="" role="form" method="POST"
                          action="{{ url('ecoles/edit', $ecole->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                            <label for="nom" class="control-label">Nom de l'école</label>
                            <input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom', $ecole->nom) }}"
                                   autofocus>
                            @if ($errors->has('nom'))
                                <p class="help-block">
                                    <strong>{{ $errors->first('nom') }}</strong>
                                </p>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('ville') ? ' has-error' : '' }}">
                            <label for="ville" class="control-label">Ville</label>
                            <input id="ville" type="text" class="form-control" name="ville" value="{{ old('ville', $ecole->ville) }}"
                                   autofocus>
                            @if ($errors->has('ville'))
                                <span class="help-block">
							<strong>{{ $errors->first('ville') }}</strong>
						</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                            <label for="telephone" class=" control-label">Téléphone</label>
                            <input id="telephone" type="text" class="form-control tel-mask" name="telephone"
                                   value="{{ old('telephone', $ecole->telephone) }}">
                            @if ($errors->has('telephone'))
                                <span class="help-block">
                        		    <strong>{{ $errors->first('telephone') }}</strong>
                        		</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
                            <label for="fax" class=" control-label">Fax</label>
                            <input id="fax" type="text" class="form-control tel-mask" name="fax" value="{{ old('fax', $ecole->fax) }}">
                            @if ($errors->has('fax'))
                                <span class="help-block">
                        		    <strong>{{ $errors->first('fax') }}</strong>
                        		</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">
                            Sauvegarder
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
