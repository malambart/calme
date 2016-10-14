<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Updater;
use App\ParentRep;
//use Illuminate\Support\Facades\Auth

class Dossier extends Model
{	
	use Updater;
	protected $fillable=['nom', 'prenom', 'nom_complet', 'no_doss_chus','date_naiss'];

	public function parents()
	{
	return $this->hasMany(ParentRep::class);
	}

	public function currentParent()
	{
		return $this->hasOne(ParentRep::class)->where('current', true);
	}

}
