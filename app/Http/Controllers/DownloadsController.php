<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class DownloadsController extends Controller
{
    public function getModels()
    {
        return [
            ['Activitées', 'activities'],
            ['Adresses enseignants', 'adresse_profs'],
            ['Antécédents', 'antecedents'],
            ['Contenu des scéances', 'contenu_seances'],
            ['Dossiers', 'dossiers'],
            ['Dossier-enseignant', 'dossier_enseignant'],
            ['Écoles', 'ecoles'],
            ['Enseignants', 'enseignants'],
            ['Exercices', 'exercises'],
            ['Impressions diagnostiques', 'impressions'],
            ['Journal de bord', 'journals'],
            ['Mesures', 'mesures'],
            ['Notes évolutives', 'notes'],
            ['Objectifs', 'objectifs'],
            ['Parents', 'parents'],
            ['Partenaires', 'partenaires'],
            ['Traitements pharmaco', 'pharmacos'],
            ['Plans d\'intervention', 'plans'],
            ['Tokens', 'tokens'],
            ['Utilisateurs', 'users']
        ];

    }

    public function getQuestionnaires()
    {
        return array(
            ['Questionnaires jeunes', env('QUEST_JEUNE')],
            ['Questionnaires parents', env('QUEST_PARENT')],
            ['Questionnaires enseignants', env('QUEST_ENSEIGNANT')]
        );

    }

    public function getOldQuestionnaires()
    {
        return array(
            [['Questionnaire jeunes version 1', env('QUEST_JEUNE_V1')]]
        );
    }


    public function formulaire()
    {
        $models = $this->getModels();
        $questionnaires = $this->getQuestionnaires();
        $oldquestionnaires = $this->getOldQuestionnaires();
        return view('downloads.formulaire', compact('models', 'questionnaires', 'oldquestionnaires'));
    }

    public function getfile(Request $request)
    {
        $selection = $request->choix;
        $questionnaires = $request->questionnaires;
        try {
            Excel::create('DonneesCalme', function ($excel) use ($selection, $questionnaires, $oldquestionnaires) {
                if ($selection) {
                    foreach ($selection as $choix) {
                        $data = DB::table($choix)->get();
                        if ($data->count() >= 1) {
                            $rows = [];
                            $rows[] = array_keys(get_object_vars($data->first()));

                            foreach ($data->all() as $d) {
                                $rows[] = array_values((get_object_vars($d)));
                            }

                            $excel->sheet($choix, function ($sheet) use ($rows) {

                                $sheet->fromArray($rows, null, 'A1', true, false);

                            });
                        }
                    }
                }
                if ($questionnaires) {
                    $labels = [
                        env('QUEST_JEUNE') => 'Questionnaire jeunes',
                        env('QUEST_PARENT') => 'Questionnaire parents',
                        env('QUEST_ENSEIGNANT') => 'Questionnaire enseignant',
                    ];
                    foreach ($questionnaires as $questionnaire) {
                        $table = env('LS_PREFIX') . 'survey_' . $questionnaire;
                        $data = DB::connection('ls')->table($table)->get();
                        if ($data->count() >= 1) {
                            $rows = [];
                            $rows[] = array_keys(get_object_vars($data->first()));

                            foreach ($data->all() as $d) {
                                $rows[] = array_values((get_object_vars($d)));
                            }

                            $excel->sheet($labels[$questionnaire], function ($sheet) use ($rows) {

                                $sheet->fromArray($rows, null, 'A1', true, false);

                            });
                        }
                    }

                }
                if ($oldquestionnaires) {
                    $labels = [
                        env('QUEST_JEUNE_V1') => 'Questionnaire jeunes V1'
                    ];
                    foreach ($oldquestionnaires as $oldquestionnaire) {
                        $table = $oldquestionnaire;
                        $data = DB::connection('ls')->table($table)->get();
                        if ($data->count() >= 1) {
                            $rows = [];
                            $rows[] = array_keys(get_object_vars($data->first()));

                            foreach ($data->all() as $d) {
                                $rows[] = array_values((get_object_vars($d)));
                            }

                            $excel->sheet($labels[$oldquestionnaire], function ($sheet) use ($rows) {

                                $sheet->fromArray($rows, null, 'A1', true, false);

                            });
                        }
                    }

                }
            })->download('xlsx');
        } catch (Exception $e) {
            return view('downloads.exeption', compact('e'));
        }


    }


}
