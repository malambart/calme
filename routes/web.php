<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index');
    Route::get('utilisateurs/ajout', 'Auth\RegisterController@showRegistrationForm');
    Route::get('/user/create', 'UsersController@create');
    Route::get('/accueil', 'HomeController@index');
    Route::get('/home', 'HomeController@index');


    Route::get('dossiers', 'DossiersController@create');
    Route::get('dossiers/edit/{dossier}', 'DossiersController@edit');
    Route::patch('dossiers/edit/{dossier}', 'DossiersController@update');
    Route::get('dossiers/delete/{dossier}', 'DossiersController@delete');
    Route::get('dossiers/show/{dossier}', 'DossiersController@show');
    Route::get('dossiers/create', 'DossiersController@create');
    Route::post('dossiers/create', 'DossiersController@store');
    Route::get('dossiers/index', 'DossiersController@index');
    Route::get('dossiers/supprimes', 'DossiersController@supprimes');
    Route::get('dossiers/restore/{dossier}', 'DossiersController@restore');

    Route::get('parents/create/{dossier}', 'ParentsRepController@create');
    Route::post('parents/create/{dossier}', 'ParentsRepController@store');
    Route::get('parents/show/{parent}', 'ParentsRepController@show');
    Route::get('parents/edit/{parent}', 'ParentsRepController@edit');
    Route::patch('parents/edit/{parent}', 'ParentsRepController@update');
    Route::get('parents/delete/{parent}','ParentsRepController@delete');

    Route::get('mesures/create/{dossier}', 'MesuresController@create');
    Route::post('mesures/create/{dossier}', 'MesuresController@store');
    Route::get('mesures/show/{mesure}', 'MesuresController@show');
    Route::get('mesures/edit/{mesure}', 'MesuresController@edit');
    Route::patch('mesures/edit/{mesure}', 'MesuresController@update');
    Route::get('mesures/ajoutdate/{mesure}','MesuresController@ajoutDate');
    Route::patch('mesures/storedate/{mesure}','MesuresController@storeDate');


    Route::get('ecoles/create', 'EcolesController@create');
    Route::post('ecoles/create', 'EcolesController@store');
    Route::get('ecoles/show/{ecole}', 'EcolesController@show');
    Route::get('ecoles/edit/{ecole}', 'EcolesController@edit');
    Route::patch('ecoles/edit/{ecole}', 'EcolesController@update');


    Route::get('utilisateurs', 'UsersController@index');
    Route::get('utilisateurs/show/{user}', 'UsersController@show');
    Route::get('utilisateurs/edit/{user}', 'UsersController@edit');
    Route::patch('utilisateurs/edit/{user}', 'UsersController@update');
    Route::get('utilisateurs/delete/{user}', 'UsersController@delete');

    Route::post('recherche', 'DossiersController@recherche');

    Route::get('enseignants/create/{dossier}', 'EnseignantsController@create');
    Route::post('enseignants/create/{dossier}', 'EnseignantsController@store');
    Route::get('enseignants/show/{enseignant}/{dossier}', 'EnseignantsController@show');
    Route::get('enseignants/edit/{enseignant}', 'EnseignantsController@edit');
    Route::patch('enseignants/edit/{enseignant}', 'EnseignantsController@update');

    Route::get('tableau-de-bord','HomeController@dashbord');

    Route::get('plans/{section}/{dossier}', 'PlansController@edit');
    Route::patch('plans/{section}/{plan}', 'PlansController@store');
    Route::post('plans/create/section1/{dossier}', 'PlansController@store');
    Route::get('partenaires/delete/{partenaire}', 'PlansController@PartenaireDelete');
    Route::get('impressions/delete/{impression}', 'PlansController@ImpressionDelete');
    Route::get('antecedents/delete/{antecedent}', 'PlansController@AntecedentDelete');

    Route::get('notes/create/{dossier}/{no}', 'NotesController@create');
    Route::post('notes/create/{dossier}', 'NotesController@store');
    Route::get('notes/show/{note}', 'NotesController@show');
    Route::get('notes/edit/{note}', 'NotesController@edit');
    Route::patch('notes/edit/{note}', 'NotesController@update');

    Route::get('journals/create/{dossier}', 'JournalsController@create');
    Route::post('journals/create/{dossier}', 'JournalsController@store');
    Route::get('journals/show/{journal}', 'JournalsController@show');
    Route::get('journals/edit/{journal}', 'JournalsController@edit');
    Route::patch('journals/edit/{journal}', 'JournalsController@update');


});






