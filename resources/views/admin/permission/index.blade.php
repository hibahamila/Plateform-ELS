<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Gestion des Permissions</h5>
        <a  id="open-create-permission-modal" data-create-url="{{ route('admin.permissions.create') }}" class="btn btn-success">Créer une Nouvelle Permission</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="permission-table">  <thead class="table-primary">
                    <tr>
                        <th scope="col">Nom du Permission</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <i class="icofont icofont-edit edit-permission-icon action-icon" data-edit-permission-url="{{ route('admin.permissions.edit', $permission->id) }}" ></i>
                            <i class="icofont icofont-ui-delete delete-permission-icon action-icon" data-delete-permission-url="{{ route('admin.permissions.destroy', $permission->id) }}" data-csrf="{{ csrf_token() }}" style=" color: rgb(204, 28, 28);"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
