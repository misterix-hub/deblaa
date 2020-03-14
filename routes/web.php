<?php

use App\Models\Universite;
use App\Models\Structure;
use App\FactureUniversite;
use App\FactureStructure;
use App\MessageUniversite;
use App\CibleMessageUniversite;
use App\User;
use App\MessageStructure;
use App\CibleMessageStructure;

use Illuminate\Http\Request;

Route::get('/', function () {
    if(session()->has('category')) {
        if (session()->get('category') == "universite") {
            return redirect(route('indexUniversite'));
        } else {
            if (session()->get('category') == "structure") {
                return redirect(route('indexStructure'));
            } else {
                if (session()->get('category') == "membre") {
                    return redirect(route('inboxMembre'));
                } else {
                    return redirect(route('inboxEtudiant'));
                }

            }

        }
    } else {
        return view('welcome');
    }

})->name('indexVisitors');
Route::post('contact', 'ContactController@sendMessageByUser')->name('messageSendByUsers');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index');

    Route::resource('admin/universites', 'UniversiteController');

    Route::get('admin/universites/{id}/access-pro', 'UniversiteController@giveAccessPro')->name('universites.getAccess');

    Route::resource('admin/filieres', 'FiliereController');

    Route::resource('admin/niveaux', 'NiveauController');

    Route::resource('admin/filiereNiveaus', 'FiliereNiveauController');

    Route::resource('admin/structures', 'StructureController');

    Route::get('admin/structures/{id}/access-pro', 'StructureController@giveAccessPro')->name('structures.getAccess');

    Route::resource('admin/departements', 'DepartementController');

    Route::get('admin/statistiques/universites/show/{id}/', function ($id) {

        return view('statistiques.universite.show', [
            'universite' => Universite::findOrFail($id),
            /*'universites' => FactureUniversite::leftJoin('universites', 'universite_id', 'universites.id')
                                        ->where('universites.id', $id)->orderByDesc('facture_universites.id')
                                        ->limit(1)->get(),*/
            'montantUniversite' => FactureUniversite::where('universite_id', $id)->orderByDesc('id')->limit(1)->get('montant')->first()->montant,
            'messages' => MessageUniversite::where('universite_id', $id)->get(),
            'users' => User::where('filiere_id', '<>', null)->get(),
            'cible_message_universites' => CibleMessageUniversite::all(),
            'numero_facture_universites' => FactureUniversite::all(),
            'numero_facture_structures' => FactureStructure::all()
        ]);
    });

    Route::get('admin/statistiques/structures/show/{id}/', function ($id) {

        return view('statistiques.structure.show', [
            'structure' => Structure::findOrFail($id),
            /*'structures' => FactureStructure::rightJoin('structures', 'structure_id', 'structures.id')
                                        ->where('structures.id', $id)->orderByDesc('facture_structures.id)
                                        ->limit(1)->get(),*/
            'montantStructure' => FactureStructure::where('structure_id', $id)->orderByDesc('id')->limit(1)->get('montant')->first()->montant,
            'messages' => MessageStructure::where('structure_id', $id)->get(),
            'users' => User::where('departement_id', '<>', null)->get(),
            'cible_message_structures' => CibleMessageStructure::all(),
            'numero_facture_universites' => FactureUniversite::all(),
            'numero_facture_structures' => FactureStructure::all()
        ]);
    });

    Route::post('admin/factures/universite/regler', function(Request $request) {

        $request->validate([
            'date' => 'required',
        ],
            [
                'date.required' => 'Veuillez entrer la date du règlement'
            ]);

        if ($request->montant == 0) {
            return back()->with('error', "Impossible de régler une facture vide !");
        } else {

            $facture_universite = new FactureUniversite;
            $facture_universite->numero = $request->numero;
            $facture_universite->universite_id = $request->universite_id;
            $facture_universite->montant = $request->montant;
            $facture_universite->date = $request->date;
            $facture_universite->save();

            return back()->with('success', "Facture réglée avec succès !");
        }
    })->name('reglerFactureUniversite');

    Route::post('admin/factures/structure/regler', function(Request $request) {

        $request->validate([
            'date' => 'required',
        ],
            [
                'date.required' => 'Veuillez entrer la date du règlement'
            ]);

        if ($request->montant == 0) {
            return back()->with('error', "Impossible de régler une facture vide !");
        } else {

            $facture_structure = new FactureStructure;
            $facture_structure->numero = $request->numero;
            $facture_structure->structure_id = $request->structure_id;
            $facture_structure->montant = $request->montant;
            $facture_structure->date = $request->date;
            $facture_structure->save();

            return back()->with('success', "Facture réglée avec succès !");
        }
    })->name('reglerFactureStructure');

    Route::get('admin/statistiques/universites', function () {
        return view('statistiques.universite.index', [
            'universites' => Universite::all()
        ]);
    });

    Route::get('admin/statistiques/structures', function () {
        return view('statistiques.structure.index', [
            'structures' => Structure::all()
        ]);
    });

    /* DEMANDE */
    Route::get('demandes-processing', 'DemandeController@totalDemande')->name('demandeComptePro');
    Route::get('demandes', 'DemandeController@indexDemandes')->name('indexDemandes');
    Route::post('demandes/structure-accord-processing/{id}', 'DemandeController@accordStructureProcessing')->name('accordStructureProcessing');
    Route::post('demandes/universite-accord-processing/{id}', 'DemandeController@accordUniversiteProcessing')->name('accordUniversiteProcessing');
});

/* UNIVERSITE */

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
Route::post('universite/message/envoyer', 'Universite\MessageController@envoyer')->name('uEnvoyerMessageFrom');
Route::get('universites/messages', 'Universite\MessageController@index')->name('uListeMessage');
Route::get('universites/messages/bilan', 'Universite\MessageController@bilan')->name('uBilanMessage');
Route::get('universites/messages/{id}/details', 'Universite\MessageController@details')->name('uDetailsMessage');

Route::get('universites/{id}/profil', 'Universite\CompteController@edit')->name('uCompte');
Route::post('universites/{id}/profil/update', 'Universite\CompteController@update')->name('uCompteUpdate');
Route::get('universites/login', 'Universite\MainController@login')->name('uLogin');

Route::get('universites/reset-password', 'Universite\ResetPasswordController@checkEmailView')->name('uResetPassword');
Route::post('universites/reset-password/processing', 'Universite\ResetPasswordController@resetPasswordProcessing')->name('uResetPasswordProcessing');

Route::post('universites/login/processing', 'Universite\LoginController@loginProcessing')->name('uLoginProcessing');
Route::get('universites/register', 'Universite\MainController@register')->name('uRegister');
Route::post('universites/register', 'Universite\LoginController@registerProcessing')->name('uRegisterProcessing');
Route::get('universites/register/success', 'Universite\LoginController@registerSuccess')->name('uRegisterSuccess');

Route::get('logout', 'Universite\LoginController@logout')->name('logout');

Route::get('universites/demande', 'Universite\CompteController@comptePro')->name('uDemandeComptePro');
Route::get('universites/{id}/{formule}/paiements', 'Universite\CompteController@modePaiement')->name('uModePaiement');

Route::get('universite/alerte-message', 'Universite\MessageController@alert')->name('alertUniversite');

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
Route::post('structures/messages/envoyer', 'Structure\MessageController@envoyer')->name('sEnvoyerMessageForm');
Route::get('structures/messages', 'Structure\MessageController@index')->name('sListeMessage');
Route::get('structures/messages/bilan', 'Structure\MessageController@bilan')->name('sBilanMessage');
Route::get('structures/messages/{id}/details', 'Structure\MessageController@details')->name('sDetailsMessage');

Route::get('structures/{id}/profil', 'Structure\CompteController@edit')->name('sCompte');
Route::post('structures/{id}/profil/update', 'Structure\CompteController@update')->name('sCompteUpdate');
Route::get('structures/login', 'Structure\MainController@login')->name('sLogin');
Route::post('structures/login/processing', 'Structure\LoginController@loginProcessing')->name('sLoginProcessing');

Route::get('structures/reset-password', 'Structure\ResetPasswordController@checkEmailView')->name('sResetPassword');
Route::post('structures/reset-password/processing', 'Structure\ResetPasswordController@resetPasswordProcessing')->name('sResetPasswordProcessing');

Route::get('structures/register', 'Structure\MainController@register')->name('sRegister');
Route::post('structures/register', 'Structure\LoginController@registerProcessing')->name('sRegisterProcessing');
Route::get('structures/register/success', 'Structure\LoginController@registerSuccess')->name('sRegisterSuccess');

Route::get('logout', 'Structure\LoginController@logout')->name('sLogout');

Route::get('structures/demande', 'Structure\CompteController@comptePro')->name('sDemandeComptePro');
Route::get('structures/{id}/{formule}/paiements', 'Structure\CompteController@modePaiement')->name('sModePaiement');

Route::get('structure/alerte-message', 'Structure\MessageController@alert')->name('alertStructure');

/* ETUDIANT */

Route::get('etudiants/query', 'Etudiant\LoginController@query');

Route::get('etudiants/inbox', 'Etudiant\MessageController@inbox')->name('inboxEtudiant');
Route::get('etudiants/inboxs', 'Etudiant\MessageController@inboxs')->name('inboxsEtudiant');
Route::get('etudiants/message', 'Etudiant\MessageController@details')->name('eDetailsMessage');
Route::get('etudiants/message/fetching', 'Etudiant\MessageController@messageFecting')->name('eMessageFecting');
Route::get('etudiants/message/fetching/sScreen', 'Etudiant\MessageController@messageFectingS')->name('eMessageFectingS');

Route::get('etudiants/message/{id}/details', 'Etudiant\MessageController@sDetails')->name('eSDetailsMessage');

Route::get('etudiants/login', 'Etudiant\MainController@login')->name('eLogin');
Route::post('etudiants/login/processing', 'Etudiant\LoginController@loginProcessing')->name('eLoginProcessing');

/* MEMBRE */

Route::get('membres/query', 'Membre\LoginController@query');

Route::get('membres/inbox', 'Membre\MessageController@inbox')->name('inboxMembre');
Route::get('membres/inboxs', 'Membre\MessageController@inboxs')->name('inboxsMembre');
Route::get('membres/message', 'Membre\MessageController@details')->name('mDetailsMessage');
Route::get('membres/message/fetching', 'Membre\MessageController@messageFecting')->name('mMessageFecting');
Route::get('membres/message/fetching/sScreen', 'Membre\MessageController@messageFectingS')->name('mMessageFectingS');

Route::get('membres/message/{id}/details', 'Membre\MessageController@sDetails')->name('mSDetailsMessage');

Route::get('membres/login', 'Membre\MainController@login')->name('mLogin');
Route::post('membres/login/processing', 'Membre\LoginController@loginProcessing')->name('mLoginProcessing');


