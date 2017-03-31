<?php

use Illuminate\Database\Seeder;
use App\Questionnaire;

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
    		'ls_id'=>243656,
    		'rep'=>'JE', 
    		'temps'=>1, 
    		'titre'=>'Questionnaire aux jeunes', 
    		]);
    	Questionnaire::create([
    		'ls_id'=>685656,
    		'rep'=>'PA', 
    		'temps'=>1, 
    		'titre'=>'Questionnaire aux parents', 
    		]);
    	Questionnaire::create([
    		'ls_id'=>165315,
    		'rep'=>'EN', 
    		'temps'=>1, 
    		'titre'=>'Questionnaire aux enseignant', 
    		]);
	Questionnaire::create([
                'ls_id'=>243656,
                'rep'=>'JE',
                'temps'=>2,
                'titre'=>'Questionnaire aux jeunes',
                ]);
        Questionnaire::create([
                'ls_id'=>685656,
                'rep'=>'PA',
                'temps'=>2,
                'titre'=>'Questionnaire aux parents',
                ]);
        Questionnaire::create([
                'ls_id'=>165315,
                'rep'=>'EN',
                'temps'=>2,
                'titre'=>'Questionnaire aux enseignant',
                ]);
 
    }
}
