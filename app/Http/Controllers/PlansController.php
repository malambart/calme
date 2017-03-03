<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier;
use App\PlanInterventions\Plan;
use App\PlanInterventions\Partenaire;

class PlansController extends Controller {

    public function edit($section, Dossier $dossier)
    {
        $plan = $dossier->getPlan();
        if (!$plan && $section == 1) {
            $plan = $dossier->plans()->create([]);
        }
        return view('plans/section' . $section, compact('dossier', 'plan', 'section'));
    }

    public function store($section, Plan $plan, Request $request)
    {
        $donnees = $request->all();
        $rules = [];
        if ($section == 2) {
            $rules = [
                'date_eval' => 'Date',
                'reference' => 'Date',
                'new_diagnostic' => 'in:""',
                'new_medicament' => 'in:""'
            ];
            if (isset($donnees['diagnostics'])) {
                $donnees['diagnostics'] = json_encode($donnees['diagnostics']);
            }
            if (isset($donnees['medication'])) {
                $donnees['medication'] = json_encode($donnees['medication']);
            }

        }
        $this->validate($request, $rules);
        if ($section == 4) {
            $stored = $plan->partenaires()->pluck('id')->toArray();
            $posted = [];

            if ($request->partenaires) {
                $posted = array_column($request->partenaires, 'id');
            }

            $todelete = array_diff($stored, $posted);

            // On supprime les partenaires
            if (!empty($todelete)) {
                foreach ($todelete as $d) {
                    Partenaire::find($d)->delete();
                }
            }

            if ($request->partenaires) {
                foreach ($request->partenaires as $partenaire) {
                    if ($partenaire['id'] == "") {
                        // J'evite de creer des objets vides
                        if (count(array_filter($partenaire))) {
                            $plan->partenaires()->create($partenaire);
                        }
                    } else {
                        Partenaire::find($partenaire['id'])->update($partenaire);
                    }
                }
            }

        }
        $plan->update($request->all());
        $section = ++$section;
        $dossier = $plan->dossier()->first();
        return redirect(url('plans', [$section, $dossier->id]));
    }
}
