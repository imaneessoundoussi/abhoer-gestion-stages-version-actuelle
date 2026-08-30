<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Departement;
use Illuminate\Http\Request;

class AdminServiceController extends Controller
{
    /**
     * Afficher la liste des services.
     */
    public function index()
    {
        $services = Service::with('departement')
            ->orderBy('idService', 'desc')
            ->get();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Afficher le formulaire d'ajout.
     */
    public function create()
    {
        $departements = Departement::orderBy('nomDepartement')->get();

        return view('admin.services.create', compact('departements'));
    }

    /**
     * Enregistrer un nouveau service.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idDepartement' => [
                'required',
                'integer',
                'exists:departement,idDepartement',
            ],

            'nomService' => [
                'required',
                'string',
                'max:255',
            ],

            'capaciteAccueil' => [
                'required',
                'integer',
                'min:0',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ]);

        Service::create($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service ajouté avec succès.');
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(int $idService)
    {
        $service = Service::findOrFail($idService);

        $departements = Departement::orderBy('nomDepartement')->get();

        return view(
            'admin.services.edit',
            compact('service', 'departements')
        );
    }

    /**
     * Modifier un service.
     */
    public function update(Request $request, int $idService)
    {
        $service = Service::findOrFail($idService);

        $validated = $request->validate([
            'idDepartement' => [
                'required',
                'integer',
                'exists:departement,idDepartement',
            ],

            'nomService' => [
                'required',
                'string',
                'max:255',
            ],

            'capaciteAccueil' => [
                'required',
                'integer',
                'min:0',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ]);

        $service->update($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service modifié avec succès.');
    }

    /**
     * Supprimer un service.
     */
    public function destroy(int $idService)
    {
        $service = Service::findOrFail($idService);

        if ($service->demandes()->exists()) {
            return redirect()
                ->route('admin.services.index')
                ->with(
                    'error',
                    'Impossible de supprimer ce service car il possède des demandes de stage.'
                );
        }

        if ($service->affectations()->exists()) {
            return redirect()
                ->route('admin.services.index')
                ->with(
                    'error',
                    'Impossible de supprimer ce service car il possède des affectations.'
                );
        }

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service supprimé avec succès.');
    }
}