<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesure extends Model
{
	use Updater;
	protected $fillable=['temps','date'];
	public function questionnaires()
	{
		return $this->hasMany(Questionnaire::class, 'temps', 'temps');
	}

	protected $dates=['date'];

	public function dossier()
	{
		return $this->belongsTo(Dossier::class);
	}
	public function tokens()
	{
		return $this->hasMany(Token::class);
	}

	public function qCompleted()
	{
		$count=0;
		$questionnaires=$this->tokens()->get();
		if ($this->dossier->exclu) {
			$deno=$questionnaires->where('rep', 'JE')->count();
		}
		else {
			$deno=$questionnaires->count();
			// Pour les jeunes agés de moins de 8 ans au T1, le questionanire jeune n'est pas administré.
            if ($this->age<8) {
                $deno=$deno-1;
            }
		}
		foreach($questionnaires as $q)
			if ($q->isCompleted()!='N') {
				$count=$count+1;
			}
		$result=['deno'=>$deno, 'complet'=>$count];
		return $result;
	}
	public function getTokens()
	{
		if ($this->dossier->exclu) {
			$tokens=$this->tokens()->where('rep', 'JE')->get();
		}
		else {
			$tokens=$this->tokens()->get();
		}
		return $tokens;
	}
    public function getAgeAttribute()
    {
        $naiss=$this->dossier->date_naiss;
        $date=$this->date;
        return round(($date->diff($naiss)->format('%a'))/365.25, 1);
    }
}
