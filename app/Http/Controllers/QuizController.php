<?php

// app/Http/Controllers/QuizController.php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

use App\Models\Cours;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $cours = Cours::all(); // Récupérer tous les cours
        return view('quizzes.create', compact('cours'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string',
            'date_limite' => 'required|date',
            'date_fin' => 'required|date',
            'cours_id' => 'required|exists:cours,id', // Validation de la clé étrangère
            'score_minimum' => 'required|integer',
        ]);

        Quiz::create($request->all());

        return redirect()->route('quizzes.index')->with('success', 'Quiz ajouté avec succès');
    }

    public function show(Quiz $quiz)
    {
        return view('quizzes.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        $cours = Cours::all(); // Récupérer tous les cours
        return view('quizzes.edit', compact('quiz', 'cours'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string',
            'date_limite' => 'required|date',
            'date_fin' => 'required|date',
            'cours_id' => 'required|exists:cours,id', // Validation de la clé étrangère
            'score_minimum' => 'required|integer',
        ]);

        $quiz->update($request->all());

        return redirect()->route('quizzes.index')->with('success', 'Quiz mis à jour avec succès');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Quiz supprimé avec succès');
    }
}
