<?php

namespace App\Http\Controllers\Structure;

use App\CibleMessageStructure;
use App\Http\Controllers\Controller;
use App\MessageStructure;
use App\Models\Departement;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index() {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('structure.message.liste', [
                'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
                'messages' => MessageStructure::where('structure_id', session()->get('id'))->get(),
                'users'
            ]);
        }

    }

    public function create() {
        if (!session()->has('id')) {
            abort('404');
        } else {
            return view('structure.message.envoyer', [
                'groupes' => Departement::where('structure_id', session()->get('id'))->get()
            ]);
        }
    }

    public function envoyer(Request $request) {

        $groupes = $request->input('groupes');

        if(empty($groupes)) {
            return back()->with('error', 'Sélectionnez au moins un groupe, Votre message n\'a aucune cible');
        } else {
            $message_structure = new MessageStructure();
            $message_structure->structure_id = session()->get('id');
            $message_structure->titre = $request->titre;
            $message_structure->contenu = $request->message;

            if ($request->fichier != "") {
                $target_dir = "db/messages/structures/fichier/";

                $file_name = time() . "_" . basename($_FILES["fichier"]["name"]);

                $target_file = $target_dir . $file_name;
                $FileType = strtolower(pathinfo(basename($_FILES["fichier"]["name"]), PATHINFO_EXTENSION));

                $message_structure->fichier = $file_name;
                $message_structure->taille = ($_FILES["fichier"]["size"] / 1000000);

                switch ($FileType) {
                    case 'png':
                        $message_structure->format = "Image";
                        break;

                    case 'jpg':
                        $message_structure->format = "Image";
                        break;

                    case 'jpeg':
                        $message_structure->format = "Image";
                        break;

                    case 'mp3':
                        $message_structure->format = "Audio";
                        break;

                    case 'mp4':
                        $message_structure->format = "Vidéo";
                        break;

                    case 'pdf':
                        $message_structure->format = "Document PDF";
                        break;

                    default:
                        $message_structure->format = "Inconnu";
                        break;
                }

                move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file);
            }

            $message_structure->save();

            if (is_array($groupes) || is_array($groupes)) {
                foreach ($groupes as $groupe) {
                    $cible_message_structure = new CibleMessageStructure();
                    $cible_message_structure->message_structure_id = $message_structure->id;
                    $cible_message_structure->departement_id = $groupe;
                    $cible_message_structure->save();

		            $telephones = User::where('departement_id', $groupe)->get();

                    foreach($telephones as $telephone) {
                        $num = $telephone->telephone;
                        echo $num;

                    }
                }
            }

            //return redirect(route('sListeMessage'))->with('success', "Message envoyé avec succès !");
        }
    }

    public function bilan() {
        return view('structure.message.bilan');
    }

    public function details($id) {
        if(!session()->has('id')) {
            abort('404');
        } else {
            return view('structure.message.details', [
                'messages' => MessageStructure::where('id', $id)->get(),
                'groupes' => Departement::where('structure_id', session()->get('id'))->get(),
                'cible_messages' => CibleMessageStructure::where('message_structure_id', $id)->get(),
                'users' => User::leftjoin('message_lus', 'users.id', 'user_id')
                    ->where('message_structure_id', $id)
                    ->where('user_id', '<>', null)->get()
            ]);
        }

    }
}
