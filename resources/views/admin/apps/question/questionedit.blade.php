
@extends('layouts.admin.master')

@section('content')
   

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
                    <div class="card-header pb-0">
                        <h5>Modifier une question</h5>
                        <span>Modifiez les informations du question</span>
                    </div>
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

                            <!-- Enoncé -->
                            <div class="mb-3 row">
                                <label for="statement" class="col-sm-2 col-form-label">Enoncé <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-question-circle"></i></span>
                                        <input type="text" name="statement" class="form-control" value="{{ old('statement', $question->statement) }}" required>
                                    </div>
                                    <div class="invalid-feedback">Veuillez entrer un énoncé valide.</div>
                                </div>
                            </div>

                            <!-- Quiz -->
                            <div class="mb-3 row">
                                <label for="quiz_id" class="col-sm-2 col-form-label">Quiz <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-auto">
                                            <span class="input-group-text"><i class="fa fa-list-alt"></i></span>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <select class="form-select select2-quiz" id="quiz_id" name="quiz_id" required>
                                                    <option value="" selected disabled>Sélectionnez un quiz</option>
                                                    @foreach($quizzes as $quiz)
                                                    <option value="{{ $quiz->id }}" {{ old('quiz_id', $question->quiz_id) == $quiz->id ? 'selected' : '' }}>{{ $quiz->title }}</option>
                                                    @endforeach
                                        
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">Veuillez sélectionner un quiz valide.</div>
                                </div>
                            </div>

                            <!-- Nombre de réponses -->
                            <div class="mb-3 row">
                                <label for="response_count" class="col-sm-2 col-form-label">Nombre de réponses <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-list-ol"></i></span>
                                        <input type="number" name="response_count" id="response_count" class="form-control" min="1" max="10" value="{{ old('response_count', count($question->reponses)) }}" required>
                                    </div>
                                    <div class="invalid-feedback">Veuillez entrer un nombre de réponses valide (entre 1 et 10).</div>
                                </div>
                            </div>

                            <!-- Réponses -->
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Réponses <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div id="reponses-container">
                                        @foreach ($question->reponses as $index => $reponse)
                                            <div class="mb-3 d-flex align-items-center reponse-item">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-check-circle"></i></span>
                                                    <input type="text" name="reponses[{{ $index }}][content]" class="form-control response-input {{ $errors->has("reponses.$index.content") ? 'is-invalid' : '' }}" 
                                                           value="{{ old("reponses.$index.content", $reponse->content) }}" required>
                                                    <input type="hidden" name="reponses[{{ $index }}][id]" value="{{ $reponse->id }}">
                                                    <input type="hidden" name="reponses[{{ $index }}][is_correct]" value="0">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="reponses[{{ $index }}][is_correct]" value="1" 
                                                               {{ old("reponses.$index.is_correct", $reponse->is_correct) ? 'checked' : '' }}>
                                                    </div>
                                                    <button type="button" class="btn btn-danger btn-sm remove-btn"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Message d'erreur -->
                            <div id="error-message" style="display: none; color: #FF4B59; margin-top: 10px; text-align: center;">
                                Vous devez sélectionner au moins une réponse correcte.
                            </div>

                            <!-- Boutons de soumission -->
                            <div class="row mt-3">
                                <div class="col-sm-10 offset-sm-2 text-end">
                                    <button class="btn btn-secondary me-3" type="submit">
                                        <i class="fa fa-save"></i> Modifier
                                    </button>
                                    <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('questions') }}'">
                                        <i class="fa fa-times"></i> Annuler
                                    </button>
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
    <script src="{{ asset('assets/js/MonJs/questions/question-edit.js') }}"></script>
    <script src="{{ asset('assets/js/MonJs/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/MonJs/form-validation/form-validation.js') }}"></script>
         <script src="https://cdn.tiny.cloud/1/ofuiqykj9zattk5odkx0o1t79jxdfcb5eeuemjgcdtb1s95t/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

@endpush