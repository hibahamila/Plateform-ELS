@extends('layouts.app')

@section('content')
    <h1>Ajouter un chapitre</h1>

    <form action="{{ route('chapitres.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" class="form-control" value="{{ old('titre') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="durée">Durée (HH:mm)</label>
            <input type="text" id="duree" name="duree" class="form-control" value="{{ old('duree') }}" required>
        </div>

        <div class="form-group">
            <label for="cours_id">Cours</label>
            <select id="cours_id" name="cours_id" class="form-control" required>
                @foreach($cours as $coursItem)
                    <option value="{{ $coursItem->id }}" {{ old('cours_id') == $coursItem->id ? 'selected' : '' }}>{{ $coursItem->titre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Ajouter</button>
    </form>
@endsection
