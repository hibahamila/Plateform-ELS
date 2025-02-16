@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Ajouter une Catégorie</h1>

        <!-- Affichage des erreurs de validation -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="titre" class="form-label">Titre :</label>
                <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
