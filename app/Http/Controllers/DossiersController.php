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

    public function create()
    {
        return view('dossiers.create');
    }

    private function getValidationRules($accepte, $verb = 'edit', $params = []) {
        $rules =  [
            'sexe' => 'required',
        ];
        $moreRules = [];
        $evenMoreRules = [];
        if ($accepte == 1) {
            $moreRules = [
                'nom' => 'required',
                'prenom' => 'required',
                'no_doss_chus' => 'required|unique:dossiers,no_doss_chus|regex:/^[0-9]{7}$/',
                'date_naiss' => 'required|date_format:Y-m-d|after:1990-01-01',
            ];
         if($verb == 'create')
            $evenMoreRules = [
                'premiere_seance' => 'required|date_format:Y-m-d|after:today|before:' . $params['bilan_final'],
                'bilan_final' => 'required|date_format:Y-m-d|after:today|after:' . $params['premiere_seance']
            ];
        }
        return array_merge($rules, $moreRules, $evenMoreRules);
    }

    public function store(Request $request)
    {
        $params = [
            'bilan_final' => $request->bilan_final,
            'premiere_seance' => $request->premiere_seance
        ];

        $this->validate($request, $this->getValidationRules($request->accepte, 'create', $params));
        $data = $request->all();

        if ($request->accepte == 1) {
            $data['nom_complet'] = $request->prenom . ' ' . $request->nom;
        }

        $dossier = Dossier::create($data);

        //Creation du premier temps de mesure

        $temps_mesure = [1, 2];

        foreach ($temps_mesure as $tm) {

            $mesure = $dossier->mesures()->create(['temps' => $tm]);

            if ($tm == 1) {
                $date = $request->premiere_seance;
            } elseif ($tm == 2) {
                $date = $request->bilan_final;
            }

            $mesure->date = $date;
            $mesure->save();
            //On fetch les questionnaires associés
            $questionnaires = $mesure->questionnaires()->where('temps', $tm)->get();
            // On cree l'invitation dans limeSurvey
            foreach ($questionnaires as $q) {
                $table = env('LS_PREFIX') . 'tokens_' . $q->ls_id;
                $token = $mesure->id . $q->ls_id . str_random(12);
                DB::connection('ls')->insert('insert into ' . $table . ' (attribute_1, attribute_2, firstname, lastname, token) values (?, ?, ?, ?, ?)',
                    [
                        $mesure->temps,
                        $mesure->id,
                        $dossier->prenom,
                        $dossier->nom,
                        $token]
                );
                $mesure->tokens()->create(['token' => $token, 'ls_id' => $q->ls_id, 'rep' => $q->rep]);
            }

        }
        
        if (!$dossier->exclu) {
            return redirect(url('parents/create', $dossier->id));
        } else {
            return redirect(url('dossiers/show', $dossier->id));
        }

    }

    public function show(Dossier $dossier)
    {
        $dossier->load('mesures');
        $enseignant = $dossier->currentEnseignant();
        $plan = $dossier->plan()->first();
        return view('dossiers.show', compact('dossier', 'enseignant', 'plan'));
    }

    public function index()
    {
        $dossiers = Dossier::select(['id', 'nom_complet', 'accepte'])->get();
        return view('dossiers.liste', compact('dossiers'));
    }

    public function recherche(Request $request)
    {
        $this->validate($request, ['recherche' => 'required']);
        //dd($request->recherche);

        $results = DB::table('dossiers')
            ->whereRaw("MATCH (nom, prenom, no_doss_chus) AGAINST ('$request->recherche')")
            ->orWhere('id', $request->recherche)
            ->where('deleted_at', null)
            ->get();

        if ($results->count() == 1) {
            return redirect(url('dossiers/show', $results->first()->id));
        }


        $chaine = $request->recherche;
        return view('recherche', compact('results', 'chaine'));
    }

    public function edit(Dossier $dossier)
    {
        return view('dossiers.edit', compact('dossier'));
    }


    public function update(Dossier $dossier, Request $request)
    {
        $this->validate($request, $this->getValidationRules($request->accepte));
        $data = $request->all();

        if($request->accepte == 1) {
            $data['nom_complet'] = $request->prenom . ' ' . $request->nom;
        } elseif($request->accepte == 2) {
            $toRemove = ['nom', 'prenom', 'no_doss_chus', 'date_naiss', 'nom_complet'];
            foreach ($toRemove as $r) {
                $data[$r] = null;
            }
            //dd($data);
            // On enlève aussi les données des parents
            $parents = $dossier->parents;
            $parentToRemove = [
                'date_naiss',
                'nom',
                'prenom',
                'tel',
                'ext',
                'tel2',
                'ext2',
                'emploi',
                'courriel'
            ];
            foreach ($parents as $p) {
                foreach ($parentToRemove as $r) {
                    $p->$r = null;
                }
                $p->save();
            }


        }
        $dossier->update($data);
        return redirect(url('dossiers/show', $dossier->id));
    }


    public function delete(Dossier $dossier)
    {
        $dossier->delete();
        return redirect('/');
    }

    public function supprimes()
    {
        $dossiers = Dossier::onlyTrashed()->select(['id', 'nom_complet'])->get();
        return view('dossiers.supprimes', compact('dossiers'));
    }

    public function restore($dossier)
    {
        $d = Dossier::onlyTrashed()->findOrFail($dossier);
        $d->restore();
        $d->deleted_by = null;
        $d->save();
        return redirect(url('dossiers/show', $d->id));
    }

}
