<?php

namespace App\Http\Controllers;
use Gate;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Dossier;
use App\User;

use Illuminate\Support\Facades\Auth;



class DossiersController extends Controller
{   
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show(Dossier $dossier)
    {	
    	//$dossier=Dossier::findOrFail($id);
    	$this->authorize('show', $dossier);
    	return $dossier->nom;
    }

    public function create()
    {
    return view('dossiers.create');
    }

    public function store(Request $request)
    {
    $this->validate($request, [
        'nom'=>'required', 
        'prenom'=>'required', 
        'no_doss_chus'=>'required', 
        'date_naiss'=>'required|date', 
        ]);
     $data=$request->all();
     $data['nom_complet']=$request->prenom.' '.$request->nom;
     $dossier=Dossier::create($data);

     return($dossier);
    }
}
