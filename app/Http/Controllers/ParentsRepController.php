<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Dossier;
use App\ParentRep;

class ParentsRepController extends Controller {
    public function create(Dossier $dossier)
    {
        return view('parents.create', compact('dossier'));
    }

    public function store(Dossier $dossier, Request $request)
    {
        $rules = [
            'lien' => 'required',
        ];
        if ($request->repondant == 1) {
            $rules['lieuT1'] = 'required';
            $rules['tel'] = 'required';
            if ($request->lieuT1 == "maison") {
                $rules['courriel'] = 'required';
            }
        }
        if ($request->lien == "autre") {
            $rules['lien_autre'] = 'required';
        }

        $this->validate($request, $rules);
        $data = $request->all();

        $parent = $dossier->parents()->create($data);

        return redirect(url('dossiers/show',$dossier->id));


    }

    public function show(ParentRep $parent)
    {
        return view('parents.show', compact('parent'));
    }

    public function edit(ParentRep $parent)
    {
        $dossier=$parent->dossier()->first();
        return view('parents.edit', compact('parent', 'dossier'));
    }

    public function update(ParentRep $parent, Request $request)
    {
        $parent->update($request->all());
        return redirect(url('parents/show', $parent->id));
    }

    public function delete(ParentRep $parent)
        {
            $dossier=$parent->dossier;
            $parent->delete();
            return redirect(url('dossiers/show',$dossier->id));
        }


}
