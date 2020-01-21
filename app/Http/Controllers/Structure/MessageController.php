<?php

namespace App\Http\Controllers\Structure;

use App\CibleMessageStructure;
use App\FichierMessageStructure;
use App\Http\Controllers\Controller;
use App\MessageStructure;
use App\Models\Departement;
use App\User;
use Illuminate\Http\Request;
use App\Models\Structure;
use App\BilanMessageStructure;

class MessageController extends Controller
{
    public function index() {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('structure.message.liste', [
                'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
                'messages' => MessageStructure::where('structure_id', session()->get('id'))->orderByDesc('id')->get(),
                'users' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
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
                'messages' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                'users' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->get()
            ]);
        }
    }

    public function envoyer(Request $request) {

        $groupes = $request->input('groupes');

        if (is_array($groupes) || is_array($groupes)) {
            
            $dest = 0;
            foreach ($groupes as $groupe) {

                $telephones = User::where('departement_id', $groupe)->get();
                
                foreach($telephones as $telephone) {
                    $dest += 1;
                }
            }
        }

        if ($dest > session()->get('message_bonus')) {
            return back()->with('error', "Le nombre de destinataires autorisé est dépassé !");
        } else {
            
            if($dest == 0) {
                return back()->with('error', 'Sélectionnez au moins un groupe, Votre message n\'a aucune cible');
            } else {

                if(session()->get('message_bonus') == 0) {
                    return back()->with('error', "Vous avez épuisé votre nombre nombre de messages.");
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
    
                if (is_array($groupes) || is_array($groupes)) {

                    if (session()->get('pro') == 0) {
                        $titre = "Message de Deblaa. Vous pouvez le personnaliser quand vous passerez en compte profesionnel.";
                    } else {
                        $titre = $message_structure->titre;
                    }
    
                    foreach ($groupes as $groupe) {
                        $cible_message_structure = new CibleMessageStructure();
                        $cible_message_structure->message_structure_id = $message_structure->id;
                        $cible_message_structure->departement_id = $groupe;
                        $cible_message_structure->save();
    
                        $telephones = User::where('departement_id', $groupe)->get();
                        
                        foreach($telephones as $telephone) {
                            $num = $telephone->telephone;
    
                            if ($request->fichier != "") {
                                $texte = strtoupper($titre) . " *** ". $totalFichier." fichier(s)  associé(s) à ce message. Vérifiez dans votre boite Deblaa. https://deblaa.com/membres/query?telephone=" . $num . "" . $telephone->departement_id;
                            } else {
                                $texte = strtoupper($titre) . " *** https://deblaa.com/membres/query?telephone= " . $num . "". $telephone->departement_id;
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
    
                echo "En cours d'envoi ... Patientez !<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
                echo "<div><center><img src='https://deblaa.com/assets/images/gif2.gif' width='150' /></center></div>"
                //
    ?>
            <script>
                
                setTimeout(() => {
                    window.location = "https://deblaa.com/structures/messages";
                }, 5000);
    
            </script>
    <?php
    
            }

        }

    }

    public function bilan() {
        return view('structure.message.bilan', [
            'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
            'messages' => MessageStructure::where('structure_id', session()->get('id'))->get(),
            'users' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                ->where('structure_id', session()->get('id'))
                ->where('users.id', '<>', null)
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
                'messages' => MessageStructure::where('id', $id)->get(),
                'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
                'cible_messages' => CibleMessageStructure::where('message_structure_id', $id)->get(),
                'fichier_messages' => MessageStructure::rightJoin('fichier_message_structures', 'message_structures.id', 'message_structure_id')
                                        ->where('message_structure_id', $id)
                                        ->get(),        
                'users' => Departement::leftJoin('users', 'departements.id', 'departement_id')
                    ->where('structure_id', session()->get('id'))
                    ->where('users.id', '<>', null)
                    ->get()
            ]);
        }

    }
}
