{{-- 
@extends('layouts.admin.master')

@section('title', 'Liste des Leçons')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
<!-- Inclure ici le CSS d'icofont -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icofont@1.0.0/css/icofont.css">
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

    .custom-btn i {
        margin-right: 8px;
    }

    .action-icon {
        cursor: pointer;
        font-size: 20px;
    }

    /* .delete-icon {
        color: #dc3545;
    }

    .edit-icon {
        color: #ffc107;
    } */
</style>
@endpush

@section('content')

@component('components.breadcrumb')
    @slot('breadcrumb_title')
        <h3>Liste des Leçons</h3>
    @endslot
    <li class="breadcrumb-item">Leçons</li>
    <li class="breadcrumb-item active">Liste des Leçons</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Leçons Disponibles</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" id="success-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('delete'))
                        <div class="alert alert-danger" id="delete-message">
                            {{ session('delete') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-end mb-3">
                        <a class="btn btn-primary custom-btn" href="{{ route('lessoncreate') }}">
                            <i class="icofont icofont-plus-square"></i> Ajouter une Leçon
                        </a>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Durée</th>
                                <th>Chapitre</th>
                                <th>Fichier</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lessons as $lesson)
                                <tr>
                                    <td>{{ $lesson->titre }}</td>
                                    <td>{{ $lesson->description }}</td>
                                    <td>{{ $lesson->duree }}</td>
                                    <td>{{ $lesson->chapitre->titre ?? 'Non attribué' }}</td>
                                    <td>
                                        @if ($lesson->file_path)
                                            <a href="{{ asset('storage/' . $lesson->file_path) }}" target="_blank">
                                                Voir le fichier
                                            </a>
                                        @else
                                            Aucun fichier
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Icône Modifier -->
                                        <i class="icofont icofont-edit edit-icon action-icon" data-edit-url="{{ route('lessonedit', $lesson->id) }}" style="cursor: pointer;"></i>


                                        <!-- Icône Supprimer -->
                                        <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="{{ route('lessondestroy', $lesson->id) }}" data-csrf="{{ csrf_token() }}" style="cursor: pointer; color: rgb(204, 28, 28);"></i>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
     <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
<script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
<script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
<script src="{{ asset('assets/js/custom-card/custom-card.js') }}"></script>
<script src="{{ asset('assets/js/height-equal.js') }}"></script>
<script src="{{ asset('assets/js/actions-icon/actions-icon.js') }}"></script>



<script>
    window.onload = function() {
        ['success-message', 'delete-message'].forEach(id => {
            const message = document.getElementById(id);
            if (message) {
                message.style.opacity = 1;
                setTimeout(() => {
                    message.style.opacity = 0;
                }, 2000);
            }
        });
    }
</script>
@endpush

@endsection 
 --}}




@extends('layouts.admin.master')

@section('title', 'Liste des Leçons')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
<!-- Inclure ici le CSS d'icofont -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icofont@1.0.0/css/icofont.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
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

    .custom-btn i {
        margin-right: 8px;
    }

    .action-icon {
        cursor: pointer;
        font-size: 20px;
    }

    .delete-icon {
        color: #dc3545;
    }

    /* .edit-icon {
        color: #ffc107;
    } */
</style>
@endpush

@section('content')

@component('components.breadcrumb')
    @slot('breadcrumb_title')
        <h3>Liste des Leçons</h3>
    @endslot
    <li class="breadcrumb-item">Leçons</li>
    <li class="breadcrumb-item active">Liste des Leçons</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Leçons Disponibles</h5>
                    <span>Ce tableau affiche la liste des leçons disponibles. Vous pouvez rechercher, trier et paginer les données.</span>
                    <span>Les fonctionnalités de recherche et de pagination sont activées par défaut.</span>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" id="success-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('delete'))
                        <div class="alert alert-danger" id="delete-message">
                            {{ session('delete') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-end mb-3">
                        <a class="btn btn-primary custom-btn" href="{{ route('lessoncreate') }}">
                            <i class="icofont icofont-plus-square"></i> Ajouter une Leçon
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="display" id="lessons-table">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Durée</th>
                                    <th>Chapitre</th>
                                    <th>Fichier</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lessons as $lesson)
                                    <tr>
                                        <td>{{ $lesson->titre }}</td>
                                        <td>{{ $lesson->description }}</td>
                                        <td>{{ $lesson->duree }}</td>
                                        <td>{{ $lesson->chapitre->titre ?? 'Non attribué' }}</td>
                                        <td>
                                            @if ($lesson->file_path)
                                                <a href="{{ asset('storage/' . $lesson->file_path) }}" target="_blank">
                                                    Voir le fichier
                                                </a>
                                            @else
                                                Aucun fichier
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Icône Modifier -->
                                            <i class="icofont icofont-edit edit-icon action-icon" data-edit-url="{{ route('lessonedit', $lesson->id) }}" style="cursor: pointer;"></i>

                                            <!-- Icône Supprimer -->
                                            <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="{{ route('lessondestroy', $lesson->id) }}" data-csrf="{{ csrf_token() }}" style="cursor: pointer; color: rgb(204, 28, 28);"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
     <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
<script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
<script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
<script src="{{ asset('assets/js/custom-card/custom-card.js') }}"></script>
<script src="{{ asset('assets/js/height-equal.js') }}"></script>
<script src="{{ asset('assets/js/actions-icon/actions-icon.js') }}"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<script>
    window.onload = function() {
        ['success-message', 'delete-message'].forEach(id => {
            const message = document.getElementById(id);
            if (message) {
                message.style.opacity = 1;
                setTimeout(() => {
                    message.style.opacity = 0;
                }, 2000);
            }
        });

        // Initialisation de DataTable
        $('#lessons-table').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json" // Langue française
            },
            responsive: true,
            paging: true,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
            pageLength: 10,
            order: [[0, 'asc']] // Tri par défaut sur la première colonne
        });
    }
</script>
@endpush

@endsection 