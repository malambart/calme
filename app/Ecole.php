<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ecole extends Model
{
	use Updater;
	use RecordsActivity;
    protected $fillable=['nom', 'ville', 'telephone', 'fax'];
}
