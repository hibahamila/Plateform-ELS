{{-- @extends('layouts.admin.master')
@section('title') Ajouter une Formation @endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/MonCss/formationcreate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/MonCss/formation-create.css') }}">
<link href="{{ asset('assets/css/MonCss/custom-style.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/MonCss/SweatAlert2.css') }}" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

@endpush
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Nouvelle formation</h5>
                        <span>Complétez les informations pour créer une nouvelle formation</span>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form theme-form">
                            <meta name="csrf-token" content="{{ csrf_token() }}">

                            <form id="formationForm"class="needs-validation" action="{{ route('formationstore') }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <!-- Titre -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Titre <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                                    <input class="form-control" type="text" id="title" name="title" placeholder="Titre" value="{{ old('title') }}" required />
                                                </div>
                                                <div class="invalid-feedback">Veuillez entrer un Titre valide.</div>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group" style="flex-wrap: nowrap;">
                                                    <div class="input-group-text d-flex align-items-stretch" style="height: auto;">
                                                        <i class="fa fa-align-left align-self-center"></i>
                                                    </div>
                                                    <textarea class="form-control" id="description" name="description" placeholder="Description" required>{{ old('description') }}</textarea>
                                                </div>
                                                <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                            </div>
                                        </div>

                                        <!-- Durée -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Durée <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="icon-timer"></i></span>
                                                    <div class="duration-picker-container">
                                                        <input type="number" class="duration-hours" min="0" max="23" placeholder="HH" required>
                                                        <span class="duration-separator">:</span>
                                                        <input type="number" class="duration-minutes" min="0" max="59" placeholder="MM" required>
                                                        <input type="hidden" id="duration" name="duration" value="{{ old('duration') }}" required>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">Veuillez sélectionner une durée valide.</div>
                                            </div>
                                        </div>

                                        <!-- Type -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Type <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-list"></i></span>
                                                    <select class="form-select" id="type" name="type" required>
                                                        <option value="" selected disabled>Choisir un type</option>
                                                        <option value="payante" {{ old('type') == 'payante' ? 'selected' : '' }}>Payante</option>
                                                        <option value="gratuite" {{ old('type') == 'gratuite' ? 'selected' : '' }}>Gratuite</option>
                                                    </select>
                                                </div>
                                                <div class="invalid-feedback">Veuillez sélectionner un type.</div>
                                            </div>
                                        </div>

                                        <!-- Prix -->
                                        <div class="mb-3 row" id="priceContainer">
                                            <label class="col-sm-2 col-form-label">Prix <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text">Dt</span>
                                                    <input class="form-control"
                                                           type="number"
                                                           id="price"
                                                           name="price"
                                                           placeholder="Ex: 50.000"
                                                           step="0.001"
                                                           min="0"
                                                           value="{{ old('price') }}" />
                                                </div>
                                                <small class="text-muted">Format: 000.000 (3 décimales obligatoires)</small>
                                                <div class="invalid-feedback">Veuillez entrer un prix valide (ex: 50.000 ou 45.500)</div>
                                            </div>
                                        </div>

                                        <!-- Catégorie -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Catégorie <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <select class="form-select select2-categorie" id="categorie_id" name="categorie_id" required>
                                                        <option value="" selected disabled>Choisir une catégorie</option>
                                                        @foreach($categories as $categorie)
                                                            <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                                                {{ $categorie->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="invalid-feedback">Veuillez sélectionner une catégorie valide.</div>
                                            </div>
                                        </div>

                                        <!-- Professeur -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Professeur <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <div class="col">
                                                        <select id="user_id" class="form-select select2-professeur" name="user_id" required>
                                                            <option value="" disabled selected>Sélectionnez un professeur</option>
                                                            @foreach($professeurs as $professeur)
                                                                <option value="{{ $professeur->id }}" {{ old('user_id') == $professeur->id ? 'selected' : '' }}>
                                                                    {{ $professeur->name }} {{ $professeur->lastname ?? '' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">Veuillez sélectionner un professeur valide.</div>
                                            </div>
                                        </div>

                                        <!-- Image -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Image <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-image"></i></span>
                                                    <input class="form-control" type="file" id="image" name="image" accept="image/*" value="{{ old('image') }}" required />
                                                </div>
                                                <div class="invalid-feedback">Veuillez télécharger une image valide.</div>
                                                <small class="text-muted">Formats acceptés: JPG, PNG, GIF. Taille max: 2Mo</small>
                                            </div>
                                        </div>

                                        <!-- Conteneur de prévisualisation de l'image -->
                                        <div class="center-container">
                                            <div id="imagePreviewContainer" class="image-preview-container hidden">
                                                <img id="imagePreview" class="image-preview" src="#" alt="Prévisualisation de l'image" />
                                                <div class="image-preview-actions">
                                                    <button type="button" class="btn-icon" id="deleteImage">
                                                        <i class="fa fa-trash trash-icon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Publication Section -->
                                        <div class="mb-3 row">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                        <div class="radio radio-primary mx-2">
                                                            <input id="publishNow" type="radio" name="publication_type" value="now" checked>
                                                            <label class="mb-0" for="publishNow">Publier immédiatement</label>
                                                        </div>
                                                        <div class="radio radio-primary mx-2">
                                                            <input id="publishLater" type="radio" name="publication_type" value="later">
                                                            <label class="mb-0" for="publishLater">Programmer la publication</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Publication Date Container -->
                                                <div id="publishDateContainer" class="mt-3 text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <div class="input-group" style="max-width:500px;">
                                                            <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                                            <input class="form-control"
                                                                type="datetime-local"
                                                                id="publish_date"
                                                                name="publish_date"
                                                                value="{{ old('publish_date') }}"
                                                                min="{{ now()->format('Y-m-d\TH:i') }}">
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">Sélectionnez la date et l'heure de publication</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Boutons -->
                                        <div class="row">
                                            <div class="col">
                                                <div class="text-end mt-4">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="fa fa-save"></i> Ajouter
                                                    </button>
                                                    <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('formations') }}'">
                                                        <i class="fa fa-times"></i> Annuler
                                                    </button>
                                                </div>
                                            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="{{ asset('assets/js/MonJs/select2-init/single-select.js') }}"></script>
<script src="{{ asset('assets/js/MonJs/form-validation/form-validation.js') }}"></script>
<script src="{{ asset('assets/js/MonJs/formations/formation-submit.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="{{ asset('assets/css/MonCss/SweatAlert2.css') }}" rel="stylesheet">

<script src="{{ asset('assets/js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/js/MonJs/description/description.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/cwjxs6s7k08kvxb3t6udodzrwpomhxtehiozsu4fem2igekf/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // Gestion de la notification après l'ajout du cours
    let formationId = "{{ session('formation_id') }}";
    if (formationId) {
        Swal.fire({
            // title: "Formation ajoutée avec succès !",
            title:"Formation ajouté avec succès !",

            text: "Voulez-vous ajouter un cours à cette formation ?",
            icon: "success",
            showCancelButton: true,
            confirmButtonText: "Oui, ajouter un cours",
            cancelButtonText: "Non, revenir à la liste",
            showCloseButton: false,
            allowOutsideClick: false,      // Empêche la fermeture en cliquant à l'extérieur
            allowEscapeKey: false,         // Empêche la fermeture avec la touche Échap
             allowEnterKey: false,
            customClass: {
                confirmButton: 'custom-confirm-btn'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('courscreate') }}?formation_id=" + formationId;
            } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
                window.location.href = "{{ route('formations') }}";
            }
        });
    }
</script>

@endpush --}}



@extends('layouts.admin.master')
@section('title') Ajouter une Formation @endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/MonCss/formationcreate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/MonCss/formation-create.css') }}">
<link href="{{ asset('assets/css/MonCss/custom-style.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/MonCss/SweatAlert2.css') }}" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

@endpush
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Nouvelle formation</h5>
                        <span>Complétez les informations pour créer une nouvelle formation</span>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form theme-form">
                            <meta name="csrf-token" content="{{ csrf_token() }}">

                            <form id="formationForm"class="needs-validation" action="{{ route('formationstore') }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <!-- Titre -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Titre <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                                    <input class="form-control" type="text" id="title" name="title" placeholder="Titre" value="{{ old('title') }}" required />
                                                </div>
                                                <div class="invalid-feedback">Veuillez entrer un Titre valide.</div>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group" style="flex-wrap: nowrap;">
                                                    <div class="input-group-text d-flex align-items-stretch" style="height: auto;">
                                                        <i class="fa fa-align-left align-self-center"></i>
                                                    </div>
                                                    <textarea class="form-control" id="description" name="description" placeholder="Description" required>{{ old('description') }}</textarea>
                                                </div>
                                                <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                            </div>
                                        </div>
{{-- 
                                        <!-- Durée -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Durée <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="icon-timer"></i></span>
                                                    <div class="duration-picker-container">
                                                        <input type="number" class="duration-hours" min="0" max="23" placeholder="HH" required>
                                                        <span class="duration-separator">:</span>
                                                        <input type="number" class="duration-minutes" min="0" max="59" placeholder="MM" required>
                                                        <input type="hidden" id="duration" name="duration" value="{{ old('duration') }}" required>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">Veuillez sélectionner une durée valide.</div>
                                            </div>
                                        </div> --}}

                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Durée</label>
                                            <div class="col-sm-10">
                                                <p class="form-text text-muted">
                                                    <i class="icon-timer"></i> La durée sera calculée automatiquement en fonction des cours ajoutés à cette formation.
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Dates de début et de fin -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Date de début <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            <input class="form-control" type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez sélectionner une date de début valide.</div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Date de fin <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            <input class="form-control" type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez sélectionner une date de fin valide.</div>
                                    </div>
                                </div>

                                        <!-- Type -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Type <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-list"></i></span>
                                                    <select class="form-select" id="type" name="type" required>
                                                        <option value="" selected disabled>Choisir un type</option>
                                                        <option value="payante" {{ old('type') == 'payante' ? 'selected' : '' }}>Payante</option>
                                                        <option value="gratuite" {{ old('type') == 'gratuite' ? 'selected' : '' }}>Gratuite</option>
                                                    </select>
                                                </div>
                                                <div class="invalid-feedback">Veuillez sélectionner un type.</div>
                                            </div>
                                        </div>

                                        <!-- Prix -->
                                        <div class="mb-3 row" id="priceContainer">
                                            <label class="col-sm-2 col-form-label">Prix <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text">Dt</span>
                                                    <input class="form-control"
                                                           type="number"
                                                           id="price"
                                                           name="price"
                                                           placeholder="Ex: 50.000"
                                                           step="0.001"
                                                           min="0"
                                                           value="{{ old('price') }}" />
                                                </div>
                                                <small class="text-muted">Format: 000.000 (3 décimales obligatoires)</small>
                                                <div class="invalid-feedback">Veuillez entrer un prix valide (ex: 50.000 ou 45.500)</div>
                                            </div>
                                        </div>

                                        <!-- Catégorie -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Catégorie <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <select class="form-select select2-categorie" id="categorie_id" name="categorie_id" required>
                                                        <option value="" selected disabled>Choisir une catégorie</option>
                                                        @foreach($categories as $categorie)
                                                            <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                                                {{ $categorie->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="invalid-feedback">Veuillez sélectionner une catégorie valide.</div>
                                            </div>
                                        </div>

                                        <!-- Professeur -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Professeur <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <div class="col">
                                                        <select id="user_id" class="form-select select2-professeur" name="user_id" required>
                                                            <option value="" disabled selected>Sélectionnez un professeur</option>
                                                            @foreach($professeurs as $professeur)
                                                                <option value="{{ $professeur->id }}" {{ old('user_id') == $professeur->id ? 'selected' : '' }}>
                                                                    {{ $professeur->name }} {{ $professeur->lastname ?? '' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">Veuillez sélectionner un professeur valide.</div>
                                            </div>
                                        </div>

                                        <!-- Image -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Image <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-image"></i></span>
                                                    <input class="form-control" type="file" id="image" name="image" accept="image/*" value="{{ old('image') }}" required />
                                                </div>
                                                <div class="invalid-feedback">Veuillez télécharger une image valide.</div>
                                                <small class="text-muted">Formats acceptés: JPG, PNG, GIF. Taille max: 2Mo</small>
                                            </div>
                                        </div>

                                        <!-- Conteneur de prévisualisation de l'image -->
                                        <div class="center-container">
                                            <div id="imagePreviewContainer" class="image-preview-container hidden">
                                                <img id="imagePreview" class="image-preview" src="#" alt="Prévisualisation de l'image" />
                                                <div class="image-preview-actions">
                                                    <button type="button" class="btn-icon" id="deleteImage">
                                                        <i class="fa fa-trash trash-icon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Publication Section -->
                                        <div class="mb-3 row">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                        <div class="radio radio-primary mx-2">
                                                            <input id="publishNow" type="radio" name="publication_type" value="now" checked>
                                                            <label class="mb-0" for="publishNow">Publier immédiatement</label>
                                                        </div>
                                                        <div class="radio radio-primary mx-2">
                                                            <input id="publishLater" type="radio" name="publication_type" value="later">
                                                            <label class="mb-0" for="publishLater">Programmer la publication</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Publication Date Container -->
                                                <div id="publishDateContainer" class="mt-3 text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <div class="input-group" style="max-width:500px;">
                                                            <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                                            <input class="form-control"
                                                                type="datetime-local"
                                                                id="publish_date"
                                                                name="publish_date"
                                                                value="{{ old('publish_date') }}"
                                                                min="{{ now()->format('Y-m-d\TH:i') }}">
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">Sélectionnez la date et l'heure de publication</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Boutons -->
                                        <div class="row">
                                            <div class="col">
                                                <div class="text-end mt-4">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="fa fa-save"></i> Ajouter
                                                    </button>
                                                    <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('formations') }}'">
                                                        <i class="fa fa-times"></i> Annuler
                                                    </button>
                                                </div>
                                            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="{{ asset('assets/js/MonJs/select2-init/single-select.js') }}"></script>
<script src="{{ asset('assets/js/MonJs/form-validation/form-validation.js') }}"></script>
<script src="{{ asset('assets/js/MonJs/formations/formation-submit.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="{{ asset('assets/css/MonCss/SweatAlert2.css') }}" rel="stylesheet">

<script src="{{ asset('assets/js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/js/MonJs/description/description.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/cwjxs6s7k08kvxb3t6udodzrwpomhxtehiozsu4fem2igekf/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // Gestion de la notification après l'ajout du cours
    let formationId = "{{ session('formation_id') }}";
    if (formationId) {
        Swal.fire({
            // title: "Formation ajoutée avec succès !",
            title:"Formation ajouté avec succès !",

            text: "Voulez-vous ajouter un cours à cette formation ?",
            icon: "success",
            showCancelButton: true,
            confirmButtonText: "Oui, ajouter un cours",
            cancelButtonText: "Non, revenir à la liste",
            showCloseButton: false,
            allowOutsideClick: false,      // Empêche la fermeture en cliquant à l'extérieur
            allowEscapeKey: false,         // Empêche la fermeture avec la touche Échap
             allowEnterKey: false,
            customClass: {
                confirmButton: 'custom-confirm-btn'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('courscreate') }}?formation_id=" + formationId;
            } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
                window.location.href = "{{ route('formations') }}";
            }
        });
    }
</script>

@endpush