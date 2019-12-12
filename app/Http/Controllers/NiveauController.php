<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNiveauRequest;
use App\Http\Requests\UpdateNiveauRequest;
use App\Repositories\NiveauRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class NiveauController extends AppBaseController
{
    /** @var  NiveauRepository */
    private $niveauRepository;

    public function __construct(NiveauRepository $niveauRepo)
    {
        $this->niveauRepository = $niveauRepo;
    }

    /**
     * Display a listing of the Niveau.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $niveaux = $this->niveauRepository->all();

        return view('niveaux.index')
            ->with('niveaux', $niveaux);
    }

    /**
     * Show the form for creating a new Niveau.
     *
     * @return Response
     */
    public function create()
    {
        return view('niveaux.create');
    }

    /**
     * Store a newly created Niveau in storage.
     *
     * @param CreateNiveauRequest $request
     *
     * @return Response
     */
    public function store(CreateNiveauRequest $request)
    {
        $input = $request->all();

        $niveau = $this->niveauRepository->create($input);

        Flash::success('Niveau saved successfully.');

        return redirect(route('niveaux.index'));
    }

    /**
     * Display the specified Niveau.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $niveau = $this->niveauRepository->find($id);

        if (empty($niveau)) {
            Flash::error('Niveau not found');

            return redirect(route('niveaux.index'));
        }

        return view('niveaux.show')->with('niveau', $niveau);
    }

    /**
     * Show the form for editing the specified Niveau.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $niveau = $this->niveauRepository->find($id);

        if (empty($niveau)) {
            Flash::error('Niveau not found');

            return redirect(route('niveaux.index'));
        }

        return view('niveaux.edit')->with('niveau', $niveau);
    }

    /**
     * Update the specified Niveau in storage.
     *
     * @param int $id
     * @param UpdateNiveauRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNiveauRequest $request)
    {
        $niveau = $this->niveauRepository->find($id);

        if (empty($niveau)) {
            Flash::error('Niveau not found');

            return redirect(route('niveaux.index'));
        }

        $niveau = $this->niveauRepository->update($request->all(), $id);

        Flash::success('Niveau updated successfully.');

        return redirect(route('niveaux.index'));
    }

    /**
     * Remove the specified Niveau from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $niveau = $this->niveauRepository->find($id);

        if (empty($niveau)) {
            Flash::error('Niveau not found');

            return redirect(route('niveaux.index'));
        }

        $this->niveauRepository->delete($id);

        Flash::success('Niveau deleted successfully.');

        return redirect(route('niveaux.index'));
    }
}
