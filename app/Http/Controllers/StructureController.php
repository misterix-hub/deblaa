<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStructureRequest;
use App\Http\Requests\UpdateStructureRequest;
use App\Models\Departement;
use App\Models\Structure;
use App\Repositories\StructureRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Response;

use App\FactureStructure;

class StructureController extends AppBaseController
{
    /** @var  StructureRepository */
    private $structureRepository;

    public function __construct(StructureRepository $structureRepo)
    {
        $this->structureRepository = $structureRepo;
    }

    /**
     * Display a listing of the Structure.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $structures = $this->structureRepository->all();

        return view('structures.index')
            ->with('structures', $structures);
    }

    /**
     * Show the form for creating a new Structure.
     *
     * @return Response
     */
    public function create()
    {
        $structure = new Structure();
        return view('structures.create', compact('structure'));
    }

    /**
     * Store a newly created Structure in storage.
     *
     * @param CreateStructureRequest $request
     *
     * @return Response
     */
    public function store(CreateStructureRequest $request)
    {
        $input = $request->all();

        $password = "DB".rand(1021, 9999);

       // $structure = $this->structureRepository->create($input);

        $target_dir = "db/logos/structure/";

        $file_name = time() . "_" . basename($_FILES["logo"]["name"]);

        $target_file = $target_dir . $file_name;
        $fileType = strtolower(pathinfo(basename($_FILES["logo"]["name"]), PATHINFO_EXTENSION));

        if($fileType != 'jpg' && $fileType != 'jpeg'  && $fileType != 'png'){

            Flash::error('Le type n\'est pas pris en charge !');
            return back();

        } else {

            $structure = $this->structureRepository->create([
                'nom' => $request->input('nom'),
                'sigle' => $request->input('sigle'),
                'logo' => $file_name,
                'telephone' => $request->input('telephone'),
                'message_bonus' => 3,
                'email' => $request->input('email'),
                'password' => bcrypt($password),
                'site_web' => $request->input('site_web'),
                'acces' => $request->input('acces'),
                'pro' => 0
            ]);



            $to_name = "Deblaa";

            $to_email = $request->input('email');
            $data = array(
                'nom' => $request->input('sigle'),
                'email' => $request->input('email'),
                'motDePasse' => $password
            );

            Mail::send('mails.structure', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email)
                        ->subject("Votre mot de passe de Deblaa");
            });

            Flash::success('Structure ajoutée avec succès.');

            move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);

            /*$facture_structure = new FactureStructure;
            $facture_structure->structure_id = $structure->id;
            $facture_structure->montant = "0";
            $facture_structure->date = now();
            $facture_structure->save();*/

            return redirect(route('structures.index'));

        }

    }

    /**
     * Display the specified Structure.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $structure = $this->structureRepository->find($id);

        if (empty($structure)) {
            Flash::error('Structure not found');

            return redirect(route('structures.index'));
        }

        return view('structures.show')->with('structure', $structure);
    }

    /**
     * Show the form for editing the specified Structure.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $structure = $this->structureRepository->find($id);

        if (empty($structure)) {
            Flash::error('Structure not found');

            return redirect(route('structures.index'));
        }

        return view('structures.edit')->with('structure', $structure);
    }

    /**
     * Update the specified Structure in storage.
     *
     * @param int $id
     * @param UpdateStructureRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStructureRequest $request)
    {
        $structure = $this->structureRepository->find($id);

        if (empty($structure)) {
            Flash::error('Structure not found');

            return redirect(route('structures.index'));
        }

        $structure = $this->structureRepository->update([
            'nom' => $request->input('nom'),
            'sigle' => $request->input('sigle'),
            'telephone' => $request->input('telephone'),
            'email' => $request->input('email'),
            'site_web' => $request->input('site_web'),
            'acces' => $request->input('acces')
        ], $id);

        if($_FILES["logo"]["name"] != '') {

            $target_dir = "db/logos/structure/";

            $file_name = time() . "_" . basename($_FILES["logo"]["name"]);

            $target_file = $target_dir . $file_name;
            $fileType = strtolower(pathinfo(basename($_FILES["logo"]["name"]), PATHINFO_EXTENSION));

            if ($fileType != 'jpg' && $fileType != 'jpeg' && $fileType != 'png') {

                Flash::error('Le type de fichier n\'est pas pris en charge !');

                return back();
            } else {

                $this->structureRepository->update([
                    'logo' => $file_name
                ], $id);

                move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);
            }
        }

        Flash::success('Structure updated successfully.');

        return redirect(route('structures.index'));
    }

    /**
     * Remove the specified Structure from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $structure = $this->structureRepository->find($id);

        if (empty($structure)) {
            Flash::error('Structure not found');

            return redirect(route('structures.index'));
        }

        File::delete([
            public_path('db/logos/structure/'. $structure->logo)
        ]);

        $departement = Departement::where('structure_id', $structure->id);

        $departement->forceDelete();

        $structure->forceDelete();

        //$this->structureRepository->delete($id);

        Flash::success('Structure deleted successfully.');

        return redirect(route('structures.index'));
    }

    /**
     * @param $id
     * @return RedirectResponse|Redirector
     */

    public function giveAccessPro($id) {

            $structure = $this->structureRepository->find($id);

            if(empty($structure)) {
                Flash::error('Structure non trouvée');

                return redirect(route('structures.index'));
            }

            $accessPro = $this->structureRepository->update([
                'message_bonus' => 0,
                'pro' => 1
            ], $id);

            $to_name = "Deblaa";

            $to_email = $structure->email;
            $data = array(
                'nom' => $structure->sigle,
            );


            Mail::send('mails.comptepro.structure', $data, function($message) use($to_name, $to_email) {
                $message->to($to_email)
                    ->subject('Compte professionnel Deblaa');
            });

            Flash::success('La structure a bien été passée en compte professionnel');

            return redirect(route('structures.index'));
    }

}
