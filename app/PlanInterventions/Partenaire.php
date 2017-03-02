<?php

namespace App\PlanInterventions;

use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    protected $fillable=[
        'passe_actuel',
        'partenaire',
        'profession',
        'frequence',
        'but',
        'quand',
        'duree',
    ];
}
