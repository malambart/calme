<?php

namespace App\Http\Controllers;
use Gate;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Dossier;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NouveauDossier;
use Illuminate\Support\Facades\DB;




class DossiersController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show(Dossier $dossier)
    {	
    	$this->authorize('show', $dossier);
        $dossier->load('mesures');
        return view('dossiers.show', compact('dossier'));

    }

    public function create()
    {
        return view('dossiers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom'=>'required', 
            'prenom'=>'required', 
            'no_doss_chus'=>'required|unique:dossiers,no_doss_chus|regex:/^[0-9]{7}$/', 
            'date_naiss'=>'required|date', 
            ]);
        $data=$request->all();
        $data['nom_complet']=$request->prenom.' '.$request->nom;
        $dossier=Dossier::create($data);
     //Mail::to('francislafort@gmail.com'->send(new NouveauDossier($dossier));
     //$user=User::findOrFail(1);
     //$user->notify(new NouveauDossier($dossier));
     //Creation du premier temps de mesure

        $mesure=$dossier->mesures()->create(['temps'=>1]);
    //On fetch les questionnaires associés
        $q=$mesure->questionnaires()->where('rep', 'JE')->where('temps', 1)->first();
    // On cree l'invitation dans limeSurvey
        if ($dossier->age>=8) {
            $table=env('LS_PREFIX').'tokens_'.$q->ls_id;
            $token=$mesure->id.$q->ls_id.str_random(12);
            DB::connection('ls')->insert('insert into '.$table.' (firstname, lastname, token) values (?, ?, ?)', [$mesure->temps, $mesure->id, $token]);
            $mesure->tokens()->create(['token'=>$token, 'ls_id'=>$q->ls_id]);
        }

        return redirect('dossiers/'.$dossier->id.'/show');
    }

    public function index()
    {
        $dossiers=Dossier::select(['id', 'nom_complet'])->get();
        return view('dossiers.liste', compact('dossiers'));
    }

    public function recherche(Request $request){
        $this->validate($request,['recherche'=>'required']);
        $results=Dossier::search($request->recherche)->take(100)->get();
        $chaine=$request->recherche;
        return view('home',compact('results','chaine'));
    }

}
