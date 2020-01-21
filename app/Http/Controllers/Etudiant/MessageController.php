<?php

namespace App\Http\Controllers\Etudiant;

use App\FichierMessageUniversite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CibleMessageUniversite;
use App\MessageUniversite;
use App\MessageLu;

class MessageController extends Controller
{
    public function inbox() {
        
        if (!session()->has('id')) {
            abort('404');
        } else {

?>

            <script>
                if (window.innerWidth < 1000) {
                    window.location = "http://192.168.1.66/deblaa/etudiants/inboxs";
                }
            </script>

<?php

            return view('etudiant.inbox');
        }
        
    }

    public function messageFecting() {

        $i = 0;
        $tab_id = array();
        $message_lus = MessageLu::where('user_id', session()->get('id'))->get();

        foreach ($message_lus as $message_lu) {
            $tab_id[$i] = $message_lu->message_universite_id;
            $i += 1;
        }

        return view('ajaxViews.etudiant.message.sideBarEtudiant', [
            'tab_id' => $tab_id,
            'message_lus' => $message_lus,
            'cible_message_universites' => CibleMessageUNiversite::leftJoin('message_universites', 'message_universite_id', 'message_universites.id')
                                            ->where('filiere_id', session()->get('filiere_id'))
                                            ->where('niveau_id', session()->get('niveau_id'))
                                            ->orderByDesc('message_universites.created_at')
                                            ->get()
        ]);
    }

    public function messageFectingS() {

        $i = 0;
        $tab_id = array();

        $message_lus = MessageLu::where('user_id', session()->get('id'))->get();

        foreach ($message_lus as $message_lu) {
            $tab_id[$i] = $message_lu->message_universite_id;
            $i += 1;
        }


        return view('ajaxViews.etudiant.message.inboxS', [
            'tab_id' => $tab_id,
            'message_lus' => $message_lus,
            'cible_message_universites' => CibleMessageUNiversite::leftJoin('message_universites', 'message_universite_id', 'message_universites.id')
                                            ->where('filiere_id', session()->get('filiere_id'))
                                            ->where('niveau_id', session()->get('niveau_id'))
                                            ->orderByDesc('message_universites.created_at')
                                            ->get()
        ]);
    }

    public function inboxs() {
        if (!session()->has('id')) {
            abort('404');
        } else {
            return view('etudiant.inboxs', [
                'messages' => CibleMessageUniversite::where('filiere_id', session()->get('filiere_id'))
                                                        ->where('niveau_id', session()->get('niveau_id'))
                                                        ->get()
            ]);
        }
    }

    public function details(Request $request) {

        if (count(MessageLu::where('user_id', session()->get('id'))->where('message_universite_id', $request->id)->get()) == 0) {
            $message_lu = new MessageLu;
            $message_lu->user_id = session()->get('id');
            $message_lu->message_universite_id = $request->id;
            $message_lu->save();
        }

        return view('ajaxViews.etudiant.message.details', [
            'messages' => MessageUniversite::where('id', $request->id)->get(),
            'fichier_messages' => FichierMessageUniversite::where('message_universite_id', $request->id)->get()
        ]);
    }

    public function sDetails($id) {

        if (count(MessageLu::where('user_id', session()->get('id'))->where('message_universite_id', $id)->get()) == 0) {
            $message_lu = new MessageLu;
            $message_lu->user_id = session()->get('id');
            $message_lu->message_universite_id = $id;
            $message_lu->save();
        }


        return view('etudiant.detailsMessage', [
            'messages' => MessageUniversite::where('id', $id)->get(),
            'fichier_messages' => FichierMessageUniversite::where('message_universite_id', $id)->get()
        ]);
    }
}
