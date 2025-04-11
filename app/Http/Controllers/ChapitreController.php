<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use App\Models\Cours;
use Illuminate\Http\Request;

class ChapitreController extends Controller
{
    public function index()
    {
        $chapitres = Chapitre::with('cours')->get();
        return view('admin.apps.chapitre.chapitres', compact('chapitres'));
    }

    public function create(Request $request)
    {
        $cours_id = $request->query('cours_id');
        $cours = Cours::all();
        return view('admin.apps.chapitre.chapitrecreate', compact('cours', 'cours_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cours_id' => 'required|exists:cours,id',
        ]);

        // Suppression du champ duration de la validation car il sera calculé automatiquement
        // Nous créons le chapitre sans spécifier la durée
        $chapitre = Chapitre::create([
            'title' => $request->title,
            'description' => $request->description,
            'cours_id' => $request->cours_id,
            // La durée sera automatiquement calculée à 0 pour les nouveaux chapitres
        ]);

        // Flasher l'id du chapitre dans la session pour l'utiliser dans l'alerte
        session()->flash('chapitre_id', $chapitre->id);

        // Rediriger vers la même page pour permettre la persistance des données dans le formulaire
        return redirect()->route('chapitrecreate')->withInput();
    }
   
    public function edit($id)
    {
        $chapitre = Chapitre::findOrFail($id);
        $cours = Cours::all();
        return view('admin.apps.chapitre.chapitreedit', compact('chapitre', 'cours'));
    }

    public function show($id)
    {
        $chapitre = Chapitre::with(['cours', 'lessons'])->findOrFail($id);
        // Ajout des leçons pour pouvoir afficher la durée calculée
        return view('admin.apps.chapitre.chapitreshow', compact('chapitre'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cours_id' => 'required|exists:cours,id',
        ]);

        // Suppression du champ duration de la validation car il sera calculé automatiquement
        $chapitre = Chapitre::findOrFail($id);
        
        // Mise à jour des champs validés - la durée sera automatiquement calculée 
        // dans le boot method du modèle lors de la sauvegarde
        $chapitre->update([
            'title' => $request->title,
            'description' => $request->description,
            'cours_id' => $request->cours_id,
        ]);

        return redirect()->route('chapitres')->with('success', 'Chapitre mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $chapitre = Chapitre::findOrFail($id);
        $chapitre->delete();

        return redirect()->route('chapitres')->with('delete', 'Chapitre supprimé avec succès.');
    }
}