<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'HomeController@index');

//Auth::routes();

// Authentication Routes...
route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
route::post('login', 'Auth\LoginController@login');
route::post('logout', 'Auth\LoginController@logout');

// Registration Routes...
Route::get('utilisateurs/ajout', 'Auth\RegisterController@showRegistrationForm');
route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/user/create', 'UsersController@create');

Route::get('/accueil', 'HomeController@index');


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


Route::get('utilisateurs', 'UsersController@index');
Route::get('utilisateurs/show/{user}', 'UsersController@show');
Route::get('utilisateurs/edit/{user}', 'UsersController@edit');
Route::patch('utilisateurs/edit/{user}', 'UsersController@update');
Route::get('utilisateurs/delete/{user}', 'UsersController@delete');

Route::post('recherche', 'DossiersController@recherche');

Route::get('enseignants/create/{dossier}', 'EnseignantsController@create');
Route::post('enseignants/create/{dossier}', 'EnseignantsController@store');
Route::get('enseignants/show/{enseignant}/{dossier}', 'EnseignantsController@show');

Route::get('tableau-de-bord','HomeController@dashbord');

Route::get('plans/{section}/{dossier}', 'PlansController@edit');
Route::patch('plans/{section}/{plan}', 'PlansController@store');
Route::post('plans/create/section1/{dossier}', 'PlansController@store');