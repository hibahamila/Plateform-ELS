@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Lessons</h2>
    <a href="{{ route('lessons.create') }}" class="btn btn-primary">Ajouter une Lesson</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Durée</th>
                <th>Chapitre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lessons as $lesson)
            <tr>
                <td>{{ $lesson->id }}</td>
                <td>{{ $lesson->titre }}</td>
                <td>{{ $lesson->description }}</td>
                <td>{{ $lesson->duree }}</td>
                <td>{{ $lesson->chapitre->titre ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('lessons.show', $lesson->id) }}" class="btn btn-info">Voir</a>
                    <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cette lesson ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
