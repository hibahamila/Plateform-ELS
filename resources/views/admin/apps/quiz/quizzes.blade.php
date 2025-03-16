{{-- @extends('layouts.admin.master')

@section('title') Liste des Quizzes
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
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
</style>
@endpush

@section('content')
@component('components.breadcrumb')
    @slot('breadcrumb_title')
        <h3>Liste des Quizzes</h3>
    @endslot
    <li class="breadcrumb-item">Quizzes</li>
    <li class="breadcrumb-item active">Liste des Quizzes</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Liste des Quizzes</h5>
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

                    <div class="row project-cards">
                        <div class="col-md-12 project-list">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-6 p-0"></div>
                                    <div class="col-md-6 p-0">
                                        <div class="form-group mb-0 me-0"></div>
                                        <a class="btn btn-primary custom-btn" href="{{ route('quizcreate') }}">
                                            <i class="fa fa-plus"></i> Ajouter un Quiz
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Date Limite</th>
                                <th>Date de Fin</th>
                                <th>Cours associé</th>
                                <th>Score Minimum</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quiz)
                                <tr>
                                    <td>{{ $quiz->titre }}</td>
                                    <td>{{ $quiz->description }}</td>
                                    <td>{{ $quiz->date_limite }}</td>
                                    <td>{{ $quiz->date_fin }}</td>
                                    <td>{{ $quiz->cours->titre ?? 'N/A' }}</td>


                                    <td>{{ $quiz->score_minimum }}</td>
                                    <td>
                                        <i class="icofont icofont-edit edit-icon action-icon" data-edit-url="{{ route('quizedit', $quiz->id) }}" style="cursor: pointer;"></i>
                                            <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="{{ route('quizdestroy', $quiz->id) }}" data-csrf="{{ csrf_token() }}" style="cursor: pointer; color: rgb(204, 28, 28);"></i>

                                         <a href="{{ route('quizshow', $quiz->id) }}" class="btn btn-info btn-sm">Voir</a> 
                                         <a href="{{ route('quizedit', $quiz->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('quizdestroy', $quiz->id) }}" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce Quiz ?')">Supprimer</button>
                                        </form> 
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
	<script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
    <script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
    <script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
    <script src="{{asset('assets/js/height-equal.js')}}"></script>
    <script src="{{ asset('assets/js/actions-icon/actions-icon.js') }}"></script>


    <script>
        window.onload = function() {
            const successMessage = document.getElementById('success-message');
            const deleteMessage = document.getElementById('delete-message');

            if (successMessage) {
                successMessage.style.opacity = 1;
                setTimeout(() => {
                    successMessage.style.transition = 'opacity 0.3s ease';
                    successMessage.style.opacity = 0;
                }, 2000);
            }

            if (deleteMessage) {
                deleteMessage.style.opacity = 1;
                setTimeout(() => {
                    deleteMessage.style.transition = 'opacity 0.3s ease';
                    deleteMessage.style.opacity = 0;
                }, 2000);
            }
        }
    </script>
@endpush

@endsection --}}










@extends('layouts.admin.master')

@section('title') Liste des Quizzes
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
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

    /* Pagination verte */
    #quizzes-table_wrapper .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #28a745 !important;
        border: 1px solid #28a745 !important;
        margin: 0 5px;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        background-color: transparent !important;
    }

    #quizzes-table_wrapper .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #28a745 !important;
        color: white !important;
        border: 1px solid #28a745 !important;
    }

    #quizzes-table_wrapper .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    #quizzes-table_wrapper .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background-color: #28a745 !important;
        color: white !important;
        border: 1px solid #28a745 !important;
    }

    .delete-icon {
        color: #dc3545;
    }

    #quizzes-table_wrapper .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    #quizzes-table_wrapper .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        color: #6c757d !important;
        border: 1px solid #6c757d !important;
        background-color: transparent !important;
        cursor: not-allowed;
    }
</style>
@endpush

@section('content')
@component('components.breadcrumb')
    @slot('breadcrumb_title')
        <h3>Liste des Quizzes</h3>
    @endslot
    <li class="breadcrumb-item">Quizzes</li>
    <li class="breadcrumb-item active">Liste des Quizzes</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="card-header">
                        <h5>Liste des Quizzes</h5>
                        <span>Ce tableau affiche la liste des Quizzes disponibles. Vous pouvez rechercher, trier et paginer les données.</span>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Affichage des messages de succès et de suppression avec animation -->
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

                    <div class="row project-cards">
                        <div class="col-md-12 project-list">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-6 p-0">
                                    </div>
                                    <div class="col-md-6 p-0 text-end">
                                        <a class="btn btn-primary custom-btn" href="{{ route('quizcreate') }}">
                                            <i class="fa fa-plus"></i> Ajouter un Quiz
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table pour afficher la liste des quizzes -->
                    <div class="table-responsive">
                        <table class="display" id="quizzes-table">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Date Limite</th>
                                    <th>Date de Fin</th>
                                    <th>Cours associé</th>
                                    <th>Score Minimum</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quizzes as $quiz)
                                    <tr>
                                        <td>{{ $quiz->titre }}</td>
                                        <td>{{ $quiz->description }}</td>
                                        <td>{{ $quiz->date_limite }}</td>
                                        <td>{{ $quiz->date_fin }}</td>
                                        <td>{{ $quiz->cours->titre ?? 'N/A' }}</td>
                                        <td>{{ $quiz->score_minimum }}</td>
                                        <td>
                                            <i class="icofont icofont-edit edit-icon action-icon" data-edit-url="{{ route('quizedit', $quiz->id) }}" style="cursor: pointer;"></i>
                                            <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="{{ route('quizdestroy', $quiz->id) }}" data-csrf="{{ csrf_token() }}" style="cursor: pointer; color: rgb(204, 28, 28);"></i>
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
<script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
<script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
<script src="{{ asset('assets/js/custom-card/custom-card.js') }}"></script>
<script src="{{ asset('assets/js/height-equal.js') }}"></script>
<script src="{{ asset('assets/js/actions-icon/actions-icon.js') }}"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialisation de DataTable
        $('#quizzes-table').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json" // Langue française
            },
            responsive: true,
            paging: true,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tout"]],
        });
    });
</script>
@endpush

@endsection

