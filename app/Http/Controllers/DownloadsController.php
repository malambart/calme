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
            ['Dossiers', 'dossiers'],
            ['Parents', 'parents'],
            ['Plans d\'intervention', 'plans'],
            ['Plans d\'intervention - partenaires', 'partenaires'],
            ['Écoles', 'ecoles'],
            ['Enseignants', 'enseignants'],
            ['Dossier-enseignant', 'dossier_enseignant'],
            ['Journals', 'journals'],
            ['Notes évolutives', 'notes']
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



    public function formulaire()
    {
        $models = $this->getModels();
        $questionnaires = $this->getQuestionnaires();
        return view('downloads.formulaire', compact('models', 'questionnaires'));
    }

    public function getfile(Request $request)
    {
        $selection = $request->choix;
        $questionnaires = $request->questionnaires;
        try {
            Excel::create('DonneesCalme', function ($excel) use ($selection, $questionnaires) {
                if($selection) {
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
                        $table=env('LS_PREFIX').'survey_'.$questionnaire;
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
            })->download('xlsx');
        } catch (Exception $e) {
            return view('downloads.exeption', compact('e'));
        }



    }


}
