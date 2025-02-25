

@extends('layouts.admin.master')

@section('title') Modifier une Catégorie @endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Modifier une Catégorie</h3>
        @endslot
        <li class="breadcrumb-item">Catégories</li>
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
                            <form action="{{ route('categorieupdate', $categorie->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Titre</label>
                                            <input class="form-control" type="text" name="titre" placeholder="Titre" value="{{ old('titre', $categorie->titre) }}" required />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end">
                                            <button class="btn btn-secondary me-3" type="submit">Mettre à jour</button>
                                            <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('categories') }}'">Annuler</button>
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
@endpush
@endsection 

