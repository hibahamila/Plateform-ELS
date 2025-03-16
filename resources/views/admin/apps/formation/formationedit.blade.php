
 @extends('layouts.admin.master')

@section('title') Modifier une Formation @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Modifier une Formation</h3>
        @endslot
        <li class="breadcrumb-item">Formations</li>
        <li class="breadcrumb-item active">Modifier</li>
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
                            <form action="{{ route('formationupdate', $formation->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Titre</label>
                                            <input class="form-control" type="text" name="titre" placeholder="Titre" value="{{ old('titre', $formation->titre) }}" required />
                                            <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" rows="4" name="description" placeholder="Description" required>{{ old('description', $formation->description) }}</textarea>
                                            <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Durée (HH:mm)</label>
                                            <input class="form-control" type="text" name="duree" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="{{ old('duree', \Carbon\Carbon::parse($formation->duree)->format('H:i')) }}" required />
                                            <div class="invalid-feedback">Veuillez entrer une durée au format HH:mm.</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Type</label>
                                            <input class="form-control" type="text" name="type" placeholder="Type" value="{{ old('type', $formation->type) }}" required />
                                            <div class="invalid-feedback">Veuillez entrer un type valide.</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Prix</label>
                                            <input class="form-control" type="number" name="prix" placeholder="Prix" step="0.01" value="{{ old('prix', $formation->prix) }}" required />
                                            <div class="invalid-feedback">Veuillez entrer un prix valide.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Catégorie</label>
                                            <select class="form-select select2-categorie" name="categorie_id" required>
                                                <option value="" disabled selected>Choisir une catégorie</option>
                                                @foreach($categories as $categorie)
                                                    <option value="{{ $categorie->id }}" {{ old('categorie_id', $formation->categorie_id) == $categorie->id ? 'selected' : '' }}>{{ $categorie->titre }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Veuillez sélectionner une catégorie.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            @if($formation->image)
                                                <div id="currentImageContainer" class="mb-3">
                                                    <img src="{{ asset('storage/' . $formation->image) }}" alt="image" width="250" class="d-block mb-2" />
                                                    <button type="button" class="btn btn-danger" id="deleteImage"><i class="fa fa-trash"></i> Supprimer</button>
                                                    <button type="button" class="btn btn-secondary" id="restoreImage" style="display: none;"><i class="fa fa-undo"></i> Revenir à l'image actuelle</button>
                                                </div>
                                            @endif
                                            <input class="form-control" type="file" name="image" id="imageUpload" style="{{ $formation->image ? 'display: none;' : '' }}">
                                            <input type="hidden" name="delete_image" id="deleteImageInput" value="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('formations') }}'">Annuler</button>
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
<script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>
<script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
<script src="{{ asset('assets/js/formations/formation-edit.js') }}"></script>
@endpush

