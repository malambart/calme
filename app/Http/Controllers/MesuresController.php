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

class mesuresController extends Controller {
    public function create(Dossier $dossier)
    {
        if ($dossier->age < 8) {
            $this->build($dossier);
            return back();
        } else {
            $ecoles = Ecole::all();
            return view('mesures.create', compact('dossier', 'ecoles'));
        }

    }

    public function store(Dossier $dossier, Request $request)
    {
        $this->validate($request, [
            'ecole_id' => 'required',
            'prenom_ens' => 'required',
            'nom_ens' => 'required',
            'tel_ens' => 'required',
            'courriel_ens' => 'required|email',
        ]);
        $this->build($dossier, $request->all());
        return redirect('/dossiers/show', $dossier->id);
    }

    public function show(Mesure $mesure)
    {
        return view('mesures.show', compact('mesure'));
    }

    public function ajoutDate(Mesure $mesure)
        {
            return view('mesures/ajoutdate', compact('mesure'));
        }

    public function storeDate(Mesure $mesure, Request $request)
        {
            $this->validate($request,[
                'date'=>'required|date_format:Y-m-d|after:today'
                ]);
            $mesure->date=$request->date;
            $mesure->save();
            return redirect(url('dossiers/show',$mesure->dossier->id));
        }

    public function edit(Mesure $mesure)
        {
            return view('mesures/edit', compact('mesure'));
        }

    public function update(Mesure $mesure, Request $request)
            {
                $this->validate($request,[
                    'date'=>'required|date_format:Y-m-d|after:today'
                ]);
                $mesure->update($request->all());
                return view('mesures/show', compact('mesure'));
            }

}
