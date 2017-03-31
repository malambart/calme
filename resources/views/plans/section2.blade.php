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
                <label for="new_diagnostic" class=" control-label">Troubles anxieux retenus</label>
                <input name="new_diagnostic" value="{{old('new_diagnostic')}}"
                       placeholder="Entrer un trouble anxieux et appuyez sur Enter" id="diagnostic" type="text"
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
            <div class="form-group{{ $errors->has('new_medicament') ? ' has-error' : '' }} clearfix">
                <label class="control-label dual-input-label">Médication</label>
                <div class="col-md-5 dual-input-input">
                    <input name="new_medicament" value="{{old('new_medicament')}}" placeholder="Nom du médicament"
                           id="medicament"
                           type="text"
                           class="form-control" v-model="new_medicament">
                </div>
                <div class="col-md-5 dual-input-input">
                    <input type="text" name="new_posologie" value="{{old('new_posologie')}}" placeholder="Posologie"
                           id="posologie" class="form-control" v-model="new_posologie">
                </div>
                <button class="btn btn-primary" @click.prevent="addMedicament">Ajouter</button>

                @if ($errors->has('new_medicament'))
                    <span class="help-block"><strong>Le médicament n'a pas été soumis.</strong></span>
                @endif
            </div>
            <ul class="list-group">
                <li v-for="medicament in medication" class="list-group-item">
                    @{{ medicament.med_string }}
                    <button @click="deleteMedicament(medicament)" type="button" class="btn btn-danger btn-xs pull-right"
                    >X</button>
                </li>
            </ul>
            <input v-for="medicament in medication"
                   type="hidden"
                   v-bind:value="medicament.nom"
                   v-bind:name="'medication['+medication.indexOf(medicament)+']'+'[nom]'">
            <input v-for="medicament in medication"
                   type="hidden"
                   v-bind:value="medicament.posologie"
                   v-bind:name="'medication['+medication.indexOf(medicament)+']'+'[posologie]'">
            <input v-for="medicament in medication"
                   type="hidden"
                   v-bind:value="medicament.med_string"
                   v-bind:name="'medication['+medication.indexOf(medicament)+']'+'[med_string]'">
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
                <input id="motif" type="text" class="form-control" name="motif"
                       value="{{ old('motif', $plan->motif) }}">
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
        @foreach(json_decode($plan->medication) as $med)
            oldMedication.push({nom:'{{$med->nom}}', posologie:'{{$med->posologie}}', med_string:'{{$med->med_string}}'})
        @endforeach
                @endif
            vm = new Vue({
            el: '#app',
            data: {
                diagnostics: oldDiagnostics,
                medication: oldMedication,
                new_diag: '{{old('new_diagnostic')}}',
                new_medicament: '{{old('new_medicament')}}',
                new_posologie: '{{old('new_posologie')}}',
            },
            methods: {
                addDiag: function () {
                    var value = this.new_diag && this.new_diag.trim()
                    if (!value) {
                        return;
                    }
                    else if ($.inArray(value, this.diagnostics) != -1) {
                        alert('Cet élément a déjà été entré.');
                    }
                    else {
                        this.diagnostics.push(value)
                        this.new_diag = ''
                    }

                },
                deleteDiagnostic: function (diagnostic) {
                    this.diagnostics.splice(this.diagnostics.indexOf(diagnostic), 1);
                },
                addMedicament: function () {
                    var med = this.new_medicament && this.new_medicament.trim()
                    if (!med) {
                        return
                    }
                    else if ($.inArray(med, this.medication) != -1) {
                        alert('Cet élément a déjà été entré.');
                    }
                    else {
                        if (this.new_posologie != '') {
                            var med_string = med + ' - ' + this.new_posologie;
                        }
                        else {
                            var med_string = med;
                        }
                        this.medication.push({nom: med, posologie: this.new_posologie, med_string: med_string})
                        this.new_medicament = ''
                        this.new_posologie = ''
                    }

                },
                deleteMedicament: function (medicament) {
                    this.medication.splice(this.medication.indexOf(medicament), 1);
                },
            }
        })
    </script>
@endsection