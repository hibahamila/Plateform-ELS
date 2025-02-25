
@extends('layouts.admin.master')

@section('title') Ajouter une Leçon @endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<style>
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
    .invalid-feedback {
        display: block;
    }
</style>
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter une Leçon</h3>
        @endslot
        <li class="breadcrumb-item">Leçons</li>
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

                        <form action="{{ route('lessonstore') }}" method="POST" class="form theme-form needs-validation" enctype="multipart/form-data" novalidate>
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
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" rows="4" name="description" required placeholder="Description">{{ old('description') }}</textarea>
                                        <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Durée (HH:mm)</label>
                                        <input class="form-control" type="text" name="duree" value="{{ old('duree') }}" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" required />
                                        <div class="invalid-feedback">Veuillez entrer une durée valide (HH:mm).</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                
                                        <div class="mb-3">
                                            <label class="form-label">Chapitre</label>
                                            <select class="form-select select2-chapitre" name="chapitre_id" required>
                                                <option value="" selected disabled>Choisir un chapitre</option>
                                                @foreach($chapitres as $chapitre)
                                                    <option value="{{ $chapitre->id }}" {{ old('chapitre_id') == $chapitre->id ? 'selected' : '' }}>
                                                        {{ $chapitre->titre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Veuillez sélectionner un chapitre valide.</div>
                                        </div>
    
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Fichier</label>
                                        <input class="form-control" type="file" name="file_path" value="{{ old('file_path') }}" required />
                                        <div class="invalid-feedback">Veuillez sélectionner un fichier valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                    <a href="{{ route('lessons') }}" class="btn btn-danger px-4">Annuler</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>

<script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>
<script>
    document.getElementById('categoryForm').addEventListener('submit', function(event) {
        var form = this;
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });
    </script>


@endpush

@endsection 







{{-- maymshish :feha upload  --}}

{{-- 
@extends('layouts.admin.master')

@section('title') Ajouter une Leçon @endsection

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
    .invalid-feedback {
        display: block;
    }
</style>
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter une Leçon</h3>
        @endslot
        <li class="breadcrumb-item">Leçons</li>
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

                        <form action="{{ route('lessonstore') }}" method="POST" class="form theme-form needs-validation" enctype="multipart/form-data" novalidate>
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
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" rows="4" name="description" required placeholder="Description">{{ old('description') }}</textarea>
                                        <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Durée (HH:mm)</label>
                                        <input class="form-control" type="text" name="duree" value="{{ old('duree') }}" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" required />
                                        <div class="invalid-feedback">Veuillez entrer une durée valide (HH:mm).</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Chapitre</label>
                                        <select class="form-select select2-chapitre" name="chapitre_id" required>
                                            <option value="" selected disabled>Choisir un chapitre</option>
                                            @foreach($chapitres as $chapitre)
                                                <option value="{{ $chapitre->id }}" {{ old('chapitre_id') == $chapitre->id ? 'selected' : '' }}>
                                                    {{ $chapitre->titre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Veuillez sélectionner un chapitre valide.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Upload du fichier</label>
                                        <div class="dropzone" id="singleFileUpload">
                                            @csrf
                                            <div class="dz-message needsclick">
                                                <i class="icon-cloud-up"></i>
                                                <h6>Déposez le fichier ici ou cliquez pour uploader.</h6>
                                                <span class="note needsclick">(Tous les types de fichiers sont acceptés.)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                    <a href="{{ route('lessons') }}" class="btn btn-danger px-4">Annuler</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    // Initialisation de Dropzone
    Dropzone.autoDiscover = false; // Désactive la découverte automatique de Dropzone
    const dropzone = new Dropzone("#singleFileUpload", {
        paramName: "file", // Nom du paramètre pour le fichier
        maxFilesize: 100, // Taille maximale du fichier en MB
        // Supprimez la restriction sur les types de fichiers
        init: function() {
            this.on("success", function(file, response) {
                console.log("Fichier téléversé avec succès", response);
            });
            this.on("error", function(file, message) {
                console.error("Erreur lors du téléversement", message);
                alert("Erreur lors du téléversement : " + message);
            });
        }
    });

    // Initialisation de Select2 pour le champ de sélection des chapitres
    $(document).ready(function() {
        $('.select2-chapitre').select2({
            placeholder: "Choisir un chapitre",
            allowClear: true
        });
    });

    // Validation du formulaire
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            const forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endpush
@endsection  --}}