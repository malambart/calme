<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Updater;
use App\ParentRep;
use Carbon\Carbon;
use Sofa\Eloquence\Eloquence;
//use Illuminate\Support\Facades\Auth

class Dossier extends Model
{	
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
		return $this->hasOne(ParentRep::class)->where('current', true);
	}
	public function mesures()
	{
		return $this->hasMany(Mesure::class);
	}
	protected $dates=['date_naiss'];
	public function getAgeAttribute()	
	{
		$naiss=$this->date_naiss;
		$auj=Carbon::today();
		return round(($auj->diff($naiss)->format('%a'))/365.25, 1);
	}

}
