<!--
 * Created by PhpStorm.
 * Project: calme
 * User: laff3601
 * Date: 30/03/17
 * Time: 16:03
-->

@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a>: compléter le plan d'intervention :
        recommendations concernant l'enfant</h1>
@endsection
@section('body')
    <div id="app">
        <form role="form" method="POST" action="{{ url('') }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group{{ $errors->has('retenu') ? ' has-error' : '' }}">
                <label for="retenu" class="control-label">Retenu(e) ou non retenu(e)</label>
                <select class="form-control" name="retenu" v-model="retenu">
                    <option value="" selected>Veuillez choisir</option>
                    <option value="Retenu(e)"
                            @if(old('retenu', $plan->retenu)=="Retenu(e)")
                            selected
                            @endif>
                        Retenu(e)
                    </option>
                    <option value="Non retenu(e)"
                            @if(old('retenu', $plan->retenu)=="Non retenu(e)")
                            selected
                            @endif>
                        Non retenu(e)
                    </option>
                </select>
                @if ($errors->has('retenu'))
                    <span class="help-block"><strong>{{ $errors->first('retenu') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('non_retenu_motif') ? ' has-error' : '' }}" v-show="retenu=='Non retenu(e)'">
                <label for="non_retenu_motif" class=" control-label">Motifs</label>
                <input id="non_retenu_motif" type="text" class="form-control" name="non_retenu_motif"
                       value="{{ old('non_retenu_motif') }}">
                @if ($errors->has('non_retenu_motif'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('non_retenu_motif', $plan->non_retenu_motif) }}</strong>
            		</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('non_retenu_redirige') ? ' has-error' : '' }}" v-show="retenu=='Non retenu(e)'">
                <label for="non_retenu_redirige" class=" control-label">Redirigé(e)</label>
                <textarea id="non_retenu_redirige" class="form-control"
                          name="non_retenu_redirige">{{ old('non_retenu_redirige', $plan->non_retenu_redirige) }}</textarea>
                @if ($errors->has('non_retenu_redirige'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('non_retenu_redirige') }}</strong>
            		</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('date_premiere_seance') ? ' has-error' : '' }}" v-show="retenu=='Retenu(e)'">
                <p style="color:red;">Cette information est déjà entrée à la création du dossier...</p>
                <label for="date_premiere_seance" class=" control-label">Date de la première séance<span class="tip">(aaaa-mm-jj)</span></label>
                <input id="date_premiere_seance" type="date" class="form-control datepicker" name="date_premiere_seance"
                       value="{{ old('date_premiere_seance', $premiere_seance->date->toDateString()) }}">
                @if ($errors->has('date_premiere_seance'))
                    <span class="help-block"><strong>{{ $errors->first('date_premiere_seance') }}</strong></span>
                @endif
            </div>
            @include('plans/nav')
        </form>
    </div>
@endsection
@section('script')
    @include('partials.dateSupport')
    <script type="text/javascript">
        vm = new Vue({
            el: '#app',
            data: {
                retenu:''
            },
        })
    </script>
@endsection
