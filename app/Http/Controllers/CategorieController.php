<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Formation;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    // Afficher la liste des catégories
    public function index()
    {
        $categories = Categorie::all();
        return view('admin.apps.categorie.categories', compact('categories'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('admin.apps.categorie.categoriecreate');
    }

    // Enregistrer une nouvelle catégorie
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
        ]);

        Categorie::create($request->all());

        return redirect()->route('categories')->with('success', 'Catégorie ajoutée avec succès.');
    }

    // Afficher une catégorie spécifique
    public function show($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('admin.apps.categorie.categorieshow', compact('categorie'));
    }

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);
        $formations = Formation::all(); // Ajouter la récupération des formations


        return view('admin.apps.categorie.categorieedit', compact('categorie','formations'));
    }

    // Mettre à jour une catégorie
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
        ]);

        $categorie = Categorie::findOrFail($id);
        $categorie->update($request->all());

        return redirect()->route('categories')->with('success', 'Catégorie mise à jour avec succès.');
    }

    // Supprimer une catégorie
    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return redirect()->route('categories')->with('delete', 'Catégorie supprimée avec succès.');
    }
}
