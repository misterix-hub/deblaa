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
                'users' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                                ->where('universite_id', session()->get('id'))
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
        $ckech_filiere_niveau = FiliereNiveau::where('filiere_id', $request->filiere)
                                                ->where('niveau_id', $request->niveau)
                                                ->get();
        if (count($ckech_filiere_niveau) == 0) {
            return redirect(route('uListeEtudiant'))->with('error', "Filière et niveau non conformes");
        } else {

            if (count(User::where('telephone', $request->telephone)->get()) != 0) {
                return back()->with('error', "Numéro de téléphone déjà utilisé !");
            } else {
                $password = "ET" . rand(0121201101, 32145999990);
                
                $user = new User;
                $user->name = $request->nomComplet;
                $user->email = $request->telephone . "@example.com";
                $user->telephone = $request->telephone;
                $user->filiere_id = $request->filiere;
                $user->niveau_id = $request->niveau;
                $user->password = bcrypt($password);
                $user->save();
    
                return redirect(route('uListeEtudiant'))->with('success', "Étudiant ajouté avec succès !" . $password);
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
