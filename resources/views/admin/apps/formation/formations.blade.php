
   @extends('layouts.admin.master')

@section('title')
    Liste des Formations {{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
    <style>
        #success-message, #delete-message, #create-message {
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

        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
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
            <h3>Liste des Formations</h3>
        @endslot
        <li class="breadcrumb-item">Apps</li>
        <li class="breadcrumb-item active">Liste des Formations</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row project-cards">
            <div class="col-md-12 project-list">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6 p-0">
                            <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i data-feather="target"></i>All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><i data-feather="check-circle"></i>Published</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"><i data-feather="info"></i>Upublished</a>
                                </li>
                               
                            </ul>
                        </div>
                        <div class="col-md-6 p-0">
                            <div class="form-group mb-0 me-0"></div>
                            <a class="btn btn-primary custom-btn" href="{{ route('formationcreate') }}">
                                <i data-feather="plus-square"></i>Ajouter une formation
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        {{-- Messages de succès, création, et suppression --}}
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

                        @if(session('create'))
                            <div class="alert alert-info" id="create-message">
                                {{ session('create') }}
                            </div>
                        @endif

                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                <div class="row">
                                    @foreach($formations as $formation)
                                        <div class="col-xxl-4 col-lg-6">
                                            <div class="project-box">
                                                <span class="badge badge-primary">Published</span>
                                                <h6>{{ $formation->titre }}</h6>
                                                <p>{{ $formation->description }}</p>
                                                <div class="row details">
                                                    <div class="col-6"><span>Durée</span></div>
                                                    <div class="col-6 font-primary">{{ $formation->duree }}</div>
                                                    <div class="col-6"><span>Type</span></div>
                                                    <div class="col-6 font-primary">{{ $formation->type }}</div>
                                                    <div class="col-6"><span>Prix</span></div>
                                                    <div class="col-6 font-primary">{{ number_format($formation->prix, 3) }} Dt</div>
                                                    <div class="col-6"><span>Catégorie</span></div>
                                                    <div class="col-6 font-primary">{{ $formation->categorie->titre ?? 'N/A' }}</div>
                                                </div>
                                                {{-- <div class="mt-3">
                                                    <a href="{{ route('formationedit', $formation->id) }}" class="btn btn-warning btn-sm"><i class="icofont icofont-edit"></i>Modifier</a>
                                                    <form action="{{ route('formationdestroy', $formation->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?')"><i class="icofont icofont-ui-delete"></i>Supprimer</button>
                                                    </form>
                                                </div> --}}
                                                 <div class="mt-3">
                                                    <!-- Icône Modifier -->
                                                    <i class="icofont icofont-edit edit-icon action-icon" data-edit-url="{{ route('formationedit', $formation->id) }}" style="cursor: pointer;"></i>
                                                
                                                    <!-- Icône Supprimer -->
                                                    <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="{{ route('formationdestroy', $formation->id) }}" data-csrf="{{ csrf_token() }}" style="cursor: pointer; color: rgb(204, 28, 28);"></i>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                                <div class="row">
                                    <!-- Ajoutez ici les formations en cours -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                                <div class="row">
                                    <!-- Ajoutez ici les formations terminées -->
                                </div>
                            </div>
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

        <script>
            window.onload = function() {
                // Messages de succès, suppression et création
                const successMessage = document.getElementById('success-message');
                const deleteMessage = document.getElementById('delete-message');
                const createMessage = document.getElementById('create-message');

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

                if (createMessage) {
                    createMessage.style.opacity = 1;
                    setTimeout(() => {
                        createMessage.style.transition = 'opacity 0.3s ease';
                        createMessage.style.opacity = 0;
                    }, 2000);
                }
            }
        </script>
    @endpush
@endsection




