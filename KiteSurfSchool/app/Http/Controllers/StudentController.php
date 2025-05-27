<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\lespakketten;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
    public function index()
    {
        try {
            $students = Student::with('user')->get();
            
            // Check if the view exists before rendering
            if (!View::exists('students.index')) {
                Log::error('View students.index niet gevonden');
                return response()->view('errors.custom', [
                    'message' => 'De pagina die je zoekt kan niet worden gevonden.'
                ], 404);
            }
            
            return view('students.index', compact('students'));
        } catch (\Exception $e) {
            Log::error('Fout bij het ophalen van studenten: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het ophalen van de studentenlijst.');
        }
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        try {
            // Get users that are not already students
            $users = User::whereDoesntHave('student')->get();
            
            // If no eligible users are found, return with a message
            if ($users->isEmpty()) {
                return redirect()->route('students.index')
                    ->with('info', 'Alle gebruikers zijn al als student geregistreerd. Maak eerst een nieuwe gebruiker aan.');
            }
            
            // Check if the view exists before rendering
            if (!View::exists('students.create')) {
                Log::error('View students.create niet gevonden');
                return redirect()->route('students.index')
                    ->with('error', 'Het aanmaakformulier kan niet worden gevonden.');
            }
            
            return view('students.create', compact('users'));
        } catch (\Exception $e) {
            Log::error('Fout bij het laden van het create formulier: ' . $e->getMessage());
            return redirect()->route('students.index')
                ->with('error', 'Er is een fout opgetreden bij het laden van het formulier: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id|unique:students,user_id',
            'date_of_birth' => 'nullable|date',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'medical_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $student = Student::create($validator->validated());
            
            return redirect()->route('students.show', $student)
                ->with('success', 'Student is succesvol aangemaakt!');
        } catch (\Exception $e) {
            Log::error('Fout bij het aanmaken van een student: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Er is een fout opgetreden bij het aanmaken van de student.')
                ->withInput();
        }
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        try {
            // Debug information
            Log::info('Showing student with ID: ' . $student->id);
            
            // Eager load relationships to prevent N+1 query issues
            $student->load(['user', 'lespakketten']);
            
            // Check if the view exists before rendering
            if (!View::exists('students.show')) {
                Log::error('View students.show niet gevonden');
                return redirect()->route('students.index')
                    ->with('error', 'De detailpagina kan niet worden gevonden.');
            }
            
            return view('students.show', compact('student'));
        } catch (\Exception $e) {
            Log::error('Fout bij het tonen van student: ' . $e->getMessage());
            return redirect()->route('students.index')
                ->with('error', 'Er is een fout opgetreden bij het tonen van de studentdetails: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        try {
            // Check if the view exists before rendering
            if (!View::exists('students.edit')) {
                Log::error('View students.edit niet gevonden');
                return response()->view('errors.custom', [
                    'message' => 'Het bewerkingsformulier kan niet worden gevonden.'
                ], 404);
            }
            
            return view('students.edit', compact('student'));
        } catch (\Exception $e) {
            Log::error('Fout bij het laden van het edit formulier voor student ID ' . $student->id . ': ' . $e->getMessage());
            return redirect()->route('students.index')
                ->with('error', 'Er is een fout opgetreden bij het laden van het bewerkingsformulier.');
        }
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'date_of_birth' => 'nullable|date',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'medical_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $student->update($validator->validated());
            
            return redirect()->route('students.show', $student)
                ->with('success', 'Studentinformatie is succesvol bijgewerkt!');
        } catch (\Exception $e) {
            Log::error('Fout bij het bijwerken van student ID ' . $student->id . ': ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Er is een fout opgetreden bij het bijwerken van de studentinformatie.')
                ->withInput();
        }
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return redirect()->route('students.index')
                ->with('success', 'Student is succesvol verwijderd!');
        } catch (\Exception $e) {
            Log::error('Fout bij het verwijderen van student ID ' . $student->id . ': ' . $e->getMessage());
            return redirect()->route('students.index')
                ->with('error', 'Er is een fout opgetreden bij het verwijderen van de student.');
        }
    }
}
