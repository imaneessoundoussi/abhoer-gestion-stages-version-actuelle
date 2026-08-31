<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Vérifie que l'utilisateur connecté possède
     * l'un des rôles autorisés.
     *
     * Exemple :
     * ->middleware('role:ADMINISTRATEUR')
     * ->middleware('role:ETUDIANT')
     * ->middleware('role:RESPONSABLE')
     */
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {
        /*
        |--------------------------------------------------------------------------
        | Récupérer le système d'authentification Laravel
        |--------------------------------------------------------------------------
        */

        $auth = app(AuthFactory::class);

        /*
        |--------------------------------------------------------------------------
        | Vérifier si l'utilisateur est connecté
        |--------------------------------------------------------------------------
        */

        if (!$auth->guard()->check()) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'Veuillez vous connecter pour accéder à cette page.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Récupérer l'utilisateur connecté
        |--------------------------------------------------------------------------
        */

        $utilisateur = $auth->guard()->user();

        /*
        |--------------------------------------------------------------------------
        | Vérifier le rôle
        |--------------------------------------------------------------------------
        */

        if (
            $utilisateur === null ||
            !in_array($utilisateur->role, $roles, true)
        ) {
            /*
            |--------------------------------------------------------------------------
            | Déconnexion
            |--------------------------------------------------------------------------
            */

            $auth->guard()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'Vous n\'êtes pas autorisé à accéder à cette page.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Accès autorisé
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}
