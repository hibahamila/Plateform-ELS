@extends('layouts.app')

@section('content')
    <h1>Détails du chapitre</h1>

    <div class="card">
        <div class="card-header">
            <h3>{{ $chapitre->titre }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $chapitre->description }}</p>
            <p><strong>Durée:</strong> {{ $chapitre->duree }}</p>
            <p><strong>Cours associé:</strong> {{ $chapitre->cours->titre }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('chapitres.index') }}" class="btn btn-secondary">Retour à la liste</a>
            <a href="{{ route('chapitres.edit', $chapitre->id) }}" class="btn btn-warning">Modifier</a>
        </div>
    </div>
@endsection
