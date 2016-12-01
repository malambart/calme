<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier;
use App\Ecole;
use App\Enseignant;
use Illuminate\Support\Facades\DB;

class EnseignantsController extends Controller
{
    public function create(Dossier $dossier)
    {
    	$ecoles=Ecole::all();   
    	return view('enseignants.create', compact('dossier', 'ecoles'));
    }
    public function store(Dossier $dossier, Request $request)
    {
    	//$this->validate($request, ['prenom'=>'required', 'nom'=>'required', 'ecole_id'=>'required']);
    	//On cherche si un enseignant du même nom existe déjà...
    	
    	$enseignant=Enseignant::where('nom', $request->nom)->where('prenom', $request->prenom)->first();
    	if ($enseignant) {
    		$request->session()->flash('enseignant_existe', '$enseignant->id');
    		return back()->withInput();
    	}	
    	else {
    		DB::table('dossier_enseignant')
            ->where('dossier_id', $dossier->id)
            ->update(['current' => false]);
    		$dossier->enseignants()->attach(Enseignant::create($request->all()));
    		return redirect('dossiers/'.$dossier->id.'/show');
    	}
    }
    public function show(Enseignant $enseignant, Dossier $dossier)
    {	
    	$ecole=$enseignant->ecole()->first();
    	return view('enseignants.show', compact('enseignant', 'ecole', 'dossier'));
    }
}
