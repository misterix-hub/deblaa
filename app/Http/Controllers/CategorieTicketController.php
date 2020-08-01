<?php

namespace App\Http\Controllers;

use App\CategorieTicket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategorieTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorie_tickets = CategorieTicket::all();
        return view('categorie_tickets.index', compact('categorie_tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorie_tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'montant' => 'required',
            'nombre_mms' => 'required'
        ]);

        CategorieTicket::create([
            'nom' => $request->input('nom'),
            'montant' => $request->input('montant'),
            'nombre_mms' => $request->input('nombre_mms')
        ]);

        return redirect()->route('categorie.tickets.index')->with('success', 'La catégorie a été enregistrée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategorieTicket  $categorieTicket
     * @return \Illuminate\Http\Response
     */
    public function show(CategorieTicket $categorieTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategorieTicket  $categorieTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(CategorieTicket $categorieTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategorieTicket  $categorieTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategorieTicket $categorieTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategorieTicket  $categorieTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategorieTicket $categorieTicket)
    {
        CategorieTicket::where('id', $categorieTicket->id)->delete();

        return redirect()->back()->with('success', 'La catégorie a été supprimée');
    }
}
