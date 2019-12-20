<?php

namespace App\Http\Controllers\Membre;

use App\CibleMessageStructure;
use App\FichierMessageStructure;
use App\Http\Controllers\Controller;
use App\MessageLu;
use App\MessageStructure;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function inbox() {
        if(!session()->has('id')) {
            abort('404');
        } else {

            return view('membre.inbox');
        }
    }

    public function messageFecting() {

        $i = 0;
        $tab_id = array();
        $message_lus = MessageLu::where('user_id', session()->get('id'))->get();

        foreach ($message_lus as $message_lu) {
            $tab_id[$i] = $message_lu->message_structure_id;
            $i += 1;
        }

        return view('ajaxViews.membre.message.sideBarMembre', [
            'tab_id' => $tab_id,
            'message_lus' => $message_lus,
            'cible_message_structures' => CibleMessageStructure::leftJoin('message_structures', 'message_structure_id', 'message_structures.id')
                ->where('departement_id', session()->get('departement_id'))
                ->orderByDesc('message_structures.created_at')
                ->get()
        ]);
    }

    public function messageFectingS() {

        $i = 0;
        $tab_id = array();

        $message_lus = MessageLu::where('user_id', session()->get('id'))->get();

        foreach ($message_lus as $message_lu) {
            $tab_id[$i] = $message_lu->message_structure_id;
            $i += 1;
        }


        return view('ajaxViews.membre.message.inboxS', [
            'tab_id' => $tab_id,
            'message_lus' => $message_lus,
            'cible_message_structures' => CibleMessageStructure::leftJoin('message_structures', 'message_structure_id', 'message_structures.id')
                ->where('departement_id', session()->get('departement_id'))
                ->orderByDesc('message_structures.created_at')
                ->get()
        ]);
    }

    public function inboxs() {
        if (!session()->has('id')) {
            abort('404');
        } else {
            return view('membre.inboxs', [
                'messages' => CibleMessageStructure::where('departement_id', session()->get('departement_id'))
                    ->get()
            ]);
        }
    }

    public function details(Request $request) {

        if (count(MessageLu::where('user_id', session()->get('id'))->where('message_structure_id', $request->id)->get()) == 0) {
            $message_lu = new MessageLu;
            $message_lu->user_id = session()->get('id');
            $message_lu->message_structure_id = $request->id;
            $message_lu->save();
        }

        return view('ajaxViews.membre.message.details', [
            'messages' => MessageStructure::where('id', $request->id)->get(),
            'fichier_messages' => FichierMessageStructure::where('message_structure_id', $request->id)->get()
        ]);
    }

    public function sDetails($id) {

        if (count(MessageLu::where('user_id', session()->get('id'))->where('message_structure_id', $id)->get()) == 0) {
            $message_lu = new MessageLu;
            $message_lu->user_id = session()->get('id');
            $message_lu->message_structure_id = $id;
            $message_lu->save();
        }


        return view('membre.detailsMessage', [
            'messages' => MessageStructure::where('id', $id)->get(),
            'fichier_messages' => FichierMessageStructure::where('message_structure_id', $id)->get()
        ]);
    }
}
