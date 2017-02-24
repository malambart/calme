<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier;
use App\PlanInterventions\Plan;

class PlansController extends Controller {

    public function create($section, Dossier $dossier)
    {
        $plan = $dossier->getPlan();
        if (!$plan){
            $plan=$dossier->plans()->create([]);
        }
        return view('plans/section'.$section, compact('dossier','plan'));
    }

    public function store($section, Plan $plan, Request $request)
    {
        $plan->update($request->all());
        $section=++$section;
        $dossier=$plan->dossier()->first();
        return view('plans/section'.$section, compact('plan','dossier'));
    }
}
