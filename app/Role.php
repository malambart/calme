<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Updater;

class Role extends Model
{
	use Updater;
    public function users()
    {
    	return $this->belongsToMany(User::class);
    }
}
