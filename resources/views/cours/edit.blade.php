@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Modifier un cours</h2>
        <form action="{{ route('cours.update', $cours->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="titre" class="form-label">Titre :</label>
                <input type="text" name="titre" class="form-control" value="{{ $cours->titre }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description :</label>
                <textarea name="description" class="form-control" required>{{ $cours->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="date_debut" class="form-label">Date de début :</label>
                <input type="date" name="date_debut" class="form-control" value="{{ $cours->dateDebut }}" required>
            </div>
            <div class="mb-3">
                <label for="date_fin" class="form-label">Date de fin :</label>
                <input type="date" name="date_fin" class="form-control" value="{{ $cours->dateFin }}" required>
            </div>

            <!-- Sélection de l'utilisateur -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Utilisateur :</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $cours->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sélection de la formation -->
            <div class="mb-3">
                <label for="formation_id" class="form-label">Formation :</label>
                <select name="formation_id" class="form-control" required>
                    @foreach($formations as $formation)
                        <option value="{{ $formation->id }}" {{ $formation->id == $cours->formation_id ? 'selected' : '' }}>
                            {{ $formation->titre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Mettre à jour</button>
        </form>
    </div>
@endsection
