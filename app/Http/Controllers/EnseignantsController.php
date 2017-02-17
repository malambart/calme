<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier;
use App\Ecole;
use App\Enseignant;
use Illuminate\Support\Facades\DB;

class EnseignantsController extends Controller {
    public function create(Dossier $dossier)
    {
        $ecoles = Ecole::all();
        return view('enseignants.create', compact('dossier', 'ecoles'));
    }

    private function clearCurrent(Dossier $dossier) {
        DB::table('dossier_enseignant')
            ->where('dossier_id', $dossier->id)
            ->update(['current' => false]);
    }

    public function store(Dossier $dossier, Request $request)
    {
        //$this->validate($request, ['prenom'=>'required', 'nom'=>'required', 'ecole_id'=>'required']);
        //On cherche si un enseignant du même nom existe déjà...
        $this->validate($request,['ecole_id'=>'required','prenom'=>'required','nom'=>'required']);
        //dd($request->all());
        $enseignant = Enseignant::where('nom', $request->nom)->where('prenom', $request->prenom)->where('ecole_id',$request->ecole_id)->first();
        if ($enseignant) {
            if (!$request->confirmAssociate && !$request->confirmCreate) {
                $request->session()->flash('enseignant_existe', $enseignant);
                return back()->withInput();
            }
            if ($request->confirmAssociate==1){
                $enseignant=Enseignant::findOrFail($request->prof_id);
                $this->clearCurrent($dossier);
                $dossier->enseignants()->attach($enseignant);
            }
            if ($request->confirmCreate==1){
                $this->clearCurrent($dossier);
                $dossier->enseignants()->attach(Enseignant::create($request->all()));
            }
        } else {
            $this->clearCurrent($dossier);
            $dossier->enseignants()->attach(Enseignant::create($request->all()));

        }
        return redirect(url('dossiers/show', $dossier->id));
    }

    public function show(Enseignant $enseignant, Dossier $dossier)
    {
        $ecole = $enseignant->ecole()->first();
        return view('enseignants.show', compact('enseignant', 'ecole', 'dossier'));
    }
}
