<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFiliereNiveauRequest;
use App\Http\Requests\UpdateFiliereNiveauRequest;
use App\Repositories\FiliereNiveauRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FiliereNiveauController extends AppBaseController
{
    /** @var  FiliereNiveauRepository */
    private $filiereNiveauRepository;

    public function __construct(FiliereNiveauRepository $filiereNiveauRepo)
    {
        $this->filiereNiveauRepository = $filiereNiveauRepo;
    }

    /**
     * Display a listing of the FiliereNiveau.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $filiereNiveaus = $this->filiereNiveauRepository->all();

        return view('filiere_niveaus.index')
            ->with('filiereNiveaus', $filiereNiveaus);
    }

    /**
     * Show the form for creating a new FiliereNiveau.
     *
     * @return Response
     */
    public function create()
    {
        return view('filiere_niveaus.create');
    }

    /**
     * Store a newly created FiliereNiveau in storage.
     *
     * @param CreateFiliereNiveauRequest $request
     *
     * @return Response
     */
    public function store(CreateFiliereNiveauRequest $request)
    {
        $input = $request->all();

        $filiereNiveau = $this->filiereNiveauRepository->create($input);

        Flash::success('Filiere Niveau saved successfully.');

        return redirect(route('filiereNiveaus.index'));
    }

    /**
     * Display the specified FiliereNiveau.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $filiereNiveau = $this->filiereNiveauRepository->find($id);

        if (empty($filiereNiveau)) {
            Flash::error('Filiere Niveau not found');

            return redirect(route('filiereNiveaus.index'));
        }

        return view('filiere_niveaus.show')->with('filiereNiveau', $filiereNiveau);
    }

    /**
     * Show the form for editing the specified FiliereNiveau.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $filiereNiveau = $this->filiereNiveauRepository->find($id);

        if (empty($filiereNiveau)) {
            Flash::error('Filiere Niveau not found');

            return redirect(route('filiereNiveaus.index'));
        }

        return view('filiere_niveaus.edit')->with('filiereNiveau', $filiereNiveau);
    }

    /**
     * Update the specified FiliereNiveau in storage.
     *
     * @param int $id
     * @param UpdateFiliereNiveauRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFiliereNiveauRequest $request)
    {
        $filiereNiveau = $this->filiereNiveauRepository->find($id);

        if (empty($filiereNiveau)) {
            Flash::error('Filiere Niveau not found');

            return redirect(route('filiereNiveaus.index'));
        }

        $filiereNiveau = $this->filiereNiveauRepository->update($request->all(), $id);

        Flash::success('Filiere Niveau updated successfully.');

        return redirect(route('filiereNiveaus.index'));
    }

    /**
     * Remove the specified FiliereNiveau from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $filiereNiveau = $this->filiereNiveauRepository->find($id);

        if (empty($filiereNiveau)) {
            Flash::error('Filiere Niveau not found');

            return redirect(route('filiereNiveaus.index'));
        }

        $this->filiereNiveauRepository->delete($id);

        Flash::success('Filiere Niveau deleted successfully.');

        return redirect(route('filiereNiveaus.index'));
    }
}
