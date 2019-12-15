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

        if (count(User::where('telephone', $request->telephone)->get()) != 0) {
            return back()->with('error', "Numéro de téléphone déjà utilisé !");
        } else {
            $password = "PT" . rand(0121201101, 32145999990);

            $user = new User;
            $user->name = $request->nomComplet;
            $user->email = $request->telephone . "@example.com";
            $user->telephone = $request->telephone;
            $user->fonction = $request->role;
            $user->departement_id = $request->groupe;
            $user->password = bcrypt($password);
            $user->save();

            return redirect(route('sListeMembre'))->with('success', "Membre ajouté avec succès !".$password);
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
