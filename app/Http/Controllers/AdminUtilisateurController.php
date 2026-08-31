<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUtilisateurController extends Controller
{
    /**
     * Vérifier que l'utilisateur connecté est administrateur.
     */
    private function verifierAdmin(): void
    {
        $user = Auth::user();

        if (
            !$user ||
            strtoupper(trim($user->role)) !== 'ADMINISTRATEUR'
        ) {
            abort(403, 'Accès non autorisé.');
        }
    }


    /**
     * Liste des utilisateurs.
     */
    public function index()
    {
        $this->verifierAdmin();

        $utilisateurs = Utilisateur::with([
            'candidat',
            'service',
        ])
            ->orderBy('nom')
            ->orderBy('prenom')
            ->get();

        return view(
            'admin.utilisateurs.index',
            compact('utilisateurs')
        );
    }


    /**
     * Formulaire de création.
     */
    public function create()
    {
        $this->verifierAdmin();

        return view(
            'admin.utilisateurs.create'
        );
    }


    /**
     * Enregistrer un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        $this->verifierAdmin();

        $validated = $request->validate([
            'nom' => [
                'required',
                'string',
                'max:100',
            ],

            'prenom' => [
                'required',
                'string',
                'max:100',
            ],

            'login' => [
                'required',
                'string',
                'max:100',
                'unique:utilisateur,login',
            ],

            'motDePasse' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],

            'role' => [
                'required',
                'in:ETUDIANT,RESPONSABLE,ADMINISTRATEUR',
            ],
        ]);


        Utilisateur::create([
            'nom' => $validated['nom'],

            'prenom' => $validated['prenom'],

            'login' => $validated['login'],

            'motDePasse' => Hash::make(
                $validated['motDePasse']
            ),

            'role' => $validated['role'],

            'actif' => true,
        ]);


        return redirect()
            ->route('admin.utilisateurs.index')
            ->with(
                'success',
                'Utilisateur créé avec succès.'
            );
    }


    /**
     * Formulaire de modification.
     */
    public function edit(int $idUtilisateur)
    {
        $this->verifierAdmin();

        $utilisateur = Utilisateur::findOrFail(
            $idUtilisateur
        );

        return view(
            'admin.utilisateurs.edit',
            compact('utilisateur')
        );
    }


    /**
     * Modifier un utilisateur.
     */
    public function update(
        Request $request,
        int $idUtilisateur
    ) {
        $this->verifierAdmin();

        $utilisateur = Utilisateur::findOrFail(
            $idUtilisateur
        );


        $validated = $request->validate([
            'nom' => [
                'required',
                'string',
                'max:100',
            ],

            'prenom' => [
                'required',
                'string',
                'max:100',
            ],

            'login' => [
                'required',
                'string',
                'max:100',
                'unique:utilisateur,login,' .
                    $idUtilisateur .
                    ',idUtilisateur',
            ],

            'role' => [
                'required',
                'in:ETUDIANT,RESPONSABLE,ADMINISTRATEUR',
            ],

            'actif' => [
                'nullable',
                'boolean',
            ],
        ]);


        $utilisateur->update([
            'nom' => $validated['nom'],

            'prenom' => $validated['prenom'],

            'login' => $validated['login'],

            'role' => $validated['role'],

            'actif' => $request->boolean('actif'),
        ]);


        /*
        |--------------------------------------------------------------------------
        | Modifier le mot de passe uniquement s'il est fourni
        |--------------------------------------------------------------------------
        */

        if ($request->filled('motDePasse')) {

            $request->validate([
                'motDePasse' => [
                    'string',
                    'min:6',
                    'confirmed',
                ],
            ]);


            $utilisateur->update([
                'motDePasse' => Hash::make(
                    $request->input('motDePasse')
                ),
            ]);
        }


        return redirect()
            ->route('admin.utilisateurs.index')
            ->with(
                'success',
                'Utilisateur modifié avec succès.'
            );
    }


    /**
     * Activer / désactiver un utilisateur.
     */
    public function toggle(int $idUtilisateur)
    {
        $this->verifierAdmin();


        $utilisateur = Utilisateur::findOrFail(
            $idUtilisateur
        );


        $userConnecte = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Empêcher l'administrateur de désactiver son propre compte
        |--------------------------------------------------------------------------
        */

        if (
            $userConnecte &&
            $userConnecte->idUtilisateur ===
            $utilisateur->idUtilisateur
        ) {
            return back()->with(
                'error',
                'Vous ne pouvez pas désactiver votre propre compte.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Inverser l'état du compte
        |--------------------------------------------------------------------------
        */

        $utilisateur->actif = !$utilisateur->actif;

        $utilisateur->save();


        /*
        |--------------------------------------------------------------------------
        | Message
        |--------------------------------------------------------------------------
        */

        $message = $utilisateur->actif
            ? 'Utilisateur activé avec succès.'
            : 'Utilisateur désactivé avec succès.';


        return back()->with(
            'success',
            $message
        );
    }


    /**
     * Supprimer un utilisateur.
     */
    public function destroy(int $idUtilisateur)
    {
        $this->verifierAdmin();


        $utilisateur = Utilisateur::findOrFail(
            $idUtilisateur
        );


        $userConnecte = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Empêcher l'administrateur de supprimer son propre compte
        |--------------------------------------------------------------------------
        */

        if (
            $userConnecte &&
            $userConnecte->idUtilisateur ===
            $utilisateur->idUtilisateur
        ) {
            return back()->with(
                'error',
                'Vous ne pouvez pas supprimer votre propre compte.'
            );
        }


        $utilisateur->delete();


        return back()->with(
            'success',
            'Utilisateur supprimé avec succès.'
        );
    }
}
