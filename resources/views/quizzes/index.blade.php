@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Quizzes</h2>
    <a href="{{ route('quizzes.create') }}" class="btn btn-primary">Ajouter un Quiz</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date Limite</th>
                <th>Date de Fin</th>
                <th>Score Minimum</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quizzes as $quiz)
                <tr>
                    <td>{{ $quiz->titre }}</td>
                    <td>{{ $quiz->description }}</td>
                    <td>{{ $quiz->date_limite }}</td>
                    <td>{{ $quiz->date_fin }}</td>
                    <td>{{ $quiz->score_minimum }}</td>
                    <td>
                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
