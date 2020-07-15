<?php

namespace App\Http\Controllers\Universite;

use App\FichierMessageUniversite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Niveau;
use App\Models\Filiere;
use App\MessageUniversite;
use App\CibleMessageUniversite;
use App\User;
use App\BilanMessageUniversite;
use App\Models\Universite;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{

    public function __construct()
    {
        return $this->middleware('checkMessageBonusUniversite')->only(['create', 'envoyer']);
    }

    public function index() {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.message.liste', [
                'niveaux' => Niveau::all(),
                'messages' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
                'messageCount' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
                'filieres' => Filiere::where('universite_id', session()->get('id'))->get(),
                'filiere_niveaux' => Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get(),
                'users' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                        ->where('universite_id', session()->get('id'))
                        ->where('users.id', '<>', null)
                        ->get()
            ]);
        }
    }

    public function create() {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.message.envoyer', [
                'i' => 0,
                'j' => 0,
                'niveaux' => Niveau::all(),
                'filieres' => Filiere::where('universite_id', session()->get('id'))->get(),
                'messages' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
                'messageCount' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
                'filiere_niveaux' => Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get(),
                'users' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                        ->where('universite_id', session()->get('id'))
                        ->where('users.id', '<>', null)
                        ->get(),
                'userCount' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                    ->where('universite_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->get()
            ]);
        }
    }

    public function envoyer(Request $request) {

        $numero = [];

        for ($i=0; $i < intval($request->input('index'),10); $i++) {

            for ($j=0; $j < intval($_POST['index' . $i],10); $j++) {
                if (isset($_POST['niveaux' . $i . $j]) && $_POST['niveaux' . $i . $j] != "") {

                    $users = User::where(['filiere_id' => intval($_POST['filiere' . $i], 10), 'niveau_id' => intval($_POST['niveaux' . $i . $j],10)])->get();

                    if (count($users) != 0) {
                        foreach ($users as $user) {
                            $numero[] = $user->telephone;
                        }
                    }
                }
            }
        }

        $dest = sizeof(array_unique($numero));

        if(session()->has('pro') == 1) {

            if ($dest == 0) {
                return back()->with('error', 'Votre message n\'a aucun destinataire');
            } else {

                $message_universite = new MessageUNiversite;
                $message_universite->universite_id = session()->get('id');
                $message_universite->titre = $request->titre;
                $message_universite->contenu = $request->message;
                $message_universite->save();

                $bilan_message_universite = new BilanMessageUniversite;
                $bilan_message_universite->universite_id = session()->get('id');
                $bilan_message_universite->message_universite_id = $message_universite->id;
                $bilan_message_universite->nb_destinataire = $dest;
                $bilan_message_universite->save();

                $totalFichier = count($_FILES['fichier']['name']);

                $target_dir = "db/messages/universites/fichier/";



                if ($request->fichier == "") {

                } else {

                    for ($i = 0; $i < $totalFichier; $i++) {

                        $file = $_FILES["fichier"]["name"][$i];

                        if ($file != "") {
                            $file_name = time() . "_" . basename($file);
                            $target_file = $target_dir . $file_name;
                            $FileType = strtolower(pathinfo(basename($_FILES["fichier"]["name"][$i]), PATHINFO_EXTENSION));

                            $fichier_message_universite = new FichierMessageUniversite();
                            $fichier_message_universite->message_universite_id = $message_universite->id;
                            $fichier_message_universite->fichier = $file_name;
                            $fichier_message_universite->format = $FileType;
                            $fichier_message_universite->taille = ($_FILES["fichier"]["size"][$i] / 1000000);

                            $fichier_message_universite->save();

                            move_uploaded_file($_FILES["fichier"]["tmp_name"][$i], $target_file);
                        }

                    }
                }

                $number1 = [];

                $titre = $message_universite->titre;

                for ($i=0; $i < $request->index; $i++) {

                    for ($j=0; $j < $_POST['index' . $i]; $j++) {
                        if (isset($_POST['niveaux' . $i . $j]) && $_POST['niveaux' . $i . $j] != "") {

                            $cible_message_universite = new CibleMessageUniversite;
                            $cible_message_universite->message_universite_id = $message_universite->id;
                            $cible_message_universite->filiere_id = $_POST['filiere' . $i];
                            $cible_message_universite->niveau_id = $_POST['niveaux' . $i . $j];
                            $cible_message_universite->save();

                            $telephones = User::where('filiere_id', $_POST['filiere' . $i])->where('niveau_id', $_POST['niveaux' . $i . $j])->get();

                            foreach ($telephones as $telephone) {
                                $number1[] = $telephone->telephone;
                            }
                        }
                    }
                }

                $numero_trie1 = array_unique($number1);

                for($i = 0; $i < sizeof($numero_trie1); $i++) {

                    if ($request->fichier != "") {
                        $texte = $message_universite->titre . " *** ". $totalFichier." fichier(s) associé(s) à ce message. Vérifiez dans votre boite Deblaa. https://deblaa.com/etudiants/query?telephone=" . $numero_trie1[$i] . "";
                    } else {
                        $texte = $titre . " *** https://deblaa.com/etudiants/query?telephone= " . $numero_trie1[$i] . "";
                    }
                    ?>
                    <script src="https://deblaa.com/mdb/js/jquery.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            $(function () {
                                $.ajax({
                                    type: "GET",
                                    url: "http://dashboard.smszedekaa.com:6005/api/v2/SendSMS?SenderId=<?php session()->get('sigle')?>&Message=<?= $texte ?>&MobileNumbers=<?= $numero_trie1[$i] ?>&ApiKey=yAYu1Q7C9FKy/1dOOBSHvpcrTldsEHGHtM2NjcuF4iU=&ClientId=4460f3b0-3a6a-49f4-8cce-d5900b86723d",
                                });
                            });
                        });
                    </script>
                    <?php
                }
                echo "En cours d'envoi ... Patientez !<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
                echo "<div><center><img src='https://deblaa.com/assets/images/gif2.gif' width='150' /></center></div>"
                ?>
                <script>

                    setTimeout(() => {
                        <?php
                            return redirect(route('uListeMessage'))->with('success', "Message envoyé avec succès !");
                        ?>
                    }, 5000);

                </script>
                <?php

                //return redirect(route('uListeMessage'))->with('success', "Message envoyé avec succès !");


            }

        } else {

            if ($dest > session()->get('message_bonus')) {
                return back()->with('error', "Le nombre de destinataires autorisé est dépassé !");
            } else {

                if ($dest == 0) {
                    return back()->with('error', "Votre message n'a aucun destinataire !");
                } else {

                    if (session()->get('message_bonus') == 0) {
                        return back()->with('error', "Vous avez épuisé votre nombre de messages bonus.");
                    }
                    $universite = Universite::findOrFail(session()->get('id'));
                    $universite->message_bonus = $universite->message_bonus - $dest;
                    $universite->save();

                    session()->put('message_bonus', $universite->message_bonus);

                    $message_universite = new MessageUNiversite;
                    $message_universite->universite_id = session()->get('id');
                    $message_universite->titre = $request->titre;
                    $message_universite->contenu = $request->message;
                    $message_universite->save();

                    $bilan_message_universite = new BilanMessageUniversite;
                    $bilan_message_universite->universite_id = session()->get('id');
                    $bilan_message_universite->message_universite_id = $message_universite->id;
                    $bilan_message_universite->nb_destinataire = $dest;
                    $bilan_message_universite->save();

                    $totalFichier = count($_FILES['fichier']['name']);

                    $target_dir = "db/messages/universites/fichier/";



                    if ($request->fichier == "") {

                    } else {

                        for ($i = 0; $i < $totalFichier; $i++) {

                            $file = $_FILES["fichier"]["name"][$i];

                            if ($file != "") {
                                $file_name = time() . "_" . basename($file);
                                $target_file = $target_dir . $file_name;
                                $FileType = strtolower(pathinfo(basename($_FILES["fichier"]["name"][$i]), PATHINFO_EXTENSION));

                                $fichier_message_universite = new FichierMessageUniversite();
                                $fichier_message_universite->message_universite_id = $message_universite->id;
                                $fichier_message_universite->fichier = $file_name;
                                $fichier_message_universite->format = $FileType;
                                $fichier_message_universite->taille = ($_FILES["fichier"]["size"][$i] / 1000000);

                                $fichier_message_universite->save();

                                move_uploaded_file($_FILES["fichier"]["tmp_name"][$i], $target_file);
                            }

                        }
                    }
                    //$titre = $request->titre;

                    $titre = "Message de Deblaa. Vous pouvez le personnaliser quand vous passerez en compte profesionnel.";

                    $number2 = [];

                    for ($i=0; $i < $request->index; $i++) {

                        for ($j=0; $j < $_POST['index' . $i]; $j++) {
                            if (isset($_POST['niveaux' . $i . $j]) && $_POST['niveaux' . $i . $j] != "") {

                                $cible_message_universite = new CibleMessageUniversite;
                                $cible_message_universite->message_universite_id = $message_universite->id;
                                $cible_message_universite->filiere_id = $_POST['filiere' . $i];
                                $cible_message_universite->niveau_id = $_POST['niveaux' . $i . $j];
                                $cible_message_universite->save();

                                $telephones = User::where('filiere_id', $_POST['filiere' . $i])->where('niveau_id', $_POST['niveaux' . $i . $j])->get();

                                foreach ($telephones as $telephone) {
                                    $number2[] = $telephone->telephone;
                                }
                            }
                        }
                    }

                    $numero_trie2 = array_unique($number2);

                    for($i = 0; $i < sizeof($numero_trie2); $i++) {

                        if ($request->fichier != "") {
                            $texte = $message_universite->titre. " *** ". $totalFichier." fichier(s) associé(s) à ce message. Vérifiez dans votre boite Deblaa. https://deblaa.com/etudiants/query?telephone=" . $numero_trie2 . "";
                        } else {
                            $texte = $titre. " *** https://deblaa.com/etudiants/query?telephone= " . $numero_trie2[$i] . "";
                        }
                        ?>
                        <script src="https://deblaa.com/mdb/js/jquery.min.js"></script>
                        <script>
                            $(document).ready(function () {
                                $(function () {
                                    $.ajax({
                                        type: "GET",
                                        url: "http://dashboard.smszedekaa.com:6005/api/v2/SendSMS?SenderId=Deblaa&Message=<?= $texte ?>&MobileNumbers=<?= $numero_trie2[$i] ?>&ApiKey=yAYu1Q7C9FKy/1dOOBSHvpcrTldsEHGHtM2NjcuF4iU=&ClientId=4460f3b0-3a6a-49f4-8cce-d5900b86723d",
                                    });
                                });
                            });
                        </script>
                        <?php
                    }
                    echo "En cours d'envoi ... Patientez !<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
                    echo "<div><center><img src='https://deblaa.com/assets/images/gif2.gif' width='150' /></center></div>"
                    ?>
                    <script>

                        setTimeout(() => {
                            <?php
                                return redirect(route('uListeMessage'))->with('success', "Message envoyé avec succès !");
                            ?>
                        }, 5000);

                    </script>
                    <?php

                }


            }
            }
        }



    public function bilan() {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.message.bilan', [
                'niveaux' => Niveau::all(),
                'filieres' => Filiere::where('universite_id', session()->get('id'))->get(),
                'filiere_niveaux' => Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get(),
                'messages' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
                'messageCount' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
                'users' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                        ->where('universite_id', session()->get('id'))
                        ->where('users.id', '<>', null)
                        ->get(),
                'userCount' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                    ->where('universite_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->get(),
                'bilan_messages' => BilanMessageUniversite::leftJoin('message_universites', 'message_universite_id', 'message_universites.id')
                                    ->where('bilan_message_universites.universite_id', session()->get('id'))
                                    ->orderByDesc('bilan_message_universites.id')->get()
            ]);
        }
    }

    public function details($id) {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.message.details', [
                'niveaux' => Niveau::all(),
                'messages' => MessageUniversite::where('id', $id)->get(),
                'messageCount' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
                'filieres' => Filiere::where('universite_id', session()->get('id'))->get(),
                'cible_messages' => CibleMessageUniversite::where('message_universite_id', $id)->get(),
                'filiere_niveaux' => Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get(),
                'fichier_messages' => MessageUniversite::rightJoin('fichier_message_universites', 'message_universites.id', 'message_universite_id')
                            ->where('message_universite_id', $id)
                            ->get(),
                'users' => DB::table('cible_message_universites')
                                ->join('message_universites', 'message_universites.id', '=', 'cible_message_universites.message_universite_id')
                                ->join('users', 'users.filiere_id', '=', 'cible_message_universites.filiere_id')
                                ->where('message_universites.id', $id)
                                ->where('message_universites.universite_id', session()->get('id'))
                                ->where('users.id', '<>', null)
                                ->groupBy('users.telephone')
                                ->get(),

                'userCount' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                    ->where('universite_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->get(),

                'message_lus' => DB::table('users')
                    ->join('message_lus', 'message_lus.user_id', '=', 'users.id')
                    ->join('message_universites', 'message_universites.id', '=', 'message_lus.message_universite_id')
                    ->where('message_universites.id', $id)
                    ->get(),

                'id' => $id


                /*DB::table('message_lus')
                            ->join('message_universites', 'message_universites.id', '=', 'message_lus.message_universite_id')
                            ->join('cible_message_universites', 'cible_message_universites.message_universite_id', '=', 'message_lus.message_universite_id')
                            ->where('message_universites.id', $id)
                            ->where('message_universites.universite_id', session()->get('id'))
                            ->get(),*/

            ]);
        }
    }

    public function alert(){
        if (!session()->has('id')){
            abort('404');
        } else {
            return view('universite.alert');
        }
    }
}
