<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Reponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index()
    {
        // Récupérer toutes les questions avec leur quiz associé et le nombre de réponses
        $questions = Question::with('quiz')
            ->withCount('reponses') // Ajout du nombre de réponses
            ->get();

        return view('admin.apps.question.questions', compact('questions'));
    }



// public function create(Request $request)
// {
//     // Récupérer tous les quiz
//     $quizzes = Quiz::all();

//     // Récupérer l'ID du quiz depuis l'URL ou la session
//     $quizId = $request->query('quiz_id') ?? session('quiz_id');

//     // Récupérer le quiz associé
//     $quiz = Quiz::find($quizId);
//     // Passer les données à la vue
//     return view('admin.apps.question.questioncreate', [
//         'quizzes' => $quizzes,
//         'quizId' => $quizId,
//         'quiz' => $quiz, // Passer le quiz associé à la vue
//     ]);
// }


//zedtou tw :
public function create(Request $request)
{
    // Récupérer tous les quiz
    $quizzes = Quiz::all();

    // Récupérer l'ID du quiz depuis l'URL ou la session
    $quizId = $request->query('quiz_id') ?? session('quiz_id');

    // Si aucun quiz n'existe dans la base de données
    if ($quizzes->isEmpty()) {
        return redirect()->route('quizcreate')->with('info', 'Aucun quiz existant. Veuillez d\'abord créer un quiz.');
    }

    // Si un quizId est présent
    if ($quizId) {
        // Récupérer le quiz associé
        $quiz = Quiz::find($quizId);

        // Vérifier si le quiz existe
        if (!$quiz) {
            return redirect()->route('quizzes')->with('error', 'Le quiz spécifié n\'existe pas.');
        }
    } else {
        // Si aucun quizId n'est fourni, initialiser $quiz à null
        $quiz = null;
    }

    // Passer les données à la vue
    return view('admin.apps.question.questioncreate', [
        'quizzes' => $quizzes,
        'quizId' => $quizId,
        'quiz' => $quiz, // Passer le quiz associé à la vue (peut être null)
    ]);
}


    public function store(Request $request)
{
    // Validation des champs
    $request->validate([
        'statement' => 'required|string',
        'quiz_id' => 'required|exists:quizzes,id',
        'response_count' => 'required|integer|min:1|max:10',
        'reponses' => 'required|array|size:' . $request->response_count,         
        // Vérifier que le nombre de réponses correspond à response_count
        //reponses howa  tableau obligatoire, w lezm taille  mteeou tkoun nfsha  à response_count 
       // (l'utilisateur doit fournir exactement ce nombre de réponses).
        'reponses.*.content' => 'required|string',
        //kol élément ml tableau reponses lezm ykoun andou   champ  esmou content, eli howa lezm w type mteeou chaine.
        'reponses.*.is_correct' => 'required|in:0,1',
         // Valider que chaque valeur est 0 ou 1  ,,Chaque réponse doit avoir un champ is_correct, qui ne peut être que 0 (fausse) ou 1 (correcte).
    ]);

    // Vérifier qu'au moins une réponse est correcte
    //Laravel fournit la classe Collection, qui permet de manipuler facilement des tableaux de données.
    //On convertit $request->reponses en collection et on vérifie si au moins un élément a is_correct égal à 1.
    $hasCorrectAnswer = collect($request->reponses)->contains('is_correct', 1);
    if (!$hasCorrectAnswer) {
        return redirect()->back()
            ->withInput() // Conserver les données saisies
            ->withErrors(['reponses' => 'Au moins une réponse doit être correcte.']);
    }

//     Si aucune réponse correcte n'est trouvée (!$hasCorrectAnswer)
// → On redirige l'utilisateur en arrière (redirect()->back()).
// → On conserve les anciennes données saisies (withInput()).
// → On affiche une erreur (withErrors()), indiquant que "Au moins une réponse doit être correcte".

    // Création de la question
    $question = Question::create([
        'statement' => $request->statement,
        'quiz_id' => $request->quiz_id,
        'response_count' => $request->response_count,
    ]);

// On parcourt le tableau reponses envoyé par l'utilisateur.
    foreach ($request->reponses as $reponse) {
        Reponse::create([
            'question_id' => $question->id,
            'content' => $reponse['content'],
            'is_correct' => $reponse['is_correct'],
        ]);
    }
    session()->flash('question_id', $question->id);


    return redirect()->route('questions')->with('success', 'Question et réponses ajoutées avec succès !');
}



// //new 
// public function store(Request $request)
// {
//     // Validation des champs
//     $request->validate([
//         'statement' => 'required|string',
//         'quiz_id' => 'required|exists:quizzes,id',
//         'response_count' => 'required|integer|min:1|max:10',
//         'reponses' => 'required|array|size:' . $request->response_count,
//         'reponses.*.content' => 'required|string',
//         'reponses.*.is_correct' => 'required|in:0,1',
//     ]);

//     // Vérifier qu'au moins une réponse est correcte
//     $hasCorrectAnswer = collect($request->reponses)->contains('is_correct', 1);
//     if (!$hasCorrectAnswer) {
//         return redirect()->back()
//             ->withInput() // Conserver les données saisies
//             ->withErrors(['reponses' => 'Au moins une réponse doit être correcte.']);
//     }

//     // Création de la question
//     $question = Question::create([
//         'statement' => $request->statement,
//         'quiz_id' => $request->quiz_id,
//         'response_count' => $request->response_count,
//     ]);

//     // Création des réponses
//     foreach ($request->reponses as $reponse) {
//         Reponse::create([
//             'question_id' => $question->id,
//             'content' => $reponse['content'],
//             'is_correct' => $reponse['is_correct'],
//         ]);
//     }

//     return redirect()->route('questions')->with('success', 'Question et réponses ajoutées avec succès !');
// }


    public function show($id)
    {
        // Récupérer la question avec son quiz associé et le nombre de réponses
        $question = Question::with('quiz')
            ->withCount('reponses') // Ajout du nombre de réponses
            ->findOrFail($id);

        return view('admin.apps.question.questionshow', compact('question'));
    }

    public function edit($id)
    {
        // Récupérer la question et tous les quiz pour le formulaire de modification
        $question = Question::withCount('reponses')->findOrFail($id); // Ajout du nombre de réponses
        $quizzes = Quiz::all();
        $reponses = Reponse::where('question_id', $id)->get(); 

        return view('admin.apps.question.questionedit', compact('question', 'quizzes', 'reponses'));
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'statement' => 'required|string|max:255',
    //         'quiz_id' => 'required|exists:quizzes,id',
    //     ]);

    //     DB::beginTransaction();
    //     try {
    //         // Mise à jour de la question
    //         $question = Question::findOrFail($id);
    //         $question->update($request->all());
    //         DB::commit();
    //         return redirect()->route('admin.apps.question.questions')->with('success', 'Question mise à jour avec succès.');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->route('admin.apps.question.questions')->with('error', 'Une erreur est survenue lors de la mise à jour.');
    //     }
    // }


    public function update(Request $request, $id)
{
    // Validation des champs
    $request->validate([
        'statement' => 'required|string|max:255',
        'quiz_id' => 'required|exists:quizzes,id',
        'response_count' => 'required|integer|min:1|max:10',
        'reponses' => 'required|array|size:' . $request->response_count, 
        'reponses.*.content' => 'required|string',
        'reponses.*.is_correct' => 'required|in:0,1',
    ]);

    // Vérifier qu'au moins une réponse est correcte
    $hasCorrectAnswer = collect($request->reponses)->contains('is_correct', 1);
    if (!$hasCorrectAnswer) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['reponses' => 'Au moins une réponse doit être correcte.']);
    }

    DB::beginTransaction();
    try {
        // Récupération de la question
        $question = Question::findOrFail($id);

        // Mise à jour des informations de la question
        $question->update([
            'statement' => $request->statement,
            'quiz_id' => $request->quiz_id,
            'response_count' => $request->response_count,
        ]);

        // Suppression des anciennes réponses
        Reponse::where('question_id', $question->id)->delete();

        // Ajout des nouvelles réponses
        foreach ($request->reponses as $reponse) {
            Reponse::create([
                'question_id' => $question->id,
                'content' => $reponse['content'],
                'is_correct' => $reponse['is_correct'],
            ]);
        }

        DB::commit();
        return redirect()->route('questions')->with('success', 'Question et réponses mises à jour avec succès.');

    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->route('questions')->with('error', 'Une erreur est survenue lors de la mise à jour.');
    }
}

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // Suppression des réponses associées avant de supprimer la question
            Reponse::where('question_id', $id)->delete();
            
            // Suppression de la question
            $question = Question::findOrFail($id);
            $question->delete();
            
            DB::commit();
            return redirect()->route('questions')->with('delete', 'Question supprimée avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('questions')->with('error', 'Erreur lors de la suppression de la question.');
        }
    }
}
