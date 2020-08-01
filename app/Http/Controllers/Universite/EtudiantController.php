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
use League\Flysystem\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkUniversiteSessionId');
        $this->middleware('checkMessageBonusUniversite')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response|Factory|View
     */
    public function index()
    {
        return view('universite.etudiant.liste', [
            'niveaux' => Niveau::all(),
            'filieres' => Filiere::where('universite_id', session()->get('id'))->get(),
            'fil_nivos' => FiliereNiveau::all(),
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
                ->get(),
            'messages' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
            'messageCount' => MessageUniversite::where('universite_id', session()->get('id'))->get()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create(Filiere $filiere, $slug, $niveau)
    {
        $niveau = intval($niveau);
        $niveaux = Niveau::all();
        $filieres = Filiere::where('universite_id', session()->get('id'))->get();
        $filiere_niveaux = FiliereNiveau::where('filiere_id', $filiere->id)->get();
        $users = Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
            ->where('universite_id', session()->get('id'))
            ->where('users.id', '<>', null)
            ->groupBy('users.telephone')
            ->get();
        $userCount = Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
            ->where('universite_id', session()->get('id'))
            ->where('users.id', '<>', null)
            ->groupBy('users.telephone')
            ->get();
        $messages = MessageUniversite::where('universite_id', session()->get('id'))->get();
        $messageCount = MessageUniversite::where('universite_id', session()->get('id'))->get();
        $pays = Pays::all()->sortBy('nom_fr_fr');

        return view('universite.etudiant.create', compact('niveaux', 'filieres', 'filiere_niveaux', 'userCount', 'users', 'messageCount', 'messages', 'pays', 'filiere', 'niveau'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
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
                'filiere.required' => 'La filiere n\'a pas été renseignée'
            ]);

        $telephone =  substr($_POST['code_select'], 1).$request->input('telephone');

        $ckech_filiere_niveau = FiliereNiveau::where('filiere_id', intval($request->filiere))
                                                ->where('niveau_id', intval($request->niveau))
                                                ->get();


        if (count($ckech_filiere_niveau) == 0) {
            return redirect(route('uListeEtudiant'))->with('error', "Filière et niveau non conformes");
        } else {

            // $verify_students = User::where('telephone', $telephone)
            //     ->where('filiere_id', '<>', null)
            //     ->where('niveau_id', '<>', null)
            //     ->get();

            $emails = User::where('telephone' , $telephone)->get();

            // if (count($verify_students) != 0) {
            //     return back()->with('error', 'L\'étudiant que vous essayez d\'enregistrer existe déja .');
            // }
            $filiere_nom = Filiere::where('id', $request->filiere)->get('acronyme')->first()->acronyme;

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
                $user->acronyme_niveau = $filiere_nom . $request->niveau;
                $user->password = $password;
                $user->save();

                return redirect(route('uListeFiliere'))->with('success', "L'étudiant est enregistré avec succès !");
            } else {
                $password = "DB" . rand(1021, 9999);

                $user = new User;
                $user->name = $request->nomComplet;
                $user->email = $telephone . time() . "@example.com";
                $user->telephone = $telephone;
                $user->filiere_id = $request->filiere;
                $user->niveau_id = $request->niveau;
                $user->acronyme_niveau = $filiere_nom . $request->niveau;
                $user->password = bcrypt($password);
                $user->access_id = Str::random(15).Str::substr(Hash::make($password), 7);
                $user->save();

                session()->put('msg_tel', $telephone);
                session()->put('msg_pwd', "Chèr (e) " . $request->nomComplet . ", votre compte Déblaa est crée et voici votre mot de passe : " . $password . ". Ce compte vous permettra désormais de recevoir des fichiers multimedia (images, vidéos ...) et documents (word, pdf ...) par SMS.  Connectez-vous ici: https://deblaa.com/etudiants/login");

                return redirect(route('uListeFiliere'))->with('success', "L'étudiant est enregistré avec succès !".$password);
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

    public function ajaxListStudent(Request $request) {
        if ($request->data == '') {
            $users = Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                ->where('universite_id', session()->get('id'))
                ->where('users.id', '<>', null)
                ->groupBy('users.telephone')
                ->get();
            $niveaux = Niveau::all();
            $filieres = Filiere::where('universite_id', session()->get('id'))->get();

        } else {
            $users = Filiere::join('users', 'filieres.id', 'filiere_id')
                ->where('universite_id', session()->get('id'))
                ->where('users.filiere_id', substr($request->data, 0, 1))
                ->where('users.niveau_id', substr($request->data, 1))
                ->where('users.id', '<>', null)
                ->groupBy('users.telephone')
                ->get();
            $niveaux = Niveau::all();
            $filieres = Filiere::where('universite_id', session()->get('id'))->get();
        }
        return view('universite.etudiant.ajaxListStudent', compact('users', 'niveaux', 'filieres'));
    }

    /*public function ajaxContactSpinneret(Request $request) {

        $contacts = Filiere::join('users', 'filieres.id', 'filiere_id')
            ->where('filieres.universite_id', session()->get('id'))
            ->where('users.filiere_id', '<>', $request->filiere)
            ->where('users.niveau_id', '<>', $request->niveau)
            ->where('users.telephone', '<>', 'null')
            ->where('users.id', '<>', null)
            ->groupBy('users.telephone')
            ->get();

        return view('universite.etudiant.ajaxList', compact('contacts'));
    }*/

    public function listContactBySpinneret(Filiere $filiere, $slug, $niveau) {

        $niveau = intval($niveau);

        $filiere_acronyme = Filiere::where('id', $filiere->id)->get('acronyme')->first()->acronyme;
        $acronyme_niveau = $filiere_acronyme . $niveau;

        $niveaux = Niveau::all();
        $filieres = Filiere::where('universite_id', session()->get('id'))->get();
        $filiere_niveaux = Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get();
        $users = Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
            ->where('universite_id', session()->get('id'))
            ->where('users.id', '<>', null)
            ->groupBy('users.telephone')
            ->get();
        $userCount = Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
            ->where('universite_id', session()->get('id'))
            ->where('users.id', '<>', null)
            ->groupBy('users.telephone')
            ->get();
        $messages = MessageUniversite::where('universite_id', session()->get('id'))->get();
        $messageCount = MessageUniversite::where('universite_id', session()->get('id'))->get();

        //     ->where('users.telephone', '<>', 'null')
        //     ->where('users.departement_id', null)
        //     ->where('users.id', '<>', null)
        //     ->groupBy('users.telephone')
        //     ->orderBy('users.name')

        $contacts = Filiere::join('users', 'filieres.id', 'filiere_id')
            ->where([
                ['filieres.universite_id', '=', session()->get('id')],
                ['users.filiere_id', '<>', null],
                ['users.niveau_id', '<>', null],
                ['users.acronyme_niveau', '<>', $acronyme_niveau],
                ['users.telephone', '<>', null],
                ['users.departement_id', '=', null],
                ['users.id', '<>', null]
            ])
            ->groupBy('users.telephone')
            ->orderBy('users.name')
            ->get();


        return view('universite.etudiant.listBySpinneret', compact('niveaux', 'filieres', 'filiere_niveaux', 'users', 'userCount', 'messageCount', 'messages', 'filiere', 'contacts', 'niveau', 'acronyme_niveau'));
    }

    public function insertContact(Request $request) {

        $request->validate([
            'filiere' => 'required',
            'student' => 'required'
        ], [
            'filiere.required' => 'Impossible d\'ajouter un ou plusieurs étudiants sans filière',
            'student.required' => 'Veuillez sélectionner au moins un étudiant'
        ]);

        $students = $request->input('student');

        if ($students === null) {
            return back()->with('error', 'Veuillez sélectionner au moins un contact');
        }

        if (is_array($students)) {

            /*$verify_contact = [];*/
            $insert_contact = [];

            foreach ($students as $student) {
                //$check_membre = User::where(['telephone' => $membre, 'departement_id' => $request->input('department')])->get();

               /* if (count($check_membre) != 0) {
                    foreach ($check_membre as $item) {
                        $verify_contact[] = $item->telephone;
                    }
                } else {*/
                    $contact = User::where('telephone', $student)->get();

                    foreach ($contact as $item) {
                        $name = $item->name;
                        $password = $item->password;
                        $access_id = $item->access_id;
                        break;
                    }
                    User::create([
                        'name' => $name,
                        'password' => $password,
                        'filiere_id' => $request->input('filiere'),
                        'niveau_id' => $request->input('niveau'),
                        'acronyme_niveau' => $request->input('acronyme_niveau'),
                        'access_id' => $access_id,
                        'telephone' => $student
                    ]);
                    $insert_contact[] = $student;
                /*}*/
            }

            //$requestNomDepartement = Departement::where('id', $request->input('department'))->first();
            //$nomDepartement = $requestNomDepartement->nom;

            return redirect()->route('uListeFiliere')->with('success', count($insert_contact) > 1 ? 'Les étudiants sélectionnés ont bien été enregistrés dans la filière' : 'L\'étudiant sélectionné a bien été enregistré dans la filière');

        }
    }
}
