<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reponse;

class ReponseController extends Controller
{
    /**
     * Afficher toutes les réponses.
     */
    public function index()
    {
        $reponses = Reponse::all();
        return view('reponses.index', compact('reponses'));
    }

    /**
     * Afficher le formulaire de création d'une réponse.
     */
    public function create()
    {
        return view('reponses.create');
    }

    /**
     * Enregistrer une nouvelle réponse dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string',
            'question_id' => 'required|exists:questions,id'
        ]);

        Reponse::create([
            'contenu' => $request->contenu,
            'question_id' => $request->question_id,
        ]);

        return redirect()->route('reponses.index')->with('success', 'Réponse ajoutée avec succès.');
    }

    /**
     * Afficher une réponse spécifique.
     */
    public function show($id)
    {
        $reponse = Reponse::findOrFail($id);
        return view('reponses.show', compact('reponse'));
    }

    /**
     * Afficher le formulaire de modification d'une réponse.
     */
    public function edit($id)
    {
        $reponse = Reponse::findOrFail($id);
        return view('reponses.edit', compact('reponse'));
    }

    /**
     * Mettre à jour une réponse.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'contenu' => 'required|string',
        ]);

        $reponse = Reponse::findOrFail($id);
        $reponse->update([
            'contenu' => $request->contenu,
        ]);

        return redirect()->route('reponses.index')->with('success', 'Réponse mise à jour avec succès.');
    }

    /**
     * Supprimer une réponse.
     */
    public function destroy($id)
    {
        $reponse = Reponse::findOrFail($id);
        $reponse->delete();

        return redirect()->route('reponses.index')->with('success', 'Réponse supprimée avec succès.');
    }
}
