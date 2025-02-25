

 @extends('layouts.admin.master')

 @section('title') Ajouter une Question @endsection
 
 @push('css')
     <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
     <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
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
             <h3>Ajouter une Question</h3>
         @endslot
         <li class="breadcrumb-item">Questions</li>
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
 
                         <form action="{{ route('questionstore') }}" method="POST" class="needs-validation" novalidate>
                             @csrf
 
                             <div class="row">
                                 <div class="col">
                                     <div class="mb-3">
                                         <label class="form-label" for="enonce">Enoncé</label>
                                         <input class="form-control" id="enonce" type="text" name="enonce" placeholder="Enoncé" value="{{ old('enonce') }}" required />
                                         <div class="invalid-feedback">Veuillez entrer un énoncé valide.</div>
                                     </div>
                                 </div>
                             </div>
 
                             <div class="row">
                                 <div class="col">
                                     <div class="mb-3">
                                         <label class="form-label" for="quiz_id">Quiz</label>
                              
                                         <select class="form-select select2-quiz"  name="quiz_id" required>
                                             <option value="" selected disabled>Sélectionnez un quiz</option>
                                             @foreach($quizzes as $quiz)
                                                 <option value="{{ $quiz->id }}" {{ old('quiz_id') == $quiz->id ? 'selected' : '' }}>{{ $quiz->titre }}</option>
                                             @endforeach
                                         </select>
                                         <div class="invalid-feedback">Veuillez sélectionner un quiz valide.</div> 
                                     </div>
                                 </div>
                             </div>
 
                             <div class="row">
                                 <div class="col text-end">
                                     <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                     <a href="{{ route('questions') }}" class="btn btn-danger px-4">Annuler</a>
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
     <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
 
  <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>


 @endpush
 
 @endsection
 