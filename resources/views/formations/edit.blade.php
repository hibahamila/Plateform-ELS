@extends('layouts.app')

@section('content')
    <h1>Modifier une formation</h1>
    <form action="{{ route('formations.update', $formation->id) }}" method="POST">
        @csrf
        @method('PUT') <!--  PUT pour la mise à jour -->

        <input type="text" name="titre" value="{{ old('titre', $formation->titre) }}" placeholder="Titre">

        <input type="text" name="description" value="{{ old('description', $formation->description) }}" placeholder="Description">

        <!-- Champ Durée (au format HH:mm) -->
        <input type="text" name="duree" value="{{ old('duree', \Carbon\Carbon::parse($formation->duree)->format('H:i')) }}" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm">

        <input type="text" name="type" value="{{ old('type', $formation->type) }}" placeholder="Type">

        <input type="text" name="prix" value="{{ old('prix', $formation->prix) }}" placeholder="Prix (ex: 12.500)" pattern="^\d+(\.\d{1,3})?$" title="Format: 12.500">

        <select name="categorie_id">
            @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}" 
                    @if($categorie->id == $formation->categorie_id) selected @endif>
                    {{ $categorie->titre }}
                </option>
            @endforeach
        </select>

        <button type="submit">Mettre à jour</button>
    </form>
@endsection
