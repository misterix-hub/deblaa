<?php

namespace App\Http\Controllers\Universite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Filiere;
use App\Models\FiliereNiveau;
use App\Repositories\FiliereRepository;
use App\Models\Niveau;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** @var  FiliereRepository */
    private $filiereRepository;

    public function __construct(FiliereRepository $filiereRepo)
    {
        $this->filiereRepository = $filiereRepo;
    }

    public function index()
    {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.filiere.liste', [
                'niveaux' => Niveau::all(),
                'filieres' => Filiere::where('universite_id', session()->get('id'))->get(),
                'filiere_niveaux' => Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get()
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
        if (trim($request->nom) == "") {
            return redirect(route('uListeFiliere'))->with('error', "Impossible de retourner un champs vide !");
        } else {

            $niveaux = $request->niveaux;

            if(empty($niveaux)) {
                return redirect(route('uListeFiliere'))->with('error', "Sélectionnez au moins un niveau !");
            } else {
                $filiere = $this->filiereRepository->create([
                    'nom' => $request->nom,
                    'universite_id' => session()->get('id')
                ]);
    
                if (is_array($niveaux) || is_object($niveaux)){
                    foreach ($niveaux as $niveau) {
                        $filiere_niveau = FiliereNiveau::create([
                            'filiere_id' => $filiere->id,
                            'niveau_id' => $niveau
                        ]);
                    }
                }
    
                return redirect(route('uListeFiliere'))->with('success', "Filière ajoutée avec succès !");
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
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.filiere.details', [
                'niveaux' => Niveau::all(),
                'filieres' => Filiere::where('id', $id)->get(),
                'filiere_niveaux' => Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('universite.filiere.modifier', [
            'niveaux' => Niveau::all(),
            'filieres' => Filiere::where('id', $id)->get(),
            'filiere_niveaux' => Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get()
        ]);
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
        if (trim($request->nom) == "") {
            return redirect(route('uListeFiliere'))->with('error', "Impossible de retourner un champs vide !");
        } else {

            $filiere = Filiere::findOrFail($id);
            $filiere->nom = $request->nom;
            $filiere->save();

            $niveaux = $request->niveaux;

            if(!empty($niveaux)) {
    
                if (is_array($niveaux) || is_object($niveaux)){

                    $del_filiereNiveau = FiliereNiveau::where('filiere_id', $id);
                    $del_filiereNiveau->forceDelete();

                    foreach ($niveaux as $niveau) {
                        $filiere_niveau = FiliereNiveau::create([
                            'filiere_id' => $filiere->id,
                            'niveau_id' => $niveau
                        ]);
                    }
                }
                
            }
            return redirect(route('uListeFiliere'))->with('success', "Filière mise à jour avec succès !");
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
        $filiere = Filiere::findOrFail($id);
        $filiere->delete();

        $del_filiereNiveau = FiliereNiveau::where('filiere_id', $id);
        $del_filiereNiveau->forceDelete();

        return redirect(route('uListeFiliere'))->with('success', "Filière supprimée avec succès !");
    }
}
