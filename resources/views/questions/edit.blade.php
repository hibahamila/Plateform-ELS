@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier la Question</h2>
    <form action="{{ route('questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- On indique que c'est une mise à jour (PUT) -->

        <div class="mb-3">
            <label for="enonce" class="form-label">Enonce</label>
            <input type="text" class="form-control" name="enonce" value="{{ old('enonce', $question->enonce) }}" required>
        </div>

        <div class="mb-3">
            <label for="quiz_id" class="form-label">Quiz</label>
            <select class="form-control" name="quiz_id" required>
                @foreach($quizzes as $quiz)
                    <option value="{{ $quiz->id }}" {{ $question->quiz_id == $quiz->id ? 'selected' : '' }}>
                        {{ $quiz->titre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Modifier</button>
    </form>
</div>
@endsection
