<?php

namespace App\Http\Controllers;

use App\AdresseProf;
use Illuminate\Http\Request;
use Mockery\Exception;
use App\Mesure;
use App\Token;
use App\Questionnaire;

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

    protected function getLink(Token $tok) {

        $quest = Questionnaire::where('rep', $tok->rep)->where('temps', $tok->mesure->temps)->first()->ls_id;
        return $link = env('LS_BASE_PATH').'/index.php?r=survey/index/sid/'.$quest.'/token/'.$tok->token.'/newtest/Y';

    }

    public function terminerPlusTard($token)
    {
        $tok = Token::where('token', $token)->first();
        $link = $this->getLink($tok);
        return view('ls.terminer-plus-tard', compact('link'));

    }

    public function ressources($token)
    {
        $tok = Token::where('token', $token)->first();
        $link = $this->getLink($tok);
        $rep = $tok->rep;
        return view('ls.ressources', compact('link', 'rep'));
    }

}
