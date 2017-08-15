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

    public function show(Mesure $mesure)
    {
        $ete = $mesure->ete();
        // On vérifie si un enseignant existe
        $hasEN = false;
        if ($mesure->dossier->currentEnseignant()) {
            $hasEN=true;
        }
        return view('mesures.show', compact('mesure', 'hasEN', 'ete'));
    }


    public function edit(Mesure $mesure)
        {
            return view('mesures/edit', compact('mesure'));
        }

    public function update(Mesure $mesure, Request $request)
            {
                if ($mesure->temps==1) {
                    $tempsToCompare = 2;
                    $rule='before:';
                }
                elseif ($mesure->temps==2) {
                    $tempsToCompare = 1;
                    $rule='after:';
                }

                $date = Mesure::where('dossier_id', $mesure->dossier_id)->where('temps', $tempsToCompare)->first()->date;
                $this->validate($request,[
                    'date'=>'required|date_format:Y-m-d|after:today|'.$rule.$date
                ]);
                $mesure->update($request->all());
                return redirect(url('mesures/show', $mesure->id));
            }

}
