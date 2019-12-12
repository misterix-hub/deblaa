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

Route::get('universites', 'Universite\MainController@index')->name('indexUniversite');
Route::get('universites/filieres', 'Universite\FiliereController@index')->name('uListeFiliere');
Route::post('universites/filieres', 'Universite\FiliereController@store')->name('uAjouterFiliere');
Route::get('universites/filieres/{id}/details', 'Universite\FiliereController@show')->name('uDetailsFiliere');
Route::get('universites/filieres/{id}/modifier', 'Universite\FiliereController@edit')->name('uModifierFiliere');
Route::post('universites/filieres/{id}/update', 'Universite\FiliereController@update')->name('uUpdateFiliere');
Route::get('universites/filieres/{id}/supprimer', 'Universite\FiliereController@destroy')->name('uSupprimerFiliere');

Route::post('universites/etudiants', 'Universite\EtudiantController@store')->name('uAjouterEtudiant');
Route::get('universites/etudiants', 'Universite\EtudiantController@index')->name('uListeEtudiant');
Route::get('universites/etudiants/{id}/supprimer', 'Universite\EtudiantController@destroy')->name('uSupprimerEtudiant');

Route::get('universites/messages/creer', 'Universite\MessageController@create')->name('uEnvoyerMessage');
Route::get('universites/messages', 'Universite\MessageController@index')->name('uListeMessage');
Route::get('universites/messages/bilan', 'Universite\MessageController@bilan')->name('uBilanMessage');
Route::get('universites/messages/{id}/details', 'Universite\MessageController@details')->name('uDetailsMessage');

Route::get('universites/{id}/profil', 'Universite\CompteController@edit')->name('uCompte');

/* STRUCTURE */

Route::get('structures', 'Structure\MainController@index')->name('indexStructure');
Route::get('structures/groupes', 'Structure\GroupeController@index')->name('sListeGroupe');
Route::post('structures/groupes', 'Structure\GroupeController@store')->name('sAjouterGroupe');
Route::get('structures/groupes/{id}/details', 'Structure\GroupeController@show')->name('sDetailsGroupe');
Route::get('structures/groupes/{id}/modifier', 'Structure\GroupeController@edit')->name('sModifierGroupe');
Route::post('structures/groupes/{id}/update', 'Structure\GroupeController@update')->name('sUpdateGroupe');
Route::get('structures/groupes/{id}/supprimer', 'Structure\GroupeController@destroy')->name('sSupprimerGroupe');

Route::post('structures/membres', 'Structure\MembreController@store')->name('sAjouterMembre');
Route::get('structures/membres', 'Structure\MembreController@index')->name('sListeMembre');
Route::get('structures/membres/{id}/supprimer', 'Structure\MembreController@destroy')->name('sSupprimerMembre');

Route::get('structures/messages/creer', 'Structure\MessageController@create')->name('sEnvoyerMessage');
Route::get('structures/messages', 'Structure\MessageController@index')->name('sListeMessage');
Route::get('structures/messages/bilan', 'Structure\MessageController@bilan')->name('sBilanMessage');
Route::get('structures/messages/{id}/details', 'Structure\MessageController@details')->name('sDetailsMessage');

Route::get('structures/{id}/profil', 'Structure\CompteController@edit')->name('sCompte');

/* ETUDIANT */

Route::get('etudiants/inbox', 'Etudiant\MessageController@inbox')->name('inboxEtudiant');
Route::get('etudiants/inboxs', 'Etudiant\MessageController@inboxs')->name('inboxEtudiants');