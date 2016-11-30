<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Updater;

class Parentrep extends Model
{
	use Updater;
	protected $table='parents';
    protected $fillable=['prenom', 'nom', 'lien', 'lieuT1', 'courriel', 'tel', 'tel2'];

    public function dossier()
    {
    	return $this->belongsTo(dossier::class);
    }
    
    public function current($query)	
    {
    	return $query->where('current', true);
    }
}
