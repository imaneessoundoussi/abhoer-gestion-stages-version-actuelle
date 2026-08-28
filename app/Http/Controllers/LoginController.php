<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Afficher le formulaire de connexion.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Traiter la connexion.
     */
    public function login(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'login' => [
                'required',
                'string',
            ],
            'motDePasse' => [
                'required',
                'string',
            ],
        ], [
            'login.required' => 'Veuillez saisir votre login.',
            'motDePasse.required' => 'Veuillez saisir votre mot de passe.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Recherche de l'utilisateur
        |--------------------------------------------------------------------------
        */

        $utilisateur = Utilisateur::where(
            'login',
            $validated['login']
        )->first();

        /*
        |--------------------------------------------------------------------------
        | Vérification du compte
        |--------------------------------------------------------------------------
        */

        if (!$utilisateur) {
            return back()
                ->withInput($request->only('login'))
                ->withErrors([
                    'login' => 'Login ou mot de passe incorrect.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Vérification du mot de passe
        |--------------------------------------------------------------------------
        */

        if (!Hash::check(
            $validated['motDePasse'],
            $utilisateur->motDePasse
        )) {
            return back()
                ->withInput($request->only('login'))
                ->withErrors([
                    'login' => 'Login ou mot de passe incorrect.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Vérification du compte actif
        |--------------------------------------------------------------------------
        */

        if (!$utilisateur->actif) {
            return back()
                ->withInput($request->only('login'))
                ->withErrors([
                    'login' => 'Votre compte est désactivé. Veuillez contacter l’administrateur.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Connexion de l'utilisateur
        |--------------------------------------------------------------------------
        */

        Auth::login($utilisateur);

        // Régénérer la session pour la sécurité
        $request->session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | REDIRECTION SELON LE RÔLE
        |--------------------------------------------------------------------------
        */

        if ($utilisateur->role === 'ETUDIANT') {
            return redirect()
                ->route('etudiant.dashboard')
                ->with('success', 'Bienvenue dans votre espace étudiant.');
        }

        if ($utilisateur->role === 'ADMINISTRATEUR') {
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Bienvenue dans votre espace administrateur.');
        }

        /*
        |--------------------------------------------------------------------------
        | Rôle inconnu
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        return redirect()
            ->route('login')
            ->withErrors([
                'login' => 'Le rôle de votre compte n’est pas reconnu.',
            ]);
    }

    /**
     * Déconnexion.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Vous êtes déconnecté avec succès.');
    }
}