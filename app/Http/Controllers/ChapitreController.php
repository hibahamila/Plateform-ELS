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

     public function create()
    {
        $cours = Cours::all();   
        return view('admin.apps.chapitre.chapitrecreate', compact('cours'));
    }



    //code jdid 
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'cours_id' => 'required|exists:cours,id',
        'duration' => 'required|date_format:H:i',
    ]);
    $chapitre = Chapitre::create($request->all());
    // pour passe l id a la vue suivante 
    session()->flash('chapitre_id', $chapitre->id);

    // Rediriger vers la même page pour permettre la persistance des données dans le formulaire
    return redirect()->route('chapitrecreate')->withInput(); // Utilisez withInput() pour maintenir les anciennes données


}

   
    public function edit($id)
    {
        $chapitre = Chapitre::findOrFail($id);
        $cours = Cours::all();
        return view('admin.apps.chapitre.chapitreedit', compact('chapitre', 'cours'));
    }

    public function show($id)
{
    $chapitre = Chapitre::with('cours')->findOrFail($id);

    return view('admin.apps.chapitre.chapitreshow', compact('chapitre'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cours_id' => 'required|exists:cours,id',
            'duration' => 'required|date_format:H:i',
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


