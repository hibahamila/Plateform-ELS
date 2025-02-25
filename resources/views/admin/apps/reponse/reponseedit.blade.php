@extends('layouts.admin.master')

@section('title') Modifier la Réponse @endsection

@push('css')
<!-- Si vous avez des fichiers CSS supplémentaires -->
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Modifier la Réponse</h3>
        @endslot
        <li class="breadcrumb-item">Réponses</li>
        <li class="breadcrumb-item active">Modifier</li>
    @endcomponent
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <!-- CSS de Select2 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Affichage des messages d'erreur -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Affichage du message flash de succès -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('reponseupdate', $reponse->id) }}" method="POST" class="form theme-form">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Question</label>
                                        <select class="form-select select2-question" name="question_id" required>
                                            @foreach($questions as $question)
                                                <option value="{{ $question->id }}" {{ old('question_id', $reponse->question_id) == $question->id ? 'selected' : '' }}>
                                                    {{ $question->enonce }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Contenu</label>
                                        <input class="form-control" type="text" name="contenu" value="{{ old('contenu', $reponse->contenu) }}" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Est correcte ?</label>
                                        <select class="form-select" name="est_correcte" required>
                                            <option value="1" {{ old('est_correcte', $reponse->est_correcte) == 1 ? 'selected' : '' }}>Oui</option>
                                            <option value="0" {{ old('est_correcte', $reponse->est_correcte) == 0 ? 'selected' : '' }}>Non</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Mettre à jour</button>
                                    <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('reponses') }}'">Annuler</button>

                                    {{-- <a href="{{ route('reponses') }}" class="btn custom-btn-annuler px-4">Annuler</a> --}}
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
    <!-- Inclusion de Select2 JS via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- Inclusion du fichier externe pour l'initialisation de Select2 -->
    <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
    @endpush

@endsection

<style>
    .custom-btn-modifier {
        background-color: #6a4e23; /* Marron */
        color: white; /* Texte en blanc */
        border-color: #6a4e23; /* Border avec la même couleur */
    }

    .custom-btn-modifier:hover {
        background-color: #4e3821; /* Marron plus foncé au survol */
        border-color: #4e3821;
        color: white; /* Texte en blanc */
    }

    .custom-btn-annuler {
        background-color: #e74c3c; /* Rouge */
        color: white; /* Texte en blanc */
        border-color: #e74c3c; /* Border avec la même couleur */
    }

    .custom-btn-annuler:hover {
        background-color: #c0392b; /* Rouge plus foncé au survol */
        border-color: #c0392b;
        color: white; /* Texte en blanc */
    }
</style>
