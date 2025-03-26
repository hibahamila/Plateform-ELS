{{-- 
@extends('layouts.admin.master')

@section('title') Modifier un Quiz @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone/dropzone.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        #success-message, #delete-message {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
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
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Modifier un Quiz</h3>
        @endslot
        <li class="breadcrumb-item">Quiz</li>
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

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('quizupdate', $quiz->id) }}" method="POST" class="theme-form needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">title</label>
                                        <input class="form-control" type="text" name="title" value="{{ old('title', $quiz->title) }}" required>
                                        <div class="invalid-feedback">Veuillez entrer un title valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" rows="4" name="description" required>{{ old('description', $quiz->description) }}</textarea>
                                        <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Date Limite</label>
                                        <input class="form-control" type="date" name="deadline" value="{{ old('deadline', $quiz->deadline) }}" required>
                                        <div class="invalid-feedback">Veuillez choisir une date limite valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Date de Fin</label>
                                        <input class="form-control" type="date" name="end_date" value="{{ old('end_date', $quiz->end_date) }}" required>
                                        <div class="invalid-feedback">Veuillez choisir une date de fin valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Cours</label>
                                        <select name="cours_id" class="form-select select2-cours" required>
                                            <option value="" disabled selected>Choisir un cours</option>
                                            @foreach($cours as $coursItem)
                                                <option value="{{ $coursItem->id }}" {{ old('cours_id', $quiz->cours_id) == $coursItem->id ? 'selected' : '' }}>
                                                    {{ $coursItem->title }}
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
                                        <input class="form-control" type="number" name="minimum_score" value="{{ old('minimum_score', $quiz->minimum_score) }}" required>
                                        <div class="invalid-feedback">Veuillez entrer un score minimum valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Mettre à jour</button>
                                    <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('quizzes') }}'">Annuler</button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/MonJs/form-validation/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/MonJs/select2-init/single-select.js') }}"></script>

    
@endpush --}}








@extends('layouts.admin.master')

@section('title') Modifier un Quiz @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone/dropzone.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@endpush

@section('content')
   


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Modifier un Quiz</h5>
                    <span>Modifiez les informations du quiz</span>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form theme-form">
                        <form action="{{ route('quizupdate', $quiz->id) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <!-- Titre -->
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Titre <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                        <input class="form-control" type="text" name="title" placeholder="Titre" value="{{ old('title', $quiz->title) }}" required />
                                    </div>
                                    <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-align-left"></i></span>
                                        <textarea id="description" class="form-control" rows="4" name="description" placeholder="Description" required>{{ old('description', $quiz->description) }}</textarea>
                                    </div>
                                    <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                </div>
                            </div>

                            <!-- Date Limite -->
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Date Limite <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control" type="date" name="deadline" value="{{ old('deadline', $quiz->deadline) }}" required />
                                    </div>
                                    <div class="invalid-feedback">Veuillez entrer une date limite valide.</div>
                                </div>
                            </div>

                            <!-- Date de Fin -->
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Date de Fin <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control" type="date" name="end_date" value="{{ old('end_date', $quiz->end_date) }}" required />
                                    </div>
                                    <div class="invalid-feedback">Veuillez entrer une date de fin valide.</div>
                                </div>
                            </div>

                            <!-- Cours -->
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Cours <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-auto">
                                            <span class="input-group-text"><i class="fa fa-book"></i></span>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <select class="form-select select2-cours" name="cours_id" required>
                                                    <option value="" selected disabled>Choisir un cours</option>
                                                    @foreach($cours as $coursItem)
                                                        <option value="{{ $coursItem->id }}" {{ old('cours_id', $quiz->cours_id) == $coursItem->id ? 'selected' : '' }}>
                                                            {{ $coursItem->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">Veuillez sélectionner un cours valide.</div>
                                </div>
                            </div>

                            <!-- Score Minimum -->
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Score Minimum <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-star"></i></span>
                                        <input class="form-control" type="number" name="minimum_score" placeholder="Score Minimum" min="1" value="{{ old('minimum_score', $quiz->minimum_score) }}" required />
                                    </div>
                                    <div class="invalid-feedback">Veuillez entrer un score minimum valide.</div>
                                </div>
                            </div>

                            <!-- Boutons de soumission -->
                            <div class="row">
                                <div class="col">
                                    <div class="text-end mt-4">
                                        <button class="btn btn-primary" type="submit" id="submitBtn">
                                            <i class="fa fa-save"></i> Mettre à jour
                                        </button>
                                        <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('quizzes') }}'">
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/MonJs/form-validation/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/MonJs/select2-init/single-select.js') }}"></script>


    
    <script src="https://cdn.tiny.cloud/1/ofuiqykj9zattk5odkx0o1t79jxdfcb5eeuemjgcdtb1s95t/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ asset('assets/js/MonJs/description/description.js') }}"></script>

    
@endpush 