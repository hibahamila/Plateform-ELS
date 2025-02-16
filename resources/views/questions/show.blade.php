@extends('layouts.app')

@section('content')
    <h1>Détails de la Question</h1>

    <div>
        <p><strong>Enoncé :</strong> {{ $question->texte }}</p>
    </div>

    <h2>Réponses associées :</h2>
    @if ($question->reponses->count() > 0)
        <ul>
            @foreach ($question->reponses as $reponse)
                <li>{{ $reponse->texte }} - <strong>{{ $reponse->est_correct ? 'Correcte' : 'Incorrecte' }}</strong></li>
            @endforeach
        </ul>
    @else
        <p>Aucune réponse associée à cette question.</p>
    @endif

    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-primary">Modifier</a>
    <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
    <a href="{{ route('questions.index') }}" class="btn btn-secondary">Retour à la liste des questions</a>
@endsection
