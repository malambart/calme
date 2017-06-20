<?php

namespace App\Http\Controllers;

use App\Exercise;
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
        /*Validation pour éviter des note en double pour une seule séance*/
        $this->validate($request, [
           'no_seance' => Rule::unique('notes')->where(function ($query) use ($dossier) {
            $query->where('dossier_id', $dossier->id);
           })
        ]);
        $note=$dossier->notes()->create($request->except('exercises'));

        foreach ($request->exercises as $ex) {
            if (non_empty_array($ex, 1)) {
                $note->exercises()->create($ex);
            }

        }

        return redirect(url('notes/show', $note->id));
    }

    public function show(Note $note)
    {

        return view('notes.show', compact('note'));

    }

    public function edit(Note $note)
    {
        $dossier=$note->dossier()->first();
        $no=$note->no_seance;
        $contenus=ContenuSeance::where('no_seance', $no)->get()->groupBy('categories')->toArray();
        return view('notes.edit', compact('note', 'dossier', 'contenus', 'no'));

    }

    public function update(Note $note, Request $request)
    {
        //dd($request->all());
        $note->update($request->except('no_seance', 'exercises'));

        if (isset($request->exercises)) {
            foreach ($request->exercises as $ex) {
                if($ex['id']) {
                    $exercise = Exercise::find($ex['id']);
                    if($ex['toDelete']) {
                        $exercise->delete();
                    }
                    else {
                        $exercise->update($ex);
                    }

                }
                else {
                    if (non_empty_array($ex, 1)) {
                        $note->exercises()->create($ex);
                    }
                }
            }
        }

        return redirect(url('notes/show', $note->id));

    }
}
