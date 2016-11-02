<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mesure;
class Token extends Model
{
    protected $fillable=['token', 'ls_id'];

    public function mesure()
    {
    	return $this->belongsTo(Mesure::class, 'lastname', 'id');
    }
    public function questionnaire()
    {
    	return $this->hasOne(Questionnaire::class, 'ls_id', 'ls_id');
    }
}
