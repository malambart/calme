<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentRep extends Model
{
	protected $table='parents';
    protected $fillable=['prenom', 'lien', 'lieuT1', 'courriel', 'tel', 'tel2'];
    
    public function current($query)	
    {
    	return $query->where('current', true);
    }
}
