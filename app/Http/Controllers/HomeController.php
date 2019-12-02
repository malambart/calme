<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Dossier;
use App\Mesure;

class HomeController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $today = new Carbon();
       $last = Dossier::all()->sortByDesc('created_at')->take(5);
	$mesures = Mesure::all();
	//dd($mesures);
	$mesures = $mesures->filter(function ($value, $key) use ($today) {
	$result = false;
	
	if($value->dossier && $value->date >= $today) {
	
	$result = true;
	}

	return $result;
	});
	



      // $mesures = Mesure::has('dossier')->where('Date', '>=', $today)->orderBy('Date')->take(10)->get();
      $mesures = $mesures->where('completed', '===', false);
       return view('home', compact('last', 'mesures'));
    }

}
