
@extends('layouts.admin.master')
@section('title') Ajouter une Question @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone/dropzone.css') }}">
    <link href="{{ asset('assets/css/MonCss/custom-style.css') }}" rel="stylesheet">
    <!-- CSS de Select2 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/MonCss/SweatAlert2.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Nouvelle Question</h5>
                        <span>Complétez les informations pour ajouter une nouvelle question</span>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any()))
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Zone pour afficher les messages d'erreur temporaires -->
                        <div id="error-message" class="alert alert-danger d-none mb-3"></div>

                        <!-- Message d'information si aucun quiz n'existe -->
                        {{-- @if ($quizzes->isEmpty())
                            <div class="alert alert-info">
                                Aucun quiz n'existe. Veuillez <a href="{{ route('quizcreate') }}">créer un quiz</a> avant d'ajouter une question.
                            </div>
                        @endif --}}

                        <div class="form theme-form">
                            <form id="question-form" action="{{ route('questionstore') }}" method="POST" class="needs-validation" novalidate>
                                @csrf

                                <!-- Énoncé de la question -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Énoncé <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-question-circle"></i></span>
                                            <input class="form-control" type="text" id="statement" name="statement" placeholder="Enoncé" value="{{ old('statement') }}" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer un énoncé valide.</div>
                                    </div>
                                </div>

                                <!-- Quiz associé -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Quiz <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="input-group-text"><i class="fa fa-list-alt"></i></span>
                                            </div>
                                            <div class="col">
                                                @if ($quizId && $quiz)
                                                    <!-- Cas 1 : Un quiz_id est déjà récupéré -->
                                                    <div class="input-group">
                                                        <input class="form-control bg-light" type="text" value="{{ $quiz->title }}" readonly />
                                                        <input type="hidden" id="hidden_quiz_id" name="quiz_id" value="{{ $quizId }}">
                                                    </div>
                                                @else
                                                    <!-- Cas 2 : Aucun quiz_id n'est récupéré, afficher la liste déroulante -->
                                                    <div class="input-group">
                                                        <select class="form-select select2-quiz" id="quiz_id" name="quiz_id" required>
                                                            <option value="" selected disabled>Sélectionnez un quiz</option>
                                                            @foreach($quizzes as $quizOption)
                                                                <option value="{{ $quizOption->id }}" {{ old('quiz_id') == $quizOption->id ? 'selected' : '' }}>
                                                                    {{ $quizOption->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                                <div class="invalid-feedback">Veuillez sélectionner un quiz valide.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nombre de réponses -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Nombre de réponses <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-list-ol"></i></span>
                                            <input class="form-control" type="number" id="response_count" name="response_count" min="1" max="10" value="{{ old('response_count', 1) }}" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer un nombre de réponses valide (entre 1 et 10).</div>
                                    </div>
                                </div>

                                {{-- <!-- Réponses -->
                                <div id="reponses-container">
                                    @if (old('reponses'))
                                        @foreach (old('reponses') as $index => $reponse)
                                            <div class="row mb-3">
                                                <div class="col-md-8">
                                                    <label class="form-label">Réponse {{ $index + 1 }} <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="reponses[{{ $index }}][content]" placeholder="Entrez la réponse {{ $index + 1 }}" value="{{ $reponse['content'] }}" required />
                                                </div>
                                                <div class="col-md-4 d-flex align-items-center">
                                                    <input type="hidden" name="reponses[{{ $index }}][is_correct]" value="0">
                                                    <input type="checkbox" name="reponses[{{ $index }}][is_correct]" value="1" class="form-check-input me-2" {{ $reponse['is_correct'] == 1 ? 'checked' : '' }} />
                                                    <label class="form-check-label">Correcte</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div> --}}

                                <!-- Réponses -->
<div id="reponses-container">
    @if (old('reponses'))
        @foreach (old('reponses') as $index => $reponse)
            <div class="row mb-3 align-items-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <input class="form-control" type="text" name="reponses[{{ $index }}][content]" placeholder="Entrez la réponse {{ $index + 1 }}" value="{{ $reponse['content'] }}" required />
                        <div class="input-group-text">
                            <input type="hidden" name="reponses[{{ $index }}][is_correct]" value="0">
                            <input type="checkbox" name="reponses[{{ $index }}][is_correct]" value="1" class="form-check-input" {{ $reponse['is_correct'] == 1 ? 'checked' : '' }} />
                            <label class="form-check-label ms-2">Correcte</label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

                                <!-- Boutons de soumission -->
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end mt-4">
                                            <button class="btn btn-primary" type="submit" id="submit-btn">
                                                <i class="fa fa-save"></i> Ajouter
                                            </button>
                                            {{-- <a href="{{ route('questioncreate', ['quiz_id' => $quiz->id]) }}" class="btn btn-primary">
                                                <i class="fa fa-plus"></i> Ajouter une question
                                            </a> --}}
                                          
                                            <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('questions') }}'">
                                                <i class="fa fa-times"></i> Annuler
                                            </button>
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
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/MonJs/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/MonJs/form-validation/form-validation.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/MonJs/questions/question-create.js') }}"></script>
@endpush