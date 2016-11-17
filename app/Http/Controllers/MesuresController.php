<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Dossier;
use App\Ecole;
use Carbon\Carbon;
use App\Mesure;
use App\Token;

use App\Http\Requests;

class mesuresController extends Controller
{
  public function create(Dossier $dossier)
  {
    if ($dossier->age<8) {
      $this->build($dossier);
      return back();
    }
    else {
      $ecoles=Ecole::all();   
      return view('mesures.create', compact('dossier', 'ecoles'));
    }

  }

  public function build(Dossier $dossier, $data=array())
  {
    $data['parent_id']=$dossier->currentParent()->first()->id;
    $lastmesure=$dossier->mesures->last();
    if($lastmesure){
      $data['temps']=$lastmesure->temps+1;
    }
    else {
      $data['temps']=1;   
    }
    $mesure=$dossier->mesures()->create($data);
        //On fetch les questionnaires associés
    $questionnaires=$mesure->questionnaires()->get();

    foreach($questionnaires as $q) {
      if ((($q->rep=='JE' | $q->rep=='EN') && $dossier->age>=8) | $q->rep=='PA')  {
        $table=env('LS_PREFIX').'tokens_'.$q->ls_id;
        $token=$mesure->id.$q->ls_id.str_random(12);
        DB::insert('insert into '.$table.' (lastname, token) values (?, ?)', [$mesure->id, $token]);
        $mesure->tokens()->create(['token'=>$token, 'ls_id'=>$q->ls_id]);
      }
    }   
  }


  public function store(Dossier $dossier, Request $request)
  {
   $this->validate($request, [
    'ecole_id'=>'required', 
    'prenom_ens'=>'required', 
    'nom_ens'=>'required', 
    'tel_ens'=>'required', 
    'courriel_ens'=>'required|email',  
    ]);
   $this->build($dossier, $request->all()); 
   return redirect('/dossiers/'.$dossier->id.'/show');   	
 }

 public function show(Mesure $mesure) 
 {  
  $mesure=$mesure->with('tokens')->first();
  $query=DB::table('questionnaires')->where('temps', $mesure->temps);
  $nb=$query->count();
  $questionnaires=$query->get();
      //dd($nb);
  $raw_query='(';
  $compteur=1;
  foreach($questionnaires as $q) {
    if ($compteur < $nb) {
      $union=' UNION ';
    }
    else {
      $union='';
    }
    $raw_query=$raw_query.'SELECT completed, '.$q->ls_id. ' as ls_id, token FROM '.env('LS_PREFIX').'tokens_'.$q->ls_id.$union;
    ++$compteur;
  }
  $raw_query=$raw_query.') AS token_all';
      //dd($raw_query);
      //SELECT completed, RRRR as ls_id, token FROM
  $test=DB::select(DB::raw('SELECT * from dossiers'));
  /*$someVariable = Input::get("some_variable");

  $results = DB::select( DB::raw("SELECT * FROM some_table WHERE some_col = :somevariable"), array(
   'somevariable' => $someVariable,
   ));
   */
  dd($test);
  $mesure=DB::table('tokens')
  ->where('mesure_id', $mesure->id)
  ->join(DB::connection('ls')->raw($raw_query), function ($join){
    $join->on('tokens.ls_id', '=', 'token_all.ls_id')->on('tokens.token', '=', 'token_all.token');
  })
  ->toSql();
  dd($mesure);
        /*
        $tokens=$mesure->tokens()->join(DB::connection('ls')->raw("
            SELECT 
          ")
          
        ) 
        ->leftJoin(DB::raw("(SELECT `local_id`, julianday('now')-julianday(last_releve) as age from (SELECT `local_id`, max(created_at) as last_releve From releves Group By local_id)) as last"),'locals.id', '=', 'last.local_id' )*/
        return view('mesures.show', compact('mesure'));
      }

    }
