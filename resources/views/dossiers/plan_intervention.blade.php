@if (!$dossier->plan)
    <a href="{{url('plans/1',$dossier->id)}}" class="btn btn-primary">Compléter le plan d'intervention</a>
@else
    <div class="rapport">
        <h1>Situation familiale</h1>
        <div class="ligne-rapport"><span>Situation familiale : </span>{{$plan->famille}}</div>
        <div class="ligne-rapport"><span>Nombre d'enfants : </span>{{$plan->nb_enfants}}</div>
        <div class="ligne-rapport"><span>Langue(s) parlée(s) à la maison : </span>{{$plan->langue}}</div>
        <hr>
        <h1>Évaluation pédopsychiatrique</h1>
        <div class="ligne-rapport"><span>Date de l'évaluation : </span>{{$plan->date_eval}}</div>
        <div class="ligne-rapport"><span>Pédopsychiatre : </span>{{$plan->pedopsy}}</div>
        <div class="ligne-rapport"><span>Troubles anxieux retenus :
        </span>{{strtolower(implode(', ', json_decode($plan->diagnostics)))}}
        </div>
        <div class="ligne-rapport"><span>Autres : </span>{{$plan->autres}}</div>
        <div class="ligne-rapport"><span>Médication :
        </span>
            <ul>
            @foreach((array_column(json_decode($plan->medication), 'med_string')) as $med)
                <li>
                    {{$med}}
                </li>
            @endforeach
            </ul>
        </div>
        <div class="ligne-rapport"><span>Date de la référence au module Calme : </span>{{$plan->reference}}</div>
        <div class="ligne-rapport"><span>Motifs : </span>{{$plan->motif}}</div>
        <hr>
        <h1>Antécédents</h1>
        <ul>
        @foreach($plan->antecedents as $antecedent)
            <li>
            <div class="ligne-rapport"><span> Description : </span>{{$antecedent->antecedent}}</div>
            <div class="ligne-rapport"><span>Personnel ou familial : </span>{{$antecedent->fam_perso}}</div>
            <div class="ligne-rapport"><span> Type : </span>{{$antecedent->type}}</div>
            @if($antecedent->type=='Module Calme')
                    <div class="ligne-rapport"><span> Motifs : </span>{{$antecedent->motifs}}</div>
            @endif
            </li>
        @endforeach
        </ul>
        <hr>
        <h1>Partenaires impliqués</h1>
        <ul>
            @foreach($plan->partenaires as $partenaire)
                <li>
                    <div class="ligne-rapport"><span> Partenaire : </span>{{$partenaire->partenaire}}</div>
                    <div class="ligne-rapport"><span>Partenaire passé ou actuel : </span>{{$partenaire->passe_actuel}}</div>
                    <div class="ligne-rapport"><span>Profession : </span>{{$partenaire->profession}}</div>
                    <div class="ligne-rapport"><span>Fréquence : </span>{{$partenaire->frequence}}</div>
                    <div class="ligne-rapport"><span>But : </span>{{$partenaire->but}}</div>
                    <div class="ligne-rapport"><span>Quand : </span>{{$partenaire->quand}}</div>
                    <div class="ligne-rapport"><span>Durée : </span>{{$partenaire->duree}}</div>
                </li>
            @endforeach
        </ul>
        <hr>
        <h1>Plan d'intervention scolaire</h1>
        <div class="ligne-rapport"><span>Plan d'intervention scolaire : </span>{{$plan->plan_intervention_acolaire}}</div>
        <div class="ligne-rapport"><span>Plan d'intervention lié à l'anxiété : </span>
        @if ($plan->lie_anxiete==1)
            Oui
        @elseif($plan->lie_anxiete==0)
            Non
        @endif
        </div>
        @if ($plan->lie_anxiete)
        <div class="ligne-rapport"><span>Expliquer : </span>{{$plan->lie_anxiete_d}}</div>
        @endif
        <hr>
        <h1>Évaluation module Calme</h1>
        <div class="ligne-rapport"><span>Facteur(s) prédisposant(s) : </span>{{$plan->facteurs_predisposants}}</div>
        <div class="ligne-rapport"><span>Facteur(s) précipitamt(s) : </span>{{$plan->facteurs_precipitants}}</div>
        <h2>Facteur(s) de maintien</h2>
        <ul>
            <li><span>Cognitions : </span>{{$plan->cognitions}}</li>
            <li><span>Sensations physiques : </span>{{$plan->sensations_psysiques}}</li>
            <li><span>Comportements : </span>{{$plan->comportements}}</li>
            <li><span>Rassurance : </span>{{$plan->rassurance}}</li>
            <li><span>Impacts fonctionnels : </span>
                <ul>
                    @if($plan->imp_maison)<li>Maison</li>@endif
                    @if($plan->imp_ecole)<li>École</li>@endif
                    @if($plan->imp_loisirs)<li>Loisirs</li>@endif
                    @if($plan->imp_reseau_social)<li>Réseau social</li>@endif
                </ul>
            </li>
        </ul>
        <hr>
        <h1>Attentes</h1>
        <div class="ligne-rapport"><span>Attentes du jeune : </span>{{$plan->attentes_jeune}}</div>
        <div class="ligne-rapport"><span>Attentes des parents : </span>{{$plan->attentes_parents}}</div>
        <hr>
        <h1>Impressions diagnostiques</h1>
        <ul>
            @foreach($plan->impressions as $imp)
                <li>
                    <div class="ligne-rapport"><span>Diagnostic : </span>{{$imp->diagnostic}}</div>
                    <div class="ligne-rapport"><span>Confirmé ADIS-C : </span>{{$imp->confirme}}</div>
                    <div class="ligne-rapport"><span>Score de sévérité : </span>{{$imp->score_severite}}</div>
                </li>
             @endforeach
        </ul>
        <div class="ligne-rapport"><span>Autre(s) : </span>{{$plan->impressions_autres}}</div>
        <hr>
        <h1>Recommendations concernant l'enfant</h1>
        <div class="ligne-rapport"><span>Retenu : </span>{{$plan->retenu}}</div>
        @if ($plan->retenu=="Retenu(e)")
            <div class="ligne-rapport"><span>Date de la première séance : </span>{{$dossier->mesures->where('temps', 1)->first()->date->toDateString()}}</div>
        @elseif ($plan->retenu=="Non retenu(e)")
            <div class="ligne-rapport"><span>Motifs : </span>{{$plan->non_retenu_motifs}}</div>
            <div class="ligne-rapport"><span>Redirigé : </span>{{$plan->non_retenu_redirige}}</div>
        @endif
        <div class="ligne-rapport"><span>Suivi : </span>{{$plan->suivi}}</div>
        <div class="ligne-rapport"><span>Type de suivi : </span>{{$plan->type_suivi}}</div>
        <div class="ligne-rapport"><span>Objectifs : </span>
            <ul>
                @foreach(json_decode($plan->objectifs) as $obj)
                    <li>{{$obj}}</li>
                @endforeach
            </ul>
        </div>
        <div class="ligne-rapport"><span>Traitement pharmacologique proposé : </span>
            @if($plan->traitement_pharmaco==1)
                Oui
            @elseif($plan->traitement_pharmaco==0)
                Non
            @endif
        </div>
        @if ($plan->traitement_pharmaco==1)
            <div class="ligne-rapport"><span>Médicaments : </span>
                <ul>
                    @foreach((array_column(json_decode($plan->pharmaco_liste), 'med_string')) as $med)
                        <li>
                            {{$med}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="ligne-rapport"><span>Recommendations concernant les parents ou la famille : </span>{{$plan->recommendations}}</div>
    </div>
    <a href="{{url('plans/1',$dossier->id)}}" class="btn btn-primary">Éditer le plan d'intervention</a>
@endif
