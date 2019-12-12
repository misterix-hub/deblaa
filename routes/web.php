<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index');



Route::resource('universites', 'UniversiteController');

Route::resource('filieres', 'FiliereController');

Route::resource('niveaux', 'NiveauController');

Route::resource('filiereNiveaus', 'FiliereNiveauController');

Route::resource('structures', 'StructureController');

Route::resource('departements', 'DepartementController');