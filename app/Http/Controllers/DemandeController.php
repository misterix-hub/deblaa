<?php

namespace App\Http\Controllers;

use App\DemandeStructure;
use App\DemandeUniversite;
use App\Http\Controllers\Controller;
use App\Models\Structure;
use App\Models\Universite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DemandeController extends Controller
{
    public function totalDemande() {

        $accordsStructure = DemandeStructure::where('accord', 0)->get();

        $totalAccordStructure = count($accordsStructure);

        $accordsUniversite = DemandeUniversite::where('accord', 0)->get();

        $totalAccordUniversite = count($accordsUniversite);

        $totauxAccords = $totalAccordStructure + $totalAccordUniversite;

        return $totauxAccords;

    }

    public function indexDemandes() {

        $demandesStructure = DemandeStructure::where('accord', 0)->get();
        $demandesUniversite = DemandeUniversite::where('accord', 0)->get();

        return view('demandes.index', compact('demandesStructure', 'demandesUniversite'));
    }



    public function accordStructureProcessing(Request $request, $id) {

        $accordStructure = DemandeStructure::findOrFail($id);

        DB::update("UPDATE demande_structures SET accord = 1, updated_at = ? WHERE id = ?", [
           now(), $accordStructure->id
        ]);

        $checkEmails = Structure::where('id', $accordStructure->structure_id)->get();

        foreach ($checkEmails as $checkEmail) {

            $to_name = "Deblaa";

            $to_email = $checkEmail->email;

            $data = array(
                'nom' => $checkEmail->sigle,
            );

            \Mail::send('mails.comptepro.structure',$data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email)
                    ->subject("Votre compte professionnel deblaa activé");
            });

        }

        return back()->with('success', 'Structure passée en compte professionnel avec succès');
    }

    public function accordUniversiteProcessing(Request $request, $id) {
        $accordUniversite = DemandeUniversite::findOrFail($id);

        DB::update("UPDATE demande_universites SET accord = 1, updated_at = ? WHERE id = ?", [
            now(), $accordUniversite->id
        ]);

        $checkEmails = Universite::where('id', $accordUniversite->universite_id)->get();

        foreach ($checkEmails as $checkEmail) {

            $to_name = "Deblaa";

            $to_email = $checkEmail->email;

            $data = array(
                'nom' => $checkEmail->sigle,
            );

            \Mail::send('mails.comptepro.universite',$data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email)
                    ->subject("Votre compte professionnel deblaa activé");
            });

        }

        return back()->with('success', 'Université passée en compte professionnel avec succès');
    }
}
