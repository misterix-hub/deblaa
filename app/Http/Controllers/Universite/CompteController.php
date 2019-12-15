<?php

namespace App\Http\Controllers\Universite;

use App\Http\Controllers\Controller;
use App\Models\Universite;
use Illuminate\Http\Request;
use App\Models\Niveau;
use App\Models\Filiere;

class CompteController extends Controller
{
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!session()->has('id')) {
            abort('404');
        } else {
            return view('universite.compte.profil', [
                'niveaux' => Niveau::all(),
                'filieres' => Filiere::where('universite_id', session()->get('id'))->get(),
                'universite' => Universite::findOrFail($id)
            ]);
        }

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
        if (trim($request->input('sigle')) == "" || trim($request->input('nom')) == "" || trim($request->input('site_web')) == "") {
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
}
