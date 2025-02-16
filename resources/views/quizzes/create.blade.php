@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter un Quiz</h2>

    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" name="titre" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>

        <div class="mb-3">
            <label for="date_limite" class="form-label">Date Limite</label>
            <input type="date" class="form-control" name="date_limite" required>
        </div>

        <div class="mb-3">
            <label for="date_fin" class="form-label">Date de Fin</label>
            <input type="date" class="form-control" name="date_fin" required>
        </div>

        <div class="mb-3">
            <label for="cours_id" class="form-label">Cours</label>
            <select class="form-control" name="cours_id" required>
                @foreach($cours as $coursItem)
                    <option value="{{ $coursItem->id }}">{{ $coursItem->titre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="score_minimum" class="form-label">Score Minimum</label>
            <input type="number" class="form-control" name="score_minimum" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
