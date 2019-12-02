<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PlanInterventions\Plan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dossier extends Model {
    use RecordsActivity;
    use SoftDeletes;
    use Updater;
    protected $searchableColumns = ['id' => 30, 'nom' => 20, 'prenom' => 10];
    protected $fillable =
        [
            'nom',
            'prenom',
            'nom_complet',
            'no_doss_chus',
            'date_naiss',
            'sexe',
            'exclu',
            'confirmation_received',
            'accepte',
            'langue',
            'diagnostic',
            'age'
        ];

    public function plan()
    {
        return $this->hasOne(Plan::class);
    }

    public function getPlan()
        {
            $plan=$this->plan()->first();
            return $plan;
        }

    public function parents()
    {
        return $this->hasMany(ParentRep::class);
    }

    public function hasRepondant()
    {
        return $this->parents()->where('repondant', true)->first();
    }

    public function Enseignants()
    {
        return $this->belongsToMany(Enseignant::class)->withTimestamps();
    }

    public function currentEnseignant()
    {
        return $this->enseignants()->wherePivot('current', true)->first();
    }

    public function mesures()
    {
        return $this->hasMany(Mesure::class);
    }

    protected $dates = ['date_naiss'];

    public function getCumputedAgeAttribute()
    {
        $naiss = $this->date_naiss;
        $auj = Carbon::today();
        return round(($auj->diff($naiss)->format('%a')) / 365.25, 1);
    }

    public function getCurrentMesure()
    {
        return $this->mesures()->orderBy('temps', 'desc')->first();
    }

    public function baseUrl()
    {
        return url('dossiers/show', $this->id);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function journals() {
        return $this->hasMany(Journal::class);
    }

    public function getAge()
    {
        if($this->accepte == 1) {
            return $this->CumputedAge;
        } else {
            return $this->age;
        }
    }

}
