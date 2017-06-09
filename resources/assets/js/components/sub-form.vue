<template>
    <div class="subform">
        <h1>{{titre}}</h1>
        <div v-for="item in list">
            <button class="btn btn-primary btn-sm pull-right" @click.prevent="deleteItem()">X</button>
            <subform-form :name="name+'['+item+']'" :id="item + 1">
            </subform-form>
        </div>

        <button class="btn btn-primary" @click.prevent="add()">{{button}}</button>
    </div>
</template>

<script>
    module.exports = {
        props: ['name', 'titre', 'tip', 'button', 'items'],
        data: function () {
            return {
                list: [0],
                nb: 0
            }
        },
        methods: {
            add: function () {
                this.nb=++this.nb;
                this.list.push(this.nb);
            },
            deleteItem: function (item) {
                this.list.splice(this.list.indexOf(item), 1);
                this.nb=this.nb-1;
            },
        }
    }
</script>