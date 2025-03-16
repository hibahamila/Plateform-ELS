 <div class="card">
    <div class="card-header">
        <h5>Utilisateurs</h5>
    </div>
    <div class="card-block row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="table-responsive">
                <table class="table table-styling" id="user-table">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->roles->isNotEmpty())
                                {{ $user->roles->pluck('name')->implode(', ') }}
                                @else
                                    Aucun rôle
                                @endif
                            </td>
                            <td>
                                <div class="media">
                                    <div class="media-body text-end icon-state switch-outline" style="margin-right: 80px;">
                                        <label class="switch" style="transform: scale(0.7); ">
                                            <input type="checkbox" class="toggle-status" data-user-id="{{ $user->id }}" {{ $user->status === 'active' ? 'checked' : '' }}>
                                            <span class="switch-state bg-primary"></span>
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td>

                                <div class="col-sm-6 col-md-4 col-xl-3">
                                    <i class="fa fa-info-circle edit-user-icon action action-icon" data-editUser-url="{{ route('admin.users.roles', $user->id) }}" style="cursor: pointer;"></i>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-3">
                                    <i class="icofont icofont-ui-delete delete-user-icon action-icon" data-deleteUser-url="{{ route('admin.users.destroy', $user->id) }}" data-csrf="{{ csrf_token() }}" style="cursor: pointer; color: rgb(204, 28, 28);"></i>
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

