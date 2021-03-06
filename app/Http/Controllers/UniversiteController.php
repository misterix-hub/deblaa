<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUniversiteRequest;
use App\Http\Requests\UpdateUniversiteRequest;
use App\Models\Filiere;
use App\Models\FiliereNiveau;
use App\Models\Niveau;
use App\Models\Universite;
use App\Repositories\UniversiteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Response;

use App\FactureUniversite;

class UniversiteController extends AppBaseController
{
    /** @var  UniversiteRepository */
    private $universiteRepository;

    public function __construct(UniversiteRepository $universiteRepo)
    {
        $this->universiteRepository = $universiteRepo;
    }

    /**
     * Display a listing of the Universite.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $universites = $this->universiteRepository->all();

        return view('universites.index')
            ->with('universites', $universites);
    }

    /**
     * Show the form for creating a new Universite.
     *
     * @return Response
     */
    public function create()
    {

        $universite = new Universite();
        return view('universites.create', compact('universite'));
    }

    /**
     * Store a newly created Universite in storage.
     *
     * @param CreateUniversiteRequest $request
     *
     * @return Response
     */
    public function store(CreateUniversiteRequest $request)
    {
        $input = $request->all();

        $password = "DB".rand(1021, 9999);

        $target_dir = "db/logos/universite/";

        $file_name = time() . "_" . basename($_FILES["logo"]["name"]);

        $target_file = $target_dir . $file_name;
        $FileType = strtolower(pathinfo(basename($_FILES["logo"]["name"]), PATHINFO_EXTENSION));

        if($FileType != "jpg" && $FileType != "jpeg" && $FileType != "png") {

            Flash::error('Le type de fichier n\'est pas pris en charge');

            return back();

        } else {

            $universite = $this->universiteRepository->create([
                'nom' => $request->input('nom'),
                'telephone' => $request->input('telephone'),
                'email' => $request->input('email'),
                'password' => bcrypt($password),
                'message_bonus' => 3,
                'acces' => $request->input('acces'),
                'sigle' => $request->input('sigle'),
                'site_web' => $request->input('site_web'),
                'logo' => $file_name,
                'pro' => 0
            ]);

            $to_name = "Deblaa";

            $to_email = $request->input('email');

            $data = array(
                'nom' => $request->input('sigle'),
                'email' => $request->input('email'),
                'motDePasse' => $password
            );

            Mail::send('mails.universite', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email)
                ->subject("Votre mot de passe de Deblaa");
            });

            Flash::success('Université ajoutée avec succès.');

            move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);

            /*$facture_universite = new FactureUniversite;
            $facture_universite->universite_id = $universite->id;
            $facture_universite->montant = "0";
            $facture_universite->date = now();
            $facture_universite->save();*/

            return redirect(route('universites.index'));
        }
    }

    /**
     * Display the specified Universite.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $universite = $this->universiteRepository->find($id);

        if (empty($universite)) {
            Flash::error('Université non trouvée');

            return redirect(route('universites.index'));
        }

        return view('universites.show')->with('universite', $universite);
    }

    /**
     * Show the form for editing the specified Universite.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $universite = $this->universiteRepository->find($id);

        if (empty($universite)) {
            Flash::error('Universite not found');

            return redirect(route('universites.index'));
        }

        return view('universites.edit')->with('universite', $universite);
    }

    /**
     * Update the specified Universite in storage.
     *
     * @param int $id
     * @param UpdateUniversiteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUniversiteRequest $request)
    {
        $universite = $this->universiteRepository->find($id);

        if (empty($universite)) {
            Flash::error('Université non trouvée');

            return redirect(route('universites.index'));
        }

        $universite = $this->universiteRepository->update([
            'nom' => $request->input('nom'),
            'telephone' => $request->input('telephone'),
            'email' => $request->input('email'),
            'acces' => $request->input('acces'),
            'sigle' => $request->input('sigle'),
            'site_web' => $request->input('site_web'),
        ], $id);

        if($_FILES["logo"]["name"] != "") {


            $target_dir = "db/logos/universite/";

            $file_name = time() . "_" . basename($_FILES["logo"]["name"]);

            $target_file = $target_dir . $file_name;
            $FileType = strtolower(pathinfo(basename($_FILES["logo"]["name"]), PATHINFO_EXTENSION));

            if($FileType != "jpg" && $FileType != "jpeg" && $FileType != "png") {

                Flash::error('Le type de fichier n\'est pas pris en charge !');

                return back();

            } else {

               $this->universiteRepository->update([
                   'logo' =>  $file_name
               ], $id);



                move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);
            }
        }

        Flash::success('Université mise à jour avec succès.');

        return redirect(route('universites.index'));
    }

    /**
     * Remove the specified Universite from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $universite = $this->universiteRepository->find($id);

        if (empty($universite)) {
            Flash::error('Universite not found');

            return redirect(route('universites.index'));
        }

        File::delete([
            public_path('db/logos/universite/'. $universite->logo)
        ]);

        $filiereUniversites = Filiere::where('universite_id', $universite->id)->get();

        foreach ($filiereUniversites as $filiereUniversite) {
            $del_filiereNiveaux = FiliereNiveau::where('filiere_id', $filiereUniversite->id);
            $del_filiereNiveaux->forceDelete();
        }

        $del_filiereUniversites = Filiere::where('universite_id', $universite->id);
        $del_filiereUniversites->forceDelete();

        $universite->forceDelete();

        Flash::success('Université supprimée avec succès.');

        return redirect(route('universites.index'));
    }

    /**
     * @param $id
     * @return RedirectResponse|Redirector
     */

    public function giveAccessPro($id) {

            $universite = $this->universiteRepository->find($id);

            if (empty($universite)) {
                Flash::error('Université non trouvée');

                return redirect(route('universites.index'));
            }


            $accessPro = $this->universiteRepository->update([
                'message_bonus' => 0,
                'pro' => 1
            ], $id);

            $to_name = "Deblaa";

            $to_email = $universite->email;
            $data = array(
                'nom' => $universite->sigle,
            );

           Mail::send('mails.comptepro.universite', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email)
                    ->subject('Compte professionnel Deblaa');
            });

            Flash::success('L\'université a été passée en compte professionnel avec succès ');

            return redirect(route('universites.index'));
        }

}
