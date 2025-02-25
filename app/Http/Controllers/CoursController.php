<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\User;
use App\Models\Formation;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    /**
     * Afficher la liste des cours.
     */
    public function index()
    {
        $cours = Cours::with('user', 'formation')->get();
        return view('admin.apps.cours.cours', compact('cours'));
    }

    /**
     * Afficher le formulaire de création d'un cours.
     */
    public function create()
    {
        $users = User::all();
        $formations = Formation::all();
        return view('admin.apps.cours.courscreate', compact('users', 'formations'));
    }

    /**
     * Enregistrer un nouveau cours.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'user_id' => 'required|exists:users,id',
            'formation_id' => 'required|exists:formations,id',
        ]);

        Cours::create($request->all());


        return redirect()->route('cours')->with('success', 'Cours ajouté avec succès.');
    }

    /**
     * Afficher les détails d'un cours.
     */
    public function show($id)
    {
        $cours = Cours::with('user', 'formation')->findOrFail($id);
        return view('admin.apps.cours.coursshow', compact('cours'));
    }

    /**
     * Afficher le formulaire d'édition d'un cours.
     */
    public function edit($id)
    {
        $cours = Cours::findOrFail($id);
        $users = User::all();
        $formations = Formation::all();
        return view('admin.apps.cours.coursedit', compact('cours', 'users', 'formations'));
    }

    /**
     * Mettre à jour un cours.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'user_id' => 'required|exists:users,id',
            'formation_id' => 'required|exists:formations,id',
        ]);

        $cours = Cours::findOrFail($id);
        $cours->update($request->all());
        // return redirect()->route('coursupdate', ['id' => $cours->id])->with('success', 'Cours mis à jour avec succès.');


        return redirect()->route('cours')->with('success', 'Cours mis à jour avec succès.');
    }

    /**
     * Supprimer un cours.
     */
    public function destroy($id)
    {
        $cours = Cours::findOrFail($id);
        $cours->delete();

        return redirect()->route('cours')->with('delete', 'Cours supprimé avec succès.');
    }
}
