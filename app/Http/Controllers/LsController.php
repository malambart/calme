<?php

namespace App\Http\Controllers;

use App\AdresseProf;
use Illuminate\Http\Request;
use Mockery\Exception;
use App\Mesure;
use App\Dossier;
use App\Token;

class LsController extends Controller
{
    public function coordo($token)
    {
        $prof = Token::where('token', $token)->first()->mesure->dossier->currentEnseignant();
        $adresse = $prof->adresse;
        if(!$adresse) {
            $adresse = new AdresseProf;
            $adresse->enseignant_id = $prof->id;
            $adresse->save();
        }
        return view('ls.coordoProf', compact('adresse'));

    }

    public function storeAdresse(Request $request, AdresseProf $adresse)
    {
        $this->validate($request, [
            'no_civique' => 'required',
            'rue' => 'required',
            'cp' => 'required',
            'ville' => 'required'
        ]);

        $adresse->update($request->all());

        return redirect(url('/adresse-confirmation'));

    }
}
