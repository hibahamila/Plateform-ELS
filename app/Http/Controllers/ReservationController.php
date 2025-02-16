<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['etudiant', 'formation'])->get();
        return response()->json($reservations);
    }

    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:users,id',
            'formation_id' => 'required|exists:formations,id',
            'date' => 'required|date',
            'heure' => 'required|date_format:H:i',
        ]);

        $reservation = Reservation::create($request->all());
        return response()->json($reservation, 201);
    }

    public function show($id)
    {
        $reservation = Reservation::with(['etudiant', 'formation'])->findOrFail($id);
        return response()->json($reservation);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:users,id',
            'formation_id' => 'required|exists:formations,id',
            'date' => 'required|date',
            'heure' => 'required|date_format:H:i',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());
        return response()->json($reservation);
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return response()->json(['message' => 'Réservation supprimée avec succès']);
    }
}
