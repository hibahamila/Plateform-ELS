<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Formation;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('admin.apps.categorie.categories', compact('categories'));
    }

    public function create()
    {
        return view('admin.apps.categorie.categoriecreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Categorie::create($request->all());
        return redirect()->route('formations');


        // return redirect()->route('categories')->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function show($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('admin.apps.categorie.categorieshow', compact('categorie'));
    }

    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);
        $formations = Formation::all(); // Ajouter la récupération des formations


        return view('admin.apps.categorie.categorieedit', compact('categorie','formations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $categorie = Categorie::findOrFail($id);
        $categorie->update($request->all());

        return redirect()->route('categories')->with('success', 'Catégorie mise à jour avec succès.');
    }

   

    public function destroy($id)
    {
        try {
            // Trouver la catégorie par son ID ou lever une exception si elle n'existe pas
            $categorie = Categorie::findOrFail($id);
            
            // Récupérer le nom de la catégorie
            $categorieName = $categorie->title;  // Remplacez 'nom' par le champ correct
    
            // Supprimer la catégorie
            $categorie->delete();
    
            // Retourner un message de succès
            return response()->json(['successMessage' => "La catégorie '{$categorieName}' a été supprimée avec succès!"]);
        } catch (\Exception $e) {
            // En cas d'erreur, retourner un message d'erreur
            return response()->json(['errorMessage' => 'Une erreur est survenue.']);
        }
    }
    


}
