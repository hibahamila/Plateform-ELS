@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Détails du cours</h2>
        <p><strong>ID :</strong> {{ $cours->id }}</p>
        <p><strong>Titre :</strong> {{ $cours->titre }}</p>
        <p><strong>Description :</strong> {{ $cours->description }}</p>
        <p><strong>Date de début :</strong> {{ $cours->date_debut }}</p>
        <p><strong>Date de fin :</strong> {{ $cours->date_fin }}</p>
        <a href="{{ route('cours.index') }}" class="btn btn-secondary">Retour</a>
    </div>
@endsection
