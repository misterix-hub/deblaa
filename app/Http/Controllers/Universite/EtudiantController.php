<?php

namespace App\Http\Controllers\Universite;

use App\Http\Controllers\Controller;
use App\MessageUniversite;
use Illuminate\Http\Request;
use App\Models\Niveau;
use App\Models\Filiere;
use App\Models\FiliereNiveau;
use App\User;

class EtudiantController extends Controller
{

    public function __construct()
    {
        return $this->middleware('checkMessageBonusUniversite')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.etudiant.liste', [
                'niveaux' => Niveau::all(),
                'filieres' => Filiere::where('universite_id', session()->get('id'))->get(),
                'filiere_niveaux' => Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get(),
                'users' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                            ->where('universite_id', session()->get('id'))
                            ->where('users.id', '<>', null)
                            ->get(),
                'messages' => MessageUniversite::where('universite_id', session()->get('id'))->get()
            ]);
        }
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

        $request->validate([
            'telephone' => 'required|regex:/(\+228)[9]([0-9]){7}/',
            'nomComplet' => 'required',
            'niveau' => 'required',
            'filiere' => 'required'
        ],
            [
                'telephone.required' => 'Veuillez entrer le numero de telephone',
                'telephone.regex' => 'Numero invalide !',
                'nomComplet.required' => 'Veuillez entrer votre nom',
                'niveau.required' => 'Veuillez entrer le niveau',
                'filiere.required' => 'Veuillez sélectionner la filiere'
            ]);

        $ckech_filiere_niveau = FiliereNiveau::where('filiere_id', $request->filiere)
                                                ->where('niveau_id', $request->niveau)
                                                ->get();
        if (count($ckech_filiere_niveau) == 0) {
            return redirect(route('uListeEtudiant'))->with('error', "Filière et niveau non conformes");
        } else {

            $emails = User::where('telephone', $request->telephone)->get();

            if (count($emails) != 0) {

                foreach ($emails as $email) {
                    $password = $email->password;
                    break;
                }

                $user = new User;
                $user->name = $request->nomComplet;
                $user->telephone = substr($request->telephone, 1);;
                $user->filiere_id = $request->filiere;
                $user->niveau_id = $request->niveau;
                $user->password = $password;
                $user->save();

                return redirect(route('uListeEtudiant'))->with('success', "Étudiant ajouté avec succès !");
            } else {
                $password = "DB" . rand(1021, 9999);

                $user = new User;
                $user->name = $request->nomComplet;
                $user->email = $request->telephone . time() . "@example.com";
                $user->telephone = substr($request->telephone, 1);;
                $user->filiere_id = $request->filiere;
                $user->niveau_id = $request->niveau;
                $user->password = bcrypt($password);
                $user->save();

                session()->put('msg_tel', $request->telephone);
                session()->put('msg_pwd', "Chèr (e) " . $request->nomComplet . ", votre compte Déblaa est créé et voici votre mot de passe : " . $password . ". Ce compte vous permettra désormais de recevoir des fichiers multimedia (images, vidéos ...) et documents (word, pdf ...) par SMS.  Connectez-vous ici: https://deblaa.com/etudiants/login");

                return redirect(route('uListeEtudiant'))->with('success', "Étudiant ajouté avec succès !");
            }


        }

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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect(route('uListeEtudiant'))->with('success', "Étudiant mis à jour avec succès !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect(route('uListeEtudiant'))->with('success', "Étudiant supprimé avec succès !");
    }
}
