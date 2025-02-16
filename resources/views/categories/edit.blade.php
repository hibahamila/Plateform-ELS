@extends('layouts.app')

@section('content')
    <h1>Modifier la Catégorie</h1>

    <form action="{{ route('categories.update', $categorie->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="titre">Titre :</label>
        <input type="text" name="titre" value="{{ $categorie->titre }}" required>
        <button type="submit">Mettre à jour</button>
    </form>
@endsection
