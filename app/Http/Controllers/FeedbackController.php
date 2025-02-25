<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Formation;

class FeedbackController extends Controller
{
    // Afficher tous les feedbacks avec leur formation associée
    public function index()
    {
        // Récupère tous les feedbacks en chargeant la relation "formation"
        $feedbacks = Feedback::with('formation')->get();
        // Renvoie vers la vue "feedbacks.blade.php"
        return view('admin.apps.feedback.feedbacks', compact('feedbacks'));
    }

    // Formulaire pour créer un feedback
    public function create()
    {
        // Récupère toutes les formations pour permettre la sélection
        $formations = Formation::all();
        // Renvoie vers la vue "feedbackcreate.blade.php"
        return view('admin.apps.feedback.feedbackcreate', compact('formations'));
    }

    // Enregistrer un feedback
    public function store(Request $request)
    {
        $request->validate([
            'formation_id' => 'required|exists:formations,id',
            'nombre_rate' => 'nullable|numeric|min:0.5|max:5', 
        ]);
    
        Feedback::create([
            'user_id'      => auth()->id(), // Utilisation de l'utilisateur authentifié
            'formation_id' => $request->formation_id,
            'nombre_rate'  => $request->nombre_rate,
        ]);
    
        return redirect()->route('feedbacks')->with('success', 'Feedback ajouté avec succès.');
    }
    // Afficher un feedback spécifique
    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        $formation = Formation::findOrFail($feedback->formation_id);
        // Renvoie vers la vue "feedbackshow.blade.php"
        return view('admin.apps.feedback.feedbackshow', compact('feedback', 'formation'));
    }

    // Formulaire pour modifier un feedback
    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
        $formations = Formation::all();
        // Renvoie vers la vue "feedbackedit.blade.php"
        return view('admin.apps.feedback.feedbackedit', compact('feedback', 'formations'));
    }

    // Mettre à jour un feedback
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_rate' => 'nullable|numeric|min:0.5|max:5', 
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update([
            'nombre_rate'  => $request->nombre_rate,
        ]);

        return redirect()->route('feedbacks')->with('success', 'Feedback mis à jour.');
    }

    // Supprimer un feedback
    public function destroy($id)
    {
        Feedback::findOrFail($id)->delete();
        return redirect()->route('feedbacks')->with('success', 'Feedback supprimé.');
    }

    public function deleteSelected(Request $request)
{
    $feedbackIds = $request->input('feedbacks', []);

    if (!empty($feedbackIds)) {
        Feedback::whereIn('id', $feedbackIds)->delete();
    }

    return redirect()->route('feedbacks')->with('success', 'Les feedbacks sélectionnés ont été supprimés avec succès.');
}

}
