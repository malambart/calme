<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesure extends Model
{
    use Updater;
    use RecordsActivity;
    protected $fillable = ['temps', 'date'];

    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class, 'temps', 'temps');
    }

    protected $dates = ['date'];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function ete()
    {
        // On vérifie si la date est en été, donc pas de questionnaire enseignant
        $ete = false;
        if ($this->date->month >= 7 && $this->date->month < 10) {
            $ete = true;
        }
        return $ete;
    }

    public function qCompleted()
    {
        $count = 0;
        $questionnaires = $this->tokens()->get();
        if ($this->dossier->exclu) {
            $deno = $questionnaires->where('rep', 'JE')->count();
        } else {
            $deno = $questionnaires->count();
            if ($this->ete()) {
                $deno = $deno - 1;
            }
        }
        // Pour les jeunes agés de moins de 8 ans au T1, le questionanire jeune n'est pas administré.
        if ($this->age < 8) {
            $deno = $deno - 1;
        }

        foreach ($questionnaires as $q)
            if ($q->isCompleted() != 'N') {
                $count = $count + 1;
            }
        $result = ['deno' => $deno, 'complet' => $count];
        return $result;
    }

    public function getTokens()
    {
        if ($this->dossier->exclu) {
            $tokens = $this->tokens()->where('rep', 'JE')->get();
        } else {
            $tokens = $this->tokens()->get();
        }
        return $tokens;
    }

    public function getAgeAttribute()
    {
        $naiss = $this->dossier->date_naiss;
        $date = $this->date;
        return round(($date->diff($naiss)->format('%a')) / 365.25, 1);
    }

    public function getStatusAttribute()
    {
        $status = [0, 0, 0];

        foreach ($this->tokens as $q)
            if ($q->isCompleted() != 'N') {
                switch ($q->rep) {
                    case 'PA':
                        $status[0] = 1;
                        break;
                    case 'JE':
                        $status[1] = 1;
                        break;
                    case 'EN':
                        $status[2] = 1;
                        break;
                }
            }

        if ($this->age < 8) {
            $status[1] = 'x';
        }
        if ($this->ete()) {
            $status[2] = 'x';
        }
        if ($this->dossier->exclu) {
            $status[0] = 'x';
            $status[2] = 'x';
        }
        $status = implode("-", $status);
        return $status;
    }

    public function getCompletedAttribute()
    {
        $result = false;
        $qCompleted = $this->qCompleted();

        if ($qCompleted['deno'] <= $qCompleted['complet']) {
            $result = true;
        }
        return $result;
    }
}
