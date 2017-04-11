<script type="text/javascript">
    var oldObjectifs = [];
    @if($plan->Objectifs != '')
        @foreach(json_decode($plan->Objectifs) as $objectif)
            oldObjectifs.push('{{$objectif}}');
    @endforeach
            @endif
        vm = new Vue({
        el: '#app',
        data: {
            retenu: '',
            objectifs: oldObjectifs,
            new_objectif: '{{old('new_diagnostic')}}',
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
            }
        }
    })
</script>