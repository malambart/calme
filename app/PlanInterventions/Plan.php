<?php

namespace App\PlanInterventions;

use App\RecordsActivity;
use Illuminate\Database\Eloquent\Model;
use App\Updater;
use App\Dossier;



class Plan extends Model {
    use Updater;
    Use RecordsActivity;
    protected $fillable = [
        'famille',
        'modalite_garde',
        'responsable',
        'langue',
        'nb_enfants',
        'date_eval',
        'pedopsy',
        'diagnostics',
        'anxiete',
        'autres',
        'medication',
        'reference',
        'motif',
        'ante_bilan',
        'ante_bilan_date',
        'ante_bilan_resultat',
        'plan_intervention_scolaire',
        'lie_anxiete',
        'lie_anxiete_d',
        'facteurs_predisposants',
        'facteurs_precipitants',
        'cognitions',
        'sensations_physiques',
        'comportements',
        'rassurance',
        'imp_maison',
        'imp_ecole',
        'imp_loisirs',
        'imp_reseau_social',
        'impacts_d',
        'attentes_jeune',
        'attentes_parents',
        'impressions_autres',
        'retenu',
        'non_retenu_motifs',
        'non_retenu_redirige',
        'suivi',
        'type_suivi',
        'suivi_duree',
        'suivi_frequence',
        'recommendations',
        'objectifs',
        'traitement_pharmaco',
        'pharmaco_liste'
    ];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function antecedents()
    {
        return $this->hasMany(Antecedent::class);
    }

    public function partenaires()
    {
        return $this->hasMany(Partenaire::class);
    }

    public function impressions()
        {
            return $this->hasMany(Impression::class);
        }

    public static function sanitize($request)
    {
        $numeric = [
            'nb_enfants',
            'date_eval',
            'reference',
            'ante_med',
            'ante_bilan',
            'antefam_med',
            'antefam_psy',
            'ante_bilan_date',
            'plan_intervention_scolaire',
            'lie_anxiete',
            'traitement_pharmaco'
        ];
        foreach ($request as $element => $value) {
            if (in_array($element, $numeric) && $value == "")
                $request[$element] = null;
        }
        return $request;
    }


}
