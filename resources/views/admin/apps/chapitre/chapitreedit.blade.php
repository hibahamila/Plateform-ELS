{{-- 


@extends('layouts.admin.master')

@section('title') Modifier un Chapitre @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <!-- CSS de Select2 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Modifier un Chapitre</h3>
        @endslot
        <li class="breadcrumb-item">Chapitre</li>
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

                        <form action="{{ route('chapitreupdate', $chapitre->id) }}" method="POST" class="theme-form needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">title</label>
                                        <input type="text" name="title" class="form-control" value="{{ old('title', $chapitre->title) }}" required>
                                        <div class="invalid-feedback">Veuillez entrer un title.</div>

                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="4"  required>{{ old('description', $chapitre->description) }}</textarea>
                                        <div class="invalid-feedback">Veuillez entrer une description.</div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Durée (HH:mm)</label>
                                        <input type="text" name="duration" class="form-control" value="{{ old('duration', \Carbon\Carbon::parse($chapitre->duration)->format('H:i')) }}" pattern="\d{2}:\d{2}" title="Format: HH:mm" required>
                                        <div class="invalid-feedback">Veuillez entrer une durée valide.</div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="cours_id" class="form-label">Cours</label>
                                        <select name="cours_id" class="form-select select2-cours" required>
                                            <option value="" disabled selected>Choisir un cours</option>
                                            @foreach($cours as $coursItem)
                                                <option value="{{ $coursItem->id }}" {{ old('cours_id', $chapitre->cours_id) == $coursItem->id ? 'selected' : '' }}>
                                                    {{ $coursItem->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Veuillez selectionnez un cours .</div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Mettre à jour</button>
                                    <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('chapitres') }}'">Annuler</button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/MonJs/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/MonJs/form-validation/form-validation.js') }}"></script>

@endpush

@push('styles')
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
@endpush

@endsection --}}


{{-- hadha mrigl bl icone w titre de champs 9odem el champs  --}}


@extends('layouts.admin.master')

@section('title') Modifier un Chapitre @endsection

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
    <link href="{{ asset('assets/css/MonCss/custom-style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/MonCss/SweatAlert2.css') }}" rel="stylesheet">
@endpush

@section('content')
    {{-- @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Modifier un Chapitre</h3>
        @endslot
        <li class="breadcrumb-item">Chapitre</li>
        <li class="breadcrumb-item active">Modifier</li>
    @endcomponent --}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Modifier un chapitre</h5>
                        <span>Complétez les informations pour modifier le chapitre</span>
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
                            <form action="{{ route('chapitreupdate', $chapitre->id) }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')

                                <!-- Titre -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Titre <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                            <input class="form-control" type="text" name="title" placeholder="Titre" value="{{ old('title', $chapitre->title) }}" required />
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
                                            <textarea id="description" class="form-control" rows="4" name="description" placeholder="Description" required>{{ old('description', $chapitre->description) }}</textarea>
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                    </div>
                                </div>

                                <!-- Durée -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Durée (HH:mm) <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="icon-timer"></i></span>
                                            <input class="form-control" type="text" name="duration" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="{{ old('duration', \Carbon\Carbon::parse($chapitre->duration)->format('H:i')) }}" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer la durée au format HH:mm.</div>
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
                                                <select class="form-select select2-cours" name="cours_id" required>
                                                    <option value="" disabled selected>Choisir un cours</option>
                                                    @foreach($cours as $coursItem)
                                                        <option value="{{ $coursItem->id }}" {{ old('cours_id', $chapitre->cours_id) == $coursItem->id ? 'selected' : '' }}>
                                                            {{ $coursItem->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">Veuillez sélectionner un cours valide.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Boutons de soumission -->
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end mt-4">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa fa-save"></i> Mettre à jour
                                            </button>
                                            <a href="{{ route('chapitres') }}" class="btn btn-danger px-4">
                                                <i class="fa fa-times"></i> Annuler
                                            </a>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/MonJs/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/MonJs/form-validation/form-validation.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/js/MonJs/description/description.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/ofuiqykj9zattk5odkx0o1t79jxdfcb5eeuemjgcdtb1s95t/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

@endpush

@endsection 