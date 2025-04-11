<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cours;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('admin.apps.quiz.quizzes', compact('quizzes'));
    }


    public function create(Request $request)
{
    $cours = Cours::all(); // Récupérer tous les cours
    return view('admin.apps.quiz.quizcreate', compact('cours'));
}




    public function show(Quiz $quiz)
    {
        return view('admin.apps.quiz.quizshow', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        $cours = Cours::all(); // Récupérer tous les cours
        return view('admin.apps.quiz.quizedit', compact('quiz', 'cours'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'end_date' => 'required|date|after_or_equal:deadline',
            'cours_id' => 'required|exists:cours,id', // Validation de la clé étrangère
            'minimum_score' => 'required|integer|min:1',
        ]);

        $quiz->update($request->all());

        return redirect()->route('quizzes')->with('success', 'Quiz mis à jour avec succès');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes')->with('delete', 'Quiz supprimé avec succès');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'deadline' => 'required|date',
        'end_date' => 'required|date|after_or_equal:deadline',
        'cours_id' => 'required|exists:cours,id',
        'minimum_score' => 'required|integer|min:1',
    ]);

    // Créer le quiz
    $quiz = Quiz::create($request->all());

    // Rediriger avec un message flash et l'ID du quiz
    return redirect()->route('quizcreate')
                     ->with('success', 'Quiz créé avec succès')
                     ->with('quiz_id', $quiz->id)->withInput();;
}

}


