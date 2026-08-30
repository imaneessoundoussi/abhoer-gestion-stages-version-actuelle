<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Vérifie le rôle de l'utilisateur connecté.
     */
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {
        // =========================================================
        // VÉRIFIER LA CONNEXION
        // =========================================================

        if (! $request->user()) {
            return redirect()->route('login');
        }

        $user = $request->user();

        // =========================================================
        // VÉRIFIER LE RÔLE
        // =========================================================

        if (! in_array($user->role, $roles, true)) {
            abort(
                403,
                'Accès non autorisé.'
            );
        }

        return $next($request);
    }
}