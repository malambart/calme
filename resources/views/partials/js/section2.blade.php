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