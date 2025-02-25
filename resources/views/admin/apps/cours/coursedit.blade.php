

@extends('layouts.admin.master')

@section('title') Modifier un Cours @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <!-- CSS de Select2 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Modifier un Cours</h3>
        @endslot
        <li class="breadcrumb-item">Cours</li>
        <li class="breadcrumb-item active">Modifier</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Affichage des messages d'erreur -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Affichage du message flash de succès -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('coursupdate', $cours->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Titre -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="titre" class="form-label">Titre du Cours</label>
                                        <input type="text" name="titre" class="form-control" value="{{ old('titre', $cours->titre) }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $cours->description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Date de début -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="date_debut" class="form-label">Date de Début</label>
                                        <input type="date" name="date_debut" class="form-control" value="{{ old('date_debut', $cours->date_debut) }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Date de fin -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="date_fin" class="form-label">Date de Fin</label>
                                        <input type="date" name="date_fin" class="form-control" value="{{ old('date_fin', $cours->date_fin) }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Formation avec Select2 -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="formation_id" class="form-label">Formation</label>
                                        <select name="formation_id" class="form-select select2-formation" required>
                                            <option value="" disabled selected>Sélectionner une formation</option>
                                            @foreach($formations as $formation)
                                                <option value="{{ $formation->id }}" {{ old('formation_id', $cours->formation_id) == $formation->id ? 'selected' : '' }}>
                                                    {{ $formation->titre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Utilisateur avec Select2 -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="user_id" class="form-label">Professeurs</label>
                                        <select name="user_id" class="form-select select2-professeur" required>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('user_id', $cours->user_id) == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <!-- Boutons -->
                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Mettre à jour</button>
                                    <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('cours') }}'">Annuler</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@push('scripts')
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <!-- Inclusion de Select2 JS via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- Inclusion du fichier JS externe pour l'initialisation de Select2 -->
    <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
@endpush

@push('styles')
    <style>
        .custom-btn {
            background-color: #2b786a; /* Vert foncé */
            color: white;
            border-color: #2b786a;
        }
        .custom-btn:hover {
            background-color: #1f5c4d;
            border-color: #1f5c4d;
            color: white;
        }
    </style>
@endpush

@endsection
