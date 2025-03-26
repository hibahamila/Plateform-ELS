<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\User;
use App\Models\Formation;
use Illuminate\Http\Request;

class CoursController extends Controller
{
  
    public function index()
    {
        $cours = Cours::with('user', 'formation')->get();
        return view('admin.apps.cours.cours', compact('cours'));
    }

  
    // public function create()
    // {
    //     $users = User::all();
    //     $formations = Formation::all();
    //     return view('admin.apps.cours.courscreate', compact('users', 'formations'));
    // }

    //code jdid
    public function create(Request $request)
    {
        $users = User::all();
        $formations = Formation::all();
        $coursId = $request->query('cours_id') ?: session('cours_id');
        return view('admin.apps.cours.courscreate', compact('formations','users','coursId'));
    }




    //zedtou jdid 
public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        // 'start_date' => 'required|date',
        // 'end_date' => 'required|date|after_or_equal:start_date',
        
        'start_date' => 'required|date_format:Y-m-d',
        'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
        'user_id' => 'required|exists:users,id',
        'formation_id' => 'required|exists:formations,id',
    ]);

    $cours = Cours::create($validatedData);

    // Flasher l'id du cours dans la session pour l'utiliser dans l'alerte
    session()->flash('cours_id', $cours->id);

    // Rediriger vers la même page pour permettre la persistance des données dans le formulaire
    return redirect()->route('courscreate')->withInput(); // Utilisez withInput() pour maintenir les anciennes données
}



    public function show($id)
    {
        $cours = Cours::with('user', 'formation')->findOrFail($id);
        return view('admin.apps.cours.coursshow', compact('cours'));
    }

 
    public function edit($id)
    {
        $cours = Cours::findOrFail($id);
        $users = User::all();
        $formations = Formation::all();
        return view('admin.apps.cours.coursedit', compact('cours', 'users', 'formations'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            // 'start_date' => 'required|date',
            // 'end_date' => 'required|date|after_or_equal:start_date',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
    
            'user_id' => 'required|exists:users,id',
            'formation_id' => 'required|exists:formations,id',
        ]);

        $cours = Cours::findOrFail($id);
        $cours->update($request->all());


        return redirect()->route('cours')->with('success', 'Cours mis à jour avec succès.');
    }

   
    public function destroy($id)
    {
        $cours = Cours::findOrFail($id);
        $cours->delete();

        return redirect()->route('cours')->with('delete', 'Cours supprimé avec succès.');
    }
}
