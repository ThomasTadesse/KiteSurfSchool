<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstructorController extends Controller
{
    /**
     * Display a listing of the instructors.
     */
    public function index()
    {
        $instructors = Instructor::with('user')->get();
        return view('instructors.index', compact('instructors'));
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
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $instructor = Instructor::create($validator->validated());
        
        return response()->json($instructor, 201);
    }

    /**
     * Display the specified instructor.
     */
    public function show(Instructor $instructor)
    {
        $instructor->load('user', 'lespakketten');
        return response()->json($instructor);
    }

    /**
     * Update the specified instructor in storage.
     */
    public function update(Request $request, Instructor $instructor)
    {
        $validator = Validator::make($request->all(), [
            'specialization' => 'string|max:255',
            'bio' => 'nullable|string',
            'certifications' => 'nullable|string|max:255',
            'years_of_experience' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $instructor->update($validator->validated());
        
        return response()->json($instructor);
    }

    /**
     * Remove the specified instructor from storage.
     */
    public function destroy(Instructor $instructor)
    {
        $instructor->delete();
        return response()->json(null, 204);
    }
}
