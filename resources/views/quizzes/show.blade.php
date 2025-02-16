@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails du Quiz</h2>
    <p><strong>Titre :</strong> {{ $quiz->titre }}</p>
    <p><strong>Description :</strong> {{ $quiz->description }}</p>
    <p><strong>Date Limite :</strong> {{ $quiz->date_limite }}</p>
    <p><strong>Date de Fin :</strong> {{ $quiz->date_fin }}</p>
    <p><strong>Score Minimum :</strong> {{ $quiz->score_minimum }}</p>

    <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
