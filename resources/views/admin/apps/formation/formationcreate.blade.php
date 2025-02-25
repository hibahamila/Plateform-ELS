

{{-- bl validation  --}}


@extends('layouts.admin.master')

@section('title') Ajouter une Formation @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Styles pour les messages d'alerte */
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
        .custom-btn i {
            margin-right: 8px;
        }
    </style>
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter une Formation</h3>
        @endslot
        <li class="breadcrumb-item">Formations</li>
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
                            <form class="needs-validation" action="{{ route('formationstore') }}" method="POST" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="titre">Titre</label>
                                            <input class="form-control" type="text" id="titre" name="titre" placeholder="Titre" value="{{ old('titre') }}" required />
                                            <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea class="form-control" id="description" rows="4" name="description" placeholder="Description" required>{{ old('description') }}</textarea>
                                            <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="duree">Durée (HH:mm)</label>
                                            <input class="form-control" type="text" id="duree" name="duree" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="{{ old('duree') }}" required />
                                            <div class="invalid-feedback">Veuillez entrer la durée au format HH:mm.</div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="type">Type</label>
                                            <input class="form-control" type="text" id="type" name="type" placeholder="Type" value="{{ old('type') }}" required />
                                            <div class="invalid-feedback">Veuillez entrer un type valide.</div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="prix">Prix</label>
                                            <input class="form-control" type="number" id="prix" name="prix" placeholder="Prix" step="0.01" value="{{ old('prix') }}" required />
                                            <div class="invalid-feedback">Veuillez entrer un prix valide.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="categorie_id">Catégorie</label>
                                            <select class="form-select select2-categorie" id="categorie_id" name="categorie_id" required>
                                                <option value="" selected disabled>Choisir une catégorie</option>
                                                @foreach($categories as $categorie)
                                                    <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                                        {{ $categorie->titre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Veuillez sélectionner une catégorie valide.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="text-end">
                                            <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                            <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('formations') }}'">Annuler</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>

    {{-- <script>
        // Activer la validation des formulaires Bootstrap
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script> --}}
@endpush

@endsection 

