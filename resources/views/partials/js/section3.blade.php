<script type="text/javascript">
    var stored = [];
    @foreach($plan->antecedents as $antecedent)
        stored.push({
        num: null,
        id: '{{$antecedent->id}}',
        antecedent:'{{$antecedent->antecedent}}',
        fam_perso: '{{$antecedent->fam_perso}}',
        type: '{{$antecedent->type}}',
        motifs: '{{$antecedent->motifs}}',
    });
    @endforeach
    if (stored.length == 0) {
        stored = [{
            num: 1,
            id: null,
            antecedent:'',
            fam_perso: '',
            type: '',
            motifs: '',
        }];
    }
    vm = new Vue({
        el: '#app',
        data: {
            ante_bilan: '{{$plan->ante_bilan}}',
            antecedents: stored,
            toDelete:'',
            num:1,
        },
        computed: {
            nombre: function () {
                return this.antecedents.length;
            }
        },
        methods: {
            ajoutantecedent: function () {
                ++this.num
                this.antecedents.push({
                    num: this.num,
                    id: null,
                    antecedent:'',
                    fam_perso: '',
                    type: '',
                    motifs: '',
                });
            },
            deleteantecedent: function () {
                if (this.toDelete.id) {
                    $.get('{{url('antecedents/delete')}}/' + this.toDelete.id);
                }
                this.antecedents.splice(this.antecedents.indexOf(this.toDelete.antecedent), 1);
                $('#confirm-delete').modal('hide');
                this.toDelete = null;
            },
            pToDelete: function(num) {
                this.toDelete = num;
                $('#confirm-delete').modal('show');
            },
            cancelDelete: function(){
                this.toDelete = null;
            }
        },
    })
</script>