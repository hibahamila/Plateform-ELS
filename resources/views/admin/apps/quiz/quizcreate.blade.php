

 @extends('layouts.admin.master')

@section('title') Ajouter un Quiz @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone/dropzone.css') }}">
    <!-- CSS de Select2 via CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter un Quiz</h3>
        @endslot
        <li class="breadcrumb-item">Quiz</li>
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

                        <form action="{{ route('quizstore') }}" method="POST" class="form theme-form needs-validation" novalidate>
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
                                        <label class="form-label">Date Limite</label>
                                        <input class="form-control" type="date" name="date_limite" value="{{ old('date_limite') }}" required />
                                        <div class="invalid-feedback">Veuillez entrer une date limite valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Date de Fin</label>
                                        <input class="form-control" type="date" name="date_fin" value="{{ old('date_fin') }}" required />
                                        <div class="invalid-feedback">Veuillez entrer une date de fin valide.</div>
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
                                        <div class="invalid-feedback">Veuillez sélectionner un cours valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Score Minimum</label>
                                        <input class="form-control" type="number" name="score_minimum" placeholder="Score Minimum" value="{{ old('score_minimum') }}" required />
                                        <div class="invalid-feedback">Veuillez entrer un score minimum valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit" id="submitBtn">Ajouter</button>
                                    <a href="{{ route('quizzes') }}" class="btn btn-danger px-4">Annuler</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Inclusion de notre fichier externe pour l'initialisation de Select2 -->
    <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>
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
