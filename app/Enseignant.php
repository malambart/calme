<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
	use Updater;
	use RecordsActivity;

	protected $fillable=['nom', 'prenom', 'ecole_id', 'courriel'];

    public function dossiers()
	{
		return $this->belongsToMany(Dossier::class)->withTimestamps();;
	}
	public function ecole()
	{
		return $this->belongsTo(Ecole::class);
	}

    public function adresse()
	{
        return $this->hasOne(AdresseProf::class);
	}
}
