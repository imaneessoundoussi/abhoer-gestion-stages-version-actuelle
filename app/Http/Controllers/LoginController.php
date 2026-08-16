<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Afficher la page de connexion.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Traiter la connexion.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'motDePasse' => ['required', 'string'],
        ], [
            'login.required' => 'Le login est obligatoire.',
            'motDePasse.required' => 'Le mot de passe est obligatoire.',
        ]);

        if (Auth::attempt([
            'login' => $credentials['login'],
            'password' => $credentials['motDePasse'],
            'actif' => true,
        ])) {
            $request->session()->regenerate();

            $user = Auth::user();

            return match ($user->role) {
                'ADMINISTRATEUR' => redirect('/admin/dashboard'),
                'AGENT' => redirect('/agent/dashboard'),
                'RESPONSABLE' => redirect('/responsable/dashboard'),
                default => redirect('/'),
            };
        }

        return back()
            ->withErrors([
                'login' => 'Login ou mot de passe incorrect.',
            ])
            ->withInput($request->only('login'));
    }

    /**
     * Déconnexion.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}