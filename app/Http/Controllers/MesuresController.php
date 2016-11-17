<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Dossier;
use App\Ecole;
use Carbon\Carbon;
use App\Mesure;
use App\Token;

use App\Http\Requests;

class mesuresController extends Controller
{
  public function create(Dossier $dossier)
  {
    if ($dossier->age<8) {
      $this->build($dossier);
      return back();
    }
    else {
      $ecoles=Ecole::all();   
      return view('mesures.create', compact('dossier', 'ecoles'));
    }

  }

  public function build(Dossier $dossier, $data=array())
  {
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

    foreach($questionnaires as $q) {
      if ((($q->rep=='JE' | $q->rep=='EN') && $dossier->age>=8) | $q->rep=='PA')  {
        $table=env('LS_PREFIX').'tokens_'.$q->ls_id;
        $token=$mesure->id.$q->ls_id.str_random(12);
        DB::connection('ls')->insert('insert into '.$table.' (lastname, token) values (?, ?)', [$mesure->id, $token]);
        $mesure->tokens()->create(['token'=>$token, 'ls_id'=>$q->ls_id]);
      }
    }   
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
   $this->build($dossier, $request->all()); 
   return redirect('/dossiers/'.$dossier->id.'/show');   	
 }

 public function show(Mesure $mesure) 
 {  
  return view('mesures.show', compact('mesure'));
}

}
