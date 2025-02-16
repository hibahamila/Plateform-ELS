@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Détails de la Catégorie</h1>

        <!-- Affichage des détails de la catégorie -->
        <div class="card">
            <div class="card-body">
                <p><strong>Nom :</strong> {{ $categorie->titre }}</p>
                <!-- Ajouter d'autres informations si nécessaire -->

                <!-- Lien de retour -->
                <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
            </div>
        </div>
    </div>
@endsection
