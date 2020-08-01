<?php

namespace App\Http\Controllers\Universite;

use App\DemandeUniversite;
use App\Http\Controllers\Controller;
use App\Models\Universite;
use Illuminate\Http\Request;
use App\Models\Niveau;
use App\Models\Filiere;
use App\MessageUniversite;

class CompteController extends Controller
{

    public function __construct() {
        return $this->middleware('checkUniversiteSessionId');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory
     */
    public function edit(Universite $universite)
    {
        return view('universite.compte.profil', [
            'niveaux' => Niveau::all(),
            'filieres' => Filiere::where('universite_id', session()->get('id'))->get(),
            'universite' => Universite::findOrFail($id),
            'messages' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
            'messageCount' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
            'filiere_niveaux' => Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get(),
            'users' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                    ->where('universite_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->groupBy('users.telephone')
                    ->get(),
            'userCount' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                ->where('universite_id', session()->get('id'))
                ->where('users.id', '<>', null)
                ->groupBy('users.telephone')
                ->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Universite $universite)
    {
        if (trim($request->input('sigle')) == "" || trim($request->input('nom')) == "") {
            return back()->with('error', 'Modification invalide, veuillez ne laisser aucun champ vide !');
        } else {

            $compte = Universite::findOrFail($id);
            $compte->sigle = $request->input('sigle');
            $compte->nom = $request->input('nom');
            $compte->email = $request->input('email');
            $compte->telephone = $request->input('telephone');
            $compte->site_web = $request->input('site_web');

            $compte->save();

            if ($_FILES["logo"]["name"] != "") {
                $compte = Universite::findOrFail($id);

                $target_dir = "db/logos/universite/";
                $file_name = time() . "_" . basename($_FILES["logo"]["name"]);

                $target_file = $target_dir . $file_name;
                $fileType = strtolower(pathinfo(basename($_FILES["logo"]["name"]), PATHINFO_EXTENSION));

                if ($fileType != 'jpg' && $fileType != 'jpeg' && $fileType != 'png') {
                    return back()->with('error', 'le type du fichier n\'est pas pris en charge !');
                } else {
                    $compte->logo = $file_name;
                    $compte->save();

                    move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);
                }

            }

            session()->put('logo', $compte->logo);
            session()->put('sigle', $compte->sigle);
            session()->put('email', $compte->email);
            session()->put('nom', $compte->nom);
            session()->put('site_web', $compte->site_web);

            return redirect(route('indexUniversite'))->with('success', 'Votre profil a bien été mis à jour avec succès');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function comptePro() {

        if (count(Universite::where('id', session()->get('id'))->where('pro', 1)->get()) != 0) {

            $universite = Universite ::findOrFail(session()->get('id'));
            $universite->message_bonus = 1000 + session()->get('message_bonus');
            $universite->save();

            session()->put('message_bonus', $universite->message_bonus);

            return back()->with('success', "Compte rechargé avec succès !");

        } else {
            $universite = Universite ::findOrFail(session()->get('id'));
            $universite->message_bonus = 1000 + session()->get('message_bonus');
            $universite->pro = 1;
            $universite->save();

            session()->put('message_bonus', $universite->message_bonus);
            session()->put('pro', 1);

            return back()->with('success', "Compte rechargé avec succès !");
        }
    }


    public function modePaiement($id, $formule) {
        switch ($formule) {
            case 1:
                $montant = 20000;
                $nbm = 1000;
                break;

            case 2:
                $montant = 150000;
                $nbm = "100 000";
                break;

            case 3:
                $montant = 500000;
                $nbm = "500 000";
                break;

            default:
                return back();
                break;
        }

        $to_name = "Deblaa";

        $to_email = "deblaa.ap@gmail.com";
        $data = array(
            'nom' => session()->get('sigle'),
            'email' => session()->get('email'),
            "montant" =>$montant
        );

        \Mail::send('mails.universite_sms', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email)
                    ->subject("Alterte de recharge de messages");
        });

        return view('universite.mode_paiement', [
            'niveaux' => Niveau::all(),
            'filieres' => Filiere::where('universite_id', session()->get('id'))->get(),
            'messages' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
            'messageCount' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
            'users' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                ->where('universite_id', session()->get('id'))
                ->where('users.id', '<>', null)
                ->get(),
            'userCount' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                ->where('universite_id', session()->get('id'))
                ->where('users.id', '<>', null)
                ->get(),
            'montant' => $montant,
            'id' => $id,
            'nbm' => $nbm
        ]);
    }
}
