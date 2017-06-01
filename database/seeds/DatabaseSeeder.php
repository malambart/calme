<?php

use Illuminate\Database\Seeder;
use App\Questionnaire;
use App\ContenuSeance;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {

        Questionnaire::create([
            'ls_id' => 243656,
            'rep' => 'JE',
            'temps' => 1,
            'titre' => 'Questionnaire aux jeunes',
        ]);
        Questionnaire::create([
            'ls_id' => 685656,
            'rep' => 'PA',
            'temps' => 1,
            'titre' => 'Questionnaire aux parents',
        ]);
        Questionnaire::create([
            'ls_id' => 165315,
            'rep' => 'EN',
            'temps' => 1,
            'titre' => 'Questionnaire aux enseignant',
        ]);
        Questionnaire::create([
            'ls_id' => 243656,
            'rep' => 'JE',
            'temps' => 2,
            'titre' => 'Questionnaire aux jeunes',
        ]);
        Questionnaire::create([
            'ls_id' => 685656,
            'rep' => 'PA',
            'temps' => 2,
            'titre' => 'Questionnaire aux parents',
        ]);
        Questionnaire::create([
            'ls_id' => 165315,
            'rep' => 'EN',
            'temps' => 2,
            'titre' => 'Questionnaire aux enseignant',
        ]);

        $contenus=[
            ['no_seance' => 1, 'categories' => 'Objectifs enfants', 'label' => 'Introduction du programme'],
            ['no_seance' => 1, 'categories' => 'Objectifs enfants', 'label' => 'Règles du groupe'],
            ['no_seance' => 1, 'categories' => 'Objectifs enfants', 'label' => "Définition de l'anxiété"],
            ['no_seance' => 2, 'categories' => 'Objectifs enfants', 'label' => 'Identifier les émotions et les sensations physiques'],
            ['no_seance' => 3, 'categories' => 'Objectifs enfants', 'label' => 'Lien entre sensations physiques et émotions'],
            ['no_seance' => 3, 'categories' => 'Objectifs enfants', 'label' => 'Démystifier les symptômes physiologiques'],
            ['no_seance' => 3, 'categories' => 'Objectifs enfants', 'label' => 'Rééducation respiratoire'],
            ['no_seance' => 3, 'categories' => 'Objectifs enfants', 'label' => 'Relaxation musculaire'],
            ['no_seance' => 4, 'categories' => 'Objectifs enfants', 'label' => 'Faire le lien entre pensées, émotions et sensations physiques'],
            ['no_seance' => 4, 'categories' => 'Objectifs enfants', 'label' => 'Distinguer les pensées aidantes des pensées catastrophiques'],
            ['no_seance' => 5, 'categories' => 'Objectifs enfants', 'label' => 'Apprendre à utiliser le jeu du détective'],
            ['no_seance' => 6, 'categories' => 'Objectifs enfants', 'label' => 'Faire le lien entre sensations physiques, pensées et comportement'],
            ['no_seance' => 6, 'categories' => 'Objectifs enfants', 'label' => "Comprendre le rôle de l'évitement dans le maintien de l'anxiété"],
            ['no_seance' => 6, 'categories' => 'Objectifs enfants', 'label' => "Introduire la l'exposition graduée"],
            ['no_seance' => 7, 'categories' => 'Objectifs enfants', 'label' => "Appliquer l'exposition graduée"],
            ['no_seance' => 8, 'categories' => 'Objectifs enfants', 'label' => "Apprendre des moyens pour faciliter les exercices d'exposition graduée"],
            ['no_seance' => 10, 'categories' => 'Objectifs enfants', 'label' => "intégrer et généraliser les acquis"],
            ['no_seance' => 1, 'categories' => 'Objectifs parents', 'label' => "Introduction du programme"],
            ['no_seance' => 1, 'categories' => 'Objectifs parents', 'label' => "Définition de l'anxiété"],
            ['no_seance' => 2, 'categories' => 'Objectifs parents', 'label' => "Information sur le TDA/H"],
            ['no_seance' => 2, 'categories' => 'Objectifs parents', 'label' => "Information sur l'étiologie de l'anxiété (mod. Dodds"],
            ['no_seance' => 3, 'categories' => 'Objectifs parents', 'label' => "Démystifier les symptomes physiologiques"],
            ['no_seance' => 3, 'categories' => 'Objectifs parents', 'label' => "Rééducation respiratoire"],
            ['no_seance' => 3, 'categories' => 'Objectifs parents', 'label' => "Relaxation musculaire"],
            ['no_seance' => 4, 'categories' => 'Objectifs parents', 'label' => "Distinguer les pensées aidantes des pensées catastrophiques"],
            ['no_seance' => 4, 'categories' => 'Objectifs parents', 'label' => "Éviter de rassurer excessivement"],
            ['no_seance' => 5, 'categories' => 'Objectifs parents', 'label' => "Restructuration cognitive"],
            ['no_seance' => 5, 'categories' => 'Objectifs parents', 'label' => "Comment éviter de rassurer son enfant de façon excessive"],
            ['no_seance' => 6, 'categories' => 'Objectifs parents', 'label' => "Introduction à l'exposition graduée"],
            ['no_seance' => 7, 'categories' => 'Objectifs parents', 'label' => "Aider son enfant à appliquer l'exposition graduée"],
            ['no_seance' => 8, 'categories' => 'Objectifs parents', 'label' => "Apprendre des moyens pour résoudre les difficultés pouvant survenir lors des exercises d'exposition graduées"],
            ['no_seance' => 10, 'categories' => 'Objectifs parents', 'label' => "Intégrer et généraliser les acquis"],
            ['no_seance' => 10, 'categories' => 'Objectifs parents', 'label' => "Boucle de coercision"],
            ['no_seance' => 1, 'categories' => "Activité d'intégration", 'label' => "Mettre les composantes dans le triangle"],
            ['no_seance' => 2, 'categories' => "Activité d'intégration", 'label' => "Cranium des émotions"],
            ['no_seance' => 2, 'categories' => "Activité d'intégration", 'label' => "Thermomètre de l'anxiété individuel"],
            ['no_seance' => 3, 'categories' => "Activité d'intégration", 'label' => "Quiz : Démystifier les sensations physiques : reconnaître et exprimer ses émotions"],
            ['no_seance' => 4, 'categories' => "Activité d'intégration", 'label' => "Trouver une PA pour remplacer une PC"],
            ['no_seance' => 5, 'categories' => "Activité d'intégration", 'label' => "Faire de détective avec une peur de son parent"],
            ['no_seance' => 6, 'categories' => "Activité d'intégration", 'label' => "Quiz: distinguer les comportement d'évitement et d'exposition"],
            ['no_seance' => 6, 'categories' => "Activité d'intégration", 'label' => "Jeu des mimes: remplacer ses comportements d'évitement par l'exposition"],
            ['no_seance' => 7, 'categories' => "Activité d'intégration", 'label' => "Choisir une peur et commencer l'escalier d'exposition"],
            ['no_seance' => 8, 'categories' => "Activité d'intégration", 'label' => "Établir et planifier les exercises à faire durant la semaine"],
            ['no_seance' => 10, 'categories' => "Activité d'intégration", 'label' => "Jeu de société portant sur l'ensemble des concepts"],
            ['no_seance' => 1, 'categories' => 'Exercices à faire à la maison', 'label' => "Liste des peurs"],
            ['no_seance' => 2, 'categories' => 'Exercices à faire à la maison', 'label' => "Intensité 0-10 de chacunes de peurs de la liste"],
            ['no_seance' => 3, 'categories' => 'Exercices à faire à la maison', 'label' => "Expliquer le système d'alarme à un parent ou un ami"],
            ['no_seance' => 3, 'categories' => 'Exercices à faire à la maison', 'label' => "Exercise de respiration et de relaxation"],
            ['no_seance' => 4, 'categories' => 'Exercices à faire à la maison', 'label' => "Exercise de respiration et de relaxation"],
            ['no_seance' => 4, 'categories' => 'Exercices à faire à la maison', 'label' => "Identifier la PC la plus importante pour chaque peur"],
            ['no_seance' => 5, 'categories' => 'Exercices à faire à la maison', 'label' => "Exercice de respiration et relaxation"],
            ['no_seance' => 5, 'categories' => 'Exercices à faire à la maison', 'label' => "Jeu du détective"],
            ['no_seance' => 6, 'categories' => 'Exercices à faire à la maison', 'label' => "Respiration et relaxation"],
            ['no_seance' => 6, 'categories' => 'Exercices à faire à la maison', 'label' => "Jeu du détective"],
            ['no_seance' => 6, 'categories' => 'Exercices à faire à la maison', 'label' => "Remplir la grille d'auto-observation en situation anxiogène"],
            ['no_seance' => 7, 'categories' => 'Exercices à faire à la maison', 'label' => "Respirations, relaxation et jeu du détective au besoin"],
            ['no_seance' => 7, 'categories' => 'Exercices à faire à la maison', 'label' => "Terminer l'escalier et débuter un premier exercice"],
            ['no_seance' => 8, 'categories' => 'Exercices à faire à la maison', 'label' => "Respirations, relaxation et jeu du détective au besoin"],
            ['no_seance' => 8, 'categories' => 'Exercices à faire à la maison', 'label' => "Relire l'histoire de Super"],
            ['no_seance' => 8, 'categories' => 'Exercices à faire à la maison', 'label' => "Poursuivre l'exposition"],
        ];

        foreach ($contenus as $contenu) {
            ContenuSeance::create($contenu);
        }

    }


}
