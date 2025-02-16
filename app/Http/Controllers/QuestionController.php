<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;

class QuestionController extends Controller
{
    // Afficher toutes les questions
    public function index()
    {
        $questions = Question::with('quiz')->get();
        return view('questions.index', compact('questions'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $quizzes = Quiz::all();
        return view('questions.create', compact('quizzes'));
    }

    // Stocker une nouvelle question
    public function store(Request $request)
    {
        $request->validate([
            'enonce' => 'required|string|max:255',
            'quiz_id' => 'required|exists:quizzes,id',
        ]);

        Question::create($request->all());

        return redirect()->route('questions.index')->with('success', 'Question ajoutée avec succès');
    }

    // Afficher une seule question
    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

    // Afficher le formulaire d'édition
    // public function edit(Question $question)
    // {
    //     // dd($question);  // Pour afficher l'objet et vérifier son contenu
    //     if (!$question) {
    //         return redirect()->route('questions.index')->with('error', 'Question non trouvée');
    //     }

    //     $quizzes = Quiz::all();
    //     return view('questions.edit', compact('question', 'quizzes'));
    // }


    public function edit(Question $question)
{
    $quizzes = Quiz::all();
    return view('questions.edit', compact('question', 'quizzes'));
}
    // Mettre à jour une question
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'enonce' => 'required|string|max:255',
            'quiz_id' => 'required|exists:quizzes,id',
        ]);

        $question->update($request->all());

        return redirect()->route('questions.index')->with('success', 'Question mise à jour avec succès');
    }

    // Supprimer une question
    public function destroy(Question $question)
    {
        if ($question) {
            $question->delete();
            return redirect()->route('questions.index')->with('success', 'Question supprimée avec succès');
        } else {
            return redirect()->route('questions.index')->with('error', 'Question non trouvée');
        }
    }
}
