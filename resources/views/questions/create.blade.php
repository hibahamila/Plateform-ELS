@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter une Question</h2>
    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="enonce" class="form-label">Enonce</label>
            <input type="text" class="form-control" name="enonce" required>
        </div>
        
        <div class="mb-3">
            <label for="quiz_id" class="form-label">Quiz</label>
            <select class="form-control" name="quiz_id" required>
                @foreach($quizzes as $quiz)
                <option value="{{ $quiz->id }}">{{ $quiz->titre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
