@extends('layouts.admin.master')

@section('title') Liste des Questions
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

                    <!-- Bouton pour ajouter une question -->
                    <div class="row project-cards">
                        <div class="col-md-12 project-list">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-6 p-0"></div>
                                    <div class="col-md-6 p-0">
                                        <div class="form-group mb-0 me-0"></div>
                                        <a class="btn btn-primary custom-btn" href="{{ route('questioncreate') }}">
                                            <i class="fa fa-plus"></i> Ajouter une Question
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table pour afficher la liste des questions -->
                    <table class="table table-striped">
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
                                    {{-- <a href="{{ route('questionshow', $question->id) }}" class="btn btn-info btn-sm">Voir</a> --}}
                                    <i class="icofont icofont-edit edit-icon action-icon" data-edit-url="{{ route('questionedit', $question->id) }}" style="cursor: pointer;"></i>
                                    <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="{{ route('questiondestroy', $question->id) }}" data-csrf="{{ csrf_token() }}" style="cursor: pointer; color: rgb(204, 28, 28);"></i>

                                    {{-- <a href="{{ route('questionedit', $question->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('questiondestroy', $question->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette question ?')">Supprimer</button>
                                    </form> --}}
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
<script src="{{ asset('assets/js/prism.js') }}"></script>
<script src="{{ asset('assets/js/clipboard.js') }}"></script>
<script src="{{ asset('assets/js/custom-card.js') }}"></script>
<script src="{{ asset('assets/js/actions-icon/actions-icon.js') }}"></script>
<script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    
@endpush
<!-- Script JavaScript pour l'animation des messages -->
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
@endsection
