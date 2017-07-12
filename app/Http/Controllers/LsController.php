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

    protected function getLink(Token $tok) {

        $quest='';
        switch ($tok->rep) {
            case 'JE': $quest = env('QUEST_JEUNE');
                break;
            case 'PA': $quest = env('QUEST_PARENT');
                break;
            case 'EN': $quest = env('QUEST_ENSEIGNANT');
                break;
        }

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
