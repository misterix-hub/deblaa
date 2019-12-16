<?php

namespace App\Http\Controllers\Structure;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\User;
use Illuminate\Http\Request;

class MembreController extends Controller
{
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
        $emails = User::where('telephone', $request->telephone)->get();

        if (count($emails) != 0) {
            
            foreach ($emails as $email) {
                $password = $email->password;
                break;
            }

            $user = new User;
            $user->name = $request->nomComplet;
            $user->telephone = $request->telephone;
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
            $user->telephone = $request->telephone;
            $user->fonction = $request->role;
            $user->departement_id = $request->groupe;
            $user->password = bcrypt($password);
            $user->save();
            session()->put('msg_tel', $request->telephone);
            session()->put('msg_pwd', "Chèr (e) " . $request->nomComplet . ", votre compte Déblaa est créé et voici votre mot de passe : " . $password . ". Connectez-vous ici: https://deblaa.com/public/membres/login");

            return redirect(route('sListeMembre'))->with('success', "Membre ajouté avec succès !");
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
