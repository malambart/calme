<?php

namespace App\PlanInterventions;

use Illuminate\Database\Eloquent\Model;

class Antecedent extends Model
{
    protected $fillable=['antecedent', 'fam_perso', 'type', 'motifs'];
}
