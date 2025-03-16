
 @extends('layouts.admin.master')

@section('title') Ajouter une Formation @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter une Formation</h3>
        @endslot
        <li class="breadcrumb-item">Formations</li>
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
                            <form class="needs-validation" action="{{ route('formationstore') }}" method="POST" enctype="multipart/form-data" novalidate >
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="titre">Titre</label>
                                            <input class="form-control" type="text" id="titre" name="titre" placeholder="Titre" value="{{ old('titre') }}" required />
                                            <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea class="form-control" id="description" rows="4" name="description" placeholder="Description" required >{{ old('description') }}</textarea>
                                            <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="duree">Durée (HH:mm)</label>
                                            <input class="form-control" type="text" id="duree" name="duree" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="{{ old('duree') }}" required />
                                            <div class="invalid-feedback">Veuillez entrer la durée au format HH:mm.</div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="type">Type</label>
                                            <input class="form-control" type="text" id="type" name="type" placeholder="Type" value="{{ old('type') }}" required />
                                            <div class="invalid-feedback">Veuillez entrer un type valide.</div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="prix">Prix</label>
                                            <input class="form-control" type="number" id="prix" name="prix" placeholder="Prix" step="0.01" value="{{ old('prix') }}" required />
                                            <div class="invalid-feedback">Veuillez entrer un prix valide.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- champs el 3edi  --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="image">Image</label>
                                            <input class="form-control" type="file" id="image" name="image" accept="image/*" required />
                                            <div class="invalid-feedback">Veuillez télécharger une image valide.</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- champs b dropzone  --}}
                                

                                
                          

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="categorie_id">Catégorie</label>
                                            <select class="form-select select2-categorie" id="categorie_id" name="categorie_id" required>
                                                <option value="" selected disabled>Choisir une catégorie</option>
                                                @foreach($categories as $categorie)
                                                    <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                                        {{ $categorie->titre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Veuillez sélectionner une catégorie valide.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="text-end">
                                            <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                            <button class="btn btn-danger" type="button" onclick="window.location.href='{{ route('formations') }}'">Annuler</button>
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

@push('scripts')
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/select2-init/single-select.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation/form-validation.js') }}"></script>

    {{-- zedtou lel dropzone --}}
    <script>
    
    </script>
    

@endpush

@endsection




