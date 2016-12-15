<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Updater;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentRep extends Model
{
	use Updater;
	use SoftDeletes;
	protected $table='parents';
    protected $fillable=['prenom', 'nom', 'lien', 'lien_autre', 'lieuT1', 'courriel', 'tel', 'tel2','ext','ext2'];

    public function dossier()
    {
    	return $this->belongsTo(Dossier::class);
    }
    
    public function current($query)	
    {
    	return $query->where('current', true);
    }
    public function getLien()
    {
    	if ($this->lien=="autre") {
    		$lien=$this->lien_autre;
    	}
    	else {
    		$lien=$this->lien;
    	}
    	return $lien;
    }
}
