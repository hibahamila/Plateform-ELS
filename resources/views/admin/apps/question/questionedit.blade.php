
@extends('layouts.admin.master')

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Modifier une Question</h3>
        @endslot
        <li class="breadcrumb-item">Questions</li>
        <li class="breadcrumb-item active">Modifier</li>
    @endcomponent

    @push('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

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

                       
                        <form action="{{ route('questionupdate', $question->id) }}" method="POST" class="theme-form needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <!-- Champ caché pour stocker les réponses dynamiques -->
                            <input type="hidden" id="dynamic-responses" name="dynamic_responses" value="{{ old('dynamic_responses', json_encode($question->reponses)) }}">

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="enonce" class="form-label">Enoncé</label>
                                        <input type="text" name="enonce" class="form-control" value="{{ old('enonce', $question->enonce) }}" required>
                                        <div class="invalid-feedback">Veuillez entrer un énoncé valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="quiz_id" class="form-label">Quiz</label>
                                        <select class="form-select select2-quiz" id="quiz_id" name="quiz_id" required>
                                            <option value="" selected disabled>Sélectionnez un quiz</option>
                                            @foreach($quizzes as $quiz)
                                                <option value="{{ $quiz->id }}" {{ old('quiz_id', $question->quiz_id) == $quiz->id ? 'selected' : '' }}>{{ $quiz->titre }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Veuillez sélectionner un quiz valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="response_count" class="form-label">Nombre de réponses</label>
                                        <input type="number" name="response_count" id="response_count" class="form-control" min="1" max="10" value="{{ old('response_count', count($question->reponses)) }}" required>
                                        <div class="invalid-feedback">Veuillez entrer un nombre de réponses valide (entre 1 et 10).</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Réponses</label>
                                    <div id="reponses-container">
                                        @foreach ($question->reponses as $index => $reponse)
                                            <div class="mb-3 d-flex align-items-center reponse-item">
                                                <input type="text" name="reponses[{{ $index }}][contenu]" class="form-control me-2 response-input {{ $errors->has("reponses.$index.contenu") ? 'is-invalid' : '' }}" 
                                                       value="{{ old("reponses.$index.contenu", $reponse->contenu) }}" required>
                                                <input type="hidden" name="reponses[{{ $index }}][id]" value="{{ $reponse->id }}">
                                                <input type="hidden" name="reponses[{{ $index }}][est_correcte]" value="0">
                                                <input type="checkbox" name="reponses[{{ $index }}][est_correcte]" value="1" 
                                                       {{ old("reponses.$index.est_correcte", $reponse->est_correcte) ? 'checked' : '' }}>
                                                <button type="button" class="btn btn-danger btn-sm ms-2 remove-btn">X</button>
                                                
                                            
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Modifier</button>
                                    <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('questions') }}'">Annuler</button>
                                </div>
                            </div>
                            <div id="error-message" class="alert alert-danger" style="display:none;">
                                Au moins une réponse doit être correcte.
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
    <script src="{{ asset('assets/js/questions/question-edit.js') }}"></script>
    <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>
@endpush





