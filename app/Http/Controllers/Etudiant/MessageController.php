<?php

namespace App\Http\Controllers\Etudiant;

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
            return view('etudiant.inbox', [
                'messages' => CibleMessageUniversite::leftJoin('message_universites', 'message_universite_id', 'message_universites.id')
                                                        ->where('filiere_id', session()->get('filiere_id'))
                                                        ->where('niveau_id', session()->get('niveau_id'))
                                                        ->get()
            ]);
        }
        
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
}
