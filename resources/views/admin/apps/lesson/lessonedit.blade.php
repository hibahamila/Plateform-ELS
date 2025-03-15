
@extends('layouts.admin.master')

@section('title') 
    Modifier une Leçon 
@endsection

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

                        <form action="{{ route('lessonupdate', $lesson->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Titre</label>
                                <input class="form-control" type="text" name="titre" placeholder="Titre" value="{{ old('titre', $lesson->titre) }}" required />
                                <div class="invalid-feedback">Veuillez entrer un titre.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="4" name="description" placeholder="Description" required>{{ old('description', $lesson->description) }}</textarea>
                                <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Durée (HH:mm)</label>
                                <input class="form-control" type="text" name="duree" value="{{ old('duree', \Carbon\Carbon::parse($lesson->duree)->format('H:i')) }}" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" required />
                                <div class="invalid-feedback">Veuillez entrer une durée valide.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Chapitre</label>
                                <select class="form-select select2-chapitre" name="chapitre_id" required>
                                    <option value="" disabled>Choisir un chapitre</option>
                                    @foreach($chapitres as $chapitre)
                                        <option value="{{ $chapitre->id }}" {{ old('chapitre_id', $lesson->chapitre_id) == $chapitre->id ? 'selected' : '' }}>{{ $chapitre->titre }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Veuillez sélectionner un chapitre.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Fichier</label>
                                <input class="form-control" type="file" name="file_path" />
                                @if($lesson->file_path)
                                    <p class="mt-2">Fichier actuel : <a href="{{ asset('storage/' . $lesson->file_path) }}" target="_blank">Voir le fichier</a></p>
                                @endif
                            </div>

                            <h3>Liens existants</h3>
                            <ul>
                                @if(!empty($lesson->link))
                                    @php 
                                        $links = trim($lesson->link, '[]"');
                                        $links = explode(',', $links);
                                    @endphp
                                    @foreach($links as $link)
                                        @php
                                            $trimmedLink = trim($link);
                                            $cleanLink = str_replace(['\\/', '"', "'"], '/', $trimmedLink);
                                            $cleanLink = trim($cleanLink, '/');
                                            $formattedLink = Str::startsWith($cleanLink, ['http://', 'https://']) ? $cleanLink : 'http://' . $cleanLink;
                                        @endphp
                                        <li><a href="{{ $formattedLink }}" target="_blank">{{ $cleanLink }}</a></li>
                                    @endforeach
                                @else
                                    <li>Aucun lien disponible</li>
                                @endif
                            </ul>

                            <div class="mb-3">
                                <label for="link">Modifier les liens (un lien par ligne)</label>
                                @php
                                    $links = !empty($lesson->link) ? json_decode($lesson->link) : [];
                                    $displayLinks = implode("\n", $links);
                                @endphp
                                <textarea class="form-control" name="link" id="link" rows="4" placeholder="Entrez un lien par ligne.">{{ old('link', $displayLinks) }}</textarea>
                                <small class="form-text text-muted">Entrez un lien valide par ligne.</small>
                                <div class="invalid-feedback">Veuillez entrer des liens valides.</div>
                            </div>

                            <div class="text-end">
                                <button class="btn btn-secondary me-3" type="submit">Modifier</button>
                                <a href="{{ route('lessons') }}" class="btn btn-danger px-4">Annuler</a>
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
    <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/lecons/link-validation.js') }}"></script>
@endpush
