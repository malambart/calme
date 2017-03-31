<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier;
use App\PlanInterventions\Plan;
use App\PlanInterventions\Partenaire;
use App\PlanInterventions\Impression;

class PlansController extends Controller {

    public function edit($section, Dossier $dossier)
    {
        $plan = $dossier->getPlan();
        if (!$plan && $section == 1) {
            $plan = $dossier->plans()->create([]);
        }
        if ($section==9) {
            $premiere_seance=$dossier->mesures()->where('temps','1')->first();
            return view('plans/section' . $section, compact('dossier', 'plan', 'section', 'premiere_seance'));
        }
        else {
            return view('plans/section' . $section, compact('dossier', 'plan', 'section'));
        }

    }

    public function store($section, Plan $plan, Request $request)
    {
        $donnees = $request->all();
        //dd($donnees);
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
        if ($section == 8 ){
            $rules=[
                'impressions.*.score_severite'=> 'numeric|min:0|max:100'
            ];
        }

        $this->validate($request, $rules);
        if ($section == 4) {
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

        if ($section == 8) {
            if ($request->impressions) {
                foreach ($request->impressions as $impression) {
                    if ($impression['id'] == "") {
                        // J'evite de creer des objets vides
                        if($impression['score_severite']==="") {
                            $impression['score_severite']=null;
                        }
                        if($impression['confirme']==="") {
                            $impression['confirme']=null;
                        }
                        if (count(array_filter($impression))) {
                            $plan->impressions()->create($impression);
                        }
                    } else {
                        Impression::find($impression['id'])->update($impression);
                    }
                }
            }
        }


        $plan->update(Plan::sanitize($donnees));
        $section = ++$section;
        $dossier = $plan->dossier()->first();
        return redirect(url('plans', [$section, $dossier->id]));
    }

    public function PartenaireDelete(Partenaire $partenaire)
    {
        if ($partenaire->delete()) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function ImpressionDelete(Impression $impression)
    {
        if ($impression->delete()) {
            return 'true';
        } else {
            return 'false';
        }
    }


}
