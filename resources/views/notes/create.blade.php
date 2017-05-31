@extends('layouts.row')
@section('panel-heading')
    <h1><a href="{{$dossier->baseUrl()}}">Dossier {{$dossier->id}}</a>: note évolutive de la séance {{$no}}</h1>
@endsection
@section('body')
    <div id="app">
        <form role="form" method="POST" action="{{ url('notes/create', $dossier->id) }}">
            {{ csrf_field() }}
            <input type="hidden" name="no_seance" value="{{$no}}">
            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                <label for="date" class=" control-label">Date de la séance <span class="tip">(aaaa-mm-jj)</span></label>
                <input id="date" type="date" class="form-control datepicker" name="date" value="{{ old('date') }}"
                       required="required">
                @if ($errors->has('date'))
                    <span class="help-block"><strong>{{ $errors->first('date') }}</strong></span>
                @endif
            </div>
            <label>Personnes présentes</label>
            <div class="checkbox-list">
                <div class="checkbox">
                    <label><input type="checkbox" value="1" name="presence[{{$dossier->prenom}}]"
                                  @if(old("presence[{{$dossier->prenom}}]")==1))
                                  checked
                                @endif
                        >{{$dossier->prenom}}</label>
                </div>
                @foreach($dossier->parents as $parent)

                    <div class="checkbox">
                        <label><input type="checkbox" value="1" name="presence[{{$parent->prenom}}]"
                                      @if(old("presence[{{$parent->prenom}}]")==1))
                                      checked
                                    @endif
                            >{{$parent->prenom." (".$parent->lien.")"}}</label>
                    </div>
                @endforeach
            </div>
            <sub-form titre="Retour sur l'exercise fait à la maison" button="Ajouter un exercice" name="exercises"></sub-form>
            <label for="">Évaluation du comportement du jeune pendant la séance</label>
            <div class="checkbox-list">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="Lever la main" name="comportement[0]">
                        Lever la main
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="Demeurer assis" name="comportement[0]">
                        Demeurer assis
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="Être attentif" name="comportement[0]">
                        Être attentif
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="Collaboration" name="comportement[0]">
                        Collaboration
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="Écouter" name="comportement[0]">
                        Écouter
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="Autre" name="comportement[0]" v-model="autre">
                        Autre
                    </label>
                </div>
                <input type="text" class="form-control small-input" v-show="autre" name="comportement_autre" placeholder="Précisez autre">
            </div>
            <h1>Contenu abordé durant la séance</h1>
            <div class="form-group">
                <label>Objectifs enfants</label>
                <div class="checkbox-list">
                    @foreach($enf as $e)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="{{$e->id}}" name="contenus[]">
                                {{$e->label}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
           <div class="form-group">
               <label>Objectifs parents</label>
               <div class="checkbox-list">
                   @foreach($par as $p)
                       <div class="checkbox">
                           <label>
                               <input type="checkbox" value="{{$p->id}}" name="contenus[]">
                               {{$p->label}}
                           </label>
                       </div>
                   @endforeach
               </div>
           </div>
            <div class="form-group">
                <label>Activité(s) d'intégration</label>
                <div class="checkbox-list">
                    @foreach($integration as $int)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="{{$int->id}}" name="contenus[]">
                                {{$int->label}}
                            </label>
                        </div>
                    @endforeach
                </div>
           </div>
            @if($exercices->count()>=1)
            <div class="form-group">
                <label>Exercises à faire à la maison</label>
                <div class="checkbox-list">
                    @foreach($exercices as $exc)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="{{$exc->id}}" name="contenus[]">
                                {{$exc->label}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
            <button type="submit" class="btn btn-primary pull-right">
                Sauvegarder
            </button>
        </form>
    </div>
@endsection



@section('script')
    <script type="text/x-template" id="form">
        <div>
            <div class="form-group">
                <label :for="name+'[nom]'" class=" control-label">Nom de l'exercise @{{ id }}</label>
                <input id="name" type="text" class="form-control" :name="name+'[nom]'">
            </div>
            <div class="form-group">
                <label :for="name+'[cote]'" class=" control-label">Cote</label>
                <input id="name" type="number" class="form-control" :name="name+'[cote]'" min="1" max="5">
            </div>
            <div class="form-group">
                <label :for="name+'[frequence]'" class=" control-label">Fréquence</label>
                <input id="name" type="text" class="form-control" :name="name+'[frequence]'">
            </div>
            <div class="form-group">
                <label :for="name+'[commentaires]'" class=" control-label">Commentaires</label>
                <textarea :name="name+'[commentaires]'" id="" class="form-control" rows="4"></textarea>
            </div>

            <hr>
        </div>

    </script>



    <script>
        Vue.component('subform-form', {
            template:'#form',
            props: ['name', 'id']
        })
        vm = new Vue({
            el: '#app',
            data: {
                autre:""
            }

        })
    </script>
@endsection


