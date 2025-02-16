@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier la Lesson</h2>
    <form action="{{ route('lessons.update', $lesson->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" name="titre" value="{{ $lesson->titre }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" required>{{ $lesson->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="duree">Durée (HH:mm)</label>
            <input type="text" id="duree" name="duree" class="form-control" value="{{ old('duree', $lesson->duree) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="chapitre_id" class="form-label">Chapitre</label>
            <select class="form-control" name="chapitre_id" required>
                @foreach($chapitres as $chapitre)
                <option value="{{ $chapitre->id }}" {{ $lesson->chapitre_id == $chapitre->id ? 'selected' : '' }}>
                    {{ $chapitre->titre }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Modifier</button>
    </form>
</div>
@endsection
