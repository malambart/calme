<template>
    <div>
        <div class="form-group clearfix">
            <label class="control-label dual-input-label">Médication</label>
            <div class="col-md-6 dual-input-input">
                <input name="new_medicament" placeholder="Nom du médicament"
                       id="medicament"
                       type="text"
                       class="form-control" v-model="new_medicament">
            </div>
            <div class="col-md-2 dual-input-input">
                <input type="number" name="new_posologie" placeholder="Posologie"
                       id="posologie" class="form-control" v-model="new_posologie">
            </div>
            <div class="col-md-2 dual-input-input">
                <select name="new_unit" id="input" class="form-control" v-model="new_unit">
                    <option value="mg/jour" selected>
                        mg/jour

                    </option>
                </select>
            </div>
            <button class="btn btn-primary" @click.prevent="addMedicament">Ajouter</button>
        </div>
        <ul class="list-group">
            <li v-for="medicament in medication" class="list-group-item">
                {{ medicament.med_string }}

                <button @click="deleteMedicament(medicament)" type="button" class="btn btn-danger btn-xs pull-right"
                >X
                </button>
            </li>
        </ul>
        <input v-for="medicament in medication"
               type="hidden"
               v-bind:value="medicament.nom"
               v-bind:name="name+'['+medication.indexOf(medicament)+']'+'[nom]'">
        <input v-for="medicament in medication"
               type="hidden"
               v-bind:value="medicament.posologie"
               v-bind:name="name+'['+medication.indexOf(medicament)+']'+'[posologie]'">
        <input v-for="medicament in medication"
               type="hidden"
               v-bind:value="medicament.unit"
               v-bind:name="name+'['+medication.indexOf(medicament)+']'+'[unit]'">
        <input v-for="medicament in medication"
               type="hidden"
               v-bind:value="medicament.med_string"
               v-bind:name="name+'['+medication.indexOf(medicament)+']'+'[med_string]'">
    </div>

</template>


<script>
    module.exports = {
        props: ['name', 'inputname', 'items', 'value', 'old_med', 'old_posologie', 'old_unit'],
        created: function () {
            let items = [];
            if (this.items !== 'null') {
                items = JSON.parse(this.items);
            }
            this.medication = items;
            if (this.old_unit !== "") {
                this.new_unit = this.old_unit;
            }
        },
        data: function () {
            return {
                medication: [],
                new_medicament: this.old_med,
                new_posologie: this.old_posologie,
                new_unit: 'mg/jour'
            }
        },
        methods: {
            addMedicament: function () {
                let med = this.new_medicament && this.new_medicament.trim()
                if (!med) {
                }
                else if (jQuery.grep(this.medication, function (n) {
                        return (n.nom === med);
                    }).length !== 0) {
                    alert('Cet élément a déjà été entré.');
                }
                else {
                    let med_string = med;
                    if (this.new_posologie !== '') {
                        med_string = med + ' - ' + this.new_posologie + ' ' + this.new_unit;
                    }

                    this.medication.push({
                        nom: med,
                        posologie: this.new_posologie,
                        unit: this.new_unit,
                        med_string: med_string
                    });
                    this.new_medicament = '';
                    this.new_posologie = '';
                    this.new_unit = 'mg/jour';
                }

            },
            deleteMedicament: function (medicament) {
                this.medication.splice(this.medication.indexOf(medicament), 1);
            },
        }
    }
</script>