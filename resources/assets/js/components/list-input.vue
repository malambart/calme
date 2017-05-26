<template>
    <div>
        <div class="form-group">
            <label v-bind:for="name" class="control-label">{{titre}}</label>
            <input v-bind:id="name" type="text" class="form-control" v-bind:name="name" v-model="new_input" v-bind:placeholder='tip'
                   @keydown.enter.prevent="add">
        </div>
        <ul class="list-group">
            <li v-for="item in list" class="list-group-item">
                {{ item }}

                <button @click="deleteItem(item)" type="button" class="btn btn-danger btn-xs pull-right"
                >X
                </button>
            </li>
        </ul>
        <input v-for="item in list"
               type="hidden"
               v-bind:value="item"
               v-bind:name="name+'['+list.indexOf(item)+']'">
    </div>
</template>

<script>
    module.exports = {
        props: ['name', 'titre', 'tip'],
        data: function () {
            return {
                list: [],
                new_input: ''
            }
        },
        methods: {
            add: function () {
                var value = this.new_input && this.new_input.trim()

                if (!value) {
                    return;
                }
                else if (jQuery.inArray(value, this.list) != -1) {
                    alert('Cet élément a déjà été entré.');
                }
                else {
                    this.list.push(value)
                    this.new_input = ''
                }

            },
            deleteItem: function (item) {
                this.list.splice(this.list.indexOf(item), 1);
            },
        }
    }
</script>