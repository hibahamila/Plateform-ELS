


@extends('layouts.admin.master')

@section('title') Ajouter une Catégorie @endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter une Catégorie</h3>
        @endslot
        <li class="breadcrumb-item">Catégories</li>
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

                        <form id="categoryForm" class="needs-validation" action="{{ route('categoriestore') }}" method="POST" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="titre" class="form-label">Titre</label>
                                        <input type="text" name="titre" id="titre" class="form-control w-100" placeholder="Titre" value="{{ old('titre') }}" required>
                                        <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                        {{-- La classe invalid-feedback vient de Bootstrap et est utilisée pour 
                                        afficher un message d'erreur de validation lorsque le champ d'un 
                                        formulaire est invalide. --}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                    <a href="{{ route('categories') }}" class="btn btn-danger">Annuler</a>
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
<script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>

@endpush

<style>
    #titre {
        width: 100%; 
        padding: 10px; 
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
</style>

@endsection
