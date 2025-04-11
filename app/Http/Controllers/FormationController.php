<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Feedback;
use App\Models\Formation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class FormationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $categories = Categorie::withCount('formations')->get();
        
        $query = Formation::with(['user', 'category', 'feedbacks', 'cours']);
        
        if ($request->has('categorie_id')) {
            $query->where('categorie_id', $request->categorie_id);
        }
        
        $formations = $query->get();
        
        $formations->each(function ($formation) {
            $formation->final_price = $formation->discount > 0 
                ? $formation->price * (1 - $formation->discount / 100)
                : $formation->price;
            
            $formation->total_feedbacks = $formation->feedbacks->count();
            $formation->average_rating = $formation->total_feedbacks > 0
                ? round($formation->feedbacks->sum('rating_count') / $formation->total_feedbacks, 1)
                : null;

            $formation->total_cours = $formation->cours->count();

        });


        
        $totalFeedbacks = $formations->sum('total_feedbacks');
        $title = $request->has('categorie_id') 
            ? Categorie::find($request->categorie_id)->title 
            : 'Toutes les formations';
        
        // Si c'est une requête AJAX, retourner JSON
        if ($request->ajax()) {
            return response()->json([
                'formations' => $formations,
                'title' => $title,
                'totalFeedbacks' => $totalFeedbacks
            ]);
        }
        return view('admin.apps.formation.formations', compact('formations', 'categories', 'title', 'totalFeedbacks'));
    }

    public function show($id)
    {
        $formation = Formation::with(['user', 'category', 'feedbacks', 'cours'])
            ->findOrFail($id);
        
        // Calculer les statistiques de feedback
        $formation->total_feedbacks = $formation->feedbacks->count();
        $formation->average_rating = $formation->feedbacks->avg('rating_count');
        $formation->sum_ratings = $formation->feedbacks->sum('rating_count');
        
        return view('admin.apps.formation.formationshow', compact('formation'));
    }

    public function create()
    {
        // Récupère seulement les noms et prénoms des professeurs
        $professeurs = User::whereHas('roles', function($query) {
            $query->where('name', 'professeur');
        })->get(['id', 'name', 'lastname']);
        
        $categories = Categorie::all();
        
        return view('admin.apps.formation.formationcreate', compact('professeurs', 'categories'));
    }

    public function store(Request $request)
    {
        // Règles de validation de base
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:payante,gratuite',
            'categorie_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'publish_date' => 'nullable|date|after_or_equal:now',
            'publication_type' => 'required|in:now,later',
            'is_bestseller' => 'nullable|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];

        // Ajout conditionnel de la règle pour le prix
        if ($request->type === 'payante') {
            $rules['price'] = 'required|numeric|min:0';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Vérification que l'utilisateur est bien un professeur
        $professeur = User::whereHas('roles', function($query) {
            $query->where('name', 'professeur');
        })->find($request->user_id);

        if (!$professeur) {
            return back()->with('error', 'L\'utilisateur sélectionné n\'est pas un professeur valide')->withInput();
        }

        $validatedData = $validator->validated();

        // Gestion de l'image
        $imagePath = $request->file('image')->store('formations', 'public');

        // Préparation des données
        $formationData = [
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],

            'type' => $validatedData['type'],
            'categorie_id' => $validatedData['categorie_id'],
            'image' => $imagePath,
            'user_id' => $validatedData['user_id'],
            'is_bestseller' => $validatedData['is_bestseller'] ?? false,
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
        ];

        // Gestion du prix selon le type
        $formationData['price'] = ($validatedData['type'] === 'payante') 
            ? $validatedData['price'] 
            : 0;

        // Gestion de la publication
        if ($validatedData['publication_type'] === 'later') {
            $formationData['publish_date'] = Carbon::parse($validatedData['publish_date'], 'Africa/Tunis')
                ->format('Y-m-d H:i:s');
            $formationData['status'] = 0; // Non publiée
        } else {
            $formationData['status'] = 1; // Publiée immédiatement
            $formationData['publish_date'] = null;
        }

        try {
            $formation = Formation::create($formationData);
            session()->flash('formation_id', $formation->id);
            session()->flash('formation_image', $imagePath);
            return redirect()->route('formationcreate')->withInput();
        } catch (\Exception $e) {
            Log::channel('formations')->error('Erreur création formation', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);
            
            if ($imagePath) {
                Storage::delete('public/' . $imagePath);
            }
            
            return back()->with('error', 'Erreur lors de la création de la formation');
        }
    }

    public function edit($id)
    {
        $formation = Formation::findOrFail($id);

        // Récupère seulement les noms et prénoms des professeurs
        $professeurs = User::whereHas('roles', function($query) {
            $query->where('name', 'professeur');
        })->get(['id', 'name', 'lastname']);
        
        $categories = Categorie::all();
        
        return view('admin.apps.formation.formationedit', compact('formation', 'professeurs', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:payante,gratuite',
            'price' => $request->type === 'payante' ? 'required|numeric|min:0' : 'nullable',
            'discount' => $request->type === 'payante' ? 'nullable|numeric|min:0|max:100' : 'nullable',
            'final_price' => $request->type === 'payante' ? 'required|numeric|min:0' : 'nullable',
            'categorie_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_image' => 'nullable|boolean',
            'publication_type' => 'required|in:now,later',
            'publish_date' => 'required_if:publication_type,later|nullable|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $formation = Formation::findOrFail($id);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Si une nouvelle image est téléchargée, supprimer l'ancienne
            if ($formation->image) {
                Storage::disk('public')->delete($formation->image);
            }
            // Stocker la nouvelle image
            $imagePath = $request->file('image')->store('formations', 'public');
            $formation->image = $imagePath;
        } elseif (isset($request->delete_image) && $request->delete_image == 1 && $formation->image) {
            // Si on demande de supprimer l'image et qu'une image existe
            Storage::disk('public')->delete($formation->image);
            // Vérifier si la table accepte les valeurs NULL pour image
            // Si non, vous pourriez avoir besoin d'une image par défaut
            $formation->image = 'formations/default.jpg'; // Utilisez une image par défaut
        }
        // Si aucune de ces conditions n'est remplie, l'image reste inchangée

        // Mise à jour des champs
        $formation->title = $validated['title'];
        $formation->description = $validated['description'];
        $formation->start_date = $validated['start_date'];
        $formation->end_date = $validated['end_date'];
        // La durée est maintenant calculée automatiquement par le modèle
        $formation->type = $validated['type'];
        $formation->categorie_id = $validated['categorie_id'];
        $formation->user_id = $validated['user_id'];

        // Gestion des prix pour les formations payantes
        if ($validated['type'] === 'payante') {
            $formation->price = $validated['price'];
            $formation->discount = $validated['discount'] ?? 0;
            $formation->final_price = $validated['final_price'];
        } else {
            $formation->price = 0;
            $formation->discount = 0;
            $formation->final_price = 0;
        }

        // Gestion de la publication
        if ($validated['publication_type'] === 'now') {
            $formation->status = true;
            $formation->publish_date = null;
        } else {
            $formation->status = false;
            $formation->publish_date = $validated['publish_date'];
        }

        $formation->save();

        return redirect()->route('formations')->with('success', 'Formation mise à jour avec succès');
    }

    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);

        try {
            if ($formation->image) {
                Storage::delete('public/' . $formation->image);
            }

            $formation->delete();

            Log::channel('formations')->info('Formation supprimée', [
                'id' => $id,
                'user_id' => Auth::id(),
                'title' => $formation->title,
            ]);

            return redirect()->route('formations')->with('success', 'Formation supprimée avec succès');
        } catch (\Exception $e) {
            Log::channel('formations')->error('Erreur suppression formation', [
                'id' => $id,
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);

            return back()->with('error', 'Erreur lors de la suppression de la formation');
        }
    }
}