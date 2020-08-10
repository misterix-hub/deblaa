<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\CategorieTicket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Structure;
use App\Models\Universite;
use Flash;

class TicketController extends Controller
{

    public function __construct() {
        $this->middleware('checkSuperAdmin')->except('verifyCodeTicket');
    }

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
            'code' => "TDB" . random_int(1000000, 9999998)
        ]);

        Flash::success('Ticket Perso enregsitré avec succès');
        return redirect()->back();
    }

    public function storePro(Request $request)
    {
        $request->validate([
            'categorie_id' => 'required'
        ]);

        Ticket::create([
            'categorie_ticket_id' => $request->input('categorie_id'),
            'code' => "TDB" . random_int(1000000, 9999998)
        ]);

        Flash::success('Ticket Pro enregsitré avec succès');
        return redirect()->back();
    }

    public function storeProMax(Request $request)
    {
        $request->validate([
            'categorie_id' => 'required'
        ]);

        Ticket::create([
            'categorie_ticket_id' => $request->input('categorie_id'),
            'code' => "TDB" . random_int(1000000, 9999998)
        ]);
        
        Flash::success('Ticket Pro Max enregsitré avec succès');
        return redirect()->back();
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
                abort('403');
            } else {
                if (!session()->has('category')) {
                abort('403');
            } else {
                if (session()->get('category') == 'etudiant') {
                    return redirect()->route('inboxEtudiant');
                } else {
                    if (session()->get('category') == 'membre') {
                        return redirect()->route('inboxMembre');
                    } else {

                        $request->validate([
                            'ticket_code' => 'required'
                        ],
                        [
                            'ticket_code.required' => 'Opération non validée. votre code ticket n\'est pas renseigné'
                        ]);


                        $ticket_exists = Ticket::where([
                            ['code', '=', $request->input('ticket_code')],
                            ['deleted_at', '=', null]
                        ])->first();

                        if ($ticket_exists == null) {
                            return redirect()->back()->with('error', 'Opération non validée. Votre code ticket est invalide');
                        } else {

                            $mms = CategorieTicket::where('id', $ticket_exists->categorie_ticket_id)->get('nombre_mms')->first()->nombre_mms;
                            $montant = CategorieTicket::where('id', $ticket_exists->categorie_ticket_id)->get('montant')->first()->montant;
                            $ticket_deleted = Ticket::where('code', $request->input('ticket_code'))->delete();

                            if (session()->get('category') == 'structure') {
                                $structure = Structure::where('id', session()->get('id'))->first();

                                    $struc_message = $structure->message_payer;
                                    $total_struc_message = intval($struc_message) + intval($mms);
                                    $structure->update([
                                        'message_payer' => $total_struc_message
                                    ]);
                                session()->put('message_payer', $total_struc_message);
                            } else {
                                $universite = Universite::where('id', session()->get('id'))->first();

                                    $univ_message = $universite->message_payer;
                                    $total_univ_message = intval($univ_message) + intval($mms);
                                    $universite->update([
                                        'message_payer' => $total_univ_message
                                    ]);
                                    session()->put('message_payer', $total_univ_message);
                                }
                                return redirect()->back()->with('success', 'Opération validée. vous avez fait une recharge de ' . $montant . ' FCFA soit ' . $mms . ' MMS');
                            }

                        }
                    }
                }
            }


        }
    }
}
