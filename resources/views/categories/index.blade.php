@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des Catégories</h1>

        <!-- Lien pour ajouter une catégorie -->
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Ajouter une catégorie</a>

        <!-- Affichage du message de succès -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Liste des catégories -->
        <ul class="list-group">
            @foreach($categories as $categorie)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $categorie->titre }}</strong>
                    </div>
                    <div>
                        <!-- Actions -->
                        <a href="{{ route('categories.show', $categorie->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <!-- Formulaire pour supprimer une catégorie -->
                        <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">Supprimer</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
