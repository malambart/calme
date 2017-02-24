<?php

namespace App\PlanInterventions;

use Illuminate\Database\Eloquent\Model;
use App\Updater;
use App\Dossier;

class Plan extends Model {
    use Updater;
    protected $fillable = [
        'famille',
        'modalite_garde',
        'responsable',
        'modalite_garde',
        'langue',
        'nb_enfants'
    ];

    public function dossier()
        {
            return $this->belongsTo(Dossier::class);
        }
}
