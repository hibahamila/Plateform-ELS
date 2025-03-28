<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Formation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::all();
        return view('admin.apps.formation.formations', compact('formations'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('admin.apps.formation.formationcreate', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
            'type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'publish_date' => 'nullable|date|after_or_equal:now',
            'publication_type' => 'required|in:now,later',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // Gestion de l'image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('formations', 'public');
        }

        // Préparation des données
        $formationData = [
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'duration' => $validatedData['duration'],
            'type' => $validatedData['type'],
            'price' => $validatedData['price'],
            'categorie_id' => $validatedData['categorie_id'],
            'image' => $imagePath,
        ];

        // Gestion de la publication
        if ($validatedData['publication_type'] === 'later') {
            $publishDate = Carbon::parse($validatedData['publish_date'], 'Africa/Tunis');
            $formationData['publish_date'] = $publishDate->format('Y-m-d H:i:s');
            $formationData['status'] = 0; // Non publiée
        } else {
            $formationData['status'] = 1; // Publiée immédiatement
            $formationData['publish_date'] = null; // Pas de date de publication
        }

        try {
            $formation = Formation::create($formationData);
            
            Log::channel('formations')->info('Formation créée', [
                'id' => $formation->id,
                'status' => $formation->status,
                'publish_date' => $formation->publish_date,
                'time' => Carbon::now('Africa/Tunis')->format('Y-m-d H:i:s')
            ]);

            return redirect()->route('formations')->with('success', 'Formation créée avec succès');
        } catch (\Exception $e) {
            Log::channel('formations')->error('Erreur création formation', [
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Erreur lors de la création');
        }
    }

    public function update(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
            'type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'publish_date' => 'nullable|date|after_or_equal:now',
            'publication_type' => 'required|in:now,later'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        // Gestion de l'image
        if ($request->hasFile('image')) {
            if ($formation->image) {
                Storage::delete('public/' . $formation->image);
            }
            $data['image'] = $request->file('image')->store('formations', 'public');
        } elseif ($request->delete_image == 1) {
            if ($formation->image) {
                Storage::delete('public/' . $formation->image);
                $data['image'] = null;
            }
        }

        // Gestion de la publication
        if ($data['publication_type'] === 'now') {
            $data['status'] = 1;
            $data['publish_date'] = null;
        } else {
            $publishDate = Carbon::parse($data['publish_date'], 'Africa/Tunis');
            $data['publish_date'] = $publishDate->format('Y-m-d H:i:s');
            $data['status'] = 0;
        }

        $formation->update($data);

        Log::channel('formations')->info('Formation mise à jour', [
            'id' => $formation->id,
            'new_status' => $formation->status,
            'new_publish_date' => $formation->publish_date
        ]);

        return redirect()->route('formations')->with('success', 'Formation mise à jour avec succès');
    }

    public function show($id)
    {
        $formation = Formation::findOrFail($id);
        return view('admin.apps.formation.formationshow', compact('formation'));
    }

    public function edit($id)
    {
        $formation = Formation::findOrFail($id);
        $categories = Categorie::all();
        return view('admin.apps.formation.formationedit', compact('formation', 'categories'));
    }

    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);

        if ($formation->image) {
            Storage::delete('public/' . $formation->image);
        }

        $formation->delete();

        return redirect()->route('formations')->with('success', 'Formation supprimée avec succès');
    }
}