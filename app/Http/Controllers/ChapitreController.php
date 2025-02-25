<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use App\Models\Cours;
use Illuminate\Http\Request;

class ChapitreController extends Controller
{
    public function index()
    {
        // Récupérer tous les chapitres
        $chapitres = Chapitre::with('cours')->get();
        return view('admin.apps.chapitre.chapitres', compact('chapitres'));
    }

    public function create()
    {
        // Récupérer les cours pour les afficher dans un select
        $cours = Cours::all();
        return view('admin.apps.chapitre.chapitrecreate', compact('cours'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'cours_id' => 'required|exists:cours,id',
            'duree' => 'required|date_format:H:i',
        ]);

        // Création du chapitre
        Chapitre::create($request->all());

        return redirect()->route('chapitres')->with('success', 'Chapitre ajouté avec succès.');
    }

    public function edit($id)
    {
        $chapitre = Chapitre::findOrFail($id);
        $cours = Cours::all();
        return view('admin.apps.chapitre.chapitreedit', compact('chapitre', 'cours'));
    }

    public function show($id)
{
    // Récupérer le chapitre avec son id, incluant les informations de cours associées
    $chapitre = Chapitre::with('cours')->findOrFail($id);

    // Retourner la vue avec les données du chapitre
    return view('admin.apps.chapitre.chapitreshow', compact('chapitre'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'cours_id' => 'required|exists:cours,id',
            'duree' => 'required|date_format:H:i',
        ]);

        $chapitre = Chapitre::findOrFail($id);
        $chapitre->update($request->all());

        return redirect()->route('chapitres')->with('success', 'Chapitre mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $chapitre = Chapitre::findOrFail($id);
        $chapitre->delete();

        return redirect()->route('chapitres')->with('delete', 'Chapitre supprimé avec succès.');
    }
}
