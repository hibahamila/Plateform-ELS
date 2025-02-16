@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Questions</h2>
    <a href="{{ route('questions.create') }}" class="btn btn-primary">Ajouter une Question</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Enonce</th>
                <th>Quiz</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $question)
            <tr>
                <td>{{ $question->id }}</td>
                <td>{{ $question->enonce }}</td>
                <td>{{ $question->quiz->titre }}</td>
                <td>
                    <a href="{{ route('questions.show', $question->id) }}" class="btn btn-info btn-sm">Voir</a>

                    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette question ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
