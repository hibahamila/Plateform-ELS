<?php
namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Categorie;
use Illuminate\Http\Request;

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
    //responsable de l'affichage du formulaire de création d'une nouvelle formation.
    public function create()
    {
        // Récupère toutes les catégories disponibles dans la base de données.
        $categories = Categorie::all();
        return view('admin.apps.formation.formationcreate', compact('categories'));

        // Renvoie la vue formations.create avec les catégories disponibles.
    }
    

    // Enregistrer une nouvelle formation
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            // 'duree' => 'required',
            'duree' => 'required|date_format:H:i', // Validation du format de la durée

            'type' => 'required|string',
            // 'prix' => 'required|numeric',
            'prix' => 'required|numeric|regex:/^\d+(\.\d{1,3})?/', // Accepte jusqu'à 3 décimales

            'categorie_id' => 'required|integer|exists:categories,id',
        ]);


        // Crée une nouvelle formation avec toutes les données validées de la requête.
         Formation::create($request->all());
         session()->flash('success', 'Formation créée avec succès !');


        // return redirect()->route('formations.index')->with('success', 'Formation ajoutée avec succès.');
                // return redirect()->route('formations.index');
                return redirect()->route('formations');



        // yhezek  lel  liste des formations avec  message de succès.
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

    // Mettre à jour une formation
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'duree' => 'required|date_format:H:i', // Validation du format de la durée
            'type' => 'required|string',
            // 'prix' => 'required|numeric',
            'prix' => 'required|numeric|regex:/^\d+(\.\d{1,2})?/',  // Validation pour un prix avec 2 décimales

            'categorie_id' => 'required|integer|exists:categories,id',
        ]);

        $formation = Formation::findOrFail($id);
        $formation->update($request->all());

        return redirect()->route('formations')->with('success', 'Formation mise à jour avec succès.');
    }

    // Supprimer une formation
    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();
        return redirect()->route('formations')->with('delete', 'Formation supprimée avec succès.');


    }
}
