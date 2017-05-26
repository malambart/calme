<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Updater;

class Ecole extends Model
{
	use Updater;
    protected $fillable=['nom', 'ville', 'telephone', 'fax'];
}
