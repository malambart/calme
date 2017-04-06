<script type="text/javascript">
    var stored = [];
    @foreach($plan->impressions as $impression)
        stored.push({
        num: null,
        id: '{{$impression->id}}',
        diagnostic: '{{$impression->diagnostic}}',
        confirme: '{{$impression->confirme}}',
        score_severite: '{{$impression->score_severite}}',
    });
    @endforeach
    if (stored.length == 0) {
        stored = [{
            num: 1,
            id: null,
            diagnostic: '',
            confirme: '',
            score_severite: '',
        }];
    }
    vm = new Vue({
        el: '#app',
        data: {
            impressions: stored,
            toDelete:'',
            num:1,
        },
        computed: {
            nombre: function () {
                return this.impressions.length;
            }
        },
        methods: {
            ajoutimpression: function () {
                ++this.num
                this.impressions.push({
                    num: this.num,
                    id: null,
                    diagnostic: '',
                    confirme: '',
                    score_severite: '',
                });
            },
            deleteimpression: function () {
                if (this.toDelete.id) {
                    $.get('{{url('impressions/delete')}}/' + this.toDelete.id);
                }
                this.impressions.splice(this.impressions.indexOf(this.toDelete.impression), 1);
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