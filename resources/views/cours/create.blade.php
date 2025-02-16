@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ajouter un nouveau cours</h2>
        <form action="{{ route('cours.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="titre" class="form-label">Titre :</label>
                <input type="text" name="titre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description :</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="date_debut" class="form-label">Date de début :</label>
                <input type="date" name="date_debut" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="date_fin" class="form-label">Date de fin :</label>
                <input type="date" name="date_fin" class="form-control" required>
            </div>

            <!-- Sélection de l'utilisateur -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Utilisateur :</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sélection de la formation -->
            <div class="mb-3">
                <label for="formation_id" class="form-label">Formation :</label>
                <select name="formation_id" class="form-control" required>
                    @foreach($formations as $formation)
                        <option value="{{ $formation->id }}">{{ $formation->titre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
@endsection
