<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Dossier;
use App\Ecole;
use Carbon\Carbon;

use App\Http\Requests;

class mesuresController extends Controller
{
    public function create(Dossier $dossier)
    {
    	$ecoles=Ecole::all();	
    	return view('mesures.create', compact('dossier', 'ecoles'));
    }
    public function store(Dossier $dossier, Request $request)
    {
    	$this->validate($request, [
    		'ecole_id'=>'required', 
    		'prenom_ens'=>'required', 
    		'nom_ens'=>'required', 
    		'tel_ens'=>'required', 
    		'courriel_ens'=>'required|email',  
    		]);
    	$data=$request->all();    	
    	$data['parent_id']=$dossier->currentParent()->first()->id;
    	$lastmesure=$dossier->mesures->last();
    	if($lastmesure){
    		$data['temps']=$lastmesure->temps+1;
    	}
    	else {
    		$data['temps']=1;	
    	}
    	$mesure=$dossier->mesures()->create($data);
    	//On fetch les questionnaires associés
    	$questionnaires=$mesure->questionnaires()->get();
    	// On calcule l'âge du jeune
    	$naiss=new Carbon($dossier->date_naiss);
    	$age=$naiss->diff(Carbon::today())->y;
    	foreach($questionnaires as $q) {
    		if ((($q->rep=='JE' | $q->rep=='EN') && $age>=8) | $q->rep=='PA')  {
    			$table='lime_tokens_'.$q->ls_id;
    			$token=$dossier->id.str_random(16);
    			DB::connection('ls')->insert('insert into '.$table.' (lastname, token) values (?, ?)', [$dossier->id, $token]);
    		}
    		
    		
    	}

    	dd($mesure);
    }

}
