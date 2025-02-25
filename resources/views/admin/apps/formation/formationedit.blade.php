
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
                            <form action="{{ route('formationupdate', $formation->id) }}" method="POST">

                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Titre</label>
                                            <input class="form-control" type="text" name="titre" placeholder="Titre" value="{{ old('titre', $formation->titre) }}" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" rows="4" name="description" placeholder="Description" required>{{ old('description', $formation->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Durée (HH:mm)</label>
                                            <input class="form-control" type="text" name="duree" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="{{ old('duree', \Carbon\Carbon::parse($formation->duree)->format('H:i')) }}" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Type</label>
                                            <input class="form-control" type="text" name="type" placeholder="Type" value="{{ old('type', $formation->type) }}" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Prix</label>
                                            <input class="form-control" type="number" name="prix" placeholder="Prix" step="0.01" value="{{ old('prix', $formation->prix) }}" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Catégorie</label>
                                            <select class="form-select select2-categorie" name="categorie_id"  required>
                                                <option value="" disabled selected>Choisir une catégorie</option>
                                                @foreach($categories as $categorie)
                                                    <option value="{{ $categorie->id }}" {{ old('categorie_id', $formation->categorie_id) == $categorie->id ? 'selected' : '' }}>
                                                        {{ $categorie->titre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col text-end">
                                            <button class="btn btn-secondary me-3" type="submit">Mettre à jour</button>
                                        <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('formations') }}'">Annuler</button>
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
    @push('scripts')
    <!--  lel update-->
    {{-- <script>
        $(document).ready(function() {
            // Initialisation spécifique pour la page d'édition
            $('.select2-categorie').select2({
                width: '100%',
                placeholder: "Sélectionner une catégorie",
                allowClear: true
            });
            
            // Forcer Select2 à reconnaître la valeur pré-sélectionnée
            setTimeout(function() {
                $('.select2-categorie').trigger('change');
            }, 100);
        });
    </script> --}}
@endpush
@endpush

<style>
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

@endsection


