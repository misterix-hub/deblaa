<?php

namespace App\Http\Controllers\Structure;

use App\Http\Controllers\Controller;
use App\Models\Structure;
use Illuminate\Http\Request;
use Psy\Util\Str;
use App\Models\Departement;
use App\MessageStructure;
use App\DemandeStructure;

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
            return view('structure.compte.profil', [
                'structure' => Structure::findOrFail($id),
                'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
                'messages' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                'users' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->get()
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

            $compte = Structure::findOrFail($id);
            $compte->sigle = $request->input('sigle');
            $compte->nom = $request->input('nom');
            $compte->email = $request->input('email');
            $compte->telephone = $request->input('telephone');
            $compte->site_web = $request->input('site_web');

            $compte->save();

            if ($_FILES["logo"]["name"] != "") {
                $compte = Structure::findOrFail($id);

                $target_dir = "db/logos/structure/";
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

            return redirect(route('indexStructure'))->with('success', 'Votre profil a bien été mis à jour avec succès');
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
        if (count(DemandeStructure::where('structure_id', session()->get('id'))->get()) != 0) {
            return back()->with('warningDemande', "true");
        } else {
            $demande_structure = new DemandeStructure;
            $demande_structure->structure_id = session()->get('id');
            $demande_structure->accord = 0;
            $demande_structure->save();

            return back()->with('successDemande', "true");
        }
        
    }
}
