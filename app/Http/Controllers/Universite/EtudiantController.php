<?php

namespace App\Http\Controllers\Universite;

use App\Http\Controllers\Controller;
use App\MessageUniversite;
use App\Pays;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Niveau;
use App\Models\Filiere;
use App\Models\FiliereNiveau;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class EtudiantController extends Controller
{

    public function __construct()
    {
        return $this->middleware('checkMessageBonusUniversite')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response|Factory|View
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
                'userCount' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                    ->where('universite_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->get(),
                'messages' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
                'messageCount' => MessageUniversite::where('universite_id', session()->get('id'))->get()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create(Filiere $filiere)
    {
        $niveaux = Niveau::all();
        $filieres = Filiere::where('universite_id', session()->get('id'))->get();
        $filiere_niveaux = Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get();
        $users = Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
            ->where('universite_id', session()->get('id'))
            ->where('users.id', '<>', null)
            ->get();
        $userCount = Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
            ->where('universite_id', session()->get('id'))
            ->where('users.id', '<>', null)
            ->get();
        $messages = MessageUniversite::where('universite_id', session()->get('id'))->get();
        $messageCount = MessageUniversite::where('universite_id', session()->get('id'))->get();
        $pays = Pays::all()->sortBy('nom_fr_fr');

        return view('universite.etudiant.create', compact('niveaux', 'filieres', 'filiere_niveaux', 'userCount', 'users', 'messageCount', 'messages', 'pays', 'filiere'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|Redirector
     */
    public function store(Request $request)
    {

        $request->validate([
            'telephone' => 'required',
            'nomComplet' => 'required',
            'niveau' => 'required',
            'filiere' => 'required'
        ],
            [
                'telephone.required' => 'Veuillez entrer le numero de telephone',
                'nomComplet.required' => 'Veuillez entrer votre nom',
                'niveau.required' => 'Veuillez entrer le niveau',
                'filiere.required' => 'Veuillez sélectionner la filiere'
            ]);

        $telephone =  substr($_POST['code_select'], 1).$request->input('telephone');

        $ckech_filiere_niveau = FiliereNiveau::where('filiere_id', $request->filiere)
                                                ->where('niveau_id', $request->niveau)
                                                ->get();
        if (count($ckech_filiere_niveau) == 0) {
            return redirect(route('uListeEtudiant'))->with('error', "Filière et niveau non conformes");
        } else {

            $emails = User::where('telephone', $telephone)->get();

            if (count($emails) != 0) {

                foreach ($emails as $email) {
                    $password = $email->password;
                    break;
                }

                $user = new User;
                $user->name = $request->nomComplet;
                $user->telephone = $telephone;
                $user->filiere_id = $request->filiere;
                $user->niveau_id = $request->niveau;
                $user->password = $password;
                $user->save();

                return redirect(route('uListeEtudiant'))->with('success', "Étudiant ajouté avec succès !");
            } else {
                $password = "DB" . rand(1021, 9999);

                $user = new User;
                $user->name = $request->nomComplet;
                $user->email = $telephone . time() . "@example.com";
                $user->telephone = $telephone;
                $user->filiere_id = $request->filiere;
                $user->niveau_id = $request->niveau;
                $user->password = bcrypt($password);
                $user->save();

                session()->put('msg_tel', $telephone);
                session()->put('msg_pwd', "Chèr (e) " . $request->nomComplet . ", votre compte Déblaa est créé et voici votre mot de passe : " . $password . ". Ce compte vous permettra désormais de recevoir des fichiers multimedia (images, vidéos ...) et documents (word, pdf ...) par SMS.  Connectez-vous ici: https://deblaa.com/etudiants/login");

                return redirect(route('uListeEtudiant'))->with('success', "Étudiant ajouté avec succès !".$password);
            }


        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response|RedirectResponse
     */
    public function update(Request $request, $id)
    {
        return redirect(route('uListeEtudiant'))->with('success', "Étudiant mis à jour avec succès !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect(route('uListeEtudiant'))->with('success', "Étudiant supprimé avec succès !");
    }

    public function ajaxContactSpinneret(Request $request) {

        $contacts = Filiere::join('users', 'filieres.id', 'filiere_id')
            ->where('filieres.universite_id', session()->get('id'))
            ->where('users.filiere_id', '<>', $request->filiere)
            ->where('users.niveau_id', '<>', $request->niveau)
            ->where('users.telephone', '<>', 'null')
            ->where('users.id', '<>', null)
            ->groupBy('users.telephone')
            ->get();

        return view('universite.etudiant.ajaxList', compact('contacts'));
    }

    public function listContactBySpinneret(Filiere $filiere) {

        $niveaux = Niveau::all();
        $filieres = Filiere::where('universite_id', session()->get('id'))->get();
        $filiere_niveaux = Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get();
        $users = Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
            ->where('universite_id', session()->get('id'))
            ->where('users.id', '<>', null)
            ->get();
        $userCount = Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
            ->where('universite_id', session()->get('id'))
            ->where('users.id', '<>', null)
            ->get();
        $messages = MessageUniversite::where('universite_id', session()->get('id'))->get();
        $messageCount = MessageUniversite::where('universite_id', session()->get('id'))->get();




        return view('universite.etudiant.listBySpinneret', compact('niveaux', 'filieres', 'filiere_niveaux', 'users', 'userCount', 'messageCount', 'messages', 'filiere'));
    }

    public function insertContact(Request $request) {

    }
}
