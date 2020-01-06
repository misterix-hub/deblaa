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

class MessageController extends Controller
{
    public function index() {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.message.liste', [
                'niveaux' => Niveau::all(),
                'messages' => MessageUniversite::where('universite_id', session()->get('id'))->get(),
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
                'filiere_niveaux' => Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get(),
                'users' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
                        ->where('universite_id', session()->get('id'))
                        ->where('users.id', '<>', null)
                        ->get()
            ]);
        }
    }

    public function envoyer(Request $request) {

        $test = 0;

        for ($i=0; $i < $request->index; $i++) { 

            for ($j=0; $j < $_POST['index' . $i]; $j++) { 
                if (isset($_POST['niveaux' . $i . $j]) && $_POST['niveaux' . $i . $j] != "") {

                    $test += 1;
                }
            }
        }

        if ($test == 0) {
            return back()->with('error', "Votre message n'a aucune cible !");
        } else {
            $message_universite = new MessageUNiversite;
            $message_universite->universite_id = session()->get('id');
            $message_universite->titre = $request->titre;
            $message_universite->contenu = $request->message;
            $message_universite->save();

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


            $titre = $request->titre;

            if (session()->get('pro') == 0) {
                $titre = "Message de Deblaa. Vous pouvez le personnaliser quand vous passerez en compte profesionnel.";
            } else {
                $titre = $message_structure->titre;
            }
    
            for ($i=0; $i < $request->index; $i++) { 
    
                for ($j=0; $j < $_POST['index' . $i]; $j++) { 
                    if (isset($_POST['niveaux' . $i . $j]) && $_POST['niveaux' . $i . $j] != "") {
    
                        $cible_message_universite = new CibleMessageUniversite;
                        $cible_message_universite->message_universite_id = $message_universite->id;
                        $cible_message_universite->filiere_id = $_POST['filiere' . $i];
                        $cible_message_universite->niveau_id = $_POST['niveaux' . $i . $j];
                        $cible_message_universite->save();

                        $telephones = User::where('filiere_id', $_POST['filiere' . $i])->where('niveau_id', $_POST['niveaux' . $i . $j])->get();

                        foreach($telephones as $telephone) {
                            $num = $telephone->telephone;

                            if ($request->fichier != "") {
                                $texte = $message_universite->titre . " *** ". $totalFichier." fichier(s) associé(s) à ce message. Vérifiez dans votre boite Deblaa. https://deblaa.com/etudiants/query?telephone=" . $num . "";
                            } else {
                                $texte = $titre . " *** https://deblaa.com/etudiants/query?telephone= " . $num . "";
                            }
?>
                            <script src="https://deblaa.com/mdb/js/jquery.min.js"></script>
                            <script>
                                $.ajax ({
                                    url: "https://www.easysendsms.com/sms/bulksms-api/bulksms-api?username=debldebl2019&password=esm13343&from=<?php echo session()->get('sigle') ?>&to=<?php echo $num ?>&text=<?php echo $texte ?>&type=0" ,
                                    type : 'GET'
                                });
                            </script>
<?php
                        }
                    }
                }
            }
            echo "En cours d'envoi ... Patientez !<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
            echo "<div><center><img src='https://deblaa.com/assets/images/gif2.gif' width='150' /></center></div>"
?>
            <script>
                
                setTimeout(() => {
                    window.location = "https://deblaa.com/universites/messages";
                }, 5000);
    
            </script>
<?php
                //return redirect(route('sListeMessage'))->with('success', "Message envoyé avec succès !");

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
                'users' => Filiere::leftJoin('users', 'filieres.id', 'filiere_id')
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
                'filieres' => Filiere::where('universite_id', session()->get('id'))->get(),
                'cible_messages' => CibleMessageUniversite::where('message_universite_id', $id)->get(),
                'filiere_niveaux' => Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get(),
                'fichier_messages' => MessageUniversite::rightJoin('fichier_message_universites', 'message_universites.id', 'message_universite_id')
                            ->where('message_universite_id', $id)
                            ->get(),
                'users' => User::leftjoin('message_lus', 'users.id', 'user_id')
                                ->where('message_universite_id', $id)
                                ->where('user_id', '<>', null)->get()
            ]);
        }
    }
}
