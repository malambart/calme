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
        if (!$plan && $section==1){
            $plan=$dossier->plans()->create([]);
        }
        return view('plans/section'.$section, compact('dossier','plan','section'));
    }

    public function store($section, Plan $plan, Request $request)
    {
        $donnees=$request->all();
        $rules=[];
        if ($section==2) {
            $rules=[
                'date_eval'=>'Date',
                'reference'=>'Date',
                'new_diagnostic'=>'in:""',
                'new_medicament'=>'in:""'
            ];
            if(isset($donnees['diagnostics'])){
                $donnees['diagnostics']=json_encode($donnees['diagnostics']);
            }
            if(isset($donnees['medication'])) {
                $donnees['medication']=json_encode($donnees['medication']);
            }

        }

        if ($section==4) {
            //dd($request->all());
            foreach ($request->partenaires as $partenaire) {
                $plan->partenaires()->create($partenaire);
            }
        }

        $this->validate($request,$rules);
        $plan->update(Plan::sanitize($donnees));
        $section=++$section;
        $dossier=$plan->dossier()->first();
        return redirect(url('plans',[$section, $dossier->id]));
    }
}
