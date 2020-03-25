<?php

namespace App\Http\Controllers\Universite;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Filiere;
use App\Models\FiliereNiveau;
use App\Repositories\FiliereRepository;
use App\Models\Niveau;
use App\MessageUniversite;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
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
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
           'nom' => 'required|string',
           'acronyme' => 'required|string|min:2|max:10'
        ],
            [
                'nom.required' => 'Veuillez saisir le nom de la filière',
                'nom.string' => 'Le nom de votre filière doit être une chaîne de caractères',
                'acronyme.required' => 'Veuillez saisir l\'acronyme de la filière',
                'acronyme.string' => 'l\'acronyme de votre filière doit être une chaîne de caractères',
                'acronyme.max' => 'Acronyme trop long',
                'acronyme.min' => 'Acronyme trop court'
            ]);
        if (trim($request->nom) == "") {
            return redirect(route('uListeFiliere'))->with('error', "Impossible de retourner vide le nom de la filiere !");
        } elseif (trim($request->input('acronyme')) == "") {
            return redirect(route('uListeFiliere'))->with('error', "Impossible de retourner vide l'acronyme de la filiere !");
        } else {

            $niveaux = $request->niveaux;

            if(empty($niveaux)) {
                return redirect(route('uListeFiliere'))->with('error', "Sélectionnez au moins un niveau !");
            } else {
                $filiere = $this->filiereRepository->create([
                    'nom' => $request->nom,
                    'acronyme' => Str::upper($request->input('acronyme')),
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
     * @return Response|Factory
     */
    public function show($id)
    {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.filiere.details', [
                'niveaux' => Niveau::all(),
                'filieres' => Filiere::where('id', $id)->get(),
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response|Factory
     */
    public function edit($id)
    {
        return view('universite.filiere.modifier', [
            'niveaux' => Niveau::all(),
            'filieres' => Filiere::where('id', $id)->get(),
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

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse|Redirector
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
     * @return Response
     */
    public function destroy($id)
    {
        $filiere = Filiere::findOrFail($id);
        $filiere->delete();

        $del_filiereNiveau = FiliereNiveau::where('filiere_id', $id);
        $del_filiereNiveau->forceDelete();

        $users = User::where('filiere_id', $id);
        $users->forceDelete();

        return redirect(route('uListeFiliere'))->with('success', "Filière supprimée avec succès !");
    }
}
