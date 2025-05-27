<?php

namespace App\Http\Controllers;

use App\Models\lespakketten;
use Illuminate\Http\Request;

class LespakkettenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lespakketten = lespakketten::all();
        return view('lespakketten.index', compact('lespakketten'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lespakketten.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'beschrijving' => 'required|string',
            'prijs' => 'required|numeric',
            'duur' => 'required|numeric',
            'aantal_personen' => 'required|integer',
            'aantal_lessen' => 'required|integer',
            'aantal_dagdelen' => 'required|integer',
            'materiaal_inbegrepen' => 'boolean',
        ]);

        lespakketten::create($validated);

        return redirect()->route('lespakketten.index')
            ->with('success', 'Lespakket is succesvol aangemaakt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(lespakketten $lespakketten)
    {
        return view('lespakketten.show', compact('lespakketten'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lespakketten $lespakketten)
    {
        return view('lespakketten.edit', compact('lespakketten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lespakketten $lespakketten)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'beschrijving' => 'required|string',
            'prijs' => 'required|numeric',
            'duur' => 'required|numeric',
            'aantal_personen' => 'required|integer',
            'aantal_lessen' => 'required|integer',
            'aantal_dagdelen' => 'required|integer',
            'materiaal_inbegrepen' => 'boolean',
        ]);

        $lespakketten->update($validated);

        return redirect()->route('lespakketten.index')
            ->with('success', 'Lespakket is succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lespakketten $lespakketten)
    {
        $lespakketten->delete();

        return redirect()->route('lespakketten.index')
            ->with('success', 'Lespakket is succesvol verwijderd.');
    }
}
