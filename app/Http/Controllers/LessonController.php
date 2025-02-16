<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Chapitre;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Affiche la liste des lessons.
     */
    public function index()
    {
        $lessons = Lesson::with('chapitre')->get();
        return view('lessons.index', compact('lessons'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        $chapitres = Chapitre::all();
        return view('lessons.create', compact('chapitres'));
    }

    /**
     * Enregistre une nouvelle leçon.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'duree' => 'required|date_format:H:i',
            'chapitre_id' => 'required|exists:chapitres,id',
        ]);

        Lesson::create($request->all());

        return redirect()->route('lessons.index')->with('success', 'Lesson ajoutée avec succès.');
    }

    /**
     * Affiche une leçon spécifique.
     */
    public function show(Lesson $lesson)
    {
        return view('lessons.show', compact('lesson'));
    }

    /**
     * Affiche le formulaire d'édition.
     */
    public function edit(Lesson $lesson)
    {
        $chapitres = Chapitre::all();
        return view('lessons.edit', compact('lesson', 'chapitres'));
    }

    /**
     * Met à jour la leçon.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'duree' => 'required|date_format:H:i',
            'chapitre_id' => 'required|exists:chapitres,id',
        ]);

        $lesson->update($request->all());

        return redirect()->route('lessons.index')->with('success', 'Lesson mise à jour avec succès.');
    }

    /**
     * Supprime une leçon.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('lessons.index')->with('success', 'Lesson supprimée avec succès.');
    }
}
