
@extends('layouts.admin.master')

@section('title') Ajouter un Chapitre @endsection

@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
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
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter un Chapitre</h3>
        @endslot
        <li class="breadcrumb-item">Chapitres</li>
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

                        <form class="needs-validation" action="{{ route('chapitrestore') }}" method="POST" novalidate>
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
                                        <textarea class="form-control" rows="4" name="description" placeholder="Description" required>{{ old('description') }}</textarea>
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

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Cours</label>
                                        <select class="form-select select2-cours" name="cours_id" required>
                                            <option value="" selected disabled>Choisir un cours</option>
                                            @foreach($cours as $coursItem)
                                                <option value="{{ $coursItem->id }}" {{ old('cours_id') == $coursItem->id ? 'selected' : '' }}>
                                                    {{ $coursItem->titre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Veuillez sélectionner un cours.</div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>
@endpush
@endsection 


