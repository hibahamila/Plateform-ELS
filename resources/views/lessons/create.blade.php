@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter une Lesson</h2>
    <form action="{{ route('lessons.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" name="titre" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="duree">Durée (HH:mm)</label>
            <input type="text" id="duree" name="duree" class="form-control" value="{{ old('duree') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="chapitre_id" class="form-label">Chapitre</label>
            <select class="form-control" name="chapitre_id" required>
                @foreach($chapitres as $chapitre)
                <option value="{{ $chapitre->id }}">{{ $chapitre->titre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
