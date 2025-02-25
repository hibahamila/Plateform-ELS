

@extends('layouts.admin.master')

@section('title') Liste des Cours
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">
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
            <h3>Liste des Cours</h3>
        @endslot
        <li class="breadcrumb-item">Apps</li>
        <li class="breadcrumb-item active">Liste des Cours</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Cours Disponibles</h5>
                    </div>
                    <div class="card-body">
                        <!-- Message de succès si le cours a été ajouté -->
                        @if(session('success'))
                            <div class="alert alert-success" id="success-message">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Message de succès si le cours a été supprimé -->
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
                                            <a class="btn btn-primary" href="{{ route('courscreate') }}"> <i data-feather="plus-square"></i> Ajouter un cours</a>
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
                                    <th>Date debut</th>
                                    <th>Date fin</th>
                                    <th>Professeur</th>
                                    <th>Formation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($cours) && count($cours) > 0)
                                    @foreach($cours as $cour)
                                        <tr>
                                            <td>{{ $cour->titre }}</td>
                                            <td>{{ $cour->description }}</td>
                                            <td>{{ $cour->date_debut }}</td>
                                            <td>{{ $cour->date_fin }}</td>
                                            <td>{{ $cour->user ? $cour->user->name : 'Aucun utilisateur' }}</td>
                                            <td>{{ $cour->formation ? $cour->formation->titre : 'Aucune formation' }}</td>
                                            <td>
                                                {{-- <a href="{{ route('coursshow', $cour->id) }}" class="btn btn-info btn-sm">Voir</a> --}}
                                                {{-- <a href="{{ route('coursedit', $cour->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                                <form action="{{ route('coursdestroy', $cour->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">Supprimer</button>
                                                </form> --}}

                                                <i class="icofont icofont-edit edit-icon action-icon" data-edit-url="{{ route('coursedit', $cour->id) }}" style="cursor: pointer;"></i>
                                                
                                                    <!-- Icône Supprimer -->
                                                    <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="{{ route('coursdestroy', $cour->id) }}" data-csrf="{{ csrf_token() }}" style="cursor: pointer; color: rgb(204, 28, 28);"></i>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">Aucun cours disponible.</td>
                                    </tr>
                                @endif
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
@endsection
