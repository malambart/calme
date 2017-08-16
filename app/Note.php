<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use RecordsActivity, Labels;
    protected $fillable = [
        'no_seance',
        'date',
        'presence',
        'ponctualite',
        'ponctualite_motif',
        'comportement',
        'comportement_autre',
        'contenu',
        'commentaires',
        'prochaine_rencontre',
    ];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    protected $casts = [
        'presence' => 'array',
        'contenu' => 'array',
        'comportement' => 'array'
    ];

    public function exercises()
    {
        return $this->hasMany(Exercise::class);

    }

    protected $dates = [
        'date',
        'prochaine_rencontre'
    ];

    protected $labels =
        [
            'ponctualite' => [
                1 => 'À l\'heure',
                2 => 'En retard de plus de 5 minutes',
                3 => 'Ne se présente pas sans avis',
                4 => 'Annule plus de 24h à l\'avance',
                5 => 'Annule moins de 24h à l\'avance'
            ]
        ];
}
