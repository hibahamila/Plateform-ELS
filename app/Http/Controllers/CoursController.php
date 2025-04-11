<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Formation;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    public function index()
    {
        $cours = Cours::with('formation')->get();
        return view('admin.apps.cours.cours', compact('cours'));
    }

    public function create(Request $request)
    {
        $formation_id = $request->query('formation_id'); 
        $formations = Formation::all();
        
        return view('admin.apps.cours.courscreate', compact('formations', 'formation_id'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'formation_id' => 'required|exists:formations,id',
        ]);

        // Création du cours - la durée sera automatiquement calculée dans le boot method du modèle
        $cours = Cours::create($validatedData);

        // Flasher l'id du cours dans la session pour l'utiliser dans l'alerte
        session()->flash('cours_id', $cours->id);

        // Rediriger vers la même page pour permettre la persistance des données dans le formulaire
        return redirect()->route('courscreate')->withInput();
    }

    public function show($id)
    {
        $cours = Cours::with('formation')->findOrFail($id);
        return view('admin.apps.cours.coursshow', compact('cours'));
    }

    public function edit($id)
    {
        $cours = Cours::findOrFail($id);
        $formations = Formation::all();
        return view('admin.apps.cours.coursedit', compact('cours', 'formations'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'formation_id' => 'required|exists:formations,id',
        ]);

        $cours = Cours::findOrFail($id);
        
        // Mise à jour des champs validés - la durée sera automatiquement calculée
        // dans le boot method du modèle lors de la sauvegarde
        $cours->update($request->only([
            'title', 'description', 'start_date', 'end_date', 'formation_id'
        ]));

        return redirect()->route('cours')->with('success', 'Cours mis à jour avec succès.');
    }
   
    public function destroy($id)
    {
        $cours = Cours::findOrFail($id);
        $cours->delete();

        return redirect()->route('cours')->with('delete', 'Cours supprimé avec succès.');
    }
}