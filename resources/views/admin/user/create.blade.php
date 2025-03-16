<div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouvel utilisateur</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-bookmark needs-validation" id="createUserForm" method="POST" action="{{ route('admin.users.store') }}" novalidate>
                    @csrf
                    <div class="row g-2">
                        <div class="mb-3 col-md-12 mt-0">
                            <label for="first_name">Prénom</label>
                            <input class="form-control" id="first_name" name="name" type="text" required placeholder="Prénom" autocomplete="off" />
                            <div class="invalid-feedback">Veuillez entrer un prénom.</div>
                        </div>
                        <div class="mb-3 col-md-12 mt-0">
                            <label for="last_name">Nom</label>
                            <input class="form-control" id="last_name" name="lastname" type="text" required placeholder="Nom" autocomplete="off" />
                            <div class="invalid-feedback">Veuillez entrer un nom.</div>
                        </div>
                        <div class="mb-3 col-md-12 mt-0">
                            <label for="email">Adresse Email</label>
                            <input class="form-control" id="email" name="email" type="email" required autocomplete="off" />
                            <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
                        </div>
                        <div class="mb-3 col-md-12 mt-0">
                            <label for="role_id">Rôle</label>
                            <select class="form-control" id="role_id" name="roles" required>
                                <option value="" disabled selected>Sélectionnez un rôle</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Veuillez sélectionner un rôle.</div>
                        </div>
                        <!-- Champ caché pour le mot de passe généré automatiquement -->
                        <input type="hidden" name="password_auto_generate" value="1">
                    </div>
                    <button class="btn btn-secondary" type="submit">Enregistrer</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>
