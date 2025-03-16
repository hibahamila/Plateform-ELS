@extends('layouts.admin.master')

@section('title') Modifier la Réponse @endsection

@push('css')
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
    @endpush

@endsection

<style>
    .custom-btn-modifier {
        background-color: #6a4e23;
        color: white; 
        border-color: #6a4e23; 
    }

    .custom-btn-modifier:hover {
        background-color: #4e3821; 
        border-color: #4e3821;
        color: white; 
    }

    .custom-btn-annuler {
        background-color: #e74c3c; 
        color: white; 
        border-color: #e74c3c;
    }

    .custom-btn-annuler:hover {
        background-color: #c0392b; 
        border-color: #c0392b;
        color: white; 
    }
</style>
