<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Token;
use App\Updater;

class Mesure extends Model
{
	use Updater;
	protected $fillable=['prenom_ens', 'nom_ens', 'ecole_id', 'parent_id', 'courriel_ens', 'fax_ens', 'tel_ens', 'temps'];
	public function questionnaires()
	{
		return $this->hasMany(Questionnaire::class, 'temps', 'temps');
	}

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
}
