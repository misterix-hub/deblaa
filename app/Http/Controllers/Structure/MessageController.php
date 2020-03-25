<?php

namespace App\Http\Controllers\Structure;

use App\CibleMessageStructure;
use App\FichierMessageStructure;
use App\Http\Controllers\Controller;
use App\MessageLu;
use App\MessageStructure;
use App\Models\Departement;
use App\User;
use Illuminate\Http\Request;
use App\Models\Structure;
use App\BilanMessageStructure;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function __construct()
    {
        return $this->middleware('checkMessageBonusStructure')->only(['create', 'envoyer']);
    }

    public function index() {
        if (!session()->has('id')) {
            abort("404");
        } else {

            return view('structure.message.liste', [
                'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
                'messageCount' => MessageStructure::where('structure_id', session()->get('id'))->orderByDesc('id')->get(),
                'messages' => MessageStructure::where('structure_id', session()->get('id'))->orderByDesc('id')->get(),
                'users' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->groupBy('telephone')
                    ->get(),
                'userCount' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->groupBy('telephone')
                    ->get()
            ]);
        }
    }

    public function create() {
        if (!session()->has('id')) {
            abort('404');
        } else {
            return view('structure.message.envoyer', [
                'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
                'messageCount' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                'messages' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                'userCount' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->groupBy('telephone')
                    ->get(),
                'users' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->groupBy('telephone')
                    ->get()
            ]);
        }
    }

    public function envoyer(Request $request) {

        $groupes = $request->input('groupes');
        $dest = 0;
        $numero = [];
        if (is_array($groupes)) {

            foreach ($groupes as $groupe) {

                $telephones = User::where('departement_id', $groupe)->groupBy('telephone')->get();

                foreach($telephones as $telephone) {
                    $numero[] = $telephone->telephone;
                }
            }
            $dest = sizeof(array_unique($numero));
        }

        if(session()->get('pro') == 1) {

            if($dest == 0) {
                return back()->with('error', 'Sélectionnez au moins un groupe, Votre message n\'a aucun destinataire');
            } else {

                $message_structure = new MessageStructure();
                $message_structure->structure_id = session()->get('id');
                $message_structure->titre = $request->titre;
                $message_structure->contenu = $request->message;
                $message_structure->save();

                $bilan_message_structure = new BilanMessageStructure;
                $bilan_message_structure->structure_id = session()->get('id');
                $bilan_message_structure->message_structure_id = $message_structure->id;
                $bilan_message_structure->nb_destinataire = $dest;
                $bilan_message_structure->save();

                $totalFichier = count($_FILES['fichier']['name']);

                $target_dir = "db/messages/structures/fichier/";

                if ($request->fichier == "") {

                } else {

                    for ($i = 0; $i < $totalFichier; $i++) {

                        $file = $_FILES["fichier"]["name"][$i];

                        if ($file != "") {
                            $file_name = time() . "_" . basename($file);
                            $target_file = $target_dir . $file_name;
                            $FileType = strtolower(pathinfo(basename($_FILES["fichier"]["name"][$i]), PATHINFO_EXTENSION));

                            $fichier_message_structure = new FichierMessageStructure();
                            $fichier_message_structure->message_structure_id = $message_structure->id;
                            $fichier_message_structure->fichier = $file_name;
                            $fichier_message_structure->format = $FileType;
                            $fichier_message_structure->taille = ($_FILES["fichier"]["size"][$i] / 1000000);

                            $fichier_message_structure->save();

                            move_uploaded_file($_FILES["fichier"]["tmp_name"][$i], $target_file);
                        }

                    }
                }

                if (is_array($groupes)) {

                    $titre = $message_structure->titre;

                    $number1 = [];

                    foreach ($groupes as $groupe) {
                        $cible_message_structure = new CibleMessageStructure();
                        $cible_message_structure->message_structure_id = $message_structure->id;
                        $cible_message_structure->departement_id = $groupe;
                        $cible_message_structure->save();

                        $telephones = User::where('departement_id', $groupe)->groupBy('telephone')->get();

                        foreach ($telephones as $telephone) {
                            $number1[] = $telephone->telephone;
                        }

                    }

                     $numero_trie1 = array_unique($number1);

                    for($i = 0; $i < sizeof($numero_trie1); $i++) {

                        if ($request->fichier != "") {
                            $texte = $titre . " *** ". $totalFichier." fichier(s)  associé(s) à ce message. Vérifiez dans votre boite Deblaa. https://deblaa.com/membres/query?telephone=" .  $numero_trie1[$i] . "" ;
                        } else {
                            $texte = $titre . " *** https://deblaa.com/membres/query?telephone= " . $numero_trie1[$i] ;
                        }
                        ?>
                        <script src="https://deblaa.com/mdb/js/jquery.min.js"></script>
                        <script>
                            $(document).ready(function () {
                                $(function () {
                                    $.ajax({
                                        type: "GET",
                                        url: "https://api.smszedekaa.com/api/v2/SendSMS?ApiKey=yAYu1Q7C9FKy/1dOOBSHvpcrTldsEHGHtM2NjcuF4iU=&ClientId=4460f3b0-3a6a-49f4-8cce-d5900b86723d&SenderId=<?php session()->get('sigle')?>&Message=<?= $texte ?>&MobileNumber=<?= $numero_trie1[$i] ?>",
                                    });
                                });
                            });
                        </script>

                        <?php

                    }
                }

                echo "En cours d'envoi ... Patientez !<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
                echo "<div><center><img src='https://deblaa.com/assets/images/gif2.gif' width='150' /></center></div>"
                //
                ?>
                <script>

                    setTimeout(() => {
                        <?php
                            return redirect(route('sListeMessage'))->with('success', 'Votre message a été en voyé avec succès');
                        ?>
                    }, 5000);

                </script>
                <?php


            }

        } else {
            if ($dest > session()->get('message_bonus')) {
                return back()->with('error', "Le nombre de destinataires autorisé est dépassé !");
            } else {

                if($dest == 0) {
                    return back()->with('error', 'Sélectionnez au moins un groupe, Votre message n\'a aucun destinataire');
                } else {

                    if(session()->get('message_bonus') == 0) {
                        return back()->with('error', "Vous avez épuisé votre nombre de messages bonus.");
                    }

                    $structure = Structure::findOrFail(session()->get('id'));
                    $structure->message_bonus = $structure->message_bonus - $dest;
                    $structure->save();

                    session()->put('message_bonus', $structure->message_bonus);

                    $message_structure = new MessageStructure();
                    $message_structure->structure_id = session()->get('id');
                    $message_structure->titre = $request->titre;
                    $message_structure->contenu = $request->message;
                    $message_structure->save();

                    $bilan_message_structure = new BilanMessageStructure;
                    $bilan_message_structure->structure_id = session()->get('id');
                    $bilan_message_structure->message_structure_id = $message_structure->id;
                    $bilan_message_structure->nb_destinataire = $dest;
                    $bilan_message_structure->save();

                    $totalFichier = count($_FILES['fichier']['name']);

                    $target_dir = "db/messages/structures/fichier/";

                    if ($request->fichier == "") {

                    } else {

                        for ($i = 0; $i < $totalFichier; $i++) {

                            $file = $_FILES["fichier"]["name"][$i];

                            if ($file != "") {
                                $file_name = time() . "_" . basename($file);
                                $target_file = $target_dir . $file_name;
                                $FileType = strtolower(pathinfo(basename($_FILES["fichier"]["name"][$i]), PATHINFO_EXTENSION));

                                $fichier_message_structure = new FichierMessageStructure();
                                $fichier_message_structure->message_structure_id = $message_structure->id;
                                $fichier_message_structure->fichier = $file_name;
                                $fichier_message_structure->format = $FileType;
                                $fichier_message_structure->taille = ($_FILES["fichier"]["size"][$i] / 1000000);

                                $fichier_message_structure->save();

                                move_uploaded_file($_FILES["fichier"]["tmp_name"][$i], $target_file);
                            }

                        }
                    }

                    if (is_array($groupes)) {
                        $number2 = [];
                        $titre = "Message de Deblaa. Vous pouvez le personnaliser quand vous passerez en compte profesionnel.";

                        foreach ($groupes as $groupe) {
                            $cible_message_structure = new CibleMessageStructure();
                            $cible_message_structure->message_structure_id = $message_structure->id;
                            $cible_message_structure->departement_id = $groupe;
                            $cible_message_structure->save();

                            $telephones = User::where('departement_id', $groupe)->groupBy('telephone')->get();

                            foreach ($telephones as $telephone) {
                                $number2[] = $telephone->telephone;
                            }
                        }

                        $numero_trie2 = array_unique($number2);

                        for($i = 0; $i < sizeof($numero_trie2); $i++) {


                            if ($request->fichier != "") {
                                $texte = $titre . " *** " .$totalFichier." fichier(s)  associé(s) à ce message. Vérifiez dans votre boite Deblaa. https://deblaa.com/membres/query?telephone=" . $numero_trie2[$i] . "";
                            } else {
                                $texte = $titre . " *** https://deblaa.com/membres/query?telephone= " . $numero_trie2[$i] ; /*. "". $telephone->departement_id*/
                            }
                            ?>
                            <script src="https://deblaa.com/mdb/js/jquery.min.js"></script>
                            <script>
                                $(document).ready(function () {
                                    $(function () {
                                        $.ajax({
                                            type: "GET",
                                            url: "https://api.smszedekaa.com/api/v2/SendSMS?ApiKey=yAYu1Q7C9FKy/1dOOBSHvpcrTldsEHGHtM2NjcuF4iU=&ClientId=4460f3b0-3a6a-49f4-8cce-d5900b86723d&SenderId=Deblaa&Message=<?= $texte ?>&MobileNumber=<?= $numero_trie2[$i] ?>",
                                        });
                                    });
                                });
                            </script>

                            <?php

                        }
                    }

                    echo "En cours d'envoi ... Patientez !<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
                    echo "<div><center><img src='https://deblaa.com/assets/images/gif2.gif' width='150' /></center></div>"
                    //
                    ?>
                    <script>

                        setTimeout(() => {
                            <?php
                                return redirect(route('sListeMessage'))->with('success', 'Votre message a été envoyé avec succès');
                            ?>
                        }, 5000);

                    </script>
                    <?php

                }

            }
        }



    }

    public function bilan() {
        return view('structure.message.bilan', [
            'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
            'messageCount' => MessageStructure::where('structure_id', session()->get('id'))->get(),
            'messages' => MessageStructure::where('structure_id', session()->get('id'))->get(),
            'userCount' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                ->where('structure_id', session()->get('id'))
                ->where('users.id', '<>', null)
                ->groupBy('users.telephone')
                ->get(),
                'bilan_messages' => BilanMessageStructure::leftJoin('message_structures', 'message_structure_id', 'message_structures.id')
                                    ->where('bilan_message_structures.structure_id', session()->get('id'))
                                    ->orderByDesc('bilan_message_structures.id')->get()
        ]);
    }

    public function details($id) {
        if(!session()->has('id')) {
            abort('404');
        } else {



            return view('structure.message.details', [
                'messageCount' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                'messages' => MessageStructure::where('id', $id)->get(),
                'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
                'cible_messages' => CibleMessageStructure::where('message_structure_id', $id)->get(),
                'fichier_messages' => MessageStructure::rightJoin('fichier_message_structures', 'message_structures.id', 'message_structure_id')
                                        ->where('message_structure_id', $id)
                                        ->get(),
                'users' => DB::table('cible_message_structures')
                            ->join('message_structures', 'message_structures.id', '=', 'cible_message_structures.message_structure_id')
                            ->join('users', 'users.departement_id', '=', 'cible_message_structures.departement_id')
                            ->where('message_structures.id', $id)
                            ->where('message_structures.structure_id', session()->get('id'))
                            ->where('users.id', '<>', null)
                            ->groupBy('users.telephone')
                            ->get(),

                'message_lus' => DB::table('users')
                    ->join('message_lus', 'message_lus.user_id', '=', 'users.id')
                    ->join('message_structures', 'message_structures.id', '=', 'message_lus.message_structure_id')
                    ->where('message_structures.id', $id)
                    ->get(),

                'userCount' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->groupBy('users.telephone')
                    ->get()

                    /*DB::table('message_lus')
                                    ->join('message_structures', 'message_structures.id', '=', 'message_lus.message_structure_id')
                                    ->join('cible_message_structures', 'cible_message_structures.message_structure_id', '=', 'message_lus.message_structure_id')
                                    ->where('message_structures.id', $id)
                                    ->where('message_structures.structure_id', session()->get('id'))
                                    ->groupBy('message_lus.user_id')
                                    ->get()*/

                /*'users' => CibleMessageStructure::join('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->get()*/
            ]);
        }

    }

    public function alert() {
        if( !session()->has('id')){
            abort('404');
        } else {
            return view('structure.alert');
        }

    }

}
