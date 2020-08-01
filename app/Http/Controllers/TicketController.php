<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\CategorieTicket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Structure;
use App\Model\Universite;

class TicketController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$categorie_tickets = CategorieTicket::all();
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePerso(Request $request)
    {
        $request->validate([
            'categorie_id' => 'required'
        ]);

        Ticket::create([
            'categorie_ticket_id' => $request->input('categorie_id'),
            'code' => "TDB" . random_int(100000000, 999999998)
        ]);

        return redirect()->back()->with('success', 'Ticket Perso enregsitré avec succès');
    }

    public function storePro(Request $request)
    {
        $request->validate([
            'categorie_id' => 'required'
        ]);

        Ticket::create([
            'categorie_ticket_id' => $request->input('categorie_id'),
            'code' => "TDB" . random_int(100000000, 999999998)
        ]);

        return redirect()->back()->with('success', 'Ticket Pro enregsitré avec succès');
    }

    public function storeProMax(Request $request)
    {
        $request->validate([
            'categorie_id' => 'required'
        ]);

        Ticket::create([
            'categorie_ticket_id' => $request->input('categorie_id'),
            'code' => "TDB" . random_int(100000000, 999999998)
        ]);

        return redirect()->back()->with('success', 'Ticket Pro Max enregsitré avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket_deleted = Ticket::where('id', $ticket->id);
        $ticket_deleted->delete();

        return redirect()->back()->with('success', 'Le ticket a été supprimé avec succès');
    }

    public function verifyCodeTicket(Request $request) {
        if(!session()->get('id')) {
            abort('401');
        } else {
            if (session()->get('pro') == 0) {
                abort('404');
            } else {
                if (!session()->has('category')) {
                abort('404');
            } else {
                if (session()->get('category') == 'etudiant') {
                    return redirect()->route('inboxEtudiant');
                } else {
                    if (session()->get('category') == 'membre') {
                        return redirect()->route('inboxMembre');
                    } else {

                        $request->validate([
                            'ticket' => 'required'
                        ],
                        [
                            'ticket.required' => 'Opération non validée. votre code ticket n\'est pas renseigné'
                        ]);

                        $ticket_exist = Ticket::where('code', $request->input('ticket'))->get('categorie_ticket_id')->first()->categorie_ticket_id;

                        if (count($ticket_exist) == 0) {
                            return redirect()->back()->with('error', 'Opération non validée. Votre code ticket est invalide');
                        } else {
                            $sms = CategorieTicket::where('id', $ticket_exist)->get('nombre_sms')->first()->nombre_sms;
                            $montant = CategorieTicket::where('id', $ticket_exist)->get('montant')->first()->montant;
                            $ticket_deleted = Ticket::where('code', $request->input('ticket'))->delete();
                            if (session()->get('category') == 'structure') {
                                $structures = Structure::where('id', session()->get('id'))->first();
                                foreach ($structures as $structure) {
                                    $struc_message = $structure->message_payer;
                                    $total_struc_message = intval($struc_message) + intval($sms);
                                    $structure->update([
                                        'message_payer' => $total_struc_message
                                    ]);
                                }
                                session()->put('message_payer', $total_struct_message);
                            } else {
                                $universites = Universite::where('id', session()->get('id'))->first();
                                foreach ($universites as $universite) {
                                    $univ_message = $universite->message_payer;
                                    $total_univ_message = intval($univ_message) + intval($sms);
                                    $universite->update([
                                        'message_payer' => $total_univ_message
                                    ]);
                                }
                                session()->put('message_payer', $total_univ_message);
                            }
                            return redirect()->back()->with('success', 'Opération validée. vous avez fait une recharge de ' . $montant . ' soit ' . $sms . ' MMS');
                        }
                    }
                }
            }
            }

        }
    }
}
