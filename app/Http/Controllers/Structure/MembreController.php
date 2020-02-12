<?php

namespace App\Http\Controllers\Structure;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\User;
use Illuminate\Http\Request;
use App\MessageStructure;

class MembreController extends Controller
{

    public function __construct()
    {
        return $this->middleware('checkMessageBonusStructure')->only('store');
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
            return view('structure.membre.liste', [
                'messages' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                "groupes" => Departement::where('structure_id', session()->get('id'))->get(),
                "users" => Departement::leftJoin('users', 'departements.id', 'departement_id')
                                        ->where('structure_id', session()->get('id'))
                                        ->where('users.id', '<>', null)
                                        ->get()
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
            'role' => 'required',
            'groupe' => 'required'
        ],
            [
                'telephone.required' => 'Veuillez entrer le numero de telephone',
                'telephone.regex' => 'Numero invalide !',
                'nomComplet.required' => 'Veuillez entrer votre nom',
                'role.required' => 'Veuillez entrer le role',
                'groupe.required' => 'Veuillez sélectionner le groupe'
            ]);
        if ($request->groupe == "") {
            return back()->with('error', "Impossble d'ajouter un membre sans groupe !");
        } else {
            $check_membre = User::where('telephone', $request->telephone)->where('departement_id', $request->groupe)->get();

            if (count($check_membre) != 0) {
                return back()->with('error', "Membre déjà ajouté !");
            } else {
                $emails = User::where('telephone', $request->telephone)->get();

                if (count($emails) != 0) {

                    foreach ($emails as $email) {
                        $password = $email->password;
                        break;
                    }

                    $user = new User;
                    $user->name = $request->nomComplet;
                    $user->telephone = substr($request->telephone, 1);
                    $user->fonction = $request->role;
                    $user->departement_id = $request->groupe;
                    $user->password = $password;
                    $user->save();

                    return redirect(route('sListeMembre'))->with('success', "Membre ajouté avec succès !");

                } else {
                    $password = "DB" . rand(1021, 9999);

                    $user = new User;
                    $user->name = $request->nomComplet;
                    $user->email = $request->telephone . "@example.com";
                    $user->telephone = substr($request->telephone, 1);
                    $user->fonction = $request->role;
                    $user->departement_id = $request->groupe;
                    $user->password = bcrypt($password);
                    $user->save();
                    session()->put('msg_tel', $request->telephone);
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
        //
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
        return redirect(route('sListeMembre'))->with('success', "Membre supprimé avec succès !");
    }
}
