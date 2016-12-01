<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Updater;
use App\Dossier;

class Enseignant extends Model
{
	use Updater;
	protected $fillable=['nom', 'prenom', 'ecole_id'];
    public function Dossiers()
	{
		return $this->belongsToMany(Dossier::class)->withTimestamps();;
	}
	public function ecole()
	{
		return $this->belongsTo(Ecole::class);
	}
}
