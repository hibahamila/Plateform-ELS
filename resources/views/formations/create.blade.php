@extends('layouts.app')

@section('content')
    <h1>Ajouter une formation</h1>

    <!-- Afficher le message de succès -->
    {{-- @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="card">
        
        <form action="{{ route('formations.store') }}" method="POST" class="form theme-form">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <!-- Champ Titre -->
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Titre</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="titre" type="text" name="titre" placeholder="Titre" value="{{ old('titre') }}" />
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="5" cols="5" name="description" placeholder="Description">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <br>

                        <!-- Champ Durée -->
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Durée (HH:mm)</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="duree" type="text" name="duree" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="{{ old('duree') }}" />
                            </div>
                        </div>

                        <!-- Champ Type -->
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="type" type="text" name="type" placeholder="Type" value="{{ old('type') }}" />
                            </div>
                        </div>

                        <!-- Champ Prix -->
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Prix</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="prix" type="number" name="prix" placeholder="Prix" step="0.001" value="{{ old('prix') }}" />
                            </div>
                        </div>

                        <!-- Champ Catégorie -->
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Catégorie</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="categorie_id" name="categorie_id">
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>{{ $categorie->titre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons de soumission et d'annulation -->
            <div class="card-footer text-end">
            <div class="col-sm-9 offset-sm-3">
                <button class="btn btn-success" type="submit">Ajouter</button>
                <input class="btn btn-light" type="reset" value="Annuler" />
    </div>
</div>
            </div>
        </form>
    </div>
@endsection