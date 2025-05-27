<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lespakket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $bookings = Booking::with(['user', 'lespakket'])
            ->orderBy('datum', 'desc')
            ->paginate(10);
            
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lespakketten = Lespakket::all();
        return view('bookings.create', compact('lespakketten'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lespakket_id' => 'required|exists:lespakketten,id',
            'datum' => 'required|date|after:now',
            'notes' => 'nullable|string|max:500',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'in behandeling';
        $validated['payment_status'] = 'pending';

        Booking::create($validated);

        return redirect()->route('bookings.index')
            ->with('success', 'Boeking succesvol aangemaakt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking): View
    {
        $booking->load(['user', 'lespakket']);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $lespakketten = Lespakket::all();
        return view('bookings.edit', compact('booking', 'lespakketten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'lespakket_id' => 'required|exists:lespakketten,id',
            'datum' => 'required|date',
            'status' => 'required|in:in behandeling,bevestigd,geannuleerd',
            'payment_status' => 'required|in:pending,paid,refunded',
            'notes' => 'nullable|string|max:500',
        ]);

        $booking->update($validated);

        return redirect()->route('bookings.index')
            ->with('success', 'Boeking succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Boeking succesvol verwijderd.');
    }
}
