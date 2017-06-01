<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier;
use App\Note;
use App\ContenuSeance;
use Illuminate\Validation\Rule;


class NotesController extends Controller
{
    public function create(Dossier $dossier, $no)
    {
        $contenus=ContenuSeance::where('no_seance', $no)->get()->groupBy('categories')->toArray();
        return view('notes.create', compact('dossier', 'no', 'contenus'));
    }

    public function store(Dossier $dossier, Request $request)
    {
        //dd($request->all());
        /*Validation pour éviter des note en double pour une seule séance*/
        $this->validate($request, [
           'no_seance' => Rule::unique('notes')->where(function ($query) use ($dossier) {
            $query->where('dossier_id', $dossier->id);
           })
        ]);
        $note=$dossier->notes()->create($request->except('exercices'));

        foreach ($request->exercises as $ex) {
            $note->exercises()->create($ex);
        }

        return redirect(url('dossiers/show', $dossier->id));
    }

    public function show(Note $note)
    {

        return view('notes.show', compact('note'));

    }
}
