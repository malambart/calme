<script type="text/javascript">
    var oldObjectifs = [];
    @if($plan->objectifs != '')
        @foreach(json_decode($plan->objectifs) as $objectif)
            oldObjectifs.push('{{$objectif}}');
    @endforeach
            @endif
    var oldMedication = [];
    @if($plan->pharmaco_liste != '')
    @foreach(json_decode($plan->pharmaco_liste) as $med)
        oldMedication.push({
        nom: '{{$med->nom}}',
        posologie: '{{$med->posologie}}',
        unit: '{{$med->unit}}',
        med_string: '{{$med->med_string}}'
    })
    @endforeach
            @endif
        vm = new Vue({
        el: '#app',
        data: {
            retenu: '',
            objectifs: oldObjectifs,
            traitement: '{{old('traitement_pharmaco', $plan->traitement_pharmaco)}}',
            new_objectif: '{{old('new_diagnostic')}}',
            medication: oldMedication,
            new_medicament: '{{old('new_medicament')}}',
            new_posologie: '{{old('new_posologie')}}',
            new_unit: '{{old('new_unit', 'mg/jour')}}'
        },
        methods: {
            addObjectif: function () {
                var value = this.new_objectif && this.new_objectif.trim()
                if (!value) {
                    return;
                }
                else if ($.inArray(value, this.Objectifs) != -1) {
                    alert('Cet élément a déjà été entré.');
                }
                else {
                    this.objectifs.push(value)
                    this.new_objectif = ''
                }
            },
            deleteObjectif: function (objectif) {
                this.objectifs.splice(this.objectifs.indexOf(objectif), 1);
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
                        var med_string = med + ' - ' + this.new_posologie + ' ' + this.new_unit;
                    }
                    else {
                        var med_string = med;
                    }

                    this.medication.push({
                        nom: med,
                        posologie: this.new_posologie,
                        unit: this.new_unit,
                        med_string: med_string});
                    this.new_medicament = '';
                    this.new_posologie = '';
                    this.new_unit= 'mg/jour';
                }

            },
            deleteMedicament: function (medicament) {
                this.medication.splice(this.medication.indexOf(medicament), 1);
            },
        }
    })
</script>