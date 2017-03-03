<?php

namespace App\PlanInterventions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partenaire extends Model
{
    use SoftDeletes;
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
