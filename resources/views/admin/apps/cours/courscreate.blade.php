

 @extends('layouts.admin.master')

@section('title') Ajouter un Cours @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link href="{{ asset('assets/css/MonCss/custom-style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/MonCss/SweatAlert2.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Nouveau cours</h5>
                        <span>Complétez les informations pour créer un nouveau cours</span>
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
                            <form action="{{ route('coursstore') }}" method="POST" class="needs-validation" novalidate>
                                @csrf

                                <!-- Titre -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Titre <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                            <input class="form-control" type="text" id="title" name="title" placeholder="Titre" value="{{ old('title') }}" required />
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
                                            <textarea class="form-control" id="description" rows="4" name="description" placeholder="Description" required>{{ old('description') }}</textarea>
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                    </div>
                                </div>

                                <!-- Dates de début et de fin -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Date de début <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            <input class="form-control" type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez sélectionner une date de début valide.</div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Date de fin <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            <input class="form-control" type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez sélectionner une date de fin valide.</div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Professeurs <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <div class="col">
                                                <select id="user_id" class="form-select select2-professeur" name="user_id" required>
                                                    <option value="" disabled selected>Sélectionnez un professeur</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">Veuillez sélectionner un professeur valide.</div>
                                    </div>
                                </div>
                                
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Formation <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="input-group-text"><i class="fa fa-book"></i></span>
                                            </div>
                                            <div class="col">
                                                <select id="formation_id" class="form-select select2-formation" name="formation_id" required>
                                                    <option value="" disabled selected>Sélectionner une formation</option>
                                                    @foreach($formations as $formation)
                                                        <option value="{{ $formation->id }}" {{ old('formation_id') == $formation->id ? 'selected' : '' }}>
                                                            {{ $formation->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">Veuillez sélectionner une formation valide.</div>
                                    </div>
                                </div>

                                <!-- Boutons de soumission -->
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end mt-4">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa fa-save"></i> Ajouter
                                            </button>
                                            <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('cours') }}'">
                                                <i class="fa fa-times"></i> Annuler
                                            </button>
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
    <script src="{{ asset('assets/js/MonJs/description/description.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/ofuiqykj9zattk5odkx0o1t79jxdfcb5eeuemjgcdtb1s95t/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>


    <script>
        
        // Gestion de la notification après l'ajout du cours
        let coursId = "{{ session('cours_id') }}";
        if (coursId) {
            Swal.fire({
                title: "Cours ajouté avec succès !",
                text: "Voulez-vous ajouter un chapitre à ce cours ?",
                icon: "success",
                showCancelButton: true,
                confirmButtonText: "Oui, ajouter un chapitre",
                cancelButtonText: "Non, revenir à la liste",
                showCloseButton: true,
                customClass: {
                    confirmButton: 'custom-confirm-btn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('chapitrecreate') }}?cours_id=" + coursId;
                } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
                    window.location.href = "{{ route('cours') }}";
                }
            });
        }
    </script>
@endpush 





























 