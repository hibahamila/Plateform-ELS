{{-- 


@extends('layouts.admin.master')

@section('title') Ajouter un Chapitre @endsection

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
    <link href="{{ asset('assets/css/custom-style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/SweatAlert2.css') }}" rel="stylesheet">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter un Chapitre</h3>
        @endslot
        <li class="breadcrumb-item">Chapitres</li>
        <li class="breadcrumb-item active">Ajouter</li>
    @endcomponent

    @php
        $selectedCoursId = request()->query('cours_id', old('cours_id'));
    @endphp

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

                        <form id="create-chapitre-form" class="needs-validation" action="{{ route('chapitrestore') }}" method="POST" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Titre</label>
                                        <input class="form-control" type="text" name="title" placeholder="Titre" value="{{ old('title') }}" required />
                                        <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="description">Description</label>
                                        <textarea id="description" class="form-control" rows="4" name="description" placeholder="Description" required>{{ old('description') }}</textarea>
                                        <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Durée (HH:mm)</label>
                                        <input class="form-control" type="text" name="duration" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="{{ old('duration') }}" required />
                                        <div class="invalid-feedback">Veuillez entrer la durée au format HH:mm.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Cours</label>
                                        @if ($selectedCoursId && request()->has('cours_id'))
                                            <!-- Si un cours est sélectionné via l'URL (venant d'un cours existant) -->
                                            <input type="text" class="form-control bg-light selected-course-bg" value="{{ $cours->find($selectedCoursId)->title }}" readonly />
                                            <input type="hidden" name="cours_id" value="{{ $selectedCoursId }}">
                                        @else
                                            <!-- Si aucun cours n'est sélectionné OU si on arrive sur cette page après l'alerte -->
                                            <select class="form-select select2-cours" name="cours_id" required>
                                                <option value="" disabled {{ !$selectedCoursId ? 'selected' : '' }}>Choisir un cours</option>
                                                @foreach($cours as $coursItem)
                                                    <option value="{{ $coursItem->id }}" {{ $selectedCoursId == $coursItem->id ? 'selected' : '' }} class="{{ $selectedCoursId == $coursItem->id ? 'selected-course-bg' : '' }}">
                                                        {{ $coursItem->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Veuillez sélectionner un cours valide.</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                    <a href="{{ route('chapitres') }}" class="btn btn-danger px-4">Annuler</a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Appliquer le fond bleu à l'option sélectionnée dans le dropdown de Select2
            const coursSelect = document.querySelector('.select2-cours');

            if (coursSelect) {
                // Appliquer le fond bleu à l'option sélectionnée au chargement de la page
                const selectedOption = coursSelect.options[coursSelect.selectedIndex];
                if (selectedOption && selectedOption.value) {
                    selectedOption.classList.add('selected-course-bg');
                }

                // Appliquer le fond bleu à l'option sélectionnée lorsqu'elle change
                coursSelect.addEventListener('change', function() {
                    // Supprimer la classe de l'ancienne option sélectionnée
                    const previousSelectedOption = coursSelect.querySelector('.selected-course-bg');
                    if (previousSelectedOption) {
                        previousSelectedOption.classList.remove('selected-course-bg');
                    }

                    // Ajouter la classe à la nouvelle option sélectionnée
                    const newSelectedOption = coursSelect.options[coursSelect.selectedIndex];
                    if (newSelectedOption && newSelectedOption.value) {
                        newSelectedOption.classList.add('selected-course-bg');
                    }
                });
            }

            // Gestion de l'alerte après l'ajout d'un chapitre
            let chapitreId = "{{ session('chapitre_id') }}";

            if (chapitreId) {
                Swal.fire({
                    title: "Chapitre ajouté avec succès !",
                    text: "Voulez-vous ajouter une lesson à ce chapitre ?",
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonText: "Oui, ajouter une lesson",
                    cancelButtonText: "Non, revenir à la liste",
                    showCloseButton: true, // Activer la croix de fermeture
                    customClass: {
                        confirmButton: 'custom-confirm-btn' // Personnaliser le bouton "Oui"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('lessoncreate') }}?chapitre_id=" + chapitreId;
                    } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = "{{ route('chapitres') }}";
                    }
                    // Si l'utilisateur clique sur la croix, ne rien faire (rester sur la même page)
                });
            }
        });
    </script>
@endpush

@endsection

 --}}









 @extends('layouts.admin.master')

 @section('title') Ajouter un Chapitre @endsection
 
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
             <h3>Ajouter un Chapitre</h3>
         @endslot
         <li class="breadcrumb-item">Chapitres</li>
         <li class="breadcrumb-item active">Ajouter</li>
     @endcomponent --}}
 
     @php
         $selectedCoursId = request()->query('cours_id', old('cours_id'));
     @endphp
 
     <div class="container-fluid">
         <div class="row">
             <div class="col-sm-12">
                 <div class="card">
                     <div class="card-header pb-0">
                         <h5>Nouveau chapitre</h5>
                         <span>Complétez les informations pour créer un nouveau chapitre</span>
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
 
                         <div class="form theme-form">
                             <form id="create-chapitre-form" class="needs-validation" action="{{ route('chapitrestore') }}" method="POST" novalidate>
                                 @csrf
                                 <!-- Titre -->
                                 <div class="mb-3 row">
                                     <label class="col-sm-2 col-form-label">Titre <span class="text-danger">*</span></label>
                                     <div class="col-sm-10">
                                         <div class="input-group">
                                             <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                             <input class="form-control" type="text" name="title" placeholder="Titre" value="{{ old('title') }}" required />
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
                                             <textarea id="description" class="form-control" rows="4" name="description" placeholder="Description" required>{{ old('description') }}</textarea>
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
                                             <input class="form-control" type="text" name="duration" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="{{ old('duration') }}" required />
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
                                                 @if ($selectedCoursId && request()->has('cours_id'))
                                                     <!-- Si un cours est sélectionné via l'URL (venant d'un cours existant) -->
                                                     <input type="text" class="form-control bg-light selected-course-bg" value="{{ $cours->find($selectedCoursId)->title }}" readonly />
                                                     <input type="hidden" name="cours_id" value="{{ $selectedCoursId }}">
                                                 @else
                                                     <!-- Si aucun cours n'est sélectionné OU si on arrive sur cette page après l'alerte -->
                                                     <select class="form-select select2-cours" name="cours_id" required>
                                                         <option value="" disabled {{ !$selectedCoursId ? 'selected' : '' }}>Choisir un cours</option>
                                                         @foreach($cours as $coursItem)
                                                             <option value="{{ $coursItem->id }}" {{ $selectedCoursId == $coursItem->id ? 'selected' : '' }} class="{{ $selectedCoursId == $coursItem->id ? 'selected-course-bg' : '' }}">
                                                                 {{ $coursItem->title }}
                                                             </option>
                                                         @endforeach
                                                     </select>
                                                 @endif
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
                                                 <i class="fa fa-save"></i> Ajouter
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
 @endsection
 
 @push('scripts')
     <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
     <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
     <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
     <script src="{{ asset('assets/js/MonJs/select2-init/single-select.js') }}"></script>
     <script src="{{ asset('assets/js/MonJs/form-validation/form-validation.js') }}"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="{{ asset('assets/js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
     <script src="{{ asset('assets/js/description/description.js') }}"></script>
     <script src="https://cdn.tiny.cloud/1/ofuiqykj9zattk5odkx0o1t79jxdfcb5eeuemjgcdtb1s95t/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
     <script>
         document.addEventListener("DOMContentLoaded", function() {
             // Appliquer le fond bleu à l'option sélectionnée dans le dropdown de Select2
             const coursSelect = document.querySelector('.select2-cours');
 
             if (coursSelect) {
                 // Appliquer le fond bleu à l'option sélectionnée au chargement de la page
                 const selectedOption = coursSelect.options[coursSelect.selectedIndex];
                 if (selectedOption && selectedOption.value) {
                     selectedOption.classList.add('selected-course-bg');
                 }
 
                 // Appliquer le fond bleu à l'option sélectionnée lorsqu'elle change
                 coursSelect.addEventListener('change', function() {
                     // Supprimer la classe de l'ancienne option sélectionnée
                     const previousSelectedOption = coursSelect.querySelector('.selected-course-bg');
                     if (previousSelectedOption) {
                         previousSelectedOption.classList.remove('selected-course-bg');
                     }
 
                     // Ajouter la classe à la nouvelle option sélectionnée
                     const newSelectedOption = coursSelect.options[coursSelect.selectedIndex];
                     if (newSelectedOption && newSelectedOption.value) {
                         newSelectedOption.classList.add('selected-course-bg');
                     }
                 });
             }
 
             // Gestion de l'alerte après l'ajout d'un chapitre
             let chapitreId = "{{ session('chapitre_id') }}";
 
             if (chapitreId) {
                 Swal.fire({
                     title: "Chapitre ajouté avec succès !",
                     text: "Voulez-vous ajouter une lesson à ce chapitre ?",
                     icon: "success",
                     showCancelButton: true,
                     confirmButtonText: "Oui, ajouter une lesson",
                     cancelButtonText: "Non, revenir à la liste",
                     showCloseButton: true, // Activer la croix de fermeture
                     customClass: {
                         confirmButton: 'custom-confirm-btn' // Personnaliser le bouton "Oui"
                     }
                 }).then((result) => {
                     if (result.isConfirmed) {
                         window.location.href = "{{ route('lessoncreate') }}?chapitre_id=" + chapitreId;
                     } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
                         window.location.href = "{{ route('chapitres') }}";
                     }
                     // Si l'utilisateur clique sur la croix, ne rien faire (rester sur la même page)
                 });
             }
         });
     </script>
 @endpush