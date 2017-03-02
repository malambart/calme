<!--
 * Created by PhpStorm.
 * Project: calme
 * User: laff3601
 * Date: 24/02/17
 * Time: 15:25
-->

@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a>: compléter le plan d'intervention : évaluation
        pédopsychiatrique</h1>
@endsection
@section('body')
    <div id="app">
        <form role="form" method="POST" action="{{ url('plans',[$section,$plan->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group{{ $errors->has('date_eval') ? ' has-error' : '' }}">
                <label for="date_eval" class=" control-label">Date de l'évaluation<span
                            class="tip">(aaaa-mm-jj)</span></label>
                <input id="date_eval" type="date" class="form-control datepicker" name="date_eval"
                       value="{{ old('date_eval', $plan->date_eval) }}">
                @if ($errors->has('date_eval'))
                    <span class="help-block"><strong>{{ $errors->first('date_eval') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('pedopsy') ? ' has-error' : '' }}">
                <label for="pedopsy" class=" control-label">Pédopsychiatre</label>
                <input id="pedopsy" type="text" class="form-control" name="pedopsy"
                       value="{{ old('pedopsy', $plan->pedopsy) }}">
                @if ($errors->has('pedopsy'))
                    <span class="help-block">
        		    <strong>{{ $errors->first('pedopsy') }}</strong>
        		</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('new_diagnostic') ? ' has-error' : '' }}">
                <label for="new_diagnostic" class=" control-label">Diagnostics retenus</label>
                <input name="new_diagnostic" value="{{old('new_diagnostic')}}" placeholder="Entrer un diagnostic et appuyez sur Enter" id="diagnostic" type="text"
                       class="form-control" v-model="new_diag" @keydown.enter.prevent="addDiag">
                @if ($errors->has('new_diagnostic'))
                    <span class="help-block">
        		    <strong>Ce diagnostic n'a pas été soumis.</strong>
        		</span>
                @endif
            </div>
            <ul class="list-group">
                <li v-for="diagnostic in diagnostics" class="list-group-item">
                    @{{ diagnostic }}
                    <button @click="deleteDiagnostic(diagnostic)" type="button" class="btn btn-danger btn-xs pull-right"
                    >X</button>
                </li>
            </ul>
            <input v-for="diagnostic in diagnostics"
                   type="hidden"
                   v-bind:value="diagnostic"
                   v-bind:name="'diagnostics['+diagnostics.indexOf(diagnostic)+']'">
            <div class="form-group{{ $errors->has('anxiete') ? ' has-error' : '' }}">
                <label for="anxiete" class=" control-label">Anxiété</label>
                <input id="anxiete" type="text" class="form-control" name="anxiete"
                       value="{{ old('anxiete', $plan->anxiete) }}">
                @if ($errors->has('anxiete'))
                    <span class="help-block">
        		    <strong>{{ $errors->first('anxiete') }}</strong>
        		</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('autres') ? ' has-error' : '' }}">
                <label for="autres" class=" control-label">Autres</label>
                <input id="autres" type="text" class="form-control" name="autres"
                       value="{{ old('autres', $plan->autres) }}">
                @if ($errors->has('autres'))
                    <span class="help-block">
        		    <strong>{{ $errors->first('autres') }}</strong>
        		</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('new_medicament') ? ' has-error' : '' }}">
                <label for="new_medicament" class=" control-label">Médication</label>
                <input name="new_medicament" value="{{old('new_medicament')}}"placeholder="Entrer un medicament et appuyez sur Enter" id="medicament"
                       type="text"
                       class="form-control" v-model="new_medicament" @keydown.enter.prevent="addMedicament">
                @if ($errors->has('new_medicament'))
                    <span class="help-block"><strong>Le médicament n'a pas été soumis.</strong></span>
                @endif
            </div>
            <ul class="list-group">
                <li v-for="medicament in medication" class="list-group-item">
                    @{{ medicament }}
                    <button @click="deleteMedicament(medicament)" type="button" class="btn btn-danger btn-xs pull-right"
                    >X</button>
                </li>
            </ul>
            <input v-for="medicament in medication"
                   type="hidden"
                   v-bind:value="medicament"
                   v-bind:name="'medication['+medication.indexOf(medicament)+']'">
            <div class="form-group{{ $errors->has('reference') ? ' has-error' : '' }}">
                <label for="reference" class=" control-label">Date de la référence au module Calme<span
                            class="tip">(aaaa-mm-jj)</span></label>
                <input id="reference" type="date" class="form-control datepicker" name="reference"
                       value="{{ old('reference', $plan->reference) }}">
                @if ($errors->has('reference'))
                    <span class="help-block"><strong>{{ $errors->first('reference') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('motif') ? ' has-error' : '' }}">
                <label for="motif" class=" control-label">Motif de la référence</label>
                <input id="motif" type="text" class="form-control" name="motif" value="{{ old('motif', $plan->motif) }}">
                @if ($errors->has('motif'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('motif') }}</strong>
            		</span>
                @endif
            </div>
            @include('plans/nav')
        </form>
    </div>
@endsection
@section('script')
    @include('partials.dateSupport')
    <script type="text/javascript">
        var oldDiagnostics = [];
        @if($plan->diagnostics != '')
            @foreach(json_decode($plan->diagnostics) as $diagnostic)
                oldDiagnostics.push('{{$diagnostic}}');
                @endforeach
                @endif
        var oldMedication = [];
        @if($plan->medication != '')
             @foreach(json_decode($plan->medication) as $medicament)
                oldMedication.push('{{$medicament}}');
        @endforeach
                @endif
            vm = new Vue({
            el: '#app',
            data: {
                diagnostics: oldDiagnostics,
                medication: oldMedication,
                new_diag: '{{old('new_diagnostic')}}',
                new_medicament:'{{old('new_medicament')}}',
            },
            methods: {
                addDiag: function () {
                    var value = this.new_diag && this.new_diag.trim()
                    if (!value) {
                        return;
                    }
                    else if ($.inArray(value, this.diagnostics) != -1){
                        alert ('Cet élément a déjà été entré.');
                    }
                    else {
                        this.diagnostics.push(value)
                        this.new_diag = ''
                    }

                },
                deleteDiagnostic: function () {
                    this.diagnostics.splice(this.diagnostics.indexOf(diagnostic), 1);
                },
                addMedicament: function () {
                    var value = this.new_medicament && this.new_medicament.trim()
                    if (!value) {
                        return
                    }
                    else if ($.inArray(value, this.medication) != -1){
                        alert ('Cet élément a déjà été entré.');
                    }
                    else {
                        this.medication.push(value)
                        this.new_medicament = ''
                    }

                },
                deleteMedicament: function () {
                    this.medication.splice(this.medication.indexOf(medicament), 1);
                },
            }
        })
    </script>
@endsection
