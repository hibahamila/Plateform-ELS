 @extends('layouts.admin.master')

@section('title') Ajouter une Formation @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/MonCss/formationcreate.css') }}">
    <style>
        #publishDateContainer {
            display: none;
        }
    </style>
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
                                                    <textarea class="form-control" id="description"  name="description" placeholder="Description" required>{{ old('description') }}</textarea>
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
                                                    <input class="form-control" 
                                                           type="number" 
                                                           id="price" 
                                                           name="price" 
                                                           placeholder="Ex: 50.000" 
                                                           step="0.001" 
                                                           min="0"
                                                           value="{{ old('price') }}" 
                                                           required />
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
                                            <div class="col-12">  <!-- Utilisation de col-12 pour occuper toute la largeur -->
                                                <div class="d-flex justify-content-center">  <!-- Centrage horizontal -->
                                                    <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                        <div class="radio radio-primary mx-2">  <!-- marge horizontale -->
                                                            <input id="publishNow" type="radio" name="publication_type" value="now" checked>
                                                            <label class="mb-0" for="publishNow">Publier immédiatement</label>
                                                        </div>
                                                        <div class="radio radio-primary mx-2">  <!-- marge horizontale -->
                                                            <input id="publishLater" type="radio" name="publication_type" value="later">
                                                            <label class="mb-0" for="publishLater">Programmer la publication</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Publication Date Container -->
                                                <div id="publishDateContainer" class="mt-3 text-center">  <!-- Centrage du texte -->
                                                    <div class="d-flex justify-content-center">  <!-- Centrage du groupe -->
                                                        <div class="input-group" style="max-width:500px;">  <!-- Limite de largeur -->
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
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/MonJs/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/MonJs/form-validation/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/MonJs/formations/formationcreate.js') }}"></script>
    <script src="{{ asset('assets/js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/js/MonJs/description/description.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/ofuiqykj9zattk5odkx0o1t79jxdfcb5eeuemjgcdtb1s95t/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        // Formatage automatique du prix
        document.getElementById('price').addEventListener('blur', function() {
            let value = parseFloat(this.value);
            if (!isNaN(value)) {
                this.value = value.toFixed(3);
            }
        });

        // Show/hide publication date based on radio button selection
        document.addEventListener('DOMContentLoaded', function() {
            const publishNowRadio = document.getElementById('publishNow');
            const publishLaterRadio = document.getElementById('publishLater');
            const publishDateContainer = document.getElementById('publishDateContainer');
            const publishDateInput = document.getElementById('publish_date');

            function togglePublishDate() {
                if (publishLaterRadio.checked) {
                    publishDateContainer.style.display = 'block';
                    publishDateInput.required = true;
                } else {
                    publishDateContainer.style.display = 'none';
                    publishDateInput.required = false;
                    publishDateInput.value = ''; // Clear the date when hidden
                }
            }

            publishNowRadio.addEventListener('change', togglePublishDate);
            publishLaterRadio.addEventListener('change', togglePublishDate);

            // Initial state
            togglePublishDate();
        });
    </script>
@endpush


