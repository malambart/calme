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
