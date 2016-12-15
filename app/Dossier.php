<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Updater;
use App\ParentRep;
use App\Enseignant;
use Carbon\Carbon;
use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dossier extends Model
{
    use SoftDeletes;
	use Updater;
	use Eloquence;
	protected $searchableColumns = ['id'=>30, 'nom'=>20, 'prenom'=>10];
	protected $fillable=['nom', 'prenom', 'nom_complet', 'no_doss_chus','date_naiss', 'premiere_seance', 'bilan_final', 'sexe', 'exclu'];

	public function parents()
	{
	return $this->hasMany(ParentRep::class);
	}

	public function currentParent()
	{
		return $this->parents()->where('current', true)->first();
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
	protected $dates=['date_naiss', 'premiere_seance'];
	public function getAgeAttribute()	
	{
		$naiss=$this->date_naiss;
		$auj=Carbon::today();
		return round(($auj->diff($naiss)->format('%a'))/365.25, 1);
	}
	public function getCurrentMesure()
	{
		return $this->mesures()->orderBy('temps', 'desc')->first();
	}

}
