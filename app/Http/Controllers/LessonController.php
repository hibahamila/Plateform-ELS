<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Chapitre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /**
     * Affiche la liste des lessons.
     */
    public function index()
    {
        $lessons = Lesson::all();
        $chapitres = Chapitre::all();
        return view('admin.apps.lesson.lessons', compact('lessons', 'chapitres'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        $chapitres = Chapitre::all();
        return view('admin.apps.lesson.lessoncreate', compact('chapitres'));
    }

    /**
     * Enregistre une nouvelle leçon.
     */
    public function store(Request $request)
{
    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'duree' => 'required|date_format:H:i',
        'chapitre_id' => 'required|exists:chapitres,id',
        // 'file_path' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi,pdf,doc,docx|max:20480',
        'file_path' => 'nullable|file|max:20480', // Suppression de 'mimes'

    ]);

    $data = $request->all();

    if ($request->hasFile('file_path')) {
        // Debug : vérifiez que vous obtenez bien une instance de UploadedFile
        $uploadedFile = $request->file('file_path');
        // Vous pouvez utiliser dd($uploadedFile) pour voir les détails du fichier
        // dd($uploadedFile);

        // Stockez le fichier dans le dossier 'lessons' du disque 'public'
        $path = $uploadedFile->store('lessons', 'public');
        // Debug : vérifier que $path contient bien quelque chose comme "lessons/nom_du_fichier.ext"
        // dd($path);

        $data['file_path'] = $path;
    }

    Lesson::create($data);

    return redirect()->route('lessons')->with('success', 'Lesson ajoutée avec succès.');
}

    /**
     * Affiche une leçon spécifique.
     */
    public function show(Lesson $lesson)
    {
        return view('admin.apps.lesson.lessonshow', compact('lesson'));
    }

    /**
     * Affiche le formulaire d'édition.
     */
    public function edit(Lesson $lesson)
    {
        $chapitres = Chapitre::all();
        return view('admin.apps.lesson.lessonedit', compact('lesson', 'chapitres'));
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
            'file_path' => 'nullable|file|max:20480', 
        ]);

        $data = $request->all();

        if ($request->hasFile('file_path')) {
            if ($lesson->file_path) {
                Storage::disk('public')->delete($lesson->file_path);
            }

            $file = $request->file('file_path');
            $path = $file->store('uploads/lessons', 'public');
            $data['file_path'] = $path;
        }
        
        $lesson->update($data);

        return redirect()->route('lessons')->with('success', 'Lesson mise à jour avec succès.');
    }

    /**
     * Supprime une leçon.
     */
    public function destroy(Lesson $lesson)
    {
        if ($lesson->file_path) {
            Storage::disk('public')->delete($lesson->file_path);
        }

        $lesson->delete();

        return redirect()->route('lessons')->with('delete', 'Lesson supprimée avec succès.');
    }
}
