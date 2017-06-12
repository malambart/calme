<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier;
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
        return view('home', compact('last'));
    }

    public function dashbord()
    {
        $dossiers = Dossier::count();
        $filles = Dossier::where('sexe', 2)->count();
        $garcons = Dossier::where('sexe', 1)->count();
        //TODO Enlever les dossier supprimés de $ageMoyen
        $ageMoyen = round(DB::table('dossiers')->select(DB::raw('AVG(DATEDIFF(premiere_seance,date_naiss)/365.25) as ageMoyen'))->first()->ageMoyen,2);
        //dd($ageMoyen);
        return view('dashbord', compact('dossiers', 'filles', 'garcons', 'ageMoyen'));
    }
}
