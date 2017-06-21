
@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a>: compléter le plan d'intervention</h1>
@endsection
@section('body')
    <div id="app">
        <form role="form" method="POST" action="{{ url('plans/1',$plan->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group{{ $errors->has('famille') ? ' has-error' : '' }}">
                <label for="famille" class="control-label">Situation familiale</label>
                <select class="form-control" name="famille" v-model="famille" autofocus>
                    <option value="">Veuillez choisir</option>
                    <option value="Monoparentale">
                        Monoparentale
                    </option>
                    <option value="Biparentale">
                        Biparentale
                    </option>
                    <option value="Famille accueil">
                        Famille d'accueil
                    </option>
                    <option value="Famille d'adoption">
                        Famille d'adoption
                    </option>
                </select>
                @if ($errors->has('famille'))
                    <span class="help-block"><strong>{{ $errors->first('famille') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('modalite_garde') ? ' has-error' : '' }}" v-show="famille=='Biparentale'">
                <label for="modalite_garde" class=" control-label">Modalité de garde</label>
                <input id="modalite_garde" type="text" class="form-control" name="modalite_garde"
                       value="{{ old('modalite_garde', $plan->modalite_garde) }}">
                @if ($errors->has('modalite_garde'))
                    <span class="help-block">
        		    <strong>{{ $errors->first('modalite_garde') }}</strong>
        		</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('responsable') ? ' has-error' : '' }}" v-show="famille=='Famille accueil'">
                <label for="responsable" class="control-label">Responsable de la famille d'accueil</label>
                <select class="form-control" name="responsable">
                    <option value="" selected>Veuillez choisir</option>
                    <option value="Intervenant"
                            @if(old('responsable', $plan->responsable)=="Intervenant")
                            selected
                            @endif>
                        Intervenant
                    </option>
                    <option value="Membre de la famille"
                            @if(old('responsable', $plan->responsable)=="Membre de la famille")
                            selected
                            @endif>
                        Membre de la famille
                    </option>

                </select>
                @if ($errors->has('responsable'))
                    <span class="help-block"><strong>{{ $errors->first('responsable') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('nb_enfants') ? ' has-error' : '' }}">
                <label for="nb_enfants" class=" control-label">Nombre d'enfants</label>
                <input id="nb_enfants" type="number" class="form-control" name="nb_enfants"
                       value="{{ old('nb_enfants', $plan->nb_enfants) }}">
                @if ($errors->has('nb_enfants'))
                    <span class="help-block">
        		    <strong>{{ $errors->first('nb_enfants') }}</strong>
        		</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('langue') ? ' has-error' : '' }}">
                <label for="langue" class=" control-label">Langue principalement parlée à la maison</label>
                <input id="langue" type="text" class="form-control" name="langue"
                       value="{{ old('langue', $plan->langue) }}">
                @if ($errors->has('langue'))
                    <span class="help-block">
        		    <strong>{{ $errors->first('langue') }}</strong>
        		</span>
                @endif
            </div>
            @include('plans/nav')
        </form>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        vm = new Vue({
            el: '#app',
            data: {
                famille:'{{old('famille', $plan->famille)}}'
            },
        })
    </script>
@endsection
