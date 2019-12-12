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

Route::group(['middleware' => 'auth'], function () {


    Route::get('/home', 'HomeController@index');



    Route::resource('admin/universites', 'UniversiteController');

    Route::resource('admin/filieres', 'FiliereController');

    Route::resource('admin/niveaux', 'NiveauController');

    Route::resource('admin/filiereNiveaus', 'FiliereNiveauController');

    Route::resource('admin/structures', 'StructureController');

    Route::resource('admin/departements', 'DepartementController');

});
