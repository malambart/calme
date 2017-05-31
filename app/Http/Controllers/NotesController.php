<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier;
use App\ContenuSeance;

class NotesController extends Controller
{
    public function create(Dossier $dossier, $no)
    {
        $enf=ContenuSeance::where('no_seance', $no)->where('categories', 'obj_enfants')->get();
        $par=ContenuSeance::where('no_seance', $no)->where('categories', 'obj_parents')->get();
        $integration=ContenuSeance::where('no_seance', $no)->where('categories', 'act_integration')->get();
        $exercices=ContenuSeance::where('no_seance', $no)->where('categories', 'exercises_maison')->get();

        return view('notes.create', compact('dossier', 'no', 'enf', 'par', 'integration', 'exercices'));
    }

    public function store(Dossier $dossier, Request $request)
    {
        dd($request->all());

    }
}
