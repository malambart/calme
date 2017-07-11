@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a>: note évolutive de la séance {{$no}}</h1>
@endsection
@section('body')
    <div id="app">
        <form role="form" method="POST" action="{{ url('notes/edit', $note->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <input type="hidden" name="no_seance" value="{{$no}}">
            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                <label for="date" class=" control-label">Date de la séance <span class="tip">(aaaa-mm-jj)</span></label>
                <input id="date" type="date" class="form-control datepicker" name="date"
                       value="{{ old('date', dateString($note->date)) }}"
                       required="required">
                @if ($errors->has('date'))
                    <span class="help-block"><strong>{{ $errors->first('date') }}</strong></span>
                @endif
            </div>
            <label>Personnes présentes</label>
            <div class="checkbox-list">
                <div class="checkbox">
                    <label><input type="checkbox" value="{{$dossier->prenom}}" name="presence[]"
                                  @if($note->presence)
                                  @if(in_array($dossier->prenom, old('presence', $note->presence)))
                                  checked
                                @endif
                                @endif
                        >{{$dossier->prenom}}</label>
                </div>
                @foreach($dossier->parents as $parent)
                    <div class="checkbox">
                        <label><input type="checkbox" value="{{$parent->prenom}}" name="presence[]"
                                      @if($note->presence)
                                      @if(in_array($parent->prenom, old('presence', $note->presence)))
                                      checked
                                    @endif
                                    @endif
                            >{{$parent->prenom." (".$parent->lien.")"}}</label>
                    </div>
                @endforeach
            </div>
            <exercises items="{{old('exercises', $note->exercises)}}"></exercises>
            <label for="">Évaluation du comportement du jeune pendant la séance</label>
            <div class="checkbox-list">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="Lever la main" name="comportement[]"
                               @if($note->comportement)
                                   @if(in_array("Lever la main", old('comportement', $note->comportement)))
                                       checked
                                    @endif
                                @endif
                        >
                        Lever la main
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="Demeurer assis" name="comportement[]"
                               @if($note->comportement)
                               @if(in_array("Demeurer assis", old('comportement', $note->comportement)))
                               checked
                                @endif
                                @endif
                        >
                        Demeurer assis
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="Être attentif" name="comportement[]"
                               @if($note->comportement)
                               @if(in_array("Être attentif", old('comportement', $note->comportement)))
                               checked
                                @endif
                                @endif
                        >
                        Être attentif
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="Collaboration" name="comportement[]"
                               @if($note->comportement)
                               @if(in_array("Collaboration", old('comportement', $note->comportement)))
                               checked
                                @endif
                                @endif
                        >
                        Collaboration
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="Écouter" name="comportement[]"
                               @if($note->comportement)
                               @if(in_array("Écouter", old('comportement', $note->comportement)))
                               checked
                                @endif
                                @endif
                        >
                        Écouter
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="Autre" name="comportement[]" v-model="autre"
                               @if($note->comportement)
                               @if(in_array("Autre", old('comportement', $note->comportement)))
                               checked
                                @endif
                                @endif
                        >
                        Autre
                    </label>
                </div>
                <input type="text" class="form-control small-input" v-show="autre" name="comportement_autre"
                       placeholder="Précisez autre" value="{{ old('comportement_autre', $note->comportement_autre)}}">
            </div>
            <h1>Contenu abordé durant la séance</h1>
            @foreach($contenus as $cat => $contenu)
                @if (count($contenu)>=1)
                    <div class="form-group">
                        <label>{{ $cat }}</label>
                        <div class="checkbox-list">
                            @foreach($contenu as $c)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="{{$c['id']}}" name="contenu[]"
                                               @if($note->contenu)
                                               @if(in_array($c['id'], old('contenu', $note->contenu)))
                                               checked
                                                @endif
                                                @endif
                                        >
                                        {{$c['label']}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

            <div class="form-group{{ $errors->has('commentaires') ? ' has-error' : '' }}">
                <label for="commentaires" class=" control-label">Commentaires</label>
                <textarea id="commentaires" class="form-control"
                          name="commentaires">{{ old('commentaires', $note->commentaires) }}</textarea>
                @if ($errors->has('commentaires'))
                    <span class="help-block">
            		    <strong>{{ $errors->first('commentaires') }}</strong>
            		</span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('prochaine_rencontre') ? ' has-error' : '' }}">
                <label for="prochaine_rencontre" class=" control-label">Date de la prochaine rencontre<span class="tip">(aaaa-mm-jj)</span></label>
                <input id="prochaine_rencontre" type="date" class="form-control datepicker" name="prochaine_rencontre"
                       value="{{ old('prochaine_rencontre', dateString($note->prochaine_rencontre)) }}">
                @if ($errors->has('prochaine_rencontre'))
                    <span class="help-block"><strong>{{ $errors->first('prochaine_rencontre') }}</strong></span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary pull-right">
                Sauvegarder
            </button>
        </form>
    </div>
@endsection



@section('script')
    <script>
        var vm = new Vue({
            el: '#app',
            created: function() {
                var comp = '{{ json_encode($note->comportement) }}';
               if (comp.indexOf('&quot;Autre&quot') >= 0) {
                   this.autre = 1;
               }
            },
            data: {
                autre:0
            },
        })
    </script>
@endsection


