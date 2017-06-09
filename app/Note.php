<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use RecordsActivity;
    protected $fillable=[
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

    protected $casts=[
        'presence' => 'array',
        'contenu' => 'array',
        'comportement' => 'array'
    ];

    public function exercises()
    {
        return $this->hasMany(Exercise::class);

    }
}
