<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier;
use App\Mesure;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $last = Dossier::all()->sortByDesc('created_at')->take(5);
       $mesures = Mesure::has('dossier')->orderBy('Date')->take(10)->get();

       foreach ($mesures as $mesure) {
            $mesure['completed'] = $mesure->qCompleted();
            $is_completed = false;
            if ($mesure['completed']['deno'] === $mesure['completed']['complet']) {
                $is_completed = true;
            }
            $mesure['is_completed'] = $is_completed;
       }

       $mesures = $mesures->where('is_completed', '===', false);

       return view('home', compact('last', 'mesures'));
    }
    
}
