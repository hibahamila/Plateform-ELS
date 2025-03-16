
 {{-- tw hadha --}}
 
 @extends('layouts.admin.master')

 @section('title') Ajouter un Quiz @endsection
 
 @push('css')
     <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone/dropzone.css') }}">
     <link href="{{ asset('assets/css/custom-style.css') }}" rel="stylesheet">
     <!-- CSS de Select2 via CDN -->
     <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
     @if(session()->has('quiz_id'))
         <p>Session quiz_id: {{ session('quiz_id') }}</p>
     @endif
 
     <style>
         /* Personnaliser la croix de fermeture de SweetAlert2 */
         .swal2-close {
             color: red; /* Couleur de la croix en rouge */
             font-size: 40px; /* Taille de la croix */
             background-color: transparent; /* Aucune couleur de fond */
             border: none; /* Aucune bordure */
             position: absolute; /* Permet de positionner la croix de manière absolue */
             top: 10px; /* Distance par rapport au haut de l'alerte */
             right: 10px; /* Distance par rapport à la droite de l'alerte */
             cursor: pointer; /* Change le curseur en pointeur */
             outline: none; /* Supprime le contour autour de la croix */
         }
 
         /* Optionnel : ajouter un style au survol */
         .swal2-close:hover {
             color: red; /* Garder la couleur rouge au survol */
             background-color: transparent; /* Assurer qu'il n'y a pas de fond au survol */
         }
 
         /* Supprimer les effets de bordure au clic */
         .swal2-close:focus {
             outline: none; /* Enlever l'effet de focus (bordure noire ou bleue) */
             box-shadow: none; /* Supprimer l'ombre au focus */
         }
     </style>
 @endpush
 
 @section('content')
     @component('components.breadcrumb')
         @slot('breadcrumb_title')
             <h3>Ajouter un Quiz</h3>
         @endslot
         <li class="breadcrumb-item">Quiz</li>
         <li class="breadcrumb-item active">Ajouter</li>
     @endcomponent
 
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
                         <div class="form theme-form">
                             <form action="{{ route('quizstore') }}" method="POST" class="needs-validation" novalidate>
                                 @csrf
 
                                 <div class="row">
                                     <div class="col">
                                         <div class="mb-3">
                                             <label class="form-label" for="titre">Titre</label>
                                             <input id="titre" class="form-control" type="text" name="titre" placeholder="Titre" value="{{ old('titre') }}" required />
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
                                             <label class="form-label" for="date_limite">Date Limite</label>
                                             <input id="date_limite" class="form-control" type="date" name="date_limite" value="{{ old('date_limite') }}" required />
                                             <div class="invalid-feedback">Veuillez entrer une date limite valide.</div>
                                         </div>
                                     </div>
                                 </div>
 
                                 <div class="row">
                                     <div class="col">
                                         <div class="mb-3">
                                             <label class="form-label" for="date_fin">Date de Fin</label>
                                             <input id="date_fin" class="form-control" type="date" name="date_fin" value="{{ old('date_fin') }}" required />
                                             <div class="invalid-feedback">Veuillez entrer une date de fin valide.</div>
                                         </div>
                                     </div>
                                 </div>
 
                                 <div class="row">
                                     <div class="col">
                                         <div class="mb-3">
                                             <label class="form-label" for="cours_id">Cours</label>
                                             <select id="cours_id" class="form-select select2-cours" name="cours_id" required>
                                                 <option value="" selected disabled>Choisir un cours</option>
                                                 @foreach($cours as $coursItem)
                                                     <option value="{{ $coursItem->id }}" {{ old('cours_id') == $coursItem->id ? 'selected' : '' }}>
                                                         {{ $coursItem->titre }}
                                                     </option>
                                                 @endforeach
                                             </select>
                                             <div class="invalid-feedback">Veuillez sélectionner un cours valide.</div>
                                         </div>
                                     </div>
                                 </div>
 
                                 <div class="row">
                                     <div class="col">
                                         <div class="mb-3">
                                             <label class="form-label" for="score_minimum">Score Minimum</label>
                                             <input id="score_minimum" class="form-control" type="number" name="score_minimum" placeholder="Score Minimum" value="{{ old('score_minimum') }}" required />
                                             <div class="invalid-feedback">Veuillez entrer un score minimum valide.</div>
                                         </div>
                                     </div>
                                 </div>
 
                                 <div class="row">
                                     <div class="col text-end">
                                         <button class="btn btn-secondary me-3" type="submit" id="submitBtn">Ajouter</button>
                                         <a href="{{ route('quizzes') }}" class="btn btn-danger px-4">Annuler</a>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 
     @push('scripts')
         <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
         <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
         <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
         <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>
         <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
         <script>


    document.addEventListener("DOMContentLoaded", function() {
        // Sélectionner le formulaire
        const form = document.querySelector('form.needs-validation');
        const submitBtn = document.getElementById('submitBtn');

        // Intercepter l'événement de soumission du formulaire
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                form.classList.add('was-validated');
                return;
            }
            
            // Si le formulaire est valide, on le soumet normalement
            // La redirection sera gérée par le contrôleur
        });

        // Vérifier si un quiz_id existe dans la session après la redirection
        let quizId = "{{ session('quiz_id') }}";
        
        if (quizId) {
            // Afficher l'alerte SweetAlert2 après la création du quiz
            Swal.fire({
                title: "Quiz ajouté avec succès !",
                text: "Voulez-vous ajouter une question à ce quiz ?",
                icon: "success",
                showCancelButton: true,
                confirmButtonText: "Oui, ajouter une question",
                cancelButtonText: "Non, revenir à la liste",
                showCloseButton: true,
                customClass: {
                    confirmButton: 'custom-confirm-btn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Rediriger vers la page de création de question avec l'ID du quiz
                    window.location.href = "{{ route('questioncreate') }}?quiz_id=" + quizId;
                } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
                    // Rediriger vers la liste des quizzes si l'utilisateur clique sur "Non"
                    window.location.href = "{{ route('quizzes') }}";
                }
            });
        }
    });



         </script>
     @endpush
 @endsection 
 
 



