<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mesure;
use App\Questionaire;
use Illuminate\Support\Facades\DB;
use App\Updater;
class Token extends Model
{
	use Updater;
	protected $fillable=['token', 'ls_id', 'rep'];

	public function mesure()
	{
		return $this->belongsTo(Mesure::class);
	}
	public function questionnaire()
	{
		return $this->hasOne(Questionnaire::class, 'ls_id', 'ls_id');
	}
	public function isCompleted()
	{
		$table=env('LS_PREFIX').'tokens_'.$this->ls_id;
		$state=DB::connection('ls')->select(DB::raw("
			SELECT completed 
			FROM $table
			WHERE token='$this->token';
			"));
		return $state[0]->completed;
	}
}
