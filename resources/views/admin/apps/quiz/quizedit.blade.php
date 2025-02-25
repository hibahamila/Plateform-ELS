

@extends('layouts.admin.master')

@section('title') Modifier un Quiz @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone/dropzone.css') }}">
    <!-- CSS de Select2 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Styles pour les messages d'alerte */
        #success-message, #delete-message {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        /* Styles pour le bouton personnalisé */
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

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Modifier un Quiz</h3>
        @endslot
        <li class="breadcrumb-item">Quiz</li>
        <li class="breadcrumb-item active">Modifier</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Affichage des erreurs -->
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

                        <!-- Formulaire de modification de quiz -->
                        <form action="{{ route('quizupdate', $quiz->id) }}" method="POST" class="theme-form">
                            @csrf
                            @method('PUT')

                            <!-- Titre -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="titre" class="form-label">Titre</label>
                                        <input type="text" name="titre" class="form-control" value="{{ old('titre', $quiz->titre) }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $quiz->description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Date Limite -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="date_limite" class="form-label">Date Limite</label>
                                        <input type="date" name="date_limite" class="form-control" value="{{ old('date_limite', $quiz->date_limite) }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Date de Fin -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="date_fin" class="form-label">Date de Fin</label>
                                        <input type="date" name="date_fin" class="form-control" value="{{ old('date_fin', $quiz->date_fin) }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Cours avec Select2 -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="cours_id" class="form-label">Cours</label>
                                        <select name="cours_id" class="form-select select2-cours" required>
                                            <option value="" disabled selected>Choisir un cours</option>
                                            @foreach($cours as $coursItem)
                                                <option value="{{ $coursItem->id }}" {{ old('cours_id', $quiz->cours_id) == $coursItem->id ? 'selected' : '' }}>
                                                    {{ $coursItem->titre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Score Minimum -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="score_minimum" class="form-label">Score Minimum</label>
                                        <input type="number" name="score_minimum" class="form-control" value="{{ old('score_minimum', $quiz->score_minimum) }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Mettre à jour</button>
                                    <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('quizzes') }}'">Annuler</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <!-- Inclusion de Select2 JS via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- Inclusion de notre fichier JS externe pour l'initialisation de Select2 -->
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
