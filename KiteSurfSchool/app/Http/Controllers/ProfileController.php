<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the profile dashboard with contact forms for owners.
     */
    public function show()
    {
        $user = Auth::user();
        $data = [];
        
        // Only fetch contact forms if user is an owner
        if ($user->isEigenaar()) {
            $data['contacts'] = Contact::orderBy('created_at', 'desc')->get();
        }
        
        return view('profiel', $data);
    }
}
