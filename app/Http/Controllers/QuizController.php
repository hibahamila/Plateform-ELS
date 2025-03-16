<?php

// app/Http/Controllers/QuizController.php

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


    // public function create(Request $request)
    // {
    //     $cours = Cours::all(); // Récupérer tous les cours
    //     $quizId = $request->query('quiz_id') ?: session('quiz_id');
    //     return view('admin.apps.quiz.quizcreate', compact('cours','quizId'));
    // }

    

   


// public function store(Request $request)
// {
//     $request->validate([
//         'titre' => 'required|string',
//         'description' => 'required|string',
//         'date_limite' => 'required|date',
//         'date_fin' => 'required|date|after_or_equal:date_limite',
//         'cours_id' => 'required|exists:cours,id',
//         'score_minimum' => 'required|integer',
//     ]);

//     // Créez un quiz et assignez-le à une variable pour récupérer l'ID
//     $quiz = Quiz::create($request->all());

//     // Enregistrez l'ID du quiz dans la session
//     session()->flash('quiz_id', $quiz->id);

//     // Redirigez vers la page des quizzes avec un message de succès
//     return redirect()->route('quizzes')->with('success', 'Quiz ajouté avec succès');
// }


// //jdid
// public function store(Request $request)
// {
//     $request->validate([
//         'titre' => 'required|string',
//         'description' => 'required|string',
//         'date_limite' => 'required|date',
//         'date_fin' => 'required|date|after_or_equal:date_limite',
//         'cours_id' => 'required|exists:cours,id',
//         'score_minimum' => 'required|integer',
//     ]);

//     // Créer le quiz
//     $quiz = Quiz::create($request->all());

//     // Enregistrer l'ID du quiz dans la session
//     return redirect()->route('quizcreate')->with('quiz_id', $quiz->id);
// }



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
            'titre' => 'required|string',
            'description' => 'required|string',
            'date_limite' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_limite',
            'cours_id' => 'required|exists:cours,id', // Validation de la clé étrangère
            'score_minimum' => 'required|integer',
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
        'titre' => 'required|string',
        'description' => 'required|string',
        'date_limite' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_limite',
        'cours_id' => 'required|exists:cours,id',
        'score_minimum' => 'required|integer',
    ]);

    // Créer le quiz
    $quiz = Quiz::create($request->all());

    // Rediriger avec un message flash et l'ID du quiz
    return redirect()->route('quizcreate')
                     ->with('success', 'Quiz créé avec succès')
                     ->with('quiz_id', $quiz->id)->withInput();;
}

public function create(Request $request)
{
    $cours = Cours::all(); // Récupérer tous les cours
    return view('admin.apps.quiz.quizcreate', compact('cours'));
}
}




