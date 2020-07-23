<?php

namespace App\Http\Controllers\Structure;


use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Pays;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\MessageStructure;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class MembreController extends Controller
{

    public function __construct()
    {
        return $this->middleware('checkMessageBonusStructure')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response|Factory
     */
    public function index()
    {
        if (!session()->has('id')) {
            return redirect(route('sLogin'))->with('error', 'Veuillez vous connecter....');
        } else {
            return view('structure.membre.liste', [
                'messages' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                'messageCount' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                "groupes" => Departement::where('structure_id', session()->get('id'))->get(),
                "users" => Departement::leftJoin('users', 'departements.id', 'departement_id')
                                        ->where('structure_id', session()->get('id'))
                                        ->where('users.id', '<>', null)
                                        ->groupBy('users.telephone')
                                        ->get(),
                "userCount" => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->groupBy('users.telephone')
                    ->get()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create(Departement $departement)
    {
        $messages = MessageStructure::where('structure_id', session()->get('id'))->get();
        $messageCount = MessageStructure::where('structure_id', session()->get('id'))->get();
        $groupes = Departement::where('structure_id', session()->get('id'))->get();
        $users = Departement::leftJoin('users', 'departements.id', 'departement_id')
        ->where('structure_id', session()->get('id'))
        ->where('users.id', '<>', null)
        ->groupBy('users.telephone')
        ->get();
        $userCount = Departement::leftJoin('users', 'departements.id', 'departement_id')
        ->where('structure_id', session()->get('id'))
        ->where('users.id', '<>', null)
        ->groupBy('users.telephone')
        ->get();
        $pays = Pays::all()->sortBy('nom_fr_fr');
        return view('structure.membre.create', compact('messageCount', 'messages', 'groupes', 'users', 'userCount', 'departement', 'pays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|Redirector|RedirectResponse
     */
    public function store(Request $request)
    {
        /*|regex:/(\+228)[9]([0-9]){7}/*/

        $request->validate([
            'telephone' => 'required',
            'nomComplet' => 'required',
            'role' => 'required',
            'groupe' => 'required',
            'pays' => 'required'
        ],
            [
                'telephone.required' => 'Veuillez entrer le numero de telephone',
                'nomComplet.required' => 'Veuillez entrer votre nom',
                'role.required' => 'Veuillez entrer le rôle',
                'groupe.required' => 'Veuillez sélectionner le groupe',
                'pays.required' => 'Veuillez choisir un pays'
            ]);
        if ($request->groupe == "") {
            return back()->with('error', "Impossble d'ajouter un membre sans groupe !");
        } else {

            $telephone =  substr($_POST['code_select'], 1).$request->input('telephone');

            $check_membre = User::where('telephone', $telephone)->where('departement_id', $request->groupe)->get();

            if (count($check_membre) != 0) {
                return back()->with('error', "Membre déjà ajouté à ce groupe!");
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
                    $user->fonction = $request->role;
                    $user->departement_id = $request->groupe;
                    $user->password = $password;
                    $user->save();

                    return redirect(route('sListeMembre'))->with('success', "Membre ajouté avec succès !");

                } else {
                    $password = "DB" . rand(1021, 9999);

                    $user = new User;
                    $user->name = $request->nomComplet;
                    $user->email = $_POST['code_select']. $request->input('telephone') . time()  . "@example.com";
                    $user->telephone = $telephone;
                    $user->fonction = $request->role;
                    $user->departement_id = $request->groupe;
                    $user->password = bcrypt($password);
                    $user->save();
                    session()->put('msg_tel', $telephone);
                    session()->put('msg_pwd', "Chèr (e) " . $request->nomComplet . ", votre compte Deblaa est créé et voici votre mot de passe : " . $password . ". Ce compte vous permettra désormais de recevoir des fichiers multimedia (images, vidéos ...) et documents (word, pdf ...) par SMS. Connectez-vous ici: https://deblaa.com/membres/login");

                    return redirect(route('sListeMembre'))->with('success', "Membre ajouté avec succès !");
                }
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
        return redirect(route('sListeMembre'))->with('success', "Membre supprimé avec succès !");
    }


    public function listContactByDepartment(Departement $departement) {
        $messages = MessageStructure::where('structure_id', session()->get('id'))->get();
        $messageCount = MessageStructure::where('structure_id', session()->get('id'))->get();
        $groupes = Departement::where('structure_id', session()->get('id'))->get();
        $users = Departement::leftJoin('users', 'departements.id', 'departement_id')
            ->where('structure_id', session()->get('id'))
            ->where('users.id', '<>', null)
            ->groupBy('users.telephone')
            ->get();
        $userCount = Departement::leftJoin('users', 'departements.id', 'departement_id')
            ->where('structure_id', session()->get('id'))
            ->where('users.id', '<>', null)
            ->groupBy('users.telephone')
            ->get();

        /*$members = Departement::leftJoin('users', 'departements.id', 'departement_id')
            ->where('structure_id', session()->get('id'))
            ->where('users.departement_id', 2)
            ->where('users.telephone', '22898727268')
            ->where('users.id', '<>', null)
            ->groupBy('users.telephone')
            ->get();

        dd(count($members));*/

        $contacts = Departement::join('users', 'departements.id', 'departement_id')
            ->where('structure_id', session()->get('id'))
            ->where('users.departement_id', '<>', $departement->id)
            ->where('users.telephone', '<>', 'null')
            ->where('users.id', '<>', null)
            ->groupBy('users.telephone')
            ->get();


        return view('structure.membre.listByDepartment', compact('messages', 'messageCount', 'groupes', 'users', 'userCount', 'contacts', 'departement'));
    }

    public function insertContact(Request $request) {

        $request->validate([
            'department' => 'required',
            'membre' => 'required'
        ], [
            'department.required' => 'Impossible d\'ajouter un ou plusieurs membres sans groupe',
            'membre.required' => 'Veuillez sélectionner au moins un membre'
        ]);

        $membres = $request->input('membre');

        if ($membres === null) {
            return back()->with('error', 'Veuillez sélectionner au moins un contact');
        }

        if (is_array($membres)) {

            /*$verify_contact = [];*/
            $insert_contact = [];

            foreach ($membres as $membre) {
                //$check_membre = User::where(['telephone' => $membre, 'departement_id' => $request->input('department')])->get();

               /* if (count($check_membre) != 0) {
                    foreach ($check_membre as $item) {
                        $verify_contact[] = $item->telephone;
                    }
                } else {*/
                    $contact = User::where('telephone', $membre)->get();

                    foreach ($contact as $item) {
                        $name = $item->name;
                        $fonction = $item->fonction;
                        $password = $item->password;
                        break;
                    }
                    User::create([
                        'name' => $name,
                        'fonction' => $fonction,
                        'password' => $password,
                        'departement_id' => $request->input('department'),
                        'telephone' => $membre
                    ]);
                    $insert_contact[] = $membre;
                /*}*/
            }

            return redirect(route('sDetailsGroupe', $request->input('department')))->with('success', count($insert_contact) > 1 ? 'Les contacts sélectionnés ont bien été enregistrés dans le groupe' : 'Le contact sélectionné a bien été enregistré dans le groupe');

            /*if (count($verify_contact) != 0 && count($insert_contact) != 0) {
                return redirect(route('sListeGroupe'))->with('warning', count($insert_contact) > 1 ? 'Les contacts qui existaient dans ce groupe ne sont plus insérés. Cependant l\'insertion des autres membres a bien été effectué' : 'Les contacts qui existaient dans ce groupe ne sont plus insérés. Cependant l\'insertion du membre a bien été effectué');
            } elseif (count($verify_contact) != 0 && count($insert_contact) == 0) {
                return back()->with('error', count($verify_contact) > 1 ? 'Les contacts sélectionnés existent déjà dans le groupe choisi' : 'Le contact sélectionné existe déjà dans le groupe choisi');
            } else {
                return redirect(route('sListeGroupe'))->with('success', count($insert_contact) > 1 ? 'Les contacts sélectionnés ont bien été enregistrés dans le groupe' : 'Le contact sélectionné a bien été enregistré dans le groupe');
            }*/
        }
    }
}
