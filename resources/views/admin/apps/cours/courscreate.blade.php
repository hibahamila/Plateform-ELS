{{-- 
 @extends('layouts.admin.master')

@section('title') Ajouter un Cours @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Styles pour les messages d'alerte et boutons */
        #success-message, #delete-message, #create-message {
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
        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }
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
            <h3>Ajouter un Cours</h3>
        @endslot
        <li class="breadcrumb-item">Cours</li>
        <li class="breadcrumb-item active">Ajouter</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Affichage des erreurs côté serveur -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <!-- Formulaire d'ajout de cours avec validation Bootstrap -->
                        <div class="form theme-form">
                            <form action="{{ route('coursstore') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                
                                <!-- Titre -->
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="titre">Titre</label>
                                            <input id="titre" class="form-control" type="text" name="titre" placeholder="Titre" value="{{ old('titre') }}" required>
                                            <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea id="description" class="form-control" rows="4" name="description" placeholder="Description" required>{{ old('description') }}</textarea>
                                            <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Dates -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="date_debut">Date de début</label>
                                            <input id="date_debut" class="form-control" type="date" name="date_debut" value="{{ old('date_debut') }}" required>
                                            <div class="invalid-feedback">Veuillez sélectionner une date de début valide.</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="date_fin">Date de fin</label>
                                            <input id="date_fin" class="form-control" type="date" name="date_fin" value="{{ old('date_fin') }}" required>
                                            <div class="invalid-feedback">Veuillez sélectionner une date de fin valide.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Sélection des professeurs et formations -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="user_id">Professeurs</label>
                                            <select id="user_id" class="form-select select2-professeur" name="user_id" required>
                                                <option value="" disabled selected>Sélectionnez un professeur</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Veuillez sélectionner un professeur valide.</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="formation_id">Formation</label>
                                            <select id="formation_id" class="form-select select2-formation" name="formation_id" required>
                                                <option value="" disabled selected>Sélectionner une formation</option>
                                                @foreach($formations as $formation)
                                                    <option value="{{ $formation->id }}" {{ old('formation_id') == $formation->id ? 'selected' : '' }}>
                                                        {{ $formation->titre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Veuillez sélectionner une formation valide.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Boutons -->
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end">
                                            <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                            <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('cours') }}'">Annuler</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>

    <!-- Inclusion du script de validation global pour tous les formulaires -->
    <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>
   

    @endpush

@endsection --}}



@extends('layouts.admin.master')

@section('title') Ajouter un Cours @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Styles pour les messages d'alerte et boutons */
        #success-message, #delete-message, #create-message {
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
        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }
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
            <h3>Ajouter un Cours</h3>
        @endslot
        <li class="breadcrumb-item">Cours</li>
        <li class="breadcrumb-item active">Ajouter</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Affichage des erreurs côté serveur -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <!-- Formulaire d'ajout de cours avec validation Bootstrap -->
                        <div class="form theme-form">
                            <form action="{{ route('coursstore') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                
                                <!-- Titre -->
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="titre">Titre</label>
                                            <input id="titre" class="form-control" type="text" name="titre" placeholder="Titre" value="{{ old('titre') }}" required>
                                            <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea id="description" class="form-control" rows="4" name="description" placeholder="Description" required>{{ old('description') }}</textarea>
                                            <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Dates -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="date_debut">Date de début</label>
                                            <input id="date_debut" class="form-control" type="date" name="date_debut" value="{{ old('date_debut') }}" required>
                                            <div class="invalid-feedback">Veuillez sélectionner une date de début valide.</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="date_fin">Date de fin</label>
                                            <input id="date_fin" class="form-control" type="date" name="date_fin" value="{{ old('date_fin') }}" required>
                                            <div class="invalid-feedback">Veuillez sélectionner une date de fin valide.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Sélection des professeurs et formations -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="user_id">Professeurs</label>
                                            <select id="user_id" class="form-select select2-professeur" name="user_id" required>
                                                <option value="" disabled selected>Sélectionnez un professeur</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Veuillez sélectionner un professeur valide.</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="formation_id">Formation</label>
                                            <select id="formation_id" class="form-select select2-formation" name="formation_id" required>
                                                <option value="" disabled selected>Sélectionner une formation</option>
                                                @foreach($formations as $formation)
                                                    <option value="{{ $formation->id }}" {{ old('formation_id') == $formation->id ? 'selected' : '' }}>
                                                        {{ $formation->titre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Veuillez sélectionner une formation valide.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Boutons -->
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end">
                                            <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                            <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('cours') }}'">Annuler</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Écoutez l'événement de soumission du formulaire
            document.querySelector('form.needs-validation').addEventListener('submit', function (event) {
                event.preventDefault(); // Empêchez la soumission par défaut du formulaire

                // Simulez une soumission réussie (remplacez ceci par votre logique de soumission réelle)
                setTimeout(function () {
                    // Affichez l'alerte de succès
                    alert('Cours créé avec succès !');

                    // Demandez à l'utilisateur s'il souhaite créer un chapitre
                    if (confirm('Voulez-vous créer un chapitre pour ce cours ?')) {
                        // Redirigez vers la page de création de chapitre
                        window.location.href = '{{ route("chapitrecreate") }}';
                    } else {
                        // Redirigez vers la page des cours
                        window.location.href = '{{ route("cours") }}';
                    }
                }, 1000); // Simule un délai de soumission
            });
        });
    </script>
@endpush