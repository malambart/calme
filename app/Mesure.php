<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesure extends Model
{
    protected $fillable=['prenom_ens', 'nom_ens', 'ecole_id', 'parent_id', 'courriel_ens', 'fax_ens', 'tel_ens', 'temps'];
    public function questionnaires()
    {
    	return $this->hasMany(Questionnaire::class, 'temps', 'temps');
    }
}
