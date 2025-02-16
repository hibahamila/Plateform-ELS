@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier le Quiz</h2>

    <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" name="titre" value="{{ old('titre', $quiz->titre) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" required>{{ old('description', $quiz->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="date_limite" class="form-label">Date Limite</label>
            <input type="date" class="form-control" name="date_limite" value="{{ old('date_limite', $quiz->date_limite) }}" required>
        </div>

        <div class="mb-3">
            <label for="date_fin" class="form-label">Date de Fin</label>
            <input type="date" class="form-control" name="date_fin" value="{{ old('date_fin', $quiz->date_fin) }}" required>
        </div>

        <div class="mb-3">
            <label for="cours_id" class="form-label">Cours</label>
            <select class="form-control" name="cours_id" required>
                @foreach($cours as $coursItem)
                    <option value="{{ $coursItem->id }}" {{ $quiz->Cours_id == $coursItem->id ? 'selected' : '' }}>{{ $coursItem->titre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="score_minimum" class="form-label">Score Minimum</label>
            <input type="number" class="form-control" name="score_minimum" value="{{ old('score_minimum', $quiz->score_minimum) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
