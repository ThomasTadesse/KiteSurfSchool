<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Store a new contact message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        return back()->with('success', 'Bedankt! Je bericht is succesvol verzonden.');
    }

    /**
     * Display the specified contact message.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        // Ensure only the owner can view contact messages
        if (!Auth::user()->isEigenaar()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('contact.show', compact('contact'));
    }

    /**
     * Remove the specified contact message from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        // Ensure only the owner can delete contact messages
        if (!Auth::user()->isEigenaar()) {
            abort(403, 'Unauthorized action.');
        }

        $contact->delete();
        
        return redirect()->route('profile.show')->with('success', 'Bericht succesvol verwijderd.');
    }
}
