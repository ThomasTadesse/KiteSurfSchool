<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class InstructorController extends Controller
{
    /**
     * Display a listing of the instructors.
     */
    public function index()
    {
        $instructors = Instructor::with('user')->orderByDesc('created_at')->get();
        return view('instructors.index', compact('instructors'));
    }

    /**
     * Show the form for creating a new instructor.
     */
    public function create()
    {
        $users = User::whereDoesntHave('instructor')->get();
        return view('instructors.create', compact('users'));
    }

    /**
     * Store a newly created instructor in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id|unique:instructors,user_id',
            'specialization' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'certifications' => 'nullable|string|max:255',
            'years_of_experience' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $instructor = Instructor::create($validator->validated());
            Log::info('Nieuwe instructeur aangemaakt', ['instructor_id' => $instructor->id, 'user_id' => $instructor->user_id]);
            
            return redirect()->route('instructors.index')
                    ->with('success', 'Instructeur succesvol aangemaakt!');
        } catch (\Exception $e) {
            Log::error('Fout bij aanmaken instructeur', ['error' => $e->getMessage()]);
            return redirect()->back()
                ->with('error', 'Er is een fout opgetreden bij het aanmaken van de instructeur.')
                ->withInput();
        }
    }

    /**
     * Display the specified instructor.
     */
    public function show(Instructor $instructor)
    {
        $instructor->load('user', 'lespakketten');
        return view('instructors.show', compact('instructor'));
    }

    /**
     * Show the form for editing the specified instructor.
     */
    public function edit(Instructor $instructor)
    {
        return view('instructors.edit', compact('instructor'));
    }

    /**
     * Update the specified instructor in storage.
     */
    public function update(Request $request, Instructor $instructor)
    {
        $validator = Validator::make($request->all(), [
            'specialization' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'certifications' => 'nullable|string|max:255',
            'years_of_experience' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $instructor->update($validator->validated());
            Log::info('Instructeur bijgewerkt', ['instructor_id' => $instructor->id]);
            
            return redirect()->route('instructors.show', $instructor)
                   ->with('success', 'Instructeur succesvol bijgewerkt!');
        } catch (\Exception $e) {
            Log::error('Fout bij bijwerken instructeur', ['instructor_id' => $instructor->id, 'error' => $e->getMessage()]);
            return redirect()->back()
                ->with('error', 'Er is een fout opgetreden bij het bijwerken van de instructeur.')
                ->withInput();
        }
    }

    /**
     * Remove the specified instructor from storage.
     */
    public function destroy(Instructor $instructor)
    {
        try {
            $instructorId = $instructor->id;
            $instructor->delete();
            Log::info('Instructeur verwijderd', ['instructor_id' => $instructorId]);
            
            return redirect()->route('instructors.index')
                    ->with('success', 'Instructeur succesvol verwijderd!');
        } catch (\Exception $e) {
            Log::error('Fout bij verwijderen instructeur', ['instructor_id' => $instructor->id, 'error' => $e->getMessage()]);
            return redirect()->route('instructors.index')
                    ->with('error', 'Er is een fout opgetreden bij het verwijderen van de instructeur.');
        }
    }
}
