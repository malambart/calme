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
        'no_doss_chus'=>'required', 
        'date_naiss'=>'required|date', 
        ]);
     $data=$request->all();
     $data['nom_complet']=$request->prenom.' '.$request->nom;
     $dossier=Dossier::create($data);
     //Mail::to('francislafort@gmail.com'->send(new NouveauDossier($dossier));
     $user=User::findOrFail(1);
     //$user->notify(new NouveauDossier($dossier));
     return redirect('dossiers/'.$dossier->id.'/show');
    }

    public function index()
    {
    $dossiers=Dossier::select(['id', 'nom_complet'])->get();
    return view('dossiers.liste', compact('dossiers'));
    }
}
