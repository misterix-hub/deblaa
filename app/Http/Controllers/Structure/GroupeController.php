<?php

namespace App\Http\Controllers\Structure;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Repositories\DepartementRepository;
use Illuminate\Http\Request;
use App\MessageStructure;
use App\User;

class GroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $departementRepository;

    public function __construct(DepartementRepository $departementRepo)
    {
        $this->departementRepository = $departementRepo;
    }

    public function index()
    {
        if (!session()->has('id')) {
            return redirect(route('sLogin'));
        } else {
            return view('structure.groupe.liste', [
                'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
                'messages' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                'messageCount' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                'users' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->groupBy('users.telephone')
                    ->get(),
                'userCount' => Departement::leftJoin('users', 'departements.id', 'departement_id')
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
            return redirect(route('sListeGroupe'))->with('error', "Impossible de retourner un champs vide !");
        } else {

            $groupe = $this->departementRepository->create([
                'nom' => $request->nom,
                'structure_id' => session()->get('id')
            ]);

            return redirect(route('sListeGroupe'))->with('success', "Groupe ajouté avec succès !");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        if (!session()->has('id')) {
            return redirect(route('sLogin'));
        } else {
            return view('structure.groupe.details', [
                'groupe' => Departement::findOrFail($id),
                'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
                'messages' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                'messageCount' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                'users' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->groupBy('users.telephone')
                    ->get(),
                'userCount' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->groupBy('users.telephone')
                    ->get()
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        if (!session()->has('id')) {
            return redirect(route('sLogin'));
        } else {
            return view('structure.groupe.modifier', [
                "groupe" => Departement::findOrFail($id),
                'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
                'messages' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                'messageCount' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                'users' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->groupBy('users.telephone')
                    ->get(),
                'userCount' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->groupBy('users.telephone')
                    ->get()
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        if (trim($request->nom) == "") {
            return redirect(route('sListeGroupe'))->with('error', "Impossible de retourner un champs vide !");
        } else {

            $groupe = Departement::findOrFail($id);
            $groupe->nom = $request->nom;
            $groupe->save();

            return redirect(route('sListeGroupe'))->with('success', "Groupe mis à jour avec succès !");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $groupe = Departement::findOrFail($id);
        $groupe->forceDelete();

        $users = User::where('departement_id', $id);
        $users->forceDelete();

        return redirect(route('sListeGroupe'))->with('success', "Groupe supprimé avec succès !");
    }
}
