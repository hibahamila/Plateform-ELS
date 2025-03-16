{{-- @extends('layouts.admin.master')

@section('title') Ajouter une Question @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
@component('components.breadcrumb')
    @slot('breadcrumb_title')
        <h3>Ajouter une Question</h3>
    @endslot
    <li class="breadcrumb-item"><a href="{{ route('questions') }}">Questions</a></li>
    <li class="breadcrumb-item active">Ajouter</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Zone pour afficher les messages d'erreur temporaires -->
                    <div id="error-message" class="alert alert-danger d-none mb-3"></div>

                    <!-- Message d'information si aucun quiz n'existe -->
                    @if ($quizzes->isEmpty())
                        <div class="alert alert-info">
                            Aucun quiz n'existe. Veuillez <a href="{{ route('quizcreate') }}">créer un quiz</a> avant d'ajouter une question.
                        </div>
                    @endif

                    <form id="question-form" action="{{ route('questionstore') }}" method="POST" class="needs-validation">
                        @csrf
                        <div class="mb-3">
                            <label for="enonce" class="form-label">Énoncé de la question</label>
                            <input type="text" class="form-control" id="enonce" name="enonce" placeholder="Enoncé" value="{{ old('enonce') }}" required>
                            <div class="invalid-feedback">Veuillez entrer un énoncé valide.</div>
                        </div>

                        <div class="mb-3">
                            <label for="quiz_id" class="form-label">Quiz associé</label>
                            @if ($quizId && $quiz)
                                <!-- Cas 1 : Un quiz_id est déjà récupéré -->
                                <input type="text" class="form-control bg-light" value="{{ $quiz->titre }}" readonly>
                                <input type="hidden" name="quiz_id" value="{{ $quizId }}">
                            @else
                                <!-- Cas 2 : Aucun quiz_id n'est récupéré, afficher la liste déroulante -->
                                <select class="form-select select2-quiz" id="quiz_id" name="quiz_id" required>
                                    <option value="" selected disabled>Sélectionnez un quiz</option>
                                    @foreach($quizzes as $quizOption)
                                        <option value="{{ $quizOption->id }}" {{ old('quiz_id') == $quizOption->id ? 'selected' : '' }}>
                                            {{ $quizOption->titre }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                            <div class="invalid-feedback">Veuillez sélectionner un quiz valide.</div>
                        </div>

                        <div class="mb-3">
                            <label for="response_count" class="form-label">Nombre de réponses</label>
                            <input type="number" class="form-control" id="response_count" name="response_count" min="1" max="10" value="{{ old('response_count', 1) }}" required>
                            <div class="invalid-feedback">Veuillez entrer un nombre de réponses valide (entre 1 et 10).</div>
                        </div>

                        <div id="reponses-container">
                            <!-- Les champs de réponse seront ajoutés ici dynamiquement -->
                            @if (old('reponses'))
                                @foreach (old('reponses') as $index => $reponse)
                                    <div class="row mb-3">
                                        <div class="col-md-8">
                                            <label class="form-label">Réponse {{ $index + 1 }}</label>
                                            <input class="form-control" type="text" name="reponses[{{ $index }}][contenu]" placeholder="Entrez la réponse {{ $index + 1 }}" value="{{ $reponse['contenu'] }}" required>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input type="hidden" name="reponses[{{ $index }}][est_correcte]" value="0">
                                            <input type="checkbox" name="reponses[{{ $index }}][est_correcte]" value="1" class="form-check-input me-2" {{ $reponse['est_correcte'] == 1 ? 'checked' : '' }} >
                                            <label class="form-check-label">Correcte</label>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="text-end">
                            <button class="btn btn-primary" type="submit" id="submit-btn">Ajouter</button>
                            <a href="{{ route('questions') }}" class="btn btn-danger px-4">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/questions/question-create.js') }}"></script>

@endpush

@endsection --}}





{{-- zedtouuu  --}}

@extends('layouts.admin.master')

@section('title') Ajouter une Question @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
@component('components.breadcrumb')
    @slot('breadcrumb_title')
        <h3>Ajouter une Question</h3>
    @endslot
    <li class="breadcrumb-item"><a href="{{ route('questions') }}">Questions</a></li>
    <li class="breadcrumb-item active">Ajouter</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Zone pour afficher les messages d'erreur temporaires -->
                    <div id="error-message" class="alert alert-danger d-none mb-3"></div>

                    <!-- Message d'information si aucun quiz n'existe -->
                    @if ($quizzes->isEmpty())
                        <div class="alert alert-info">
                            Aucun quiz n'existe. Veuillez <a href="{{ route('quizcreate') }}">créer un quiz</a> avant d'ajouter une question.
                        </div>
                    @endif

                    <form id="question-form" action="{{ route('questionstore') }}" method="POST" class="needs-validation">
                        @csrf
                        <div class="mb-3">
                            <label for="enonce" class="form-label">Énoncé de la question</label>
                            <input type="text" class="form-control" id="enonce" name="enonce" placeholder="Enoncé" value="{{ old('enonce') }}" required>
                            <div class="invalid-feedback">Veuillez entrer un énoncé valide.</div>
                        </div>

                        <div class="mb-3">
                            <label for="quiz_id" class="form-label">Quiz associé</label>
                            @if ($quizId && $quiz)
                                <!-- Cas 1 : Un quiz_id est déjà récupéré -->
                                <input type="text" class="form-control bg-light" value="{{ $quiz->titre }}" readonly>
                                <input type="hidden" id="hidden_quiz_id" name="quiz_id" value="{{ $quizId }}">
                            @else
                                <!-- Cas 2 : Aucun quiz_id n'est récupéré, afficher la liste déroulante -->
                                <select class="form-select select2-quiz" id="quiz_id" name="quiz_id" required>
                                    <option value="" selected disabled>Sélectionnez un quiz</option>
                                    @foreach($quizzes as $quizOption)
                                        <option value="{{ $quizOption->id }}" {{ old('quiz_id') == $quizOption->id ? 'selected' : '' }}>
                                            {{ $quizOption->titre }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                            <div class="invalid-feedback">Veuillez sélectionner un quiz valide.</div>
                        </div>

                        <div class="mb-3">
                            <label for="response_count" class="form-label">Nombre de réponses</label>
                            <input type="number" class="form-control" id="response_count" name="response_count" min="1" max="10" value="{{ old('response_count', 1) }}" required>
                            <div class="invalid-feedback">Veuillez entrer un nombre de réponses valide (entre 1 et 10).</div>
                        </div>

                        <div id="reponses-container">
                            <!-- Les champs de réponse seront ajoutés ici dynamiquement -->
                            @if (old('reponses'))
                                @foreach (old('reponses') as $index => $reponse)
                                    <div class="row mb-3">
                                        <div class="col-md-8">
                                            <label class="form-label">Réponse {{ $index + 1 }}</label>
                                            <input class="form-control" type="text" name="reponses[{{ $index }}][contenu]" placeholder="Entrez la réponse {{ $index + 1 }}" value="{{ $reponse['contenu'] }}" required>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input type="hidden" name="reponses[{{ $index }}][est_correcte]" value="0">
                                            <input type="checkbox" name="reponses[{{ $index }}][est_correcte]" value="1" class="form-check-input me-2" {{ $reponse['est_correcte'] == 1 ? 'checked' : '' }} >
                                            <label class="form-check-label">Correcte</label>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="text-end">
                            <button class="btn btn-primary" type="submit" id="submit-btn">Ajouter</button>
                            <a href="{{ route('questions') }}" class="btn btn-danger px-4">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/questions/question-create.js') }}"></script>
@endpush

@endsection