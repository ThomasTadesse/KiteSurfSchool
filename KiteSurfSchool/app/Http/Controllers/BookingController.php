<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lespakket;
use App\Models\Student;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $searchBookingNumber = $request->input('searchBookingNumber', '');
        $searchStudent = $request->input('searchStudent', '');
        $searchStatus = $request->input('searchStatus', '');
        $searchDateFrom = $request->input('searchDateFrom', '');
        $searchDateTo = $request->input('searchDateTo', '');
        $searchPaymentStatus = $request->input('searchPaymentStatus', '');

        try {
            $query = Booking::with(['user', 'lespakket'])
                ->orderBy('datum', 'asc');

            // Apply filters if search parameters are provided
            if (!empty($searchBookingNumber)) {
                $query->where('invoice_number', 'LIKE', "%{$searchBookingNumber}%");
            }

            if (!empty($searchStudent)) {
                $query->whereHas('user', function($q) use ($searchStudent) {
                    $q->where('name', 'LIKE', "%{$searchStudent}%");
                });
            }

            if (!empty($searchStatus)) {
                // Map the frontend value to database value if needed
                $statusMap = [
                    'confirmed' => 'bevestigd',
                    'pending' => 'in behandeling',
                    'cancelled' => 'geannuleerd'
                ];
                
                $dbStatus = $statusMap[$searchStatus] ?? $searchStatus;
                $query->where('status', $dbStatus);
            }

            if (!empty($searchPaymentStatus)) {
                $query->where('payment_status', $searchPaymentStatus);
            }

            if (!empty($searchDateFrom)) {
                $query->where('datum', '>=', $searchDateFrom);
            }

            if (!empty($searchDateTo)) {
                $query->where('datum', '<=', $searchDateTo);
            }

            $bookings = $query->paginate(10);
            Log::info('Bookings fetched: ' . $bookings->count());
            
        } catch (\Exception $e) {
            Log::error('Failed to fetch bookings: ' . $e->getMessage());
            $bookings = collect()->paginate(10);
        }
        
        return view('bookings.index', compact(
            'bookings',
            'searchBookingNumber',
            'searchStudent',
            'searchStatus',
            'searchDateFrom',
            'searchDateTo',
            'searchPaymentStatus'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $lespakketten = Lespakket::all();
            $students = Student::with('user')->get();
            $instructors = Instructor::with('user')->get();
            return view('bookings.create', compact('lespakketten', 'students', 'instructors'));
        } catch (\Exception $e) {
            Log::error('Error loading create booking form: ' . $e->getMessage());
            return redirect()->route('bookings.index')
                ->with('error', 'Er is een fout opgetreden bij het laden van het formulier.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'lespakket_id' => 'required|exists:lespakkettens,id',
            'datum' => 'required|date',
            'notes' => 'nullable|string|max:500',
            'instructor_id' => 'nullable|exists:instructors,id',
        ]);

        try {
            // Get price from lespakket
            $lespakket = Lespakket::find($validated['lespakket_id']);
            $validated['price'] = $lespakket->prijs;

            // Create a unique invoice number
            $validated['invoice_number'] = 'INV-' . date('Ymd') . '-' . uniqid();
            
            // Set default values
            $validated['status'] = 'in behandeling';
            $validated['payment_status'] = 'pending';

            Booking::create($validated);

            Log::info('Booking created successfully for user: ' . $validated['user_id']);
            return redirect()->route('bookings.index')
                ->with('success', 'Boeking succesvol aangemaakt.');
        } catch (\Exception $e) {
            Log::error('Error creating booking: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Er is een fout opgetreden bij het aanmaken van de boeking: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking): View
    {
        try {
            $booking->load(['user', 'lespakket']);
            return view('bookings.show', compact('booking'));
        } catch (\Exception $e) {
            Log::error('Error displaying booking: ' . $e->getMessage());
            return redirect()->route('bookings.index')
                ->with('error', 'Er is een fout opgetreden bij het weergeven van de boeking.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        try {
            $lespakketten = Lespakket::all();
            return view('bookings.edit', compact('booking', 'lespakketten'));
        } catch (\Exception $e) {
            Log::error('Error loading edit booking form: ' . $e->getMessage());
            return redirect()->route('bookings.index')
                ->with('error', 'Er is een fout opgetreden bij het laden van het bewerkingsformulier.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'lespakket_id' => 'required|exists:lespakkettens,id',
            'datum' => 'required|date',
            'status' => 'required|in:in behandeling,bevestigd,geannuleerd',
            'payment_status' => 'required|in:pending,paid,refunded',
            'notes' => 'nullable|string|max:500',
        ]);

        try {
            $booking->update($validated);
            
            Log::info('Booking updated successfully: ' . $booking->id);
            return redirect()->route('bookings.index')
                ->with('success', 'Boeking succesvol bijgewerkt.');
        } catch (\Exception $e) {
            Log::error('Error updating booking: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Er is een fout opgetreden bij het bijwerken van de boeking.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        try {
            $bookingId = $booking->id;
            $booking->delete();
            
            Log::info('Booking deleted successfully: ' . $bookingId);
            return redirect()->route('bookings.index')
                ->with('success', 'Boeking succesvol verwijderd.');
        } catch (\Exception $e) {
            Log::error('Error deleting booking: ' . $e->getMessage());
            return redirect()->route('bookings.index')
                ->with('error', 'Er is een fout opgetreden bij het verwijderen van de boeking.');
        }
    }
    
    /**
     * Mark a booking as paid.
     */
    public function markAsPaid(Booking $booking)
    {
        try {
            if ($booking->payment_status === 'paid') {
                return redirect()->route('bookings.index')
                    ->with('info', 'Deze boeking is al gemarkeerd als betaald.');
            }

            $booking->update(['payment_status' => 'paid']);
            
            Log::info('Booking marked as paid: ' . $booking->id);
            return redirect()->route('bookings.index')
                ->with('success', 'Boeking is succesvol gemarkeerd als betaald.');
        } catch (\Exception $e) {
            Log::error('Error marking booking as paid: ' . $e->getMessage());
            return redirect()->route('bookings.index')
                ->with('error', 'Er is een fout opgetreden bij het markeren van de boeking als betaald.');
        }
    }

    /**
     * Mark a booking as confirmed.
     */
    public function confirm(Booking $booking)
    {
        try {
            if ($booking->status === 'bevestigd') {
                return redirect()->route('bookings.index')
                    ->with('info', 'Deze boeking is al bevestigd.');
            }

            $booking->update(['status' => 'bevestigd']);
            
            Log::info('Booking confirmed: ' . $booking->id);
            return redirect()->route('bookings.index')
                ->with('success', 'Boeking is succesvol bevestigd.');
        } catch (\Exception $e) {
            Log::error('Error confirming booking: ' . $e->getMessage());
            return redirect()->route('bookings.index')
                ->with('error', 'Er is een fout opgetreden bij het bevestigen van de boeking.');
        }
    }

    /**
     * Cancel a booking.
     */
    public function cancel(Booking $booking)
    {
        try {
            if ($booking->status === 'geannuleerd') {
                return redirect()->route('bookings.index')
                    ->with('info', 'Deze boeking is al geannuleerd.');
            }

            $booking->update(['status' => 'geannuleerd']);
            
            Log::info('Booking cancelled: ' . $booking->id);
            return redirect()->route('bookings.index')
                ->with('success', 'Boeking is succesvol geannuleerd.');
        } catch (\Exception $e) {
            Log::error('Error cancelling booking: ' . $e->getMessage());
            return redirect()->route('bookings.index')
                ->with('error', 'Er is een fout opgetreden bij het annuleren van de boeking.');
        }
    }
}
