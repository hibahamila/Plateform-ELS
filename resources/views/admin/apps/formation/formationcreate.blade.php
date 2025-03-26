
@extends('layouts.admin.master')

@section('title') Ajouter une Formation @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/MonCss/formationcreate.css') }}">
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
                            <form class="needs-validation" action="{{ route('formationstore') }}" method="POST" enctype="multipart/form-data" novalidate>
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

                                        <!-- Description -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-align-left"></i></span>
                                                    <textarea class="form-control" id="description" rows="4" name="description" placeholder="Description" required>{{ old('description') }}</textarea>
                                                </div>
                                                <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                            </div>
                                        </div>

                                        <!-- Durée -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Durée (HH:mm) <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="icon-timer"></i></span>
                                                    <input class="form-control" type="text" id="duration" name="duration" placeholder="Ex: 02:30" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="{{ old('duration') }}" required />
                                                </div>
                                                <div class="invalid-feedback">Veuillez entrer la durée au format HH:mm.</div>
                                            </div>
                                        </div>

                                        <!-- Type -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Type <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-list"></i></span>
                                                    <input class="form-control" type="text" id="type" name="type" placeholder="Type" value="{{ old('type') }}" required />
                                                </div>
                                                <div class="invalid-feedback">Veuillez entrer un type valide.</div>
                                            </div>
                                        </div>

                                        <!-- Prix -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Prix <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text">Dt</span>
                                                    <input class="form-control" type="number" id="price" name="price" placeholder="Prix" step="0.01" value="{{ old('price') }}" required />
                                                </div>
                                                <div class="invalid-feedback">Veuillez entrer un Prix valide.</div>
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
                                        <!-- Bouton switch pour le statut -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Statut <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="form-check form-switch">
                                                    <!-- Case à cocher pour le statut -->
                                                    <input class="form-check-input" type="checkbox" id="statusToggle" name="status" 
                                                        value="1" {{ old('status', true) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="statusToggle">
                                                        <span id="statusLabel">{{ old('status', true) ? 'Publié' : 'Non publié' }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Boutons de soumission -->
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
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/MonJs/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/MonJs/form-validation/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/MonJs/formations/formationcreate.js') }}"></script>
    <script src="{{ asset('assets/js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/js/MonJs/description/description.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/ofuiqykj9zattk5odkx0o1t79jxdfcb5eeuemjgcdtb1s95t/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>


    <!-- Script pour la mise à jour dynamique du label du statut -->
    <script>
        document.getElementById('statusToggle').addEventListener('change', function() {
            const statusLabel = document.getElementById('statusLabel');
            statusLabel.textContent = this.checked ? 'Publié' : 'Non publié';
        });
    </script>
@endpush