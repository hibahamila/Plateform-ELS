@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails de la Lesson</h2>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $lesson->titre }}</h4>
            <p class="card-text"><strong>Description :</strong> {{ $lesson->description }}</p>
            <p class="card-text"><strong>Durée :</strong> {{ $lesson->duree }}</p>
            <p class="card-text"><strong>Chapitre :</strong> {{ $lesson->chapitre->titre ?? 'N/A' }}</p>
            <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-warning">Modifier</a>
            <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cette lesson ?')">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
