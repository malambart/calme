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
route::get('utilisateurs/ajout', 'Auth\RegisterController@showRegistrationForm');
route::post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/user/create','UsersController@create');

Route::get('/accueil', 'HomeController@index');


Route::get('dossiers', 'DossiersController@create');
Route::get('dossiers/{dossier}/edit', 'DossiersController@edit');
Route::patch('dossiers/{dossier}/edit', 'DossiersController@update');
Route::get('dossiers/{dossier}/show', 'DossiersController@show');
Route::get('dossiers/create', 'DossiersController@create');
Route::post('dossiers/create', 'DossiersController@store');
Route::get('dossiers/index', 'DossiersController@index');
Route::get('parents/{dossier}/create', 'ParentsRepController@create');
Route::post('parents/{dossier}/create', 'ParentsRepController@store');
Route::get('parents/{parent}/show', 'ParentsRepController@show');
Route::get('parents/{parent}/edit', 'ParentsRepController@edit');

Route::get('mesures/{dossier}/create', 'MesuresController@create');
Route::post('mesures/{dossier}/create', 'MesuresController@store');
Route::get('mesures/{mesure}/show', 'MesuresController@show');


Route::get('ecoles/create', 'EcolesController@create');
Route::post('ecoles/create', 'EcolesController@store');


Route::get('utilisateurs', 'UsersController@index');
Route::get('utilisateurs/{user}', 'UsersController@show');
Route::get('utilisateurs/{user}/edit', 'UsersController@edit');
Route::patch('utilisateurs/{user}/edit', 'UsersController@update');
Route::get('utilisateurs/{user}/delete', 'UsersController@delete');

Route::post('recherche', 'DossiersController@recherche');