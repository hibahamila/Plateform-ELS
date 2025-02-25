


@extends('layouts.admin.master')

@section('title') Ajouter une Réponse @endsection

@push('css')
    <!-- CSS de Dropzone si nécessaire -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
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
        /* Style pour le bouton personnalisé */
        .custom-btn {
            background-color: #2b786a;
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
            <h3>Ajouter une Réponse</h3>
        @endslot
        <li class="breadcrumb-item">Réponses</li>
        <li class="breadcrumb-item active">Ajouter</li>
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

                        <!-- Formulaire d'ajout de réponse -->
                        <form action="{{ route('reponsestore') }}" method="POST" class="form theme-form needs-validation" enctype="multipart/form-data" novalidate onsubmit="console.log('Formulaire soumis');">
                            @csrf

                            <!-- Champ Question avec Select2 -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="question_id" class="form-label">Question</label>
                                        <select class="form-select select2-question" name="question_id" required>
                                            <option value="" disabled selected>Choisir une question</option>
                                            @foreach($questions as $question)
                                                <option value="{{ $question->id }}">{{ $question->enonce }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Champ Contenu -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="contenu" class="form-label">Contenu</label>
                                        <input type="text" class="form-control" name="contenu" placeholder="Contenu" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Champ Est correcte ? -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Est correcte ?</label>
                                        <select class="form-select" name="est_correcte" required>
                                            <option value="1">Oui</option>
                                            <option value="0">Non</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                    <a href="{{ route('reponses') }}" class="btn btn-danger px-4">Annuler</a>
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
    <!-- Inclusion de notre fichier JS externe pour l'initialisation de Select2 -->
    <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>


    @endpush

@endsection
