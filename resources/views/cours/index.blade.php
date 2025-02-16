@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Cours</h2>
    <a href="{{ route('cours.create') }}" class="btn btn-primary">Ajouter un Cours</a>

    <table class="table mt-4">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>Titre</th>
                <th>Description</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Utilisateur</th>
                <th>Formation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cours as $cour)
                <tr>
                    {{-- <td>{{ $cour->id }}</td> --}}
                    <td>{{ $cour->titre }}</td>
                    <td>{{ $cour->description }}</td>
                    <td>{{ $cour->date_debut }}</td>
                    <td>{{ $cour->date_fin }}</td>
                    <td>{{ $cour->user->name }}</td>
                    <td>{{ $cour->formation->titre }}</td>
                    <td>
                        <a href="{{ route('cours.show', $cour->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('cours.edit', $cour->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('cours.destroy', $cour->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
