<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFiliereRequest;
use App\Http\Requests\UpdateFiliereRequest;
use App\Models\Filiere;
use App\Models\FiliereNiveau;
use App\Models\Niveau;
use App\Models\Universite;
use App\Repositories\FiliereRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Response;

class FiliereController extends AppBaseController
{
    /** @var  FiliereRepository */
    private $filiereRepository;

    public function __construct(FiliereRepository $filiereRepo)
    {
        $this->filiereRepository = $filiereRepo;
    }

    /**
     * Display a listing of the Filiere.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $filieres = $this->filiereRepository->all();

        return view('filieres.index')
            ->with('filieres', $filieres);
    }

    /**
     * Show the form for creating a new Filiere.
     *
     * @return Response
     */
    public function create()
    {
        $universites = Universite::all();
        $filiere = new Filiere();
        $niveaux = Niveau::all();
        return view('filieres.create', compact('universites', 'niveaux', 'filiere'));
    }

    /**
     * Store a newly created Filiere in storage.
     *
     * @param CreateFiliereRequest $request
     *
     * @return Response
     */
    public function store(CreateFiliereRequest $request)
    {
        $niveaux = $request->input('niveaux');

        if(empty($niveaux)) {
            Flash::error('Sélectionnez au moins un niveau pour la filière !');
            return back();
        } else {
            $filiere = $this->filiereRepository->create([
                'nom' => $request->input('nom'),
                'universite_id' => $request->input('universite_id')
            ]);

            if (is_array($niveaux) || is_object($niveaux)){
                foreach ($niveaux as $niveau) {
                    $filiere_niveau = FiliereNiveau::create([
                        'filiere_id' => $filiere->id,
                        'niveau_id' => $niveau
                    ]);
                }
            }

            Flash::success('Filiere saved successfully.');

            return redirect(route('filieres.index'));
        }
    }

    /**
     * Display the specified Filiere.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $filiere = $this->filiereRepository->find($id);

        if (empty($filiere)) {
            Flash::error('Filiere not found');

            return redirect(route('filieres.index'));
        }

        return view('filieres.show')->with('filiere', $filiere);
    }

    /**
     * Show the form for editing the specified Filiere.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $filiere = $this->filiereRepository->find($id);

        if (empty($filiere)) {
            Flash::error('Filiere not found');

            return redirect(route('filieres.index'));
        }

        $universites = Universite::all();
        $niveaux = Niveau::all();

        return view('filieres.edit', compact('filiere', 'universites', 'niveaux'));
    }

    /**
     * Update the specified Filiere in storage.
     *
     * @param int $id
     * @param UpdateFiliereRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFiliereRequest $request)
    {
        $filiere = $this->filiereRepository->find($id);
        $niveaux = $request->input('niveaux');

        if (empty($filiere)) {
            Flash::error('Filiere not found');

            return redirect(route('filieres.index'));
        }

        if (empty($niveaux)) {
            Flash::error('Sélectionnez au moins un niveau pour la filière !');
            return back();
        } else {
            $filiere = $this->filiereRepository->update([
                'nom' => $request->input('nom'),
                'universite_id' => $request->input('universite_id')
            ], $id);

            $del_filiereNiveau = FiliereNiveau::where('filiere_id', $filiere->id);
            $del_filiereNiveau->forceDelete();

            if ( is_array($niveaux) || is_object($niveaux)){
                foreach ($niveaux as $niveau) {
                    $filiere_niveau = FiliereNiveau::create([
                        'filiere_id' => $filiere->id,
                        'niveau_id' => $niveau
                    ]);
                }
            }

            Flash::success('Filiere updated successfully.');

            return redirect(route('filieres.index'));
        }



    }

    /**
     * Remove the specified Filiere from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $filiere = $this->filiereRepository->find($id);

        if (empty($filiere)) {
            Flash::error('Filiere not found');

            return redirect(route('filieres.index'));
        }

        $this->filiereRepository->delete($id);

        $del_filiereNiveau = FiliereNiveau::where('filiere_id', $filiere->id);
        $del_filiereNiveau->forceDelete();

        Flash::success('Filiere deleted successfully.');

        return redirect(route('filieres.index'));
    }
}
