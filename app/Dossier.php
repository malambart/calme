<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Updater;
//use Illuminate\Support\Facades\Auth

class Dossier extends Model
{	
	use Updater;
	protected $fillable=['nom', 'prenom', 'nom_complet', 'no_doss_chus','date_naiss'];

}
