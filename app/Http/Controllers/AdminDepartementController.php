<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class AdminDepartementController extends Controller
{
    /**
     * Afficher la liste des départements.
     */
    public function index()
    {
        $departements = Departement::withCount('services')
            ->orderBy('idDepartement', 'desc')
            ->get();

        return view('admin.departements.index', compact('departements'));
    }

    /**
     * Afficher le formulaire d'ajout.
     */
    public function create()
    {
        return view('admin.departements.create');
    }

    /**
     * Enregistrer un nouveau département.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomDepartement' => [
                'required',
                'string',
                'max:255',
                'unique:departement,nomDepartement',
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'nomDepartement.required' => 'Le nom du département est obligatoire.',
            'nomDepartement.unique' => 'Ce département existe déjà.',
            'nomDepartement.max' => 'Le nom du département ne doit pas dépasser 255 caractères.',
            'description.max' => 'La description ne doit pas dépasser 1000 caractères.',
        ]);

        Departement::create([
            'nomDepartement' => $request->nomDepartement,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.departements.index')
            ->with('success', 'Département ajouté avec succès.');
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(int $id)
    {
        $departement = Departement::findOrFail($id);

        return view('admin.departements.edit', compact('departement'));
    }

    /**
     * Mettre à jour un département.
     */
    public function update(Request $request, int $id)
    {
        $departement = Departement::findOrFail($id);

        $request->validate([
            'nomDepartement' => [
                'required',
                'string',
                'max:255',
                'unique:departement,nomDepartement,' . $id . ',idDepartement',
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'nomDepartement.required' => 'Le nom du département est obligatoire.',
            'nomDepartement.unique' => 'Ce département existe déjà.',
            'nomDepartement.max' => 'Le nom du département ne doit pas dépasser 255 caractères.',
            'description.max' => 'La description ne doit pas dépasser 1000 caractères.',
        ]);

        $departement->update([
            'nomDepartement' => $request->nomDepartement,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.departements.index')
            ->with('success', 'Département modifié avec succès.');
    }

    /**
     * Supprimer un département.
     */
    public function destroy(int $id)
    {
        $departement = Departement::findOrFail($id);

        /*
         * Un département ne peut pas être supprimé
         * s'il possède encore des services.
         */
        if ($departement->services()->exists()) {
            return redirect()
                ->route('admin.departements.index')
                ->with(
                    'error',
                    'Impossible de supprimer ce département car il possède encore des services.'
                );
        }

        $departement->delete();

        return redirect()
            ->route('admin.departements.index')
            ->with('success', 'Département supprimé avec succès.');
    }
}