<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reponse;
use App\Models\Question;

class ReponseController extends Controller
{
    // Afficher toutes les réponses
    public function index()
    {
        $reponses = Reponse::with('question')->get();
        return view('admin.apps.reponse.reponses', compact('reponses'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $questions = Question::all();
        return view('admin.apps.reponse.reponsecreate', compact('questions'));
    }

 

public function store(Request $request)
{
    $request->validate([
        'enonce' => 'required|string',
        'quiz_id' => 'required|exists:quizzes,id',
        'response_count' => 'required|integer|min:1|max:10',
        'reponses' => 'required|array',
        'reponses.*.contenu' => 'required|string',
        'reponses.*.est_correcte' => 'boolean',
    ]);

    // Création de la question
    $question = Question::create([
        'enonce' => $request->enonce,
        'quiz_id' => $request->quiz_id,
    ]);

    // Vérification que $request->reponses est bien un tableau
    if (is_array($request->reponses)) {
        foreach ($request->reponses as $reponse) {
            Reponse::create([
                'contenu' => $reponse['contenu'],
                'est_correcte' => isset($reponse['est_correcte']) ? $reponse['est_correcte'] : 0,
                'question_id' => $question->id,
            ]);
        }
    }

    return redirect()->route('questions')->with('success', 'Question et réponses ajoutées avec succès !');
}


    // Afficher une seule réponse
    public function show(Reponse $reponse)
    {
        return view('admin.apps.reponse.reponseshow', compact('reponse'));
    }

    // Afficher le formulaire de modification
    public function edit(Reponse $reponse)
    {
        $questions = Question::all();
        return view('admin.apps.reponse.reponseedit', compact('reponse', 'questions'));
    }

    // Mettre à jour une réponse
    public function update(Request $request, Reponse $reponse)
    {
        // Validation des données
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'contenu' => 'required|string|max:255',
            'est_correcte' => 'required|boolean',
        ]);

        // Mise à jour de la réponse
        $reponse->update([
            'question_id' => $request->question_id,
            'contenu' => $request->contenu,
            'est_correcte' => $request->est_correcte,
        ]);

        // Retourner à la liste des réponses avec un message de succès
        return redirect()->route('reponses.index')->with('success', 'Réponse mise à jour avec succès.');
    }

    // Supprimer une réponse
    public function destroy(Reponse $reponse)
    {
        $reponse->delete();
        return redirect()->route('reponses.index')->with('delete', 'Réponse supprimée avec succès.');
    }
}
