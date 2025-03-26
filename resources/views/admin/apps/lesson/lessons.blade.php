{{-- 
@extends('layouts.admin.master')

@section('title') Liste des Leçons
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/table.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-style.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                    <div class="alert alert-danger" id="success-message" style="display: none;">
                    </div>

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
                        <table class=" dataTable display" id="lessons-table">
                            <thead>
                                <tr>
                                    <th>title</th>
                                    <th>Description</th>
                                    <th>Durée</th>
                                    <th>Chapitre</th>
                                    <th>Fichier</th>
                                    <th>Liens</th>
                                    <th class="actions-column"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                @foreach ($lessons as $lesson)
                                    <tr>
                                        <td>{{ $lesson->title }}</td>
                                        <td>{{ $lesson->description }}</td>
                                        <td>{{ $lesson->duration }}</td>
                                        <td>{{ $lesson->chapitre->title ?? 'Non attribué' }}</td>
                                        <td>
                                            @if ($lesson->file_path)
                                                <a href="{{ asset('storage/' . $lesson->file_path) }}" target="_blank">Voir le fichier</a>
                                            @else
                                                Aucun fichier
                                            @endif
                                        </td>
                                        <td>
                                            @if ($lesson->link)
                                                @php
                                                    // Décoder les liens JSON ou les traiter comme une chaîne simple
                                                    $links = is_array(json_decode($lesson->link)) ? json_decode($lesson->link) : [$lesson->link];
                                                @endphp
                                                @foreach($links as $link)
                                                    @php
                                                        $trimmedLink = trim($link);
                                                        // Supprimer les guillemets et les caractères d'échappement
                                                        $cleanLink = str_replace(['\\/', '"', "'"], '/', $trimmedLink);
                                                        $formattedLink = Str::startsWith($cleanLink, ['http://', 'https://']) ? $cleanLink : 'http://' . $cleanLink;
                                                    @endphp
                                                    <div><a href="{{ $formattedLink }}" target="_blank">{{ $cleanLink }}</a></div>
                                                @endforeach
                                            @else
                                                Aucun lien
                                            @endif
                                        </td>
                                        <td class="actions-column">
                                            <div class="dropdown float-right">
                                                <button class="btn btn-sm btn-light dropdown-toggle no-caret" type="button" id="actionMenu{{ $lesson->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actionMenu{{ $lesson->id }}">
                                                    <a class="dropdown-item" href="{{ route('lessonedit', $lesson->id) }}">
                                                        <i class="icofont icofont-edit"></i> Modifier
                                                    </a>

                                                    <a class="dropdown-item text-danger delete-action" href="javascript:void(0);" data-delete-url="{{ route('lessondestroy', $lesson->id) }}" data-type="lesson" data-name="{{ $lesson->title }}" data-csrf="{{ csrf_token() }}">
                                                        <i class="icofont icofont-ui-delete"></i> Supprimer
                                                    </a>
                                                </div>
                                            </div>
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
    
<script src="{{ asset('assets/js/dropdown/dropdown.js') }}"></script>
<script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
<script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
<script src="{{ asset('assets/js/custom-card/custom-card.js') }}"></script>
<script src="{{ asset('assets/js/height-equal.js') }}"></script>
<script src="{{ asset('assets/js/datatables/datatables.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

@endpush
@endsection --}}







@extends('layouts.admin.master')

@section('title') Liste des Leçons
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/MonCss/table.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/MonCss/custom-style.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                    <div class="alert alert-danger" id="success-message" style="display: none;">
                    </div>

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
                        <table class=" dataTable display" id="lessons-table">
                            <thead>
                                <tr>
                                    <th>title</th>
                                    <th>Description</th>
                                    <th>Durée</th>
                                    <th>Chapitre</th>
                                    <th>Fichier</th>
                                    <th>Liens</th>
                                    <th class="actions-column"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                @foreach ($lessons as $lesson)
                                    <tr>
                                        <td>{{ $lesson->title }}</td>
                                        <td>{!! $lesson->description !!}</td> <!-- Modification ici -->

                                        <td>{{ $lesson->duration }}</td>
                                        <td>{{ $lesson->chapitre->title ?? 'Non attribué' }}</td>
                                        <td>
                                            {{-- @if ($lesson->file_path)
                                                <a href="{{ asset('storage/' . $lesson->file_path) }}" target="_blank">Voir le fichier</a>
                                            @else
                                                Aucun fichier
                                            @endif --}}
                                            @php
                                            // Décoder le champ file_path (qui est un tableau JSON)
                                            $files = json_decode($lesson->file_path) ?? []; // Utiliser un tableau vide si file_path est null
                                        @endphp
                        
                                        @if (count($files) > 0)
                                            @foreach ($files as $file)
                                                <!-- Afficher un lien pour chaque fichier -->
                                                <a href="{{ asset('storage/' . $file) }}" target="_blank">{{ basename($file) }}</a><br>
                                            @endforeach
                                        @else
                                            Aucun fichier
                                        @endif
                                        </td>
                                        <td>
                                            @if ($lesson->link)
                                                @php
                                                    // Décoder les liens JSON ou les traiter comme une chaîne simple
                                                    $links = is_array(json_decode($lesson->link)) ? json_decode($lesson->link) : [$lesson->link];
                                                @endphp
                                                @foreach($links as $link)
                                                    @php
                                                        $trimmedLink = trim($link);
                                                        // Supprimer les guillemets et les caractères d'échappement
                                                        $cleanLink = str_replace(['\\/', '"', "'"], '/', $trimmedLink);
                                                        $formattedLink = Str::startsWith($cleanLink, ['http://', 'https://']) ? $cleanLink : 'http://' . $cleanLink;
                                                    @endphp
                                                    <div><a href="{{ $formattedLink }}" target="_blank">{{ $cleanLink }}</a></div>
                                                @endforeach
                                            @else
                                                Aucun lien
                                            @endif
                                        </td>
                                        <td class="actions-column">
                                            <div class="dropdown float-right">
                                                <button class="btn btn-sm btn-light dropdown-toggle no-caret" type="button" id="actionMenu{{ $lesson->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actionMenu{{ $lesson->id }}">
                                                    <a class="dropdown-item" href="{{ route('lessonedit', $lesson->id) }}">
                                                        <i class="icofont icofont-edit"></i> Modifier
                                                    </a>

                                                    <a class="dropdown-item text-danger delete-action" href="javascript:void(0);" data-delete-url="{{ route('lessondestroy', $lesson->id) }}" data-type="lesson" data-name="{{ $lesson->title }}" data-csrf="{{ csrf_token() }}">
                                                        <i class="icofont icofont-ui-delete"></i> Supprimer
                                                    </a>
                                                </div>
                                            </div>
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
    
<script src="{{ asset('assets/js/MonJs/dropdown/dropdown.js') }}"></script>
<script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
<script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
<script src="{{ asset('assets/js/custom-card/custom-card.js') }}"></script>
<script src="{{ asset('assets/js/height-equal.js') }}"></script>
<script src="{{ asset('assets/js/datatables/datatables.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

@endpush
@endsection


