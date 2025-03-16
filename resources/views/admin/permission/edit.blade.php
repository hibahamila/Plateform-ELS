<div class="modal fade" id="EditPermissionModal" tabindex="-1" role="dialog" aria-labelledby="editPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPermissionModalLabel">Modifier une permission</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.permissions.update',$permission->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-2">
                        <div class="mb-3 col-md-12">
                            <label for="permissionName">Nom du permission</label>
                            <input class="form-control" type="text" id="permissionName" name="name" required value="{{ old('name', $permission->name) }}" autocomplete="off">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <button class="btn btn-secondary" type="submit">Modifier</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>
