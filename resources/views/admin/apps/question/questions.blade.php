{{-- 

@extends('layouts.admin.master')

@section('title') Liste des Questions
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/table.css') }}">

@endpush

@section('content')
@component('components.breadcrumb')
    @slot('breadcrumb_title')
        <h3>Liste des Questions</h3>
    @endslot
    <li class="breadcrumb-item">Questions</li>
    <li class="breadcrumb-item active">Liste des Questions</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Liste des Questions</h5>
                    <span>Ce tableau affiche la liste des questions disponibles. Vous pouvez rechercher, trier et paginer les données.</span>
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
                                        <a class="btn btn-primary custom-btn" href="{{ route('questioncreate') }}">
                                            <i class="fa fa-plus"></i> Ajouter une Question
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table pour afficher la liste des questions -->
                    <div class="table-responsive">
                        <table class="display" id="questions-table">
                            <thead>
                                <tr>
                                    <th>Énoncé</th>
                                    <th>Quiz</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($questions as $question)
                                    <tr>
                                        <td>{{ $question->enonce }}</td>
                                        <td>{{ $question->quiz->titre }}</td>
                                        <td>
                                            <i class="icofont icofont-edit edit-icon action-icon" data-edit-url="{{ route('questionedit', $question->id) }}" style="cursor: pointer;"></i>
                                            <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="{{ route('questiondestroy', $question->id) }}" data-csrf="{{ csrf_token() }}" style="cursor: pointer; color: rgb(204, 28, 28);"></i>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- Inclure les scripts de DataTables -->
     <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
     
     <!-- Inclure le fichier JavaScript pour l'initialisation -->
     <script src="{{ asset('assets/js/datatables/datatables.js') }}"></script>
    
@endpush

@endsection --}}


@extends('layouts.admin.master')

@section('title') Liste des Questions
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/table.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
    @slot('breadcrumb_title')
        <h3>Liste des Questions</h3>
    @endslot
    <li class="breadcrumb-item">Questions</li>
    <li class="breadcrumb-item active">Liste des Questions</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Questions Disponibles</h5>
                    <span>Ce tableau affiche la liste des questions disponibles.</span>
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
                        <a class="btn btn-primary custom-btn" href="{{ route('questioncreate') }}">
                            <i class="icofont icofont-plus-square"></i> Ajouter une Question
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="display dataTable" id="questions-table">
                            <thead>
                                <tr>
                                    <th>Énoncé</th>
                                    <th>Quiz</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td>{{ $question->enonce }}</td>
                                        <td>{{ $question->quiz->titre }}</td>
                                        <td>
                                            <i class="icofont icofont-edit edit-icon action-icon" data-edit-url="{{ route('questionedit', $question->id) }}" style="cursor: pointer;"></i>
                                            <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="{{ route('questiondestroy', $question->id) }}" data-csrf="{{ csrf_token() }}" style="cursor: pointer;"></i>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- Inclure les scripts de DataTables -->
     <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
     
     <!-- Inclure le fichier JavaScript pour l'initialisation -->
     <script src="{{ asset('assets/js/datatables/datatables.js') }}"></script>
    
@endpush
@endsection
