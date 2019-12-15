<?php

namespace App\Http\Controllers\Universite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Niveau;
use App\Models\Filiere;
use App\MessageUniversite;
use App\CibleMessageUniversite;
use App\User;

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
                'filiere_niveaux' => Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get()
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
                'filiere_niveaux' => Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get()
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

            if ($request->fichier != "") {
                $target_dir = "db/messages/universites/fichier/";

                $file_name = time() . "_" . basename($_FILES["fichier"]["name"]);

                $target_file = $target_dir . $file_name;
                $FileType = strtolower(pathinfo(basename($_FILES["fichier"]["name"]), PATHINFO_EXTENSION));

                $message_universite->fichier = $file_name;
                $message_universite->taille = ($_FILES["fichier"]["size"] / 1000000);

                switch ($FileType) {
                    case 'png':
                        $message_universite->format = "Image";
                        break;

                    case 'jpg':
                        $message_universite->format = "Image";
                        break;

                    case 'jpeg':
                        $message_universite->format = "Image";
                        break;

                    case 'mp3':
                        $message_universite->format = "Audio";
                        break;

                    case 'mp4':
                        $message_universite->format = "Vidéo";
                        break;

                    case 'pdf':
                        $message_universite->format = "Document PDF";
                        break;
                    
                    default:
                        $message_universite->format = "Iconnu";
                        break;
                }

                move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file);
            }
    
            $message_universite->save();
    
            for ($i=0; $i < $request->index; $i++) { 
    
                for ($j=0; $j < $_POST['index' . $i]; $j++) { 
                    if (isset($_POST['niveaux' . $i . $j]) && $_POST['niveaux' . $i . $j] != "") {
    
                        $cible_message_universite = new CibleMessageUniversite;
                        $cible_message_universite->message_universite_id = $message_universite->id;
                        $cible_message_universite->filiere_id = $_POST['filiere' . $i];
                        $cible_message_universite->niveau_id = $_POST['niveaux' . $i . $j];
                        $cible_message_universite->save();
                    }
                }
            }
            
            return redirect(route('uListeMessage'))->with('success', "Message envoyé avec succès !");
        }
        

    }

    public function bilan() {
        if (!session()->has('id')) {
            abort("404");
        } else {
            return view('universite.message.bilan', [
                'niveaux' => Niveau::all(),
                'filieres' => Filiere::where('universite_id', session()->get('id'))->get(),
                'filiere_niveaux' => Niveau::leftJoin("filiere_niveaux", "niveaux.id", "niveau_id")->get()
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
                'users' => User::leftjoin('message_lus', 'users.id', 'user_id')
                                ->where('message_universite_id', $id)
                                ->where('user_id', '<>', null)->get()
            ]);
        }
    }
}
