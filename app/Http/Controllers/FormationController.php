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


    //methode store el aadia menghir dropzone 
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'duree' => 'required|date_format:H:i',
            'type' => 'required|string',
            'prix' => 'required|numeric|regex:/^\d+(\.\d{1,3})?/',
            'categorie_id' => 'required|integer|exists:categories,id',
        ]);

        // Créer une formation avec les données de base
        $formationData = $request->except('image');

        // Vérifier et traiter l'image téléchargée via Dropzone
        if ($request->hasFile('image')) {
            // Stocke l'image dans storage/app/public/images
            $imagePath = $request->file('image')->store('images', 'public');
            // Ajoute le chemin de l'image aux données de formation
            $formationData['image'] = $imagePath;
        }

        // Créer la formation avec toutes les données, y compris le chemin de l'image
        Formation::create($formationData);

        session()->flash('success', 'Formation créée avec succès !');
        return redirect()->route('formations')->withInput();;
    }



public function update(Request $request, $id)
{
    $formation = Formation::findOrFail($id);
    
    // Validation
    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'duree' => 'required|regex:/\d{2}:\d{2}/',
        'type' => 'required|string',
        'prix' => 'required|numeric',
        'categorie_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Gestion de l'image
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si elle existe
        if ($formation->image) {
            Storage::delete('public/' . $formation->image);
        }

        // Télécharger la nouvelle image
        $imagePath = $request->file('image')->store('formations', 'public');
        $formation->image = $imagePath;
    } elseif ($request->delete_image == 1) {
        // Supprimer l'image si demandé
        if ($formation->image) {
            Storage::delete('public/' . $formation->image);
            $formation->image = null;
        }
    }

    // Mise à jour des autres informations
    $formation->titre = $request->titre;
    $formation->description = $request->description;
    $formation->duree = $request->duree;
    $formation->type = $request->type;
    $formation->prix = $request->prix;
    $formation->categorie_id = $request->categorie_id;
    $formation->save();

    return redirect()->route('formations')->with('success', 'Formation mise à jour avec succès');
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







