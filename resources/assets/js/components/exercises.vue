<template>
    <div class="subform">
        <h1>Retour sur les exercises fait à la maison</h1>
        <div v-for="item in list" class="subform-item">
            <div v-show="item.toDelete == 0" class="well">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-sm pull-right subform-button btn-danger" @click.prevent="deleteItem(item)">X</button>
                    </div>
                </div>
                <div class="form-group">
                        <label :for="'exercises['+item.index+'][nom]'" class=" control-label">Nom de l'exercise</label>
                    <input id="'exercises['+item.index+'][nom]'" type="text" class="form-control" :name="'exercises['+item.index+'][nom]'" :value="item.nom">
                </div>
                <div class="form-group">
                    <label :for="'exercises['+item.index+'][cote]'" class=" control-label">Cote</label>
                    <input :value="item.cote" :id="'exercises['+item.index+'][cote]'" type="number" class="form-control" :name="'exercises['+item.index+'][cote]'" min="1" max="5">
                </div>
                <div class="form-group">
                    <label :for="'exercises['+item.index+'][frequence]'" class=" control-label">Fréquence</label>
                    <input :value="item.frequence" :id="'exercises['+item.index+'][frequence]'" type="text" class="form-control" :name="'exercises['+item.index+'][frequence]'">
                </div>
                <div class="form-group">
                    <label :for="'exercises['+item.index+'][commentaires]'" class=" control-label">Commentaires</label>
                    <textarea :value="item.commentaires" :name="'exercises['+item.index+'][commentaires]'" :id="'exercises['+item.index+'][commentaires]'" class="form-control" rows="4"></textarea>
                </div>
                <input type="hidden" :value="item.id" :name="'exercises['+item.index+'][id]'">
                <input type="hidden" :value="item.toDelete" :name="'exercises['+item.index+'][toDelete]'">
            </div>

        </div>

        <button class="btn btn-primary" @click.prevent="add()">Ajouter un exercise</button>
    </div>
</template>

<script>
    module.exports = {
        props: ['items'],
        created: function() {
            var brut = [{
                index:0,
                toDelete:0
            }];
            if(this.items) {
                var brut=JSON.parse(this.items);
                var index;
                for (index = 0; index < brut.length; ++index) {
                    brut[index].index=index;
                    brut[index].toDelete = 0;
                }
            }
          this.list = brut;
        },
        data: function () {
            return {
                list:[]
            }
        },
        methods: {
            add: function () {
                this.list.push({
                    index:this.list.length,
                    toDelete:0,
                    id:null
                });
            },
            deleteItem: function (item) {
                if(item.id) {
                    this.list[item.index].toDelete = 1;
                }
                else {
                    console.log(item);
                    this.list.splice(this.list.indexOf(item), 1);
                }
            },
        }
    }
</script>