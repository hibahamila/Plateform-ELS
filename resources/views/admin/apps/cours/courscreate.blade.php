
@extends('layouts.admin.master')

@section('title') Ajouter un Cours @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link href="{{ asset('assets/css/custom-style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    @if(session()->has('cours_id'))
    <p>Session cours_id: {{ session('cours_id') }}</p>
    @endif

    <style>
   

/* Personnaliser la croix de fermeture de SweetAlert2 */
.swal2-close {
    color: red; /* Couleur de la croix en rouge */
    font-size: 40px; /* Taille de la croix */
    background-color: transparent; /* Aucune couleur de fond */
    border: none; /* Aucune bordure */
    position: absolute; /* Permet de positionner la croix de manière absolue */
    top: 10px; /* Distance par rapport au haut de l'alerte */
    right: 10px; /* Distance par rapport à la droite de l'alerte */
    cursor: pointer; /* Change le curseur en pointeur */
    outline: none; /* Supprime le contour autour de la croix */
}

/* Optionnel : ajouter un style au survol */
.swal2-close:hover {
    color: red; /* Garder la couleur rouge au survol */
    background-color: transparent; /* Assurer qu'il n'y a pas de fond au survol */
}

/* Supprimer les effets de bordure au clic */
.swal2-close:focus {
    outline: none; /* Enlever l'effet de focus (bordure noire ou bleue) */
    box-shadow: none; /* Supprimer l'ombre au focus */
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="form theme-form">
                            <form action="{{ route('coursstore') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="titre">Titre</label>
                                            <input id="titre" class="form-control" type="text" name="titre" placeholder="Titre" value="{{ old('titre') }}" required>
                                            <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea id="description" class="form-control" rows="4" name="description" placeholder="Description" required>{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
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
    <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let coursId = "{{ session('cours_id') }}";

            if (coursId) {
                Swal.fire({
                    title: "Cours ajouté avec succès !",
                    text: "Voulez-vous ajouter un chapitre à ce cours ?",
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonText: "Oui, ajouter un chapitre",
                    cancelButtonText: "Non, revenir à la liste",
                    showCloseButton: true, // Afficher la croix de fermeture
                    customClass: {
                        confirmButton: 'custom-confirm-btn'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Rediriger vers la page de création de chapitre
                        window.location.href = "{{ route('chapitrecreate') }}?cours_id=" + coursId;
                    } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
                        // Rediriger vers la liste des cours si l'utilisateur clique sur "Non"
                        window.location.href = "{{ route('cours') }}";
                    }
                    // Si l'utilisateur clique sur la croix, ne rien faire (rester sur la même page)
                });
            }
        });
    </script>
@endpush

@endsection