
@extends('layouts.admin.master')

@section('title') Modifier une Leçon @endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Modifier une Leçon</h3>
        @endslot
        <li class="breadcrumb-item">Leçons</li>
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

                        <form action="{{ route('lessonupdate', $lesson->id) }}" method="POST" class="form theme-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Titre -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Titre</label>
                                        <input class="form-control" type="text" name="titre" placeholder="Titre" value="{{ old('titre', $lesson->titre) }}" required />
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" rows="4" name="description" required placeholder="Description">{{ old('description', $lesson->description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Durée -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Durée (HH:mm)</label>
                                        <input class="form-control" type="text" name="duree" value="{{ old('duree', \Carbon\Carbon::parse($lesson->duree)->format('H:i')) }}" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" required />
                                    </div>
                                </div>
                            </div>

                            <!-- Chapitre -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Chapitre</label>
                                        <select class="form-select select2" name="chapitre_id" required>
                                            <option value="" disabled>Choisir un chapitre</option>
                                            @foreach($chapitres as $chapitre)
                                                <option value="{{ $chapitre->id }}" {{ old('chapitre_id', $lesson->chapitre_id) == $chapitre->id ? 'selected' : '' }}>
                                                    {{ $chapitre->titre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Fichier -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        
                                        <!-- Affichage de l'ancien fichier s'il existe -->
                                        @if($lesson->file_path)
                                            <div>
                                                <strong>Ancien fichier : </strong>
                                                <a href="{{ asset('storage/' . $lesson->file_path) }}" target="_blank">
                                                    Voir l'ancien fichier
                                                </a>
                                            </div>
                                        @else
                                            <div>Aucun fichier associé</div>
                                        @endif

                                        <!-- Champ pour télécharger un nouveau fichier -->
                                        <input class="form-control mt-2" type="file" name="file_path">
                                        <a href="{{ asset('storage/' . $lesson->file_path) }}" target="_blank">
                                        </a>
                                        <small class="text-muted">Si vous ne sélectionnez pas de fichier, l'ancien fichier restera inchangé.</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Mettre à jour</button>
                                    <a href="{{ route('lessons') }}" class="btn btn-danger px-4">Annuler</a>
                                </div>
                            </div>
                        </form>
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
<script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
@endpush  



