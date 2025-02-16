@extends('layouts.app')

@section('content')
    <h1>Liste des chapitres</h1>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('chapitres.create') }}" class="btn btn-primary">Ajouter un chapitre</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Durée</th>
                <th>Cours</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chapitres as $chapitre)
                <tr>
                    <td>{{ $chapitre->titre }}</td>
                    <td>{{ $chapitre->description }}</td>
                    <td>{{ $chapitre->duree }}</td>
                    <td>{{ $chapitre->cours->titre }}</td>
                    <td>
                        <a href="{{ route('chapitres.show', $chapitre->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('chapitres.edit', $chapitre->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('chapitres.destroy', $chapitre->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
