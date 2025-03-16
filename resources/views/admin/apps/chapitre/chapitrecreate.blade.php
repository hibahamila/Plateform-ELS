

@extends('layouts.admin.master')

@section('title') Ajouter un Chapitre @endsection

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
    <link href="{{ asset('assets/css/custom-style.css') }}" rel="stylesheet">

    @if(session()->has('chapitre_id'))
    <p>Session chapitre_id: {{ session('chapitre_id') }}</p>
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
            <h3>Ajouter un Chapitre</h3>
        @endslot
        <li class="breadcrumb-item">Chapitres</li>
        <li class="breadcrumb-item active">Ajouter</li>
    @endcomponent

    @php
        $selectedCoursId = request()->query('cours_id', old('cours_id'));
    @endphp

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

                        <form id="create-chapitre-form" class="needs-validation" action="{{ route('chapitrestore') }}" method="POST" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Titre</label>
                                        <input class="form-control" type="text" name="titre" placeholder="Titre" value="{{ old('titre') }}" required />
                                        <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="description">Description</label>
                                        <textarea id="description" class="form-control" rows="4" name="description" placeholder="Description" required>{{ old('description') }}</textarea>
                                        <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Durée (HH:mm)</label>
                                        <input class="form-control" type="text" name="duree" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="{{ old('duree') }}" required />
                                        <div class="invalid-feedback">Veuillez entrer la durée au format HH:mm.</div>
                                    </div>
                                </div>
                            </div>

                            {{-- autre --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Cours</label>
                                        @if ($selectedCoursId && request()->has('cours_id'))
                                            <!-- Si un cours est sélectionné via l'URL (venant d'un cours existant) -->
                                            <input type="text" class="form-control bg-light" value="{{ $cours->find($selectedCoursId)->titre }}" readonly />
                                            <input type="hidden" name="cours_id" value="{{ $selectedCoursId }}">
                                        @else
                                            <!-- Si aucun cours n'est sélectionné OU si on arrive sur cette page après l'alerte -->
                                            <select class="form-select select2-cours" name="cours_id" required>
                                                <option value="" disabled {{ !$selectedCoursId ? 'selected' : '' }}>Choisir un cours</option>
                                                @foreach($cours as $coursItem)
                                                    <option value="{{ $coursItem->id }}" {{ $selectedCoursId == $coursItem->id ? 'selected' : '' }}>
                                                        {{ $coursItem->titre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Veuillez sélectionner un cours valide.</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                    <a href="{{ route('chapitres') }}" class="btn btn-danger px-4">Annuler</a>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let chapitreId = "{{ session('chapitre_id') }}";

            if (chapitreId) {
                Swal.fire({
                    title: "Chapitre ajouté avec succès !",
                    text: "Voulez-vous ajouter une lesson à ce chapitre ?",
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonText: "Oui, ajouter une lesson",
                    cancelButtonText: "Non, revenir à la liste",
                    showCloseButton: true, // Activer la croix de fermeture
                    customClass: {
                        confirmButton: 'custom-confirm-btn' // Personnaliser le bouton "Oui"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('lessoncreate') }}?chapitre_id=" + chapitreId;
                    } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = "{{ route('chapitres') }}";
                    }
                    // Si l'utilisateur clique sur la croix, ne rien faire (rester sur la même page)
                });
            }
        });
    </script>
@endpush

@endsection
