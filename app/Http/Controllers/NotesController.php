<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier;
use App\ContenuSeance;

class NotesController extends Controller
{
    public function create(Dossier $dossier, $no)
    {
        $contenus=ContenuSeance::where('no_seance', $no)->get()->groupBy('categories')->toArray();
        return view('notes.create', compact('dossier', 'no', 'contenus'));
    }

    public function store(Dossier $dossier, Request $request)
    {
        dd($request->all());

    }
}
