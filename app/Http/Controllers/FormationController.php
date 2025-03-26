<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;  // Ajoutez cette ligne


class FormationController extends Controller
{
    // Afficher la liste des formations
    public function index()
    {
        // yjib les formations lkol mel table
        $formations = Formation::all();

        //renvoie les formations avec les donnees
        return view('admin.apps.formation.formations', compact('formations'));
    }






    // Afficher le formulaire de création
    public function create()
    {
        // Récupère toutes les catégories disponibles dans la base de données.
        $categories = Categorie::all();
        return view('admin.apps.formation.formationcreate', compact('categories'));
    }



public function store(Request $request)
{
    // Définir une valeur par défaut pour le statut
    $request->merge(['status' => $request->has('status') ? 1 : 0]);

    // Valider les données
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|string',
        'type' => 'required|string',
        'price' => 'required|numeric',
        'categorie_id' => 'required|exists:categories,id',
        'image' => 'required|image|mimes:jpg,png,gif|max:2048',
        'status' => 'required|boolean', // Le statut est obligatoire et doit être un booléen
    ]);

    // Enregistrer l'image
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('formations', 'public');
        $validatedData['image'] = $imagePath;
    }

    // Créer la formation
    Formation::create($validatedData);

    return redirect()->route('formations')->with('success', 'Formation créée avec succès.');
}



public function update(Request $request, $id)
{
    $formation = Formation::findOrFail($id);

    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|string',
        'type' => 'required|string',
        'price' => 'required|numeric',
        'categorie_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'status' => 'nullable|boolean',
    ]);

    // Gestion de l'image
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si elle existe
        if ($formation->image) {
            Storage::delete('public/' . $formation->image);
        }

        // Télécharger la nouvelle image
        $imagePath = $request->file('image')->store('formations', 'public');
        $data['image'] = $imagePath; // Ajouter le chemin de l'image au tableau $data
    } elseif ($request->delete_image == 1) {
        // Supprimer l'image si demandé
        if ($formation->image) {
            Storage::delete('public/' . $formation->image);
            $data['image'] = null; // Ajouter la valeur null au tableau $data
        }
    }

    // Mettre à jour le statut
    $data['status'] = (bool)$request->input('status', false);

    // Mettre à jour la formation avec les données validées
    $formation->update($data);

    return redirect()->route('formations')->with('success', 'Formation mise à jour avec succès.');
}






    // Afficher une formation spécifique
    public function show($id)
    {
        $formation = Formation::findOrFail($id); // Recherche la formation par son ID et génère une erreur 404 si elle n'est pas trouvée.

        // Renvoie la vue admin.apps.formation.formationshow avec les données de la formation trouvée.
        return view('admin.apps.formation.formationshow', compact('formation'));
    }






    // Afficher le formulaire de modification
    public function edit($id)
    {
        $formation = Formation::findOrFail($id);
        $categories = Categorie::all();
        return view('admin.apps.formation.formationedit', compact('formation', 'categories'));
    }







    // Supprimer une formation
    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);

        // Supprimer l'image associée si elle existe
        if ($formation->image && file_exists(storage_path('app/public/' . $formation->image))) {
            unlink(storage_path('app/public/' . $formation->image));
        }

        $formation->delete();
        return redirect()->route('formations')->with('delete', 'Formation supprimée avec succès.');
    }
}







