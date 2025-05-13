<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on user role
            $user = Auth::user();
            if ($user->role === 'eigenaar') {
                return redirect('/dashboard');
            } elseif ($user->role === 'instructeur') {
                return redirect('/lesrooster');
            } else {
                return redirect('/profiel');
            }
        }

        return back()->withErrors([
            'email' => 'De opgegeven inloggegevens komen niet overeen met onze gegevens.',
        ])->withInput($request->except('password'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);

        // Generate activation token
        $activationToken = Str::random(60);

        // Create user with activation token and set active to false
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'activation_token' => $activationToken,
            'active' => false,
        ]);

        // Send welcome email with activation link
        Mail::to($user->email)->send(new WelcomeMail($user, $activationToken));

        return redirect('/login')->with('status', 'Registratie succesvol! Controleer je e-mail om je account te activeren.');
    }

    public function activateAccount($token)
    {
        $user = User::where('activation_token', $token)->first();
        
        if (!$user) {
            return redirect('/login')->with('error', 'Ongeldige activatie link.');
        }
        
        $user->activation_token = null;
        $user->active = true;
        $user->save();
        
        return redirect('/login')->with('status', 'Je account is geactiveerd! Je kunt nu inloggen.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
