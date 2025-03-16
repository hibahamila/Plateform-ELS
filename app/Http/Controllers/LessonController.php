<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Chapitre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
   
    public function index()
    {
        $lessons = Lesson::all();
        //zedtou tw 
        foreach ($lessons as $lesson) {
            // Décoder les liens stockés en JSON pour chaque leçon
            $lesson->links = json_decode($lesson->link); // Assurer que les liens sont sous forme de tableau
        }
        $chapitres = Chapitre::all();
        return view('admin.apps.lesson.lessons', compact('lessons', 'chapitres'));
    }

    //code jdid 
    public function create(Request $request)
{
    $chapitreId = $request->query('chapitre_id'); // Récupérer l'ID du chapitre depuis l'URL
    $chapitres = Chapitre::all(); // Récupérer tous les chapitres

    // Passer la variable à la vue
    return view('admin.apps.lesson.lessoncreate', compact('chapitres', 'chapitreId'));
}


    //code  tnjm thot beaucoup de liens


// public function store(Request $request)
// {
//     // Validation de la requête
//     $request->validate([
//         'titre' => 'required|string|max:255',
//         'description' => 'required|string',
//         'duree' => 'required|date_format:H:i',
//         'file_path' => 'required|file',
//         'link' => 'required|string', // Supprimer la regex
//         'chapitre_id' => 'required|exists:chapitres,id', // Si vous avez un chapitre_id
//     ]);

//     // Traitement des liens
//     $links = $request->input('link');
    
//     // Convertir les liens en tableau
//     $linksArray = explode(',', $links);
    
//     // Vérification de chaque lien pour s'assurer que c'est une URL valide
//     foreach ($linksArray as $key => $link) {
//         $linksArray[$key] = trim($link); // Enlever les espaces avant et après
//         if (!filter_var($linksArray[$key], FILTER_VALIDATE_URL)) {
//             return redirect()->back()->withErrors(['link' => 'Le lien "' . $linksArray[$key] . '" n\'est pas valide.'])->withInput();
//         }
//     }

//     // Enregistrement du fichier dans le répertoire 'public/files'
//     $filePath = $request->file('file_path')->store('files', 'public');  // Spécifiez 'public' pour utiliser le disque public

//     // Enregistrement des données
//     $lesson = new Lesson();
//     $lesson->titre = $request->input('titre');
//     $lesson->description = $request->input('description');
//     $lesson->duree = $request->input('duree');
//     $lesson->file_path = $filePath;  
//     $lesson->link = json_encode($linksArray); // Stocker les liens en JSON
//     $lesson->chapitre_id = $request->input('chapitre_id'); // Si vous avez un chapitre_id
//     $lesson->save();

//     return redirect()->route('lessons')->with('success', 'Leçon ajoutée avec succès.');
// }
     
public function store(Request $request)
{
    // Validation de la requête
    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'duree' => 'required|date_format:H:i',
        'file_path' => 'required|file',
        'link' => 'required|string', // Supprimer la regex
        'chapitre_id' => 'required|exists:chapitres,id', // Si vous avez un chapitre_id
    ]);

    // Traitement des liens
    $links = $request->input('link');
    
    // Convertir les liens en tableau en utilisant les sauts de ligne
    $linksArray = explode("\n", $links);
    
    // Vérification de chaque lien pour s'assurer que c'est une URL valide
    foreach ($linksArray as $key => $link) {
        $linksArray[$key] = trim($link); // Enlever les espaces avant et après
        if (!filter_var($linksArray[$key], FILTER_VALIDATE_URL)) {
            return redirect()->back()->withErrors(['link' => 'Le lien "' . $linksArray[$key] . '" n\'est pas valide.'])->withInput();
        }
    }

    // Enregistrement du fichier dans le répertoire 'public/files'
    $filePath = $request->file('file_path')->store('files', 'public');  // Spécifiez 'public' pour utiliser le disque public

    // Enregistrement des données
    $lesson = new Lesson();
    $lesson->titre = $request->input('titre');
    $lesson->description = $request->input('description');
    $lesson->duree = $request->input('duree');
    $lesson->file_path = $filePath;  
    $lesson->link = json_encode($linksArray); // Stocker les liens en JSON
    $lesson->chapitre_id = $request->input('chapitre_id'); // Si vous avez un chapitre_id
    $lesson->save();

    return redirect()->route('lessons')->with('success', 'Leçon ajoutée avec succès.');
}
    public function show(Lesson $lesson)
    {
        return view('admin.apps.lesson.lessonshow', compact('lesson'));
    }

    public function edit(Lesson $lesson)
    {
        $chapitres = Chapitre::all();
        return view('admin.apps.lesson.lessonedit', compact('lesson', 'chapitres'));
    }

public function update(Request $request, Lesson $lesson)
{
    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'duree' => 'required|date_format:H:i',
        'chapitre_id' => 'required|exists:chapitres,id',
        'file_path' => 'nullable|file|max:20480',
        'link' => 'nullable|string',
    ]);

    $data = $request->all();

    // Gestion du fichier
    if ($request->hasFile('file_path')) {
        if ($lesson->file_path) {
            Storage::disk('public')->delete($lesson->file_path);
        }
        $file = $request->file('file_path');
        $data['file_path'] = $file->store('uploads/lessons', 'public');
    } else {
        unset($data['file_path']);
    }

    // Gestion des liens
    if (!empty($data['link'])) {
        // Nettoyer et formater les liens
        $links = array_map(function($link) {
            $trimmed = trim($link);
            // Supprimer les barres obliques supplémentaires
            $trimmed = trim($trimmed, '/');
            // Vérifier que le lien commence par http:// ou https://
            if (!empty($trimmed) && !preg_match('/^https?:\/\//i', $trimmed)) {
                return 'http://' . $trimmed;
            }
            return $trimmed;
        }, explode("\n", $data['link'])); // Diviser les liens par sauts de ligne
        
        // Filtrer les liens vides
        $links = array_filter($links);
        
        // Stocker les liens sous forme de tableau JSON
        $data['link'] = json_encode($links);
    } else {
        $data['link'] = null; // Si l'utilisateur vide le champ, on stocke null
    }

    $lesson->update($data);

    return redirect()->route('lessons')->with('success', 'Leçon mise à jour avec succès.');
}
    public function destroy($id)
{
    try {
        $lesson = Lesson::findOrFail($id);
        $lessonName = $lesson->titre;  // Récupérer le nom de la leçon
        $lesson->delete();
        return response()->json(['successMessage' => "La leçon '{$lessonName}' a été supprimée avec succès!"]);
    } catch (\Exception $e) {
        return response()->json(['errorMessage' => 'Une erreur est survenue.']);
    }
}
}
