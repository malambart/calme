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
use Illuminate\Validation\Rule;




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
            'date_naiss'=>'required|date_format:Y-m-d|after:1990-01-01',
            'premiere_seance'=>'required|date_format:Y-m-d|after:today',
            'bilan_final'=>'required|date_format:Y-m-d|after:today'
            ]);
        $data=$request->all();
        //dd($data);
        $data['nom_complet']=$request->prenom.' '.$request->nom;
        $dossier=Dossier::create($data);
     //Mail::to('francislafort@gmail.com'->send(new NouveauDossier($dossier));
     //$user=User::findOrFail(1);
     //$user->notify(new NouveauDossier($dossier));
     //Creation du premier temps de mesure
        $mesure=$dossier->mesures()->create(['temps'=>1]);
    //On fetch les questionnaires associés
        $questionnaires=$mesure->questionnaires()->where('temps', 1)->get();
    // On cree l'invitation dans limeSurvey
        foreach ($questionnaires as $q) {
            if (
                    ($q->rep=='JE' && $dossier->age<8)| //Si répondant est un jeune est à moins de 8 ans
                    ($q->rep!='JE' && $dossier->exclu==1)|
                    ($q->rep=='EN' && ($dossier->premiere_seance->month >= 7 && $dossier->premiere_seance->month < 10))
                    ) 
            {
                continue; 
            }
            $table=env('LS_PREFIX').'tokens_'.$q->ls_id;
            $token=$mesure->id.$q->ls_id.str_random(12);
            DB::connection('ls')->insert('insert into '.$table.' (firstname, lastname, token) values (?, ?, ?)', [$mesure->temps, $mesure->id, $token]);
            $mesure->tokens()->create(['token'=>$token, 'ls_id'=>$q->ls_id, 'rep'=>$q->rep]);
        }
        
        if(!$dossier->exclu){
            return redirect('parents/'.$dossier->id.'/create');
        }
        else {
            return redirect('dossiers/'.$dossier->id.'/show');
        }
        
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
    public function edit(Dossier $dossier)
    {
        return view('dossiers.edit', compact('dossier'));
    }
    public function update(Dossier $dossier, Request $request)
    {
        $this->validate($request, [
            'nom'=>'required', 
            'prenom'=>'required', 
            'no_doss_chus'=>['required', Rule::unique('dossiers')->ignore($dossier->id),'regex:/^[0-9]{7}$/'], 
            'date_naiss'=>'required|date', 
            ]);
        // Si dossier était précédemment exclu,  on créé les token pour les parents et enseignants au besoin...
        if($dossier->exclu && !$request->exclu){
            $parent=$dossier->getCurrentMesure()->tokens()->where('rep', 'PA')->count();
            if(!$parent){
                $questionnaires=$mesure->questionnaires()->where('temps', $dossier->getCurrentMesure()->temps)->get();
                // On cree l'invitation dans limeSurvey
                foreach ($questionnaires as $q) {
                    if (
                    ($q->rep!='JE')|
                    ($q->rep=='EN' && ($dossier->premiere_seance->month >= 7 && $dossier->premiere_seance->month < 10))
                    ) 
                    {
                        continue; 
                    }
                    $table=env('LS_PREFIX').'tokens_'.$q->ls_id;
                    $token=$mesure->id.$q->ls_id.str_random(12);
                    DB::connection('ls')->insert('insert into '.$table.' (firstname, lastname, token) values (?, ?, ?)', [$mesure->temps, $mesure->id, $token]);
                    $mesure->tokens()->create(['token'=>$token, 'ls_id'=>$q->ls_id, 'rep'=>$q->rep]);
                }
            }
        }    

        $data=$request->all();
        $data['nom_complet']=$request->prenom.' '.$request->nom;
        $dossier->update($data);
        return redirect('dossiers/'.$dossier->id.'/show');
    }

}
